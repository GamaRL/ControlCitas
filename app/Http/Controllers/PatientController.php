<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class PatientController extends Controller
{
    public function create()
    {
        return view('patients.register');
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
            'birth' => 'required|date_format:Y-m-d|before:today',
            'curp' => ['required','string','regex:/^[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$/']
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
            'type' => 'patient'
        ]);

        $user->save();

        $user->patient()->create([
            'curp' => $request->input('curp'),
            'birth' => $request->input('birth')
        ]);

        $user->sendEmailVerificationNotification();

        return redirect(route('home'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return View
     */
    public function edit(int $id) : View
    {
        $user = User::find($id);
        return view('shared.edit_profile')
                ->with('profile','patients')
                ->with('user',$user);
    }
}
