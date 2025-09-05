<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;

// ---------------- RUTAS PÚBLICAS ----------------
Route::get('/', [ProductController::class, 'index'])->name('welcome');

// Mostrar un producto (vista pública)
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// ---------------- AUTENTICACIÓN ----------------
require __DIR__.'/auth.php';

// ---------------- ADMIN ----------------
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Usuarios
        Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios');
        Route::put('/usuarios/{id}/rol', [UsuarioController::class, 'cambiarRol'])->name('cambiarRol');

        // Historial de productos
        Route::get('/products/history', [ProductController::class, 'history'])
            ->name('products.history'); 

        // Historial de compras (y acciones relacionadas)
        Route::get('/purchases/history', [PurchaseController::class, 'adminPurchasesHistory'])->name('purchases.history');
        Route::get('/purchases/download/pdf', [PurchaseController::class, 'downloadPdfHistory'])->name('purchases.download.pdf');
        Route::get('/purchases/download/excel', [PurchaseController::class, 'downloadExcelHistory'])->name('purchases.download.excel');
        Route::post('/purchases/clear', [PurchaseController::class, 'clearHistory'])->name('purchases.clear');

});

// ---------------- VENDEDOR ----------------
Route::middleware(['auth', 'role:vendedor'])
    ->prefix('admin')
    ->name('admin.') // 👈 FALTA ESTO
    ->group(function () {
        Route::get('/dashboard', [ProductController::class, 'dashboard'])->name('dashboard');

        Route::prefix('products')->name('products.')->group(function () {
            Route::get('/', [ProductController::class, 'adminIndex'])->name('index');
            Route::get('/historial', [ProductController::class, 'historial'])->name('historial');
            Route::get('/create', [ProductController::class, 'create'])->name('create');
            Route::post('/', [ProductController::class, 'store'])->name('store');
            Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
            Route::put('/{product}', [ProductController::class, 'update'])->name('update');
            Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
        });
});
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
Route::middleware('auth')->post('/purchase/{product}', [PurchaseController::class, 'store'])->name('purchase.store');

Route::middleware('auth')->get('/seller/purchases', [PurchaseController::class, 'sellerHistory'])->name('seller.purchases');

// Actualizar estado de compra
Route::middleware('auth')->put('/purchase/{purchase}', [PurchaseController::class, 'update'])->name('purchase.update');

// ---------------- NOTIFICACIONES (API para el cliente) ----------------
Route::middleware('auth')->get('/notifications', [PurchaseController::class, 'userNotifications']);
Route::middleware('auth')->get('/notifications/status', [PurchaseController::class, 'userNotificationStatus']);
