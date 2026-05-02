<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\SeasonsController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::controller(AuthController::class)->group(function () {
            Route::middleware('guest')->group(function () {
                Route::get('login', 'create')->name('login');
                Route::post('login', 'store')->name('login.store');
            });

            Route::middleware('auth')->group(function () {
                Route::post('logout', 'destroy')->name('logout');
            });
        });


        Route::middleware(['auth', 'admin'])->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::prefix('category')->name('category.')->controller(CategoryController::class)->group(function () {
                Route::get('', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::get('{id}', 'show')->name('show');
            });

           
            Route::prefix('brands')->name('brands.')->controller(BrandController::class)->group(function () {
                Route::get('', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::get('{product}/edit', 'edit')->name('edit');
                Route::delete('{product}', 'destroy')->name('destroy');
                Route::get('{id}', 'show')->name('show');
            });

           
            Route::prefix('country')->name('country.')->controller(CountryController::class)->group(function () {
                Route::get('', 'index')->name('index');
                Route::get('{id}', 'show')->name('show');
            });

           
            Route::prefix('size')->name('size.')->controller(SizeController::class)->group(function () {
                Route::get('', 'index')->name('index');
                Route::get('{id}', 'show')->name('show');
            });

           
            Route::prefix('season')->name('season.')->controller(SeasonsController::class)->group(function () {
                Route::get('', 'index')->name('index');
                Route::get('{id}', 'show')->name('show');
            });

         
            Route::prefix('product')->name('product.')->controller(ProductController::class)->group(function () {
                Route::get('', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('{product}', 'show')->name('show');
                Route::get('{product}/edit', 'edit')->name('edit');
                Route::put('{product}', 'update')->name('update');
                Route::delete('{product}', 'destroy')->name('destroy');
            });

        });

    });
