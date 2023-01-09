<?php

namespace App\Models;

use DB;
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
        'overtime',
        'late'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function employee()
    {
        return $this->belongsTo('App\Models\Employees', 'employee_gen_id', 'employee_id');
    }

    public static function store($params)
    {
        date_default_timezone_set("Asia/Manila");
        DB::beginTransaction();
        try {
            self::create([
                'employee_id' => $params['employee_id'],
                'activity_date' => now(),
                'time_in' => date("H:i"),
            ]);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            \Log::error(get_class().' store: '.$e);
            DB::rollback();
            return false;
        }
    }

    public static function updater($params, $timelog)
    {
        date_default_timezone_set("Asia/Manila");
        DB::beginTransaction();
        try {
            $timelog = self::where('employee_id', $timelog)->first();
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
}
