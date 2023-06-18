<?php

use App\Http\Controllers\PosologieController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\ItemsFactory;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('items/{model}', ItemsFactory::class);
    Route::get('posologie', [PosologieController::class, 'index'])->name('posologie.index');
    Route::get('posologie/edit/{anthelm}/{espece}', [PosologieController::class, 'edit'])->name('posologie.edit');
    Route::post('posologie', [PosologieController::class, 'store'])->name('posologie.store');
    // Route::get('test', TestComp::class);
});

require __DIR__.'/auth.php';
