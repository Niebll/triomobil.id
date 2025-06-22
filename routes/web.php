<?php

use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ExportController;
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


//call controller for authentication
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

});

Route::middleware('auth')->group(function () {

    Route::post('/dashboard', function () {
        auth()->logout();
        return redirect()->route('login');
    })->name('auth.logout');

    Route::get('/dashboard', [CarController::class, 'getDashboardAdmin'])->name('dashboard.dashboard');
    Route::get('/dashboard/cars', [CarController::class, 'getSearchCarAdmin'])->name('dashboard.cars');
    Route::get('/dashboard/cars/create', [CarController::class, 'showCreateCar'])->name('dashboard.cars.create');
    Route::post('/dashboard/cars/create', [CarController::class, 'postCar'])->name('dashboard.cars.create.post');
    Route::post('/dashboard/cars/{car}/update', [CarController::class, 'updateCar'])->name('dashboard.cars.update');
    Route::get('/dashboard/cars/{car}/edit', [CarController::class, 'showEditCar'])->name('dashboard.cars.edit');
    Route::get('/dashboard/cars/export-cars-pdf/{id}', [ExportController::class, 'exportCarPDF'])->name('dashboard.cars.export-pdf');
    Route::post('/cars/delete/{id}', [CarController::class, 'deleteCar'])->name('dashboard.cars.delete');

});

    Route::get('home', [CarController::class, 'getBestCar'])->name('home');
    Route::get('car-list', [CarController::class, 'getAllCar'])->name('car.list');








// Route::get('/car', function () {
//     return view('user.car');
// })->name('car');


