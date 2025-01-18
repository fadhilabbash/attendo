<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
use App\Http\Controllers\AttendanceController;

Route::get('/connect', [AttendanceController::class, 'connect']);
Route::get('/attendance', [AttendanceController::class, 'getAttendance']);
Route::post('/attendance/clear', [AttendanceController::class, 'clearAttendance']);
Route::get('/users', [AttendanceController::class, 'getUsers']);
Route::post('/users', [AttendanceController::class, 'addUser']);
Route::delete('/users/{uid}', [AttendanceController::class, 'deleteUser']);
Route::get('/device-info', [AttendanceController::class, 'getDeviceInfo']);
