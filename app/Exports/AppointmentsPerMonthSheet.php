<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AppointmentsPerMonthSheet implements FromQuery, WithHeadings, WithStyles, ShouldAutoSize, WithTitle
{
    private int $month;
    private int $year;

    public function __construct(int $month, int $year)
    {
        $this->month = $month;
        $this->year = $year;
    }

    public function query()
    {
        return DB::table('appointments as a')
            ->join('patients', 'a.patient_id', '=', 'patients.id')
            ->join('users as p', 'p.id', '=', 'patients.user_id')
            ->join('doctors', 'a.doctor_id', '=', 'doctors.id')
            ->join('users as d', 'd.id', '=', 'doctors.user_id')
            ->join('schedules as s', 'a.schedule_id', '=', 's.id')
            ->whereMonth('s.date','=', $this->month)
            ->whereYear('s.date', '=', $this->year)
            ->select([
                'd.name as doctor_name',
                'd.first_last_name as doctor_last_name1',
                'd.second_last_name as doctor_last_name2',
                'p.name as patient_name',
                'p.first_last_name as patient_last_name1',
                'p.second_last_name as patient_last_name2',
                's.date',
                's.hour'
            ])
            ->orderBy('a.id');
    }

    public function headings(): array
    {
        return [
            __('Doctor'),
            '',
            '',
            __('Patient'),
            '',
            '',
            __('Date'),
            __('Hour')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]]
        ];
    }

    public function title(): string
    {
        return $this->month.'-'.$this->year;
    }
}
