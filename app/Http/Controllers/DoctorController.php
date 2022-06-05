<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class DoctorController extends Controller
{
    public function create() : View
    {
        return view('doctors.register');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:120',
            'first_last_name' => 'required|string|max:120',
            'second_last_name' => 'required|string|max:120',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
            'telephone' => 'required|string|regex:/^\d{10}$/',
            'speciality' => 'required|in:OTOLARYNGOLOGY,AUDIOMETRY',
            'professional_license' => 'required|string|regex:/^\d{7,8}$/|unique:doctors,professional_license'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator->errors())
                ->withInput();
        }

        $user = new User([
            'name' => $request->input('name'),
            'first_last_name' => $request->input('first_last_name'),
            'second_last_name' => $request->input('second_last_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'telephone' => $request->input('telephone'),
            'type' => 'doctor'
        ]);

        $user->save();

        $user->doctor()->create([
            'professional_license' => $request->input('professional_license'),
            'speciality' => $request->input('speciality')
        ]);

        $user->sendEmailVerificationNotification();

        return redirect(route('home'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('shared.edit_profile')
                ->with('profile','patients')
                ->with('user',$user);
    }
}
