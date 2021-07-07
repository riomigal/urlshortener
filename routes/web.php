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

Auth::routes();

Route::group(['middleware' => 'web'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/shortlink/create', [ShortlinkController::class, 'create'])->name('shortlink.create');
    Route::post('/shortlink/create', [ShortlinkController::class, 'store'])->name('shortlink.store');
    Route::delete('/shortlink/delete', [ShortlinkController::class, 'delete'])->name('shortlink.delete');
});