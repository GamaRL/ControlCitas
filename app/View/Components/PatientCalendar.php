<?php

namespace App\View\Components;

use App\Models\Doctor;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use DateTime;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\View\View;

class PatientCalendar extends Component
{
    private Doctor $doctor;
    private DateTime $date;

    /**
     * Create a new component instance.
     *
     * @param Doctor $doctor
     * @param int $add_weeks
     */
    public function __construct(Doctor $doctor, int $addWeeks)
    {
        $this->doctor = $doctor;
        $this->date = Carbon::now()->addWeeks($addWeeks);
    }

    public function render() : View
    {
        $start_week = $this->date->copy()->startOfWeek(CarbonInterface::SUNDAY);

        $week_schedule = Collection::empty();

        for ($hour = 9; $hour <= 19; $hour++) {
            $minutes = ['00', '30'];
            foreach ($minutes as $minute) {
                $hour_schedule = Collection::make();
                for ($i = 0; $i < 7; $i++) {
                    $date = $start_week->copy()->addDays($i);
                    $hours = $this->doctor->schedules()
                        ->where('date', $date->format('Y-m-d'))
                        ->where('hour', $hour . ':' . $minute)
                        ->first();

                    if ($hours !== null && $hours->appointment === null) {
                        if ((new Carbon($hours->getAttribute('date')))->isAfter(Carbon::now()))
                            $hour_schedule->push(collect(['date' => $date->format('Y-m-d'), 'schedule' => $hours]));
                    }
                    else if ($hours !== null && $hours->appointment->patient->user->id === Auth::id())
                        $hour_schedule->push(collect(['date' => $date->format('Y-m-d'), 'schedule' => $hours]));
                    else
                        $hour_schedule->push(collect(['date' => $date->format('Y-m-d'), 'schedule' => null]));
                }
                $hour_schedule = $hour_schedule->mapWithKeys(function ($item) {
                    return [$item['date'] => $item['schedule']];
                });
                $week_schedule->push(['hour' => Str::padLeft($hour, 2, '0') . ':'.$minute, 'schedules' => $hour_schedule]);
            }
        }

        $week_schedule = $week_schedule->mapWithKeys(function ($item) {
            return [$item['hour'] => $item['schedules']];
        });

        return view('components.schedules.calendar', ['week_schedule' => $week_schedule, 'start_week' => $start_week, 'doctor' => $this->doctor]);
    }
}
