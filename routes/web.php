<?php

use App\Http\Controllers\medicoController;
use App\Http\Controllers\pacienteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\roleController;
use App\Http\Controllers\UserController;

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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('roles', roleController::class)->names('roles');
Route::resource('users', UserController::class)->names('users');
Route::resource('medicos', medicoController::class)->names('medicos');
Route::get('medicos/especialidad/{id}', [medicoController::class, 'especialidad']);
Route::post('medicos/esp_store', [medicoController::class, 'esp_store']);
Route::resource('pacientes', pacienteController::class)->names('pacientes');