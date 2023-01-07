<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TimeLogsController;
use App\Http\Controllers\TimeSettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('timetracker');
})->name('timelog');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('employee', EmployeeController::class);
Route::resource('timelog', TimeLogsController::class);
Route::resource('report', ReportsController::class);
Route::resource('timesetting', TimeSettingsController::class);
