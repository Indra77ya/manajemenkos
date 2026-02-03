<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('tenant.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:tenant'])->prefix('tenant')->name('tenant.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\TenantDashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/pendaftaran', function () {
        return view('admin.pendaftaran');
    })->name('pendaftaran');
    Route::get('/pembayaran', function () {
        return view('admin.pembayaran');
    })->name('pembayaran');
    Route::get('/pemasukan-lain', function () {
        return view('admin.pemasukan_lain');
    })->name('pemasukan-lain');
    Route::get('/pengeluaran', function () {
        return view('admin.pengeluaran');
    })->name('pengeluaran');
    Route::get('/laporan', function () {
        return view('admin.laporan');
    })->name('laporan');

    Route::resource('branches', BranchController::class);
    Route::resource('room-types', RoomTypeController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('tenants', \App\Http\Controllers\TenantController::class);
    Route::resource('leases', \App\Http\Controllers\LeaseController::class);
    Route::resource('invoices', \App\Http\Controllers\InvoiceController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
