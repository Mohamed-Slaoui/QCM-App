<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\QCM;
use App\Models\Question;
use Illuminate\Http\Request;

class QCMController extends Controller
{
    public function create()
    {
        $questions = Question::all();
        return view('qcm', compact('questions'));
    }

    public function store(Request $request)
    {
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
        $qcm = QCM::with('questions.answers')->find($id);

        $quizName = $qcm->quiz_name;

        $quiz_data = [
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

    public function submitQuiz(Request $request){
        dd($request->questions);
    }
}
