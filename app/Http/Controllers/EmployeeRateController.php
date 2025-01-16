<?php

namespace App\Http\Controllers;

use App\Models\EmployeeRates;
use Illuminate\Http\Request;

class EmployeeRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rates = EmployeeRates::list();
        return view('pages.payroll.rates.index', compact('rates'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeRates $rate)
    {
        $rate = $rate->load('employee.person');
        return view('pages.payroll.rates.edit', compact('rate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeRates $rate)
    {
        $request->validate([
            'jobTitle' => 'required',
            'rate' => 'required'
        ]);

        $rtn = EmployeeRates::updater($request->all(), $rate);

        if ($rtn) {
            return redirect()->route('rate.index')->with('success', ['Updated', 'success']);
        }

        return redirect()->back()->with('error', ['Something went wrong', 'danger']);
    }
}
