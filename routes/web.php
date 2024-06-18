<?php

use App\Http\Controllers\CaseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('/case')->group(function () {
        Route::view('/', 'cases')->name('case');
        Route::view('/create-case', 'cases.create')->name('create_case');
        Route::get('/view={id}', [CaseController::class, 'view'])->name('view_case');
        Route::get('/view/files/{id}&{case_number}', [CaseController::class, 'viewFiles'])->name('view_case_files');
        Route::get('/view/files/{path}', [CaseController::class, 'streamFile'])->name('stream_case_files');
        Route::delete('/view/files/{file}', [CaseController::class, 'destroyFile'])->name('destroy_case_files');
        Route::post('/create-case', [CaseController::class, 'create'])->name('save_case');
        Route::post('/upload-new-files/{id}', [CaseController::class, 'uploadFIles'])->name('upload_case_files');
        Route::patch('/create-case/{case}', [CaseController::class, 'update'])->name('update_case');
        Route::post('/add-court/{case}', [CaseController::class, 'add'])->name('add_court');
        Route::delete('/create-case/{case}', [CaseController::class, 'destroy'])->name('delete_case');

    });

    Route::prefix('/gallery')->group(function () {
        Route::view('/', 'gallery')->name('gallery');
        Route::post('/upload', [GalleryController::class, 'store'])->name('upload_gallery');

    });

    Route::prefix('/invoice')->group(function () {
        Route::view('/', 'invoice')->name('invoice');
        Route::get('/download/invoice={id}', InvoiceController::class)->name('download_invoice');
    });

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
