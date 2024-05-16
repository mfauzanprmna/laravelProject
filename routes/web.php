<?php

use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('barang/tambah', [BarangController::class, 'create'])->name('barang.tambah');
Route::post('barang/store', [BarangController::class, 'store'])->name('barang.store');
Route::get('barang/edit/{barang}', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('barang/update/{barang}', [BarangController::class, 'update'])->name('barang.update');
Route::get('barang/destroy/{barang}', [BarangController::class, 'destroy'])->name('barang.destroy');

Route::get('barang-export', [BarangController::class, 'export'])->name('barang.export');
Route::post('barang-import', [BarangController::class, 'import'])->name('barang.import');
