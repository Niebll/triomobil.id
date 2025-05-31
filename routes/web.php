<?php

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

Route::get('/halo', function () {
    return view('halo');
});

//group route for authentication no need to controller just call view
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/login/admin', function () {
    return view('auth.login_admin');
})->name('login.post');
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/dashboard', function () {
    return view('admin.dashboard.index');
})->name('dashboard.index');





