<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DoctorSchedulesController extends Controller
{
    public function all(Request $request) : View
    {
        $add_weeks = intval($request->query('add_weeks') ?? 0);
        $doctors = Doctor::all();
        $doctor = Doctor::find($request->query('doctor')) ?? $doctors->first();


        return view('schedules', [
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
