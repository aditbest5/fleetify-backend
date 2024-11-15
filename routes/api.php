<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendanceHistoryController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Models\Attendance;
use App\Models\AttendanceHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([
    "prefix"=>"auth",   
], function(){
    Route::post("register", [AuthController::class, "register"]);
    Route::post("login", [AuthController::class, "login"]);
    Route::post("logout", [AuthController::class, "logout"])->middleware('auth');
    Route::post("role", [AuthController::class, "insert_role"]);
});

Route::group([
    "prefix"=> "employee",
    'middleware' => 'auth.jwt',
], function(){
    Route::get("list", [EmployeeController::class, "index"]);
    Route::get("list/{id}", [EmployeeController::class, "show"]);
    Route::post("create", [EmployeeController::class, "store"])->middleware('admin');
    Route::patch("update/{id}", [EmployeeController::class, "update"])->middleware('admin');
    Route::delete("delete/{id}", [EmployeeController::class, "destroy"])->middleware('admin');
});
Route::get("get-profile", [UserController::class, "show"])->middleware('auth.jwt');
Route::patch("update-profile", [UserController::class, "update"])->middleware('auth.jwt');
Route::group([
    "prefix"=> "department",
    'middleware' => 'auth.jwt'
], function(){
    Route::get("/", [DepartmentController::class, "index"])->middleware('admin');
    Route::get("/{id}", [DepartmentController::class, "show"])->middleware('admin');
    Route::post("create", [DepartmentController::class, "store"])->middleware('admin');
    Route::patch("update/{id}", [DepartmentController::class, "update"])->middleware('admin');
    Route::delete("delete/{id}", [DepartmentController::class, "destroy"])->middleware('admin');
});

Route::group([
    "prefix"=> "attendance",
    'middleware' => 'auth.jwt'
], function(){
    Route::get("/", [AttendanceController::class, "index"])->middleware('admin');
    Route::post("absent_in", [AttendanceController::class, "absent_in"]);
    Route::post("absent_out", [AttendanceController::class, "absent_out"]);
});


Route::group([
    "prefix"=> "attendance-history",
    'middleware' => 'auth.jwt'
], function(){
    Route::get("/", [AttendanceHistoryController::class, "index"])->middleware('admin');
});