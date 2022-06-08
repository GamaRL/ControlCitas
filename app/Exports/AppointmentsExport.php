<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AppointmentsExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        $sheets = [];

        $query = DB::table('appointments as a')
            ->join('schedules as s', 's.id', '=', 'a.schedule_id')
            ->select(DB::raw('MIN(s.date) as min'), DB::raw('MAX(s.date) as max'))
            ->first();


        $min = new Carbon($query->min);
        $max = new Carbon($query->max);

        $min->startOfMonth();
        $max->startOfMonth();

        $tmp = $min->copy();

        while ($max->diffInMonths($tmp, false) <= 0)
        {
            $sheets[] = new AppointmentsPerMonthSheet($tmp->month, $tmp->year);
            $tmp->addMonth();
        }

        return $sheets;
    }
}
