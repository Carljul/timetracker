<?php

namespace App\Http\Controllers;

use App\Models\TimeLogs;
use Illuminate\Http\Request;

class TimeLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required'
        ]);

        $rtn = TimeLogsController::store($request->all());

        if ($rtn) {
            return redirect()->back()->with(['msg' => 'Time In']);
        }

        return redirect()->back()->with(['msg' => 'Something went wrong']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TimeLogs  $timeLogs
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $request->validate([
            'employee_id' => 'required'
        ]);

        $params = $request->all();

        $rtn = TimeLogs::where('employee_id', $params['employee_id'])
            ->whereDate('activity_date', now())
            ->exists();

        if ($rtn) {
            return redirect()->back()->with(['withRecord' => true]);
        }

        return redirect()->back()->with(['withRecord' => false]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TimeLogs  $timeLogs
     * @return \Illuminate\Http\Response
     */
    public function edit(TimeLogs $timeLogs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TimeLogs  $timeLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TimeLogs $timeLog)
    {
        $request->validate([
            'employee_id' => 'required'
        ]);

        $rtn = TimeLogsController::updater($request->all(), $timeLog);

        if ($rtn) {
            return redirect()->back()->with(['msg' => 'Time Out`']);
        }

        return redirect()->back()->with(['msg' => 'Something went wrong']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TimeLogs  $timeLogs
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimeLogs $timeLogs)
    {
        //
    }
}
