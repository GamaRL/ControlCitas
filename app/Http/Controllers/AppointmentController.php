<?php

namespace App\Http\Controllers;

use App\Exports\AppointmentsExport;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Schedule;
use App\Mail\AppointmentConfirmationRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AppointmentController extends Controller
{
    public function index(Request $request) {
        $filter = $request->query('filter') ?? 'all';
        $user = User::find(Auth::id());

        if ($user->type !== 'receptionist')
            $query = $user->appointments();
        else
            $query = Appointment::query();

        $list = $query
            ->whereHas('schedule', function (Builder $query) use ($filter) {
                if ($filter === 'upcoming')
                    return $query->where('date', '>=', Carbon::now());
                if ($filter === 'last')
                    return $query->where('date', '<', Carbon::now());
                return $query;
            })
            ->get();

        return view("appointments.list")->with("appointments", $list)
            ->with('whose', $user->getAttribute('type'))
            ->with('filter', $filter);
    }

    public function show(Appointment $appointment){

        $user = User::find(Auth::id());

        return view("appointments.details")->with("appointment", $appointment)
            ->with('whose',$user->getAttribute('type'));
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

    public function sendConfirmReminder($id){
        $appointment = Appointment::find($id);
        if($appointment !== null) {
            $patient = $appointment->patient->user;
            Mail::To($patient->email)
                ->send(new AppointmentConfirmationRequest($appointment));
        }
        return redirect(route('appointments.index'));
    }

    public function confirmAppointment(Appointment $appointment){
        if($appointment->patient->user->id == Auth::id()) {
            $appointment->confirmed_at = Carbon::now();
            $appointment->save();
        }
        return redirect(route('appointments.index'));
    }

    public function attendAppointment(Appointment $appointment, Request $request){
        if ($appointment->doctor->user->id == Auth::id()
            && (new \Carbon\Carbon($appointment->schedule->date.' '.$appointment->schedule->hour))->diffInMinutes(\Carbon\Carbon::now()) <= 60) {
            $appointment->remarks = $request->input("remarks");
            $appointment->treatment = $request->input("treatment");
            $appointment->save();
        }
        return back();
    }

    public function destroy($id)
    {
        $appointment = Appointment::find($id);
        if($appointment !== null && $appointment->patient->user->id == Auth::id()
            && Carbon::now()->diffInDays(new Carbon($appointment->schedule->date.' '.$appointment->schedule->hour)) > 1) {
            $appointment->delete();
        }
        return redirect(route('appointments.index'));
    }

    public function export()
    {
        $user = User::find(Auth::id());
        if ($user->type === 'receptionist')
        {
            $response = Excel::download(new AppointmentsExport(), Carbon::now()->format('d_M_Y').'.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            ob_end_clean();
            return $response;
        }
        throw new HttpException(403);
    }
}
