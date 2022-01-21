<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ComplaintsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::get('home', function () {
    return view('layouts.master');
});
Auth::routes();

// Complaints Routes for Admin

Route::middleware(['auth','admin'])->prefix('admin/')->name('admin.')->group(function () {
    Route::get('show_all_complaints', [ComplaintsController::class, 'index'])->name('show.all.complaints');
    Route::post('store_complaint', [ComplaintsController::class, 'store'])->name('store.complaint');
    Route::post('edit_complaint', [ComplaintsController::class, 'edit'])->name('edit.complaint');
    Route::post('delete_complaint', [ComplaintsController::class, 'destroy'])->name('delete.complaint');
});

// Complaints Routes for CSR

Route::middleware(['csr','auth'])->prefix('csr')->name('csr.')->group(function () {
    Route::get('show_active_complaints', [ComplaintsController::class, 'CsrActiveComplaints'])->name('show.active.complaints');
    Route::get('show_resolved_complaints', [ComplaintsController::class, 'CsrResolvedComplaints']);
    Route::post('resolve_complaint', [ComplaintsController::class, 'resolved'])->name('resolve.complaint');
});

