<?php

use App\Http\Controllers\CartIndexController;
use App\Http\Controllers\CategoryShowController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderIndexController;
use App\Http\Controllers\ProductShowController;
use App\Http\Controllers\CheckoutIndexController;
use App\Http\Controllers\OrderConfirmationIndexController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;

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

Route::get('/', HomeController::class)->name('home');

Route::get('/cart', CartIndexController::class)->name('cart');

Route::get('/checkout', CheckoutIndexController::class);

Route::get('/categories/{category:slug}', CategoryShowController::class);

Route::get('/orders/{order:uuid}/confirmation', OrderConfirmationIndexController::class)->name('orders.confirmation');

Route::get('/orders', OrderIndexController::class)->name('orders');

Route::get('/products/{product:slug}', ProductShowController::class)->name('product');

// Route::get('/dashboard', function () {
//     //when authenticated user can view admin dashboard
//     //if user cannot view dashboard redirect to home
//     return view('/admin/dashboard');
// })->middleware(['auth'])->name('admin.dashboard');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'viewAdmin:view admin']], function(){

    //dashboard
    // code should be changed -- create a controller for this route
    Route::get('/dashboard', function () {
        return view('/admin/dashboard');
    })->name('admin.dashboard');

    //products
    Route::get('products', [ProductController::class, 'index'])->name('admin.products');
    Route::get('products/create', [ProductController::class, 'create'])->name('admin.products.create');
    //users
    Route::get('users', [UserController::class, 'index'])->name('admin.users');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
});

require __DIR__.'/auth.php';
