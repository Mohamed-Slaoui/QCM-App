<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserRequest;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function addUser(UserRegisterRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => $request->password,
        ]);
        return redirect()->route('home');
    }

    public function logUser(UserRequest $request)
    {
        $valide = $request->validated();

        if (Auth::attempt($valide)) {
            return redirect()->intended(route('home'));
        } else {
            return redirect()->route('login')->withErrors([
                'error' => 'email or password is invalid'
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }



    public function showStudents()
    {
        // $students = User::with(['grades.quiz'])->where('role_id', 2)->get();
        $students = Grade::with('user')->get();

        return view('students', compact('students'));
    }
}
