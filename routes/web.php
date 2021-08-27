<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::prefix('transaction')->group(function()
        {
            Route::get('/', [TransactionController::class, 'index'])->name('transaction.index');
            Route::post('/create', [TransactionController::class, 'store'])->name('transaction.store');
        });

Route::middleware(['is_admin'])->group(function()
{
    Route::prefix('admin')->group(function()
    {
        Route::get('/', [HomeController::class, 'admin'])->name('admin.dashboard');

        Route::prefix('category')->group(function()
        {
            Route::get('/', [CategoryController::class, 'index'])->name('admin.category.index');
            Route::post('/add', [CategoryController::class, 'store'])->name('admin.category.store');
            Route::put('/edit/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
            Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
        });

        Route::prefix('transaction')->group(function()
        {
            Route::get('/', [TransactionController::class, 'index'])->name('admin.transaction.index');
            Route::put('/edit/{id}', [TransactionController::class, 'update'])->name('admin.transaction.update');
            Route::delete('/delete/{id}', [TransactionController::class, 'destroy'])->name('admin.transaction.destroy');
        });
    });
});