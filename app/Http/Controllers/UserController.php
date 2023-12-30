<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function addUser(UserRegisterRequest $request){
        User::create([
            'email' => $request->email,
            'role_id'=> $request->role_id,
            'password' => $request->password,
        ]);
        return redirect()->route('home');
    }

    public function logUser(UserRequest $request){
        $valide = $request->validated();

        if (Auth::attempt($valide)) {
            return redirect()->intended(route('home'));
        }else{
            return redirect()->route('login')->withErrors([
                'error' => 'email or password is invalid'
            ]);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }

    // --------------pages--------------------

    public function showUsers(){
        $users = User::where('role_id',2)->get();
        return view('users.usersPage',compact('users'));
    }

    public function myFiles($id=null){

        if ($id !== null) {
            
            $docs = User::with('documents')->findOrFail($id);
            return view('docs.myFiles', compact('docs'));
        } else {
            $docs = User::with('documents')->get();
            return view('docs.adminFiles', compact('docs'));
        }
    }

    public function deleteUser($id){
        $user = User::find($id);

        $user->delete();
        return redirect()->back()->with([
            'success' => 'user has been successfully deleted'
        ]);
    }

}
