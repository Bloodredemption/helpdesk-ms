<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UsersController;

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
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/tickets', function () {
    return view('admin.tickets.index');
});

Route::get('/transactionlogs', function () {
    return view('admin.logs.index');
});

Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
// Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
Route::post('/updatedepartments', [DepartmentController::class, 'update'])->name('departments.update');
Route::resource('departments', DepartmentController::class);
// Route::get('/departments/{id}', 'DepartmentController@getDepartmentName');

Route::resource('users', UsersController::class);
Route::post('/updateusers', [UsersController::class, 'update'])->name('users.update');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');