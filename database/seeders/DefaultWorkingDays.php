<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WorkingDays;

class DefaultWorkingDays extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $year = 2025;
        $months = [
            ['month' => 'January', 'number' => 1],
            ['month' => 'February', 'number' => 2],
            ['month' => 'March', 'number' => 3],
            ['month' => 'April', 'number' => 4],
            ['month' => 'May', 'number' => 5],
            ['month' => 'June', 'number' => 6],
            ['month' => 'July', 'number' => 7],
            ['month' => 'August', 'number' => 8],
            ['month' => 'September', 'number' => 9],
            ['month' => 'October', 'number' => 10],
            ['month' => 'November', 'number' => 11],
            ['month' => 'December', 'number' => 12],
        ];
        $toSave = [];
        foreach ($months as $month) {
            array_push($toSave, [
                'year' => $year,
                'month_in_number' => $month['number'],
                'month_name' => $month['month'],
                'days' => $this->networkDays($year, $month['number']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        WorkingDays::insert($toSave);

        echo "Saved";
    }

    public function networkDays($year, $month) {
        $startDate = new DateTime("$year-$month-01");
        $endDate = new DateTime("$year-$month-" . $startDate->format('t')); // Last day of the month
        $workdays = 0;

        while ($startDate <= $endDate) {
            // Check if it's a weekday (Monday-Friday)
            if ($startDate->format('N') < 6) {
                $workdays++;
            }
            $startDate->modify('+1 day');
        }

        return $workdays;
    }
}
