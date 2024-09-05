<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth'])->group(function () {

    Route::get('/candidate/profile', [CandidateController::class, 'index'])->name('candidate.profile');

    Route::get('/company/profile', [CompanyController::class, 'index'])->name('company.profile');
});
Route::resource('candidate', CandidateController::class);
Route::resource('company', CompanyController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

