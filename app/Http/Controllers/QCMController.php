<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Grade;
use App\Models\QCM;
use App\Models\Question;
use Hamcrest\Type\IsDouble;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QCMController extends Controller
{
    public function create()
    {
        $questions = Question::all();
        $quizzes = QCM::all();

        return view('qcm', compact('questions', 'quizzes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'quiz_name' => 'required',
        ]);



        $questions = Question::all();
        $quiz = QCM::create([
            'quiz_name' => $request->input('quiz_name')
        ]);

        foreach ($request->questions as $q) {
            $question_id =  $q['question'];

            $quiz->questions()->attach($question_id);

            foreach ($q['answers'] as $a) {
                $answer = $a['answer'];
                $isCorrect = isset($a['correct']) ? 1 : 0;

                Answer::create([
                    'question_id' => $question_id,
                    'answer' => $answer,
                    'isCorrect' => $isCorrect,
                ]);
            }
        }

        return redirect()->route('create-qcm')->with([
            'questions' => $questions,
            'success' => 'QCM created successfully'
        ]);
    }


    public function passQuiz($id)
    {
        $qcm = QCM::with('questions.answers', 'grades')->find($id);

        $user_id = auth()->user()->id;
        $is_done = Grade::where('user_id', $user_id)
            ->where('q_c_m_id', $id)
            ->first();


        if ($is_done) {
            return redirect()->back()->with([
                'message' => 'You have already taken this quiz!'
            ]);
        } else {


            $quizName = $qcm->quiz_name;

            $quiz_data = [
                'quiz_id' => $id,
                'quiz_name' => $quizName,
                'questions' => $qcm->questions->map(function ($q) {
                    return [
                        'question' => $q->question,
                        'answers' => $q->answers->map(function ($answer) {
                            return [
                                'id' => $answer->id,
                                'answer' => $answer->answer,
                                'isCorrect' => $answer->isCorrect,
                            ];
                        }),
                    ];
                }),
            ];

            return view('quizPage', compact('quiz_data'));
        }
    }


    public function submitQuiz(Request $request)
    {

        $counter = 0;
        if ($request->answers) {
            foreach ($request->answers as $answer) {
                $correctAnswerId = Answer::find($answer)->isCorrect;
                if ($correctAnswerId) {
                    $counter += 1;
                }
            }
        }
        Grade::create([
            'user_id' => $request->user_id,
            'q_c_m_id' => $request->quiz_id,
            'grade' => $counter,
            'isDone' => 1
        ]);

        return redirect()->route('home');
    }

    public function editQuiz($id)
    {

        $qcm = QCM::with('questions.answers')->find($id);
        $questions = Question::all();

        return view('editQuiz', compact('qcm', 'questions'));
    }

    public function updateQuiz(Request $request, $id)
    {

        $qcm = QCM::with('questions.answers')->where('id', $id)->first();

        // dd($qcm->questions[0]->pivot);

        $qcm->update([
            'quiz_name' => $request->quiz_name
        ]);

        $questions = Question::all();
        $quizzes = QCM::all();

        foreach ($qcm->questions as $index => $question) {

            $question->pivot->update([
                'question_id' => $request->questions[$index]['question'],
                'q_c_m_id' => $id
            ]);

            foreach ($question->answers as $i => $answer) {
                $a = Answer::where('question_id',$question->id)->first();
                
                $a->update([
                    'question_id' => $request->questions[$index]['question'],
                    'answer' => $request->questions[$index]['answers'][$i]['answer'],
                    'isCorrect' => isset($request->questions[$index]['answers'][$i]['correct']) ? 1 : 0,
                ]);
            }
        }

        return redirect()->route('create-qcm')->with(['questions', 'quizzes']);
    }
}
