<?php

use App\Http\Controllers\PosologieController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Fermes\Fermes;
use App\Http\Livewire\Fermes\FermeShow;
use App\Http\Livewire\ItemsFactory;
use App\Http\Livewire\Tests\Tests;
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
    Route::post('posologie/update', [PosologieController::class, 'update'])->name('posologie.update');
    Route::get('tests', Tests::class)->name('tests');
    Route::get('tests/{test}', [Tests::class, 'show'])->name('tests.show');
    Route::get('fermes', Fermes::class)->name('fermes');
    Route::get('fermes/{ferme}', FermeShow::class)->name('ferme.show');
});

require __DIR__.'/auth.php';
