<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\AuthController;

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
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

  Route::group(['middleware'=>'auth:sanctum'],function(){
    Route::resource('employees', EmployeeController::class);
    Route::get('get-companies', [CompanyController::class,'get_companies']);
    Route::get('dashboard-data', [DashboardController::class,'dashboard_data']);
    Route::resource('companies', CompanyController::class);
  });

    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');




