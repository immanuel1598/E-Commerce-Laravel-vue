<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('Welcome');
Route::get('/dashboard', function(){
    return inertia::render('Dashboard');
})->middleware(['auth','verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//admin Routes
Route::prefix('admin')->middleware('redirectAdmin')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    Route::get('logout', [AdminAuthController::class, 'showLoginForm'])->name('admin.logout');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group( function(){
    Route::get('/dashboard',[AdminController::class , 'index'])->name('admin.dashboard');
    //productes routes
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::put('/products/update/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/image/{id}', [ProductController::class, 'deleteImage'] )->name('admin.products.image.delete');
    Route::delete('/products/destroy', [ProductController::class, destroy])->name('admin.product.destry');
    //brands routes
    Route::get('/brands', [BrandController::class, 'index'])->name('admin.brands.index');
    //categories routes
    Route::get('/categories', [CategorieController::class, 'index'])->name('admin.categories.index');
});
//end
require __DIR__.'/auth.php';
