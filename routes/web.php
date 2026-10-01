<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectPlanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ProjectPlanController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/project-plan', [ProjectPlanController::class, 'index'])->name('project-plan.index');
    Route::get('/project-plan/pdf', [ProjectPlanController::class, 'downloadPdf'])->name('project-plan.pdf');
    Route::patch('/project-plan/details/{detail}/status', [ProjectPlanController::class, 'updateStatus'])->name('project-plan.details.status');
    Route::post('/project-plan/details', [ProjectPlanController::class, 'storeDetail'])->name('project-plan.details.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
