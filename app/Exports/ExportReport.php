<?php

namespace App\Exports;

use App\Models\TimeLogs;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportReport implements FromCollection, WithHeadings
{
    
    public function __construct($params)
    {
        $this->params = $params;
    }

    public function headings(): array
    {
        return [
           ['Date', 'ID Number', 'Name', 'Time IN', 'Time OUT', 'Undertime', 'Overtime', 'Late'],
        ];
    }

    public function prepareRows($rows)
    {
        $rowToPush = [];
        foreach ($rows as $row) {
            array_push($rowToPush, (object)[
                'Date' => $row->activity_date,
                'ID Number' => $row->employee_id,
                'Name' => $row->employee->person->fullname,
                'Time IN' => $row->time_in,
                'Time OUT' => $row->time_out,
                'Undertime' => $row->undertime,
                'Overtime' => $row->overtime,
                'Late' => $row->late,
            ]);
        }

        return $rowToPush;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Timelogs::whereIn('employee_id', $this->params['employee'])
            ->whereBetween('activity_date', [date($this->params['dateFrom']), date($this->params['dateTo'])])
            ->with('employee')
            ->get();
    }
}
