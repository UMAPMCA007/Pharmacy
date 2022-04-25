<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/work', [DashboardController::class, 'index'])->name('work');
Route::post('/work_store', [DashboardController::class, 'store'])->name('work.store');
Route::get('/work_show', [DashboardController::class, 'show'])->name('work.show');
Route::get('/work_edit/{id}', [DashboardController::class, 'edit'])->name('work.edit');
Route::post('/work_update/{id}', [DashboardController::class, 'update'])->name('work.update');
Route::get('/work_delete/{id}', [DashboardController::class, 'delete'])->name('work.delete');
Route::post('/work_create', [DashboardController::class, 'create'])->name('work.create');
