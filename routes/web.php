<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
  HomeController,
    SupplierController, ItemController,
    NeedController, QuoteController, QuoteItemController,
    CompareController, PurchaseOrderController, ReceiptController
};
Route::get('/', [HomeController::class, 'index'])->name('home');

// (opsional) tambahkan ->middleware('auth') kalau proyekmu sudah ada auth
Route::prefix('procurement')->name('proc.')->group(function () {
    // Master data
    Route::resource('suppliers', SupplierController::class);           // proc.suppliers.*
    Route::resource('items', ItemController::class);                    // proc.items.*

    // Needs (import CSV kebutuhan)
    Route::get('needs', [NeedController::class,'index'])->name('needs.index');
    Route::get('needs/create', [NeedController::class,'create'])->name('needs.create');
    Route::post('needs', [NeedController::class,'store'])->name('needs.store');

    // Quotation per supplier
    Route::resource('quotes', QuoteController::class)->only(['index','create','store','edit','update','destroy']);
    Route::post('quotes/{quote}/items', [QuoteItemController::class,'store'])->name('quotes.items.store');

    // Compare 2+ penawaran → pilih shipping/payment → buat PO
    Route::get('compare/{need}', [CompareController::class,'show'])->name('compare.show');
    Route::post('compare/{need}/choose', [CompareController::class,'choose'])->name('compare.choose');

    // Purchase Order + workflow + export + email
    Route::get('pos', [PurchaseOrderController::class,'index'])->name('pos.index');
    Route::get('pos/{po}', [PurchaseOrderController::class,'show'])->name('pos.show');
    Route::post('pos/{po}/submit', [PurchaseOrderController::class,'submit'])->name('pos.submit');
    Route::post('pos/{po}/approve', [PurchaseOrderController::class,'approve'])->name('pos.approve');
    Route::get('pos/{po}/pdf', [PurchaseOrderController::class,'pdf'])->name('pos.pdf');
    Route::get('pos/{po}/csv', [PurchaseOrderController::class,'csv'])->name('pos.csv');
    Route::post('pos/{po}/email', [PurchaseOrderController::class,'email'])->name('pos.email');

    // Penerimaan barang (web form)
    Route::get('receipts/create/{po}', [ReceiptController::class,'create'])->name('receipts.create');
    Route::post('receipts/{po}', [ReceiptController::class,'store'])->name('receipts.store');

    Route::post('procurement/receipts/{po}/scan', [ReceiptApiController::class,'store'])
     ->name('api.proc.receipts.scan');
});
