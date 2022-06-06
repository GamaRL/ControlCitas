<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use PhpParser\Builder;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = [];
        $all = Appointment::all();
        // TODO: Filtrar citas
        $filtered = $all;

        foreach ($filtered as $appointment) {
            $result = new AppointmentResult();
            $doctor = Doctor::find($appointment->doctor_id)->first();
            $doctor = User::find($doctor->user_id)->first();
            $result->doctor = $doctor->name." ".$doctor->first_last_name." ".$doctor->second_last_name;
            $patient = Patient::find($appointment->patient_id)->first();
            $patient = User::find($patient->user_id)->first();
            $result->patient = $patient->name." ".$patient->first_last_name." ".$patient->second_last_name;
            $schedule = Schedule::find($appointment->schedule_id)->first();
            $result->day = $schedule->date;
            $result->hour = $schedule->hour;
            $result->whose = "receptionist";
            array_push($list, $result);
        }
        return view("appointments.list")->with("appointments", $list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(Request $request)
    {
        $doctor = Doctor::findOrFail($request->query('doctor'));

        $schedule = $doctor->schedules()->findOrfail($request->query('schedule'));

        if ($schedule->appointment !== null)
            throw new HttpException(404);


        return view("patients.appointments.create", [
            'doctor' => $doctor,
            'schedule' => $schedule
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        $user = User::find(Auth::id());
        $schedule = Schedule::where('doctor_id', $request->input('doctor_id'))
            ->where('date', $request->input('date'))
            ->where('hour', $request->input('hour'))->first();


        if ($schedule === null || $schedule->appointment === null) {
            $user->appointments()->create([
                'patient' => $user->patient->id,
                'doctor_id' => $request->input('doctor_id'),
                'schedule_id' => $request->input('schedule_id'),
                'reason' => $request->input('reason')
            ]);
        }

        return redirect(route('doctors.schedules.all', [
            'add_weeks' => (new Carbon(Schedule::find($request->input('schedule_id'))->date))->diffInWeeks(Carbon::now())
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

class AppointmentResult {
    public $doctor;
    public $patient;
    public $whose;
    public $day;
    public $hour;
}
