<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedisController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', [RedisController::class, 'index']);
Route::get('/create', [RedisController::class, 'create']);
Route::post('/store', [RedisController::class, 'store']);
Route::get('/show/{id}', [RedisController::class, 'show']);
Route::get('/edit/{id}', [RedisController::class, 'edit']);
Route::put('/update/{id}', [RedisController::class, 'update'])->name('employee.update');
Route::delete('/delete/{id}', [RedisController::class, 'delete']);
