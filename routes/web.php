<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::resource('/admins', AdminController::class);
// Route::resource('/candidates', CandidateController::class);
// Route::resource('/categories', CompanyController::class);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/candidate/dashboard', [CandidateController::class, 'index'])->name('candidate.dashboard');

Route::get('/company/dashboard', [CompanyController::class, 'index'])->name('company.dashboard');


