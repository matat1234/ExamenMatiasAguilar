<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MedicoController;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


//rutas para las gestiones del sistema
Route::get('/admin/medicos', [MedicoController::class, 'index'])->name('admin.medicos.index')->middleware('auth');

Route::get('/admin/medicos/create', [MedicoController::class, 'create'])->name('admin.medicos.create')->middleware('auth');

Route::post('/admin/medicos/create', [MedicoController::class, 'store'])->name('admin.medicos.store')->middleware('auth');

Route::get('/admin/medicos/{id}/edit', [MedicoController::class, 'edit'])->name('admin.medicos.edit')->middleware('auth');

Route::put('/admin/medicos/{id}', [MedicoController::class, 'update'])->name('admin.medicos.update')->middleware('auth');

Route::delete('/admin/medicos/{id}', [MedicoController::class, 'destroy'])->name('admin.medicos.destroy')->middleware('auth');