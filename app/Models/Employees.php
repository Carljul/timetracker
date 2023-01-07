<?php

namespace App\Models;

use DB;
use App\Models\User;
use App\Models\Persons;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employees extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'employees';

    protected $fillable = [
        'employee_gen_id',
        'person_id',
        'date_employed',
        'date_resigned',
        'isResigned',
    ];

    public function person()
    {
        return $this->belongsTo('App\Models\Persons', 'person_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'employee_gen_id', 'employee_id');
    }

    public static function list()
    {
        return self::whereHas('user', function ($query) {
            $query->where('role', '!=', 1);
        })->with('person')->paginate(10);
    }

    public static function store($params)
    {
        DB::beginTransaction();
        try {
            $person = Persons::create([
                'firstname' => $params['firstname'],
                'middlename' => $params['middlename'],
                'lastname' => $params['lastname'],
                'suffix' => $params['suffix'],
                'birthdate' => $params['birthdate']
            ]);
            
            $employee = self::create([
                'employee_gen_id' => date('y').str_pad(self::count(), 4, '0', STR_PAD_LEFT),
                'person_id' => $person->id,
                'date_employed' => $params['employeed'],
            ]);
            User::create([
                'employee_id' => $employee->employee_gen_id,
                'username' => $employee->employee_gen_id,
                'password' => Hash::make($employee->employee_gen_id),
                'role' => 2
            ]);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            \Log::error(get_class().' store: '.$e);
            DB::rollback();
            return false;
        }
    }

    public static function updater($params, $employee)
    {
        DB::beginTransaction();
        try {
            $person = Persons::where('id', $employee->person_id)->first();
            $person->update([
                'firstname' => $params['firstname'],
                'middlename' => $params['middlename'],
                'lastname' => $params['lastname'],
                'suffix' => $params['suffix'],
                'birthdate' => $params['birthdate']
            ]);
            $employee->update([
                'date_employed' => $params['employeed'],
                'date_resigned' => $params['resigned'],
                'isResigned' => !empty($params['resigned'])
            ]);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            \Log::error(get_class().' updater: '.$e);
            DB::rollback();
            return false;
        }
    }

    public static function destroy($employee)
    {
        DB::beginTransaction();
        try {
            $user = User::where('employee_id', $employee->employee_gen_id)->first();
            $person = Person::where('id', $employee->person_id)->first();
            $user->delete();
            $person->delete();
            $employee->delete();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            \Log::error(get_clas().' destroy: '.$e);
            DB::rollback();
            return false;
        }
    }
}
