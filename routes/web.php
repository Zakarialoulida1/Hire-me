<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/home',[\App\Http\Controllers\Homecontroller::class,'index']);
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/cv', [\App\Http\Controllers\Formcontroller::class, 'index'])->name('cv_form');
    Route::post('/store', [\App\Http\Controllers\Formcontroller::class, 'store'])->name('cv.store');
    Route::get('/cv/cursus', [\App\Http\Controllers\Formcontroller::class, 'getUserCursus'])->name('getUserCursus');

});

require __DIR__.'/auth.php';

