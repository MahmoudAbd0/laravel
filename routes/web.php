<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
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




require __DIR__ . '/auth.php';
Route::get('/', function () {
    return view('welcome');
});

Route::get('/chanageLang', [CategoryController::class, 'chanageLang'])->name('chanageLang');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(CategoryController::class)->prefix('categories')->as('categories.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::delete('/{category}', 'destroy')->name('destroy');
    Route::put('/{category}', 'update')->name('update');
    Route::get('/{category}', 'show')->name('show');
    Route::get('/{category}/edit', 'edit')->name('edit');
});

Route::controller(ProductController::class)->prefix('products')->as('products.')->group(function () {

    Route::get('/',  'index')->name('index');
    Route::get('/search', 'search')->name('search');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{product}', 'show')->name('show');
    Route::get('/{product}/edit', 'edit')->name('edit');
    Route::PUT('/{product}', 'update')->name('update');
    Route::delete('/{product}', 'destroy')->name('destroy');
});
