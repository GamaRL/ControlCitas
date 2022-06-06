<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ReceptionistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Recepcionista',
            'first_last_name' => 'Inicial',
            'second_last_name' => 'Del Programa',
            'email' => 'sgcmreminder@gmail.com',
            'telephone' => '5500000000',
            'password' => Hash::make('recepcionista123'),
            'type' => 'receptionist',
            'email_verified_at' => Carbon::now()
        ]);
    }
}
