<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\PosologieController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Accueil\Accueil;
use App\Http\Livewire\Fermes\Fermes;
use App\Http\Livewire\Fermes\FermeDetail;
use App\Http\Livewire\ItemsFactory;
use App\Http\Livewire\Tests\Tests;
use App\Http\Livewire\Tests\TestShow;
use App\Http\Livewire\Associations;
use App\Http\Livewire\FermeUser\FermeUser;
use App\Http\Livewire\TestsUser\TestsUser;
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

// Route::get('/accueil', function () {
//     return view('accueil');
// })->middleware(['auth', 'verified'])->name('accueil');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('accueil', Accueil::class)->name('accueil');
    Route::get('tests-utilisateur', TestsUser::class)->name('tests-user');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('is.eleveur')->group(function () {
    Route::get('ferme-utilisateur', FermeUser::class)->name('ferme-user');
});

Route::middleware('is.admin')->group(function () {
    Route::get('items/{model}', ItemsFactory::class);
    Route::get('posologie', [PosologieController::class, 'index'])->name('posologie.index');
    Route::get('posologie/edit/{anthelm}/{espece}', [PosologieController::class, 'edit'])->name('posologie.edit');
    Route::post('posologie/update', [PosologieController::class, 'update'])->name('posologie.update');
    Route::get('tests', Tests::class)->name('tests');
    Route::get('tests/{test}', TestShow::class)->name('test.show');
    Route::get('fermes', Fermes::class)->name('fermes');
    Route::get('ferme/{ferme}', FermeDetail::class)->name('ferme');
    Route::get('associations', Associations::class)->name('associations');
});

require __DIR__.'/auth.php';
