<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return redirect()->route('login');
});



Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('users', UserController::class);

Route::resource('category', CategoryController::class);

Route::resource('product', ProductController::class);

Route::resource('brand', BrandController::class);

Route::resource('supplier', SupplierController::class);

Route::post('/find-product', [TransactionsController::class, 'findProduct'])->name('find.product');
Route::post('/cart/add', [TransactionsController::class, 'addToCart'])->name('cart.add');
Route::post('/transaction/pay', [TransactionsController::class, 'store'])->name('transaction.pay');
Route::get('/transaction/{id}/print', [TransactionsController::class, 'print'])->name('transaction.print');

Route::resource('transaction', TransactionsController::class);

// kasir route maps to TransactionsController@create (kasir/pos)
Route::get('/kasir', [TransactionsController::class, 'create'])->name('kasir.index');
// Laporan: dukung harian, mingguan, bulanan
Route::get('/laporan', [ReportController::class, 'index'])->name('report.index');
Route::get('/laporan/pdf', [ReportController::class, 'pdf'])->name('report.pdf');

// Backwards compatibility: tetap terima rute lama (redirect ke index)
Route::get('/laporan/harian', function () { return redirect()->route('report.index', ['type' => 'daily']); });
Route::get('/laporan/harian/pdf', function () { return redirect()->route('report.pdf', ['type' => 'daily']); });


require __DIR__ . '/auth.php';
