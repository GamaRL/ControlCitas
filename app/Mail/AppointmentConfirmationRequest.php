<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentConfirmationRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Solicitud de confirmación de cita";
    public $patient;
    public $day;
    public $hour;
    public $doctor;
    public $id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($patient, $day, $hour, $doctor, $id)
    {
        $this->patient = $patient;
        $this->day = $day;
        $this->hour = $hour;
        $this->doctor = $doctor;
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.solicitud_confirmacion_cita')
                    ->with('patient', $this->patient)
                    ->with('day', $this->day)
                    ->with('hour', $this->hour)
                    ->with('doctor', $this->doctor)
                    ->with('id', $this->id);
    }
}
