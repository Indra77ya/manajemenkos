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

    // Pendaftaran Sub-Routes
    Route::prefix('pendaftaran')->name('pendaftaran.')->group(function () {
        Route::get('/entri', function () {
            return view('admin.pendaftaran.entri');
        })->name('entri');
        Route::get('/edit', function () {
            return view('admin.pendaftaran.edit');
        })->name('edit');
        Route::get('/pindah-kamar', function () {
            return view('admin.pendaftaran.pindah_kamar');
        })->name('pindah-kamar');
    });

    // Keeping the main route for now as a fallback or dashboard if needed,
    // though navigation will use the dropdown.
    Route::get('/pendaftaran', function () {
        return view('admin.pendaftaran');
    })->name('pendaftaran');

    // Pembayaran Sub-Routes
    Route::prefix('pembayaran')->name('pembayaran.')->group(function () {
        Route::get('/entri', function () {
            // Redirect to invoice creation as requested
            return redirect()->route('admin.invoices.create');
        })->name('entri');
        Route::get('/edit', function () {
            // Redirect to invoice list as requested
            return redirect()->route('admin.invoices.index');
        })->name('edit');
        Route::get('/deposit', function () {
            return view('admin.pembayaran.deposit');
        })->name('deposit');
        Route::get('/konfirmasi-bayar', function () {
            return view('admin.pembayaran.konfirmasi_bayar');
        })->name('konfirmasi-bayar');
        Route::get('/check-out', function () {
            return view('admin.pembayaran.check_out');
        })->name('check-out');
    });

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

    // Pusat Data Routes
    Route::get('/owner-profil', function () {
        return view('admin.pusat_data.owner_profil');
    })->name('owner-profil');

    Route::get('/pengguna', function () {
        return view('admin.pusat_data.pengguna');
    })->name('pengguna');

    Route::get('/lokasi-kos', function () {
        return view('admin.pusat_data.lokasi_kos');
    })->name('lokasi-kos');

    Route::get('/email-setting', function () {
        return view('admin.pusat_data.email_setting');
    })->name('email-setting');

    Route::get('/kamar', function () {
        return view('admin.pusat_data.kamar');
    })->name('kamar');

    Route::get('/login-penghuni', function () {
        return view('admin.pusat_data.login_penghuni');
    })->name('login-penghuni');

    Route::get('/denda', function () {
        return view('admin.pusat_data.denda');
    })->name('denda');

    Route::get('/info-rekening', function () {
        return view('admin.pusat_data.info_rekening');
    })->name('info-rekening');

    Route::get('/setting-pernyataan', function () {
        return view('admin.pusat_data.setting_pernyataan');
    })->name('setting-pernyataan');

    Route::get('/variabel-kwh-pln', function () {
        return view('admin.pusat_data.variabel_kwh_pln');
    })->name('variabel-kwh-pln');

    Route::get('/biaya-tambahan-kamar', function () {
        return view('admin.pusat_data.biaya_tambahan_kamar');
    })->name('biaya-tambahan-kamar');

    Route::get('/jenis-pengeluaran-rutin', function () {
        return view('admin.pusat_data.jenis_pengeluaran_rutin');
    })->name('jenis-pengeluaran-rutin');

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
