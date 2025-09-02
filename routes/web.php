<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AgentTicketController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\AdminController;

// Home / Login
Route::get('/', function () {
    return view('auth.login');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Notifications
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

// Tickets (Demandeur)
Route::resource('tickets', TicketController::class);
Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');

// ----------------------
// Agent Routes
// ----------------------
Route::middleware(['auth', 'checkrole:agent'])->group(function () {
    // Ticket handling
    Route::get('/agent/tickets', [AgentTicketController::class, 'index'])->name('agent.index');
    Route::get('/agent/tickets/{id}', [AgentTicketController::class, 'show'])->name('agent.show');
    Route::post('/agent/tickets/{id}/status', [AgentTicketController::class, 'updateStatus'])->name('agent.updateStatus');

    // Stock management (agent only)
    Route::resource('/agent/stock', StockController::class)->only(['index']);
});

// ----------------------
// Admin Routes
// ----------------------
Route::middleware(['auth', 'checkrole:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('stock', StockController::class);
    Route::resource('factures', FactureController::class);
     Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});
