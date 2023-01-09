<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TimeLogsController;
use App\Http\Controllers\TimeSettingsController;
use App\Http\Controllers\Employee\EmployeeController as StaffController;

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

Route::get('/', [HomeController::class, 'index'])->name('timelogs');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
});

Route::group(['middleware' => ['auth', 'can:admin.view']], function () {
    Route::resource('employee', EmployeeController::class);
    Route::resource('report', ReportsController::class);
    Route::resource('timesetting', TimeSettingsController::class);
});

Route::group(['prefix' => 'timelog', 'as' => 'timelog.'], function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', [TimeLogsController::class, 'index'])->name('index');
        Route::get('/create', [TimeLogsController::class, 'create'])->name('create');
    });
    Route::post('/', [TimeLogsController::class, 'store'])->name('store');
    Route::post('/show', [TimeLogsController::class, 'show'])->name('show');
    Route::match(['PUT', 'PATCH'], '/{timelog}', [TimeLogsController::class, 'update'])->name('update');
    Route::delete('/{timelog}', [TimeLogsController::class, 'destroy'])->name('destroy');
    Route::get('/{timelog}/edit', [TimeLogsController::class, 'edit'])->name('edit');
});