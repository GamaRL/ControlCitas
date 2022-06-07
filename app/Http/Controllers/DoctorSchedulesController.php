<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DoctorSchedulesController extends Controller
{
    public function all(Request $request) : View
    {
        $user = User::find(Auth::id());

        $add_weeks = intval($request->query('add_weeks') ?? 0);
        $doctors = Doctor::all();
        $doctor = Doctor::find($request->query('doctor')) ?? $doctors->first();

        $view = "patients.schedules";

        if ($user->type === 'doctor')
            $view = "doctors.schedules";
        elseif ($user->type === 'receptionist')
            $view = "receptionist.schedules";

        return view($view, [
            'doctors' => $doctors,
            'doctor' => $doctor,
            'add_weeks' => $add_weeks
        ]);
    }

    public function index(Doctor $doctor)
    {
        $doctor = Doctor::first();
        return view('schedules', ['doctors' => $doctor]);
    }
}
