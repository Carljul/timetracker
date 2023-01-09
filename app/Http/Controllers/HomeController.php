<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (\Auth::check()) {
            if (\Auth::user()->role == config('const.roles.key.Admin')) {
                return redirect()->route('employee.index');
            } else {
                return redirect()->route('staff.index');
            }
        }
        
        return view('timetracker');
    }
}
