<?php

use App\Http\Controllers\{
    DashboardController,
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::group([
    'middleware' => ['auth', 'role:admin,gudang'],
], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
