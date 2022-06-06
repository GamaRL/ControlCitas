<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(){
        $id = Auth::id();
        $user = User::find($id);
        if($user == null)
            return redirect(route('home'));
        return view('shared.view_profile')
                ->with('user',$user);
    }

    public function edit()
    {
        $id = Auth::id();
        $user = User::find($id);
        if($user == null)
            return redirect(route('home'));
        return view('shared.edit_profile')
                ->with('user',$user);
    }

    public function update(Request $request){
        $id = Auth::id();
        $user = User::findOrFail($id);


        $validations = [];

        if($user->email !=  $request->input("email"))
            $validations['email'] = 'required|email|unique:users,email';
        if($user->telephone !=  $request->input("telephone"))
            $validations['telephone'] = 'required|string|regex:/^\d{10}$/';
        if($request->filled('new_password')) {
            if (!Hash::check($request->input('current_password'), $user->password)) {
                return back()->withErrors([__('Your current password doesn\'t match')])->withInput()->exceptInput('current_password');
            }
            $validations['new_password'] = ['confirmed', Password::min(8)];
        }

        $validator = Validator::make($request->all(), $validations);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator->errors())
                ->withInput()
                ->exceptInput('current_password', 'new_password', 'new_password_confirmation');
        }

        if ($user->email !== $request->input('email')) {
            $user->email = $request->input("email");
            $user->email_verified_at = null;
            $user->sendEmailVerificationNotification();
        }
        $user->telephone = $request->input("telephone");

        if (!ctype_space($request->input('new_password')))
            $user->password = Hash::make($request->input('new_password'));
        $user->save();
        return redirect(route('home'));
    }
}
