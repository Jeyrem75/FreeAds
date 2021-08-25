<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/Ad', [App\Http\Controllers\AdController::class, 'create'])->name('adCreate');

Route::post('/Ad/Create', [App\Http\Controllers\AdController::class, 'store'])->name('adStore');

Route::get('/showAds', [App\Http\Controllers\AdController::class, 'index'])->name('showAd');

Route::get('/showMyAds', [App\Http\Controllers\AdController::class, 'show'])->name('showMyAds');

Route::get('/deleteAd/{id}', [App\Http\Controllers\AdController::class, 'destroy'])->name('deleteAd');

Route::get('/showEditAd/{id}', [App\Http\Controllers\AdController::class, 'edit'])->name('editAd');

Route::post('/updateAd/{id}', [App\Http\Controllers\AdController::class, 'update'])->name('updateAd');

Route::get('/searchAds', function() {
    return view('research');
})->name('research');

Route::post('/searchAds/name', [App\Http\Controllers\AdController::class, 'searchName'])->name('searchName');

Route::post('/searchAds/price', [App\Http\Controllers\AdController::class, 'searchPrice'])->name('searchPrice');

Route::post('/searchAds/localisation', [App\Http\Controllers\AdController::class, 'searchLocalisation'])->name('searchLocalisation');

Route::get('/messaging', function() {
    return view('messaging');
})->name('messaging');