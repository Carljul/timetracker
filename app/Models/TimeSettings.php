<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSettings extends Model
{
    use HasFactory;

    protected $table = 'timesettings';

    protected $fillable = [
        'workstarts',
        'workends',
        'lunchbreak',
    ];
}
