<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Persons;
use App\Models\Employees;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DefaultAdministrator extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $persons = Persons::create([
            'firstname' => 'admin',
            'middlename' => 'admin',
            'lastname' => 'admin'
        ]);

        $employee = Employees::create([
            'employee_gen_id' => date('y').'0000',
            'person_id' => $persons->id,
            'date_employed' => now()
        ]);

        User::create([
            'employee_id' => $employee->employee_gen_id,
            'username' => $employee->employee_gen_id,
            'password' => Hash::make($employee->employee_gen_id),
            'role' => 1
        ]);
    }
}
