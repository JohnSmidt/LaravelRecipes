<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\RecipeController;


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

// Route::get('/', function () {
//     return view('welcome');
// })->middleware('auth');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');
Route::middleware(['auth'])->get('/', [RecipeController::class, 'index'])->name('recipes.index');
Route::middleware(['auth'])->get('/create', [RecipeController::class, 'create'])->name('create');
Route::middleware(['auth'])->post('store', [RecipeController::class, 'store'])->name('recipe.store');
Route::middleware(['auth'])->get('recipes/{id}', [RecipeController::class, 'show'])->name('recipes.show');
Route::middleware(['auth'])->get('recipes/{id}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
Route::middleware(['auth'])->post('recipes/{id}/update', [RecipeController::class, 'update'])->name('recipes.update');
Route::middleware(['auth'])->get('recipes/{id}/delete', [RecipeController::class, 'destroy'])->name('recipes.delete');

// Route::get('/recipes', function () {
//   return view('recipes.index');
// })->middleware('auth');


//Route::resource('recipes', RecipeController::class);

require __DIR__.'/auth.php';
