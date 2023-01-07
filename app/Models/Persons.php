<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Persons extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'persons';

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'suffix',
        'birthdate'
    ];

    protected $appends = [
        'fullname'
    ];

    public function getFullnameAttribute()
    {
        return $this->firstname.' '.$this->lastname;
    }
}
