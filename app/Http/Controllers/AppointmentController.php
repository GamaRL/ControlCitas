<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

use App\Mail\AppointmentConfirmationRequest;
use Illuminate\Support\Facades\Mail;

use \Datetime;

class AppointmentController extends Controller
{
    private function isUpcoming($day, $hour){
        $date = new DateTime($day." ".$hour);
        $now = new DateTime();

        return $date >= $now;
    } 
    
    public function index() {
        $this->showList("all");
    }

    public function showList($filter)
    {
        $whose = Auth::user()->type;
        $list = [];
        $filteredByType = Appointment::all();
        $filteredByTimeAndType = [];

        

        //Filter by type
        if ($whose == "patient"){
            $filteredByType = Appointment::where('patient_id', Auth::id())->get();
        }
        if ($whose == "doctor"){
            $filteredByType = Appointment::where('doctor_id', Auth::id())->get();
        }

        //dd($filteredByType);
        
        $now = new Datetime();
        $appointment = "";
        //Filter by time        
        $filteredByTimeAndType = $filteredByType;
        if ($filter == "upcoming"){
            $filteredByTimeAndType = [];
            foreach ($filteredByType as $appointment) {
                $dateAppointment = new Datetime($appointment->date." ".$appointment->hour);
                if ( $dateAppointment >= $now ){
                    array_push($filteredByTimeAndType, $appointment);
                }
            }
        }
        if ($filter == "last"){
            $filteredByTimeAndType = [];
            foreach ($filteredByType as $appointment) {
                $dateAppointment = new Datetime($appointment->date." ".$appointment->hour);
                if ( $dateAppointment < $now ){
                    array_push($filteredByTimeAndType, $appointment);
                }
            }
        }

        // Preparing the result list
        foreach ($filteredByTimeAndType as $appointment) {
            $result = new AppointmentResult();
            $doctor = Doctor::find($appointment->doctor_id)->user;
            $result->doctor = $doctor->name." ".$doctor->first_last_name." ".$doctor->second_last_name;
            $patient = Patient::find($appointment->patient_id)->user;
            $result->patient = $patient->name." ".$patient->first_last_name." ".$patient->second_last_name;
            $schedule = Schedule::find($appointment->schedule_id);
            $result->date = $schedule->date;
            $result->hour = $schedule->hour;
            $result->id = $appointment->id;
            array_push($list, $result);
        }

        

        return view("appointments.list")->with("appointments", $list)->with('whose',$whose);
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
                date('h:i a', strtotime($hour)),
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
    public $date;
    public $hour;
}
