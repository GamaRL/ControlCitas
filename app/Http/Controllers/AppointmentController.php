<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Mail\AppointmentConfirmationRequest;
use Illuminate\Support\Facades\Mail;

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
            $result->date = $schedule->date;
            $result->hour = $schedule->hour;
            $result->whose = "receptionist";
            $result->id = $appointment->id;
            array_push($list, $result);
        }
        return view("appointments.list")->with("appointments", $list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function sendConfirmReminder($id){
        $appointment = Appointment::find($id);
        $patient = $appointment->patient->user;
        $doctor = $appointment->doctor->user;
        $schedule = $appointment->schedule;
        $day = $schedule->date;
        $hour = $schedule->hour;
        Mail::To($patient->email)
            ->send(new AppointmentConfirmationRequest(
                $patient->name." ".$patient->first_last_name." ".$patient->second_last_name,
                date('d-M-Y', strtotime($day)),
                date('h a', strtotime($hour)),
                $doctor->name." ".$doctor->first_last_name." ".$doctor->second_last_name
                )
            );
        return redirect(route('appointments.index'));
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
     * @param  \Illuminate\Http\Request  $request
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
    public $id;
    public $doctor;
    public $patient;
    public $whose;
    public $date;
    public $hour;
}
