<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkingDays extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'working_days';

    protected $fillable = [
        'year',
        'month_in_number',
        'month_name',
        'days',
    ];

    public static function list() {
        return self::select(
            DB::raw('ANY_VALUE(id) as id'),
            DB::raw('ANY_VALUE(year) as year'),
            DB::raw('ANY_VALUE(month_in_number) as month_in_number'),
            DB::raw('ANY_VALUE(month_name) as month_name'),
            DB::raw('ANY_VALUE(days) as days'),
        )->get()->groupBy('year');
    }
}
