<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function show(){
        $questions = Question::orderBy('id', 'desc')->get();
        
        return view('questions',compact('questions'));
    }

    public function create(Request $request){
        $request->validate([
            'question',
            'user_id',
        ]);

        Question::create([
            'question' => $request->question,
            'user_id' => $request->user_id,
        ]);

        $questions = Question::orderBy('id', 'desc')->get();
        
        return redirect()->route('questions')->with([
            'questions' => $questions
        ]);
    }


    public function edit($id){
        $question = Question::find($id);
        
        return view('questions',compact('question'));
    }
    // public function delete(){
    //     $questions = Question::orderBy('id', 'desc')->get();
        
    //     return view('questions',compact('questions'));
    // }


}
