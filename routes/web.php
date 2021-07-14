<?php

use App\Http\Controllers\ShortlinkController;
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
    return view('main');
});


Route::get('/goto/{id}', [ShortlinkController::class, 'redirect'])->name('shortlink.redirect');

Auth::routes(['verify' => true]);

Route::group(['middleware' => 'verified'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/my-shortlinks', [ShortlinkController::class, 'index'])->name('shortlink.index');
    Route::get('/shortlink/create', [ShortlinkController::class, 'create'])->name('shortlink.create');
    Route::post('/shortlink/create', [ShortlinkController::class, 'store'])->name('shortlink.store');
    Route::put('/shortlink/update/{shortlink}', [ShortlinkController::class, 'update'])->name('shortlink.update');
    Route::post('/shortlink/restore/{id}', [ShortlinkController::class, 'restore'])->name('shortlink.restore');
    Route::delete('/shortlink/delete/{shortlink}', [ShortlinkController::class, 'delete'])->name('shortlink.delete');
    Route::delete('/shortlink/destroy/{id}', [ShortlinkController::class, 'destroy'])->name('shortlink.destroy');
});