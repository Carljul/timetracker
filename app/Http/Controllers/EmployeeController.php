<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employees::list();
        return view('pages.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.employees.create');
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
            'firstname' => 'required',
            'lastname' => 'required',
            'jobTitle' => 'required',
            'rate' => 'required',
            'ot_rate' => 'required'
        ]);

        $rtn = Employees::store($request->all());

        if ($rtn) {
            return redirect()->route('employee.index')->with('success', ['Saved', 'success']);
        }

        return redirect()->back()->with('error', ['Something went wrong', 'danger']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function show(Employees $employees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employees  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employees $employee)
    {
        return view('pages.employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employees  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employees $employee)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required'
        ]);

        $rtn = Employees::updater($request->all(), $employee);

        if ($rtn) {
            return redirect()->route('employee.index')->with(['msg' => 'Updated']);
        }

        return redirect()->back()->with(['msg' => 'Something went wrong']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employees  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employees $employee)
    {
        $rtn = Employees::destroy($employee);

        if ($rtn) {
            return redirect()->route('employee.index')->with(['msg' => 'Deleted']);
        }

        return redirect()->back()->with(['msg' => 'Something went wrong']);
    }
}
