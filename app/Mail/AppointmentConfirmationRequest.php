<?php

namespace App\Mail;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentConfirmationRequest extends Mailable
{
    use Queueable, SerializesModels;

    public string $patient;
    public string $day;
    public string $hour;
    public string $doctor;
    private string $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Appointment $appointment)
    {
        $this->patient = $appointment->patient->user->name
            .' ' . $appointment->patient->user->first_last_name
            .' ' . $appointment->patient->user->second_last_name;
        $this->doctor = $appointment->doctor->user->name
            .' ' . $appointment->doctor->user->first_last_name
            .' ' . $appointment->doctor->user->second_last_name;
        $this->day = (new Carbon($appointment->schedule->date))->format('d/M/Y');
        $this->hour = (new Carbon($appointment->schedule->date))->format('H:i');
        $this->url = route('appointments.confirm', ['appointment' => $appointment->getAttribute('id')]);
        $this->reason = $appointment->reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.solicitud_confirmacion_cita')
                    ->with('patient', $this->patient)
                    ->with('day', $this->day)
                    ->with('hour', $this->hour)
                    ->with('doctor', $this->doctor)
                    ->with('reason', $this->reason)
                    ->with('url', $this->url);
    }
}
