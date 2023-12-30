<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function show(){
        $questions = Question::orderBy('id', 'desc')->get();
        
        return view('questions',compact('questions'));
    }

    public function create(QuestionRequest $request){

        Question::create([
            'question' => $request->question,
            'user_id' => $request->user_id,
        ]);

        $questions = Question::orderBy('id', 'desc')->get();
        
        return redirect()->route('questions')->with([
            'questions' => $questions,
            'success' => 'Question created successfully'
        ]);
    }


    public function edit($id){
        $question = Question::find($id);
        $questions = Question::orderBy('id', 'desc')->get();

        return view('questions',compact('questions','question'));
    }

    public function update(QuestionRequest $request, $id){

        $question = Question::find($id);
        $questions = Question::orderBy('id', 'desc')->get();

        $question->update([
            'question' => $request->question,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('questions')->with([
            'questions' => $questions,
            'success' => 'Question updated successfully'
        ]);
        
    }

    public function delete($id){
        $questions = Question::orderBy('id', 'desc')->get();
        $question = Question::find($id);
        $question->delete();

        return redirect()->route('questions')->with([
            'questions' => $questions,
            'success' => 'Question deleted successfully'
        ]);
    }


}
