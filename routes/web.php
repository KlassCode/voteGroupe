<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ElectionController;
use App\Models\Election;
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
Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard.show');

Route::get('/election/create', [ElectionController::class, 'create'])->name('election.create');
Route::post('/election/store', [ElectionController::class, 'store'])->name('election.store');
Route::get('/election/{code}/edit', [ElectionController::class, 'edit'])->name('election.edit');
Route::put('/election/{id}/update', [ElectionController::class, 'update'])->name('election.update');
Route::get('/election/all', [ElectionController::class, 'fetchAllElections'])->name('election.list');
Route::delete('/election/{id}/delete', [ElectionController::class, 'delete'])->name('election.delete');

Route::post('/candidate/store', [CandidateController::class, 'store'])->name('candidate.store');
Route::put('/candidate/update', [CandidateController::class, 'update'])->name('candidate.update');
Route::delete('/candidate/{id}/delete', [CandidateController::class, 'delete'])->name('candidate.delete');
Route::get('/candidate/{id}/confirm', [CandidateController::class, 'candidateConfirm'])->name('candidate.confirm');
