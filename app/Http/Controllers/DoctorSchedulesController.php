<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DoctorSchedulesController extends Controller
{
    public function all(Request $request) : View
    {
        $user = User::find(Auth::id());

        $add_weeks = intval($request->query('add_weeks') ?? 0);
        $doctors = Doctor::all();
        if ($doctors->isEmpty())
            throw new HttpException(404);
        $doctor = Doctor::find($request->query('doctor')) ?? $doctors->first();

        $view = "patients.schedules";

        if ($user->type === 'doctor') {
            $doctor = $user->doctor;
            $view = "doctors.schedules";
        }
        elseif ($user->type === 'receptionist')
            $view = "receptionist.schedules";

        return view($view, [
            'doctor' => $doctor,
            'doctors' => $doctors,
            'add_weeks' => $add_weeks
        ]);
    }

    public function store(Doctor $doctor, Request $request)
    {
        if($doctor->user->id !== Auth::id())
            throw new HttpException(404);

        $request->validate([
            'date' => 'required|date|after:today',
            'hour' => 'required|date_format:H:i'
        ]);

        $doctor->schedules()->create([
            'date' => $request->input('date'),
            'hour' => $request->input('hour')
        ]);

        return redirect()->back();
    }

    public function destroy(Doctor $doctor, Schedule $schedule, Request $request)
    {
        if($doctor->user->id !== Auth::id())
            throw new HttpException(404);

        if ($schedule->appointment === null)
            $schedule->delete();

        return redirect()->back();
    }
}
