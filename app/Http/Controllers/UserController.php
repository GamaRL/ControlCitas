<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
        $user = User::find($id);
        if($user !== null){
            $validations = [];
            [
                'second_last_name' => 'required|string|max:120',
                
                'password' => ['required', 'confirmed', Password::min(8)]
            ];
            if($user->email !=  $request->input("email"))
                $validations['email'] = 'required|email|unique:users,email';
            if($user->telephone !=  $request->input("telephone"))
                $validations['telephone'] = 'required|string|regex:/^\d{10}$/';
            //Hash::make($request->input('password'))
            if(!ctype_space($request->input('current_password'))
                    && Hash::make($request->input('current_password')) === Hash::make($user->password))
                        //&& $request->input("new_password") === $request->input("new_password_confirmation"))
                $validations['new_password'] = ['confirmed', Password::min(8)];

            $validator = Validator::make($request->all(), $validations);
    
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator->errors())
                    ->withInput();
            }

            $user->email = $request->input("email");
            $user->telephone = $request->input("telephone");
            $user->save();
        }
        else
            dd("Ups");
        return redirect(route('home'));
    }
}
