<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

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

Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/back', [ContactController::class, 'back']);
Route::post('/thanks', [ContactController::class, 'thanks']);
Route::get('/admin', [AdminController::class, 'index']);
Route::post('/admin/delete/{id}', [AdminController::class, 'destroy']);
Route::get('/export', [AdminController::class, 'export']);