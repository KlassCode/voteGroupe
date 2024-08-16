<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ElectionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('index');
})->name('accueil');

Auth::routes();
Route::get('/dashboard/{id}', [DashboardController::class, 'show'])->name('dashboard.show');
Route::get('/election/create', [ElectionController::class, 'create'])->name('election.create');
Route::post('/election/store', [ElectionController::class, 'store'])->name('election.store');
