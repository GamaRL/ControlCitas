<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DoctorSchedulesController extends Controller
{
    public function all() : View
    {
        $doctors = Doctor::all();
        return view('schedules', ['doctors' => $doctors]);
    }

    public function index(Doctor $doctor)
    {
        $doctor = Doctor::first();
        return view('schedules', ['doctors' => $doctor]);
    }
}
