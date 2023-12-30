<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QCMController extends Controller
{
    public function create(){
        $questions = Question::all();
        return view('qcm',compact('questions'));
    }
}
