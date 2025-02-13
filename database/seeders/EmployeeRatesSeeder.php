<?php

namespace Database\Seeders;

use App\Models\Employees;
use App\Models\EmployeeRates;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeRatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees = Employees::whereNull('deleted_at')->get();
        $toCreateRates = [];

        foreach ($employees as $employee) {
            array_push($toCreateRates, [
                'employee_id' => $employee->employee_gen_id,
                'employee_title' => 'Technical Support',
                'rate' => 501,
                'ot_rate' => 78,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        EmployeeRates::insert($toCreateRates);
    }
}
