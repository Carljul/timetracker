<?php

namespace App\Http\Controllers;

use App\Models\TimeLogs;
use App\Models\Employees;
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

        $rtn = TimeLogs::store($request->all());

        return redirect()->back()->with(!empty($rtn) ? 'success' : 'error', [!empty($rtn) ? $rtn : 'Something went wrong', !empty($rtn) ? 'success' : 'danger']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TimeLogs  $timeLogs
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        $request->validate([
            'employee_id' => 'required'
        ]);

        $params = $request->all();

        $rtn = TimeLogs::where('employee_id', $params['employee_id'])
            ->whereDate('activity_date', now())
            ->first();

        $employeeExists = Employees::where('employee_gen_id', $params['employee_id'])->exists();

        if (!empty($rtn)) {
            return response()->json([
                'withRecord' => true,
                'employee' => $rtn,
                'employee_id' => $params['employee_id'],
                'exists' => $employeeExists,
                'withTimeOut' => !empty($rtn->time_out),
                'now' => now(),
                'timezone' => date_default_timezone_get()
            ]);
        }

        return response()->json([
            'withRecord' => false,
            'employee' => $rtn,
            'employee_id' => $params['employee_id'],
            'exists' => $employeeExists,
            'withTimeOut' => false,
            'now' => now(),
            'timezone' => date_default_timezone_get()
        ]);
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
    public function update(Request $request, $timeLog)
    {
        $request->validate([
            'employee_id' => 'required'
        ]);

        $rtn = TimeLogs::updater($request->all(), $timeLog);

        if ($rtn) {
            return redirect()->back()->with('success', ['Time Out!', 'success']);
        }

        return redirect()->back()->with('error', ['Something went wrong', 'danger']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TimeLogs  $timeLogs
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimeLogs $timelog)
    {
        $rtn = TimeLogs::deleter($timelog);

        if ($rtn) {
            return redirect()->back()->with('success', ['Deleted!', 'success']);
        }

        return redirect()->back()->with('error', ['Something went wrong', 'danger']);
    }

    /**
     * Updates Time log manunally by admin only
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function manual(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'activity_date' => 'required'
        ]);

        $rtn = TimeLogs::manualler($request->all());

        if ($rtn) {
            return redirect()->back()->with('success', ['Updated', 'success']);
        }

        return redirect()->back()->with('error', ['Something went wrong', 'danger']);
    }
}
