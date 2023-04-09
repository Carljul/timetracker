<?php

namespace App\Http\Controllers;

use App\Models\TimeSettings;
use Illuminate\Http\Request;

class TimeSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $timesetting = TimeSettings::first();
        return view('pages.worksettings.index', compact('timesetting'));
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
            'workstarts' => 'required',
            'workends' => 'required'
        ]);

        $params = $request->all();

        \DB::beginTransaction();
        try {
            TimeSettings::create([
                'workstarts' => $params['workstarts'],
                'workends' => $params['workends']
            ]);
            \DB::commit();
            return redirect()->back()->with('success', ['Saved!', 'success']);
        } catch (\Exception $e) {
            \Log::error(get_class().' store: '.$e);
            \DB::rollback();
            return redirect()->back()->with('error', ['Something went wrong', 'danger']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TimeSettings  $timeSettings
     * @return \Illuminate\Http\Response
     */
    public function show(TimeSettings $timeSettings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TimeSettings  $timeSettings
     * @return \Illuminate\Http\Response
     */
    public function edit(TimeSettings $timeSettings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TimeSettings  $timeSettings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TimeSettings $timesetting)
    {
        $request->validate([
            'workstarts' => 'required',
            'workends' => 'required'
        ]);

        $params = $request->all();

        \DB::beginTransaction();
        try {
            $timesetting->update([
                'workstarts' => $params['workstarts'],
                'workends' => $params['workends']
            ]);
            \DB::commit();
            return redirect()->back()->with('success', ['Updated!', 'success']);
        } catch (\Exception $e) {
            \Log::error(get_class().' store: '.$e);
            \DB::rollback();
            return redirect()->back()->with('error', ['Something went wrong', 'danger']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TimeSettings  $timeSettings
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimeSettings $timeSettings)
    {
        //
    }
}
