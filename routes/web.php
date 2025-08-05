<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;

Route::get('/', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
Route::get('/transaksi/import', [TransaksiController::class, 'importForm'])->name('transaksi.import');
Route::post('/transaksi/import', [TransaksiController::class, 'importExcel']);
Route::get('/transaksi/export-excel', [TransaksiController::class, 'exportExcel']);
Route::get('/transaksi/export-pdf', [TransaksiController::class, 'exportPDF']);

Route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit');
Route::put('/transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
