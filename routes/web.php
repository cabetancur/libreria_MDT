<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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

Route::prefix('productos')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('productos.index');
    Route::get('crear', [CategoryController::class, 'create'])->name('productos.create');
    Route::post('store', [CategoryController::class, 'store'])->name('productos.store');
    Route::get('editar/{id}', [CategoryController::class, 'edit'])->name('productos.edit');
    Route::put('actualizar/{id}', [CategoryController::class, 'update'])->name('productos.update');
    Route::delete('eliminar/{id}', [CategoryController::class, 'destroy'])->name('productos.destroy');
});
