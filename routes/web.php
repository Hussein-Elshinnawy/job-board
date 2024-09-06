<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobPostsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckUserType;

Route::get('/', function () {
    return view('welcome');
});


// Route::middleware(['auth'])->group(function () {

//     Route::get('/candidate/profile', [CandidateController::class, 'index'])->name('candidate.profile');

//     Route::get('/company/profile', [CompanyController::class, 'index'])->name('company.profile');
// });


Route::middleware(['auth', 'checkUserType:candidate'])->group(function () {
    Route::get('/candidate/profile', [CandidateController::class, 'index'])->name('candidate.profile');
    Route::resource('candidate', CandidateController::class);
});

Route::middleware(['auth', 'checkUserType:company'])->group(function () {
    Route::get('/company/profile', [CompanyController::class, 'index'])->name('company.profile');
    Route::resource('company', CompanyController::class);
});

// Route::get('/candidate/{candidate}/edit', [CandidateController::class, 'edit'])->name('candidate.edit');
// Route::resource('candidate', CandidateController::class);
// Route::resource('company', CompanyController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/candidate/dashboard', [CandidateController::class, 'index'])->name('candidate.dashboard');

// Route::get('/company/dashboard', [CompanyController::class, 'index'])->name('company.dashboard');

Route::resource('/jobs', JobPostsController::class);
