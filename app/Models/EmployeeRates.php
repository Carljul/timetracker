<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeRates extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'employee_rates';

    protected $fillable = [
        'employee_id',
        'employee_title',
        'rate',
    ];

    public function employee()
    {
        return $this->belongsTo('App\Models\Employees', 'employee_id', 'employee_gen_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'employee_id', 'employee_id');
    }

    public static function list()
    {
        return self::with([
            'employee.person'
        ])
        ->whereHas('user', function ($query) {
            $query->where('role', '!=', 1);
        })
        ->whereNull('deleted_at')
        ->paginate(10);
    }

    public static function updater($params, $rate)
    {
        DB::beginTransaction();

        try {
            $rate->update([
                'employee_title' => $params['jobTitle'],
                'rate' => $params['rate'],
            ]);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            \Log::error(get_class().' updater: '.$e);
            DB::rollback();
            return false;
        }
    }
}
