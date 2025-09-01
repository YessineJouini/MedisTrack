<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AgentTicketController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FactureController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home page
Route::get('/', function () {
    return view('auth.login');
});

// ----------------------
// Tickets (Demandeur)
// ----------------------
Route::resource('tickets', TicketController::class);

Route::get('/tickets', [App\Http\Controllers\TicketController::class, 'index'])->name('tickets.index');
// ----------------------
// Agent Ticket Handling
// ----------------------
Route::get('/agent/tickets', [AgentTicketController::class, 'index'])->name('agent.index');
Route::get('/agent/tickets/{id}', [AgentTicketController::class, 'show'])->name('agent.show');
Route::post('/agent/tickets/{id}/status', [AgentTicketController::class, 'updateStatus'])->name('agent.updateStatus');

// ----------------------
// Stock Management
// ----------------------
Route::resource('/agent/stock', StockController::class)->only(['index']);



Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
});
Route::resource('/admin/stock', StockController::class, [
    'as' => 'admin'
]);

Route::prefix('admin')->name('admin.')->group(function() {
    Route::resource('factures', FactureController::class);
});
