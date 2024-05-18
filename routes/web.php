<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AssignedTicketController;
use App\Models\AssignedTicket;

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

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

// Route::get('/adashboard', function () {
//     return view('admin.dashboard');
// })->middleware('auth')->name('admin.dashboard');

Route::get('/dashboard', [AssignedTicketController::class, 'index'])->middleware('auth')->name('admin.dashboard');

Route::get('/udashboard', function () {
    return view('user.dashboard');
})->middleware('auth')->name('user.dashboard');

Route::get('/myaccount/{user}', [UsersController::class, 'myAccount'])->middleware('auth')->name('myaccount');
Route::middleware(['auth'])->group(function () {
    Route::put('/myaccount/update/{user}', [UsersController::class, 'myAccount_update'])->name('myaccount.update');
    Route::put('/myaccount/updatePass/{user}', [UsersController::class, 'myAccount_updatePass'])->name('myaccount.updatePass');
});

Route::get('/assignedtickets', [TicketController::class, 'assignedTickets'])->middleware('auth')->name('assignedtickets');
Route::get('/assigned-tickets/{ticket}', [TicketController::class, 'assignedTickets_show'])->name('assigned-tickets.show');

Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::resource('departments', DepartmentController::class)->middleware('auth');
Route::resource('tickets', TicketController::class)->middleware('auth');
Route::resource('logs', LogsController::class)->middleware('auth');
Route::resource('users', UsersController::class)->middleware('auth');
Route::put('users/{user}/update-password', [UsersController::class, 'updatePass'])->name('users.updatePass');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/download-pdf', [PDFController::class, 'generatePDF']);

Route::get('tickets/get-users', [TicketController::class, 'getUsersByDepartment'])->name('admin.tickets.get-users');

Route::post('/ticket/{ticket}/start', [TicketController::class, 'start'])->name('ticket.start');
Route::post('/ticket/{ticket}/cancel', [TicketController::class, 'cancel'])->name('ticket.cancel');
Route::post('/ticket/{ticket}/pause', [TicketController::class, 'pause'])->name('ticket.pause');
Route::post('/ticket/{ticket}/resolve', [TicketController::class, 'resolve'])->name('ticket.resolve');