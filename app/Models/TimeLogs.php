<?php

namespace App\Models;

use DB;
use App\Models\TimeSettings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimeLogs extends Model
{
    use HasFactory;

    protected $table = 'timelogs';

    protected $fillable = [
        'employee_id',
        'activity_date',
        'time_in',
        'lunch_break_start',
        'lunch_brek_ends',
        'time_out',
        'undertime',
        'overtime',
        'late'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function employee()
    {
        return $this->belongsTo('App\Models\Employees', 'employee_id', 'employee_gen_id')->with('person');
    }

    public static function store($params)
    {
        date_default_timezone_set("Asia/Manila");
        DB::beginTransaction();
        try {
            $timesettings = TimeSettings::first();
            if (!empty($timesettings)) {
                $timeDB = $timesettings->workstarts;
                $timeEntry = date("H:i");
                $workstarts = (int)str_replace(':', '', $timeDB);
                $starts = (int)str_replace(':', '', $timeEntry);
                $late = self::convertTime(round(abs(strtotime($timeEntry) - strtotime($timeDB)) / 3600,2));

                if ($starts > $workstarts) {
                    self::create([
                        'employee_id' => $params['employee_id'],
                        'activity_date' => now(),
                        'time_in' => $timeEntry,
                        'late' => $late,
                    ]);
                    DB::commit();
                    return 'Late';
                } else {
                    self::create([
                        'employee_id' => $params['employee_id'],
                        'activity_date' => now(),
                        'time_in' => $timeEntry,
                    ]);
                }
            } else {
                self::create([
                    'employee_id' => $params['employee_id'],
                    'activity_date' => now(),
                    'time_in' => date("H:i"),
                ]);
            }
            DB::commit();
            return 'Time In';
        } catch (\Exception $e) {
            \Log::error(get_class().' store: '.$e);
            DB::rollback();
            return null;
        }
    }

    public static function updater($params, $timelog)
    {
        date_default_timezone_set("Asia/Manila");
        DB::beginTransaction();
        try {
            $timelog = self::where('employee_id', $timelog)->whereDate('activity_date', now())->first();
            $timesettings = TimeSettings::first();

            if (!empty($timesettings)) {
                $timeDB = $timesettings->workends;
                $timeEntry = date("H:i");
                $workends = (int)str_replace(':', '', $timeDB);
                $out = (int)str_replace(':', '', $timeEntry);
                $undertimeOrOvertime = self::convertTime(round(abs(strtotime($timeEntry) - strtotime($timeDB)) / 3600,2));
                
                if ($out > $workends) {
                    $timelog->update([
                        'time_out' => $timeEntry,
                        'overtime' => $undertimeOrOvertime,
                    ]);
                } else if ($out < $workends) {
                    $timelog->update([
                        'time_out' => $timeEntry,
                        'undertime' => $undertimeOrOvertime,
                    ]);
                }

                DB::commit();
                return true;
            }


            $timelog->update([
                'time_out' => date("H:i"),
            ]);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            \Log::error(get_class().' store: '.$e);
            DB::rollback();
            return false;
        }
    }

    public static function filter($params)
    {
        if (!empty($params)) {
            return self::whereBetween('activity_date', [date($this->params['dateFrom']), date($this->params['dateTo'])])
                ->with('employee')
                ->get();
        }

        return self::with('employee')->get();
    }

    public static function convertTime($dec)
    {
        // start by converting to seconds
        $seconds = ($dec * 3600);
        // we're given hours, so let's get those the easy way
        $hours = floor($dec);
        // since we've "calculated" hours, let's remove them from the seconds variable
        $seconds -= $hours * 3600;
        // calculate minutes left
        $minutes = floor($seconds / 60);
        // remove those from seconds as well
        $seconds -= $minutes * 60;
        // return the time formatted HH:MM:SS
        return self::lz($hours).":".self::lz($minutes);
    }

    // lz = leading zero
    public static function lz($num)
    {
        return (strlen($num) < 2) ? "0{$num}" : $num;
    }

    public static function deleter($timelog)
    {
        DB::beginTransaction();
        try {
            $timelog->delete();
            DB::commit();
            return true;
        } catch(\Exception $e) {
            \Log::error(get_class().' deleter'.$e);
            DB::rollback();
            return false;
        }
    }

    public static function manualler($request)
    {
        date_default_timezone_set("Asia/Manila");
        DB::beginTransaction();
        try {
            $timelog = self::where('employee_id', $request['employee_id'])->whereDate('activity_date', $request['activity_date'])->first();
            $timesettings = TimeSettings::first();

            if (!empty($timesettings)) {
                $timeDB = $timesettings->workends;
                $timeEntry = $request['time_out'];
                $workends = (int)str_replace(':', '', $timeDB);
                $out = (int)str_replace(':', '', $timeEntry);
                $undertimeOrOvertime = self::convertTime(round(abs(strtotime($timeEntry) - strtotime($timeDB)) / 3600,2));
                
                
                if ($out > $workends) {
                    $timelog->update([
                        'time_in' => $request['time_in'],
                        'time_out' => $request['time_out'],
                        'overtime' => $undertimeOrOvertime,
                    ]);
                } else if ($out < $workends) {
                    $timelog->update([
                        'time_in' => $request['time_in'],
                        'time_out' => $request['time_out'],
                        'undertime' => $undertimeOrOvertime,
                    ]);
                }

                DB::commit();
                return true;
            }


            $timelog->update([
                'time_in' => $request['time_in'],
                'time_out' => $request['time_out']
            ]);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            \Log::error(get_class().' store: '.$e);
            DB::rollback();
            return false;
        }
    }
}
