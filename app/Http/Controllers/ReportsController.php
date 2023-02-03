<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\TimeLogs;
use App\Models\Employees;
use Illuminate\Http\Request;
use App\Exports\ExportReport;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dateFrom = Carbon::now()->startOfMonth();
        $dateTo = Carbon::now()->endOfMonth();
        $params = $request->all();
        // dd($params);
        if (!empty($request->all())) {
            $request->validate([
                'dateFrom' => 'required',
                'dateTo' => 'required'
            ]);

            $dateFrom = Carbon::parse($params['dateFrom']);
            $dateTo = Carbon::parse($params['dateTo']);
        }

        $period = CarbonPeriod::create($dateFrom, $dateTo);
        foreach($period as $date)
        {
            $dates[] = $date->format('Y-m-d');
        }

        // dd($dates, $dateFrom, $dateTo);

        $timelogs = TimeLogs::filter($params);
        $timelogs =  $timelogs->groupBy(function ($item) {
            return $item->activity_date;
        });
        $newTimelog = $timelogs->toArray();
        $updatedTimelog = [];
        for($x = 0; $x < count($dates); $x++) {
            $date = $dates[$x];
            $result = null;
            if (isset($newTimelog[$date])) {
                $updatedTimelog[$date] = collect($newTimelog[$date]);
            } else {
                $updatedTimelog[$date] = collect(null);
            }
        }
        $timelogs = collect($updatedTimelog);

        $employees = Employees::where('isResigned', 0)->where('person_id', '!=', 1)->with('person')->get();
        return view('pages.reports.index', compact('timelogs', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store method is for download
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'dateFrom' => 'required',
            'dateTo' => 'required',
            'employee' => 'required'
        ]);
        $params = $request->all();

        return Excel::download(new ExportReport($params), 'Reports_'.date('Y-m-d').'.xlsx');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
