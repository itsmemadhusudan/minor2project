<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\DesignerController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\EsewaController;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DesignerAdminController;
use App\Http\Controllers\OtherController; // Add this
use App\Http\Controllers\ProductController; // Add this
use App\Http\Controllers\CustomerController; // Add this
use App\Http\Controllers\AdminOrderController; // Add this
// Home Route
Route::get('/', [UploadController::class, 'index'])->name('index');

// Upload Routes
Route::prefix('upload')->group(function () {
    Route::get('/', [UploadController::class, 'index'])->name('upload-data');
    Route::get('/add', [UploadController::class, 'addImage'])->name('add_image');
    Route::post('/', [UploadController::class, 'store'])->name('save_image');
    Route::get('/product/{product_id}', [UploadController::class, 'viewProduct'])->name('view_product');
    Route::post('/product/store-cart', [UploadController::class, 'storeCart'])->name('store_cart');
});

// Designer Routes
Route::prefix('product')->group(function () {
    Route::get('/', [DesignerController::class, 'showDesignerPage'])->name('designer');
    Route::get('/cultural-product', [DesignerController::class, 'culturalProduct'])->name('cultural');
    Route::get('/western-product', [DesignerController::class, 'westernProduct'])->name('western');
});

// About Us Route
Route::get('/aboutus', [DesignerController::class, 'aboutUs'])->name('aboutus');

// Authentication Routes
Route::prefix('auth')->group(function () {
    Route::get('/registration', [AuthController::class, 'showRegistrationForm'])->name('registration.form');
    Route::post('/registration', [AuthController::class, 'register'])->name('register');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Search Route
Route::get('/search', [SearchController::class, 'search'])->name('search');

// Product Detail Route
Route::prefix('productdetail')->group(function(){
    Route::post('/submit_form', [ProductDetailController::class, 'submitForm'])->name('submit_form');
    Route::get('/{id}', [ProductDetailController::class, 'show'])->name('productdetail');
});

// Public Routes (Blade redirects)
Route::get('/cultural', [OtherController::class,'culturalPage'])->name('cultural');
Route::get('/western', [OtherController::class, 'westernPage'])->name('western');


// Protected Routes (requires authentication)
Route::middleware(['auth'])->group(function () {
    // Profile Routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [DesignerController::class, 'profile'])->name('profile');
        Route::post('/', [DesignerController::class, 'updateProfile'])->name('profile.update');
    });

    // Cart Routes
    Route::prefix('cart')->group(function () {
         Route::get('/', [CartController::class, 'index'])->name('cart');
         Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
         Route::get('/verifyEsewa', [CartController::class, 'verifyEsewa'])->name('cart.verifyEsewa');
        Route::post('/add', [CartController::class, 'add'])->name('cart.add');
        Route::post('/place_order', [CartController::class, 'placeOrder'])->name('order.place');
        Route::patch('/{id}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/{id}', [CartController::class, 'remove'])->name('cart.remove');
        Route::get('/edit/{cart_id}', [CartController::class, 'editCart'])->name('edit_cart');
        Route::post('/update/{cart_id}', [CartController::class, 'updateCart'])->name('update_cart');
        Route::get('/delete/{cart_id}', [CartController::class, 'deleteCart'])->name('delete_cart');
    });

    // Payment Routes
        Route::get('/payment-verify', [CartController::class, 'verifyPayment'])->name('payment.verify');
});

// Esewa Payment Routes
Route::prefix('esewa')->group(function () {
    Route::get('/create', [EsewaController::class, 'create'])->name('esewa.create');
    Route::post('/store', [EsewaController::class, 'store'])->name('esewa.store');
    Route::get('/success', [EsewaController::class, 'success'])->name('payment.success');
    Route::get('/failure', [EsewaController::class, 'failure'])->name('payment.failure');
    Route::post('/callback', [EsewaController::class, 'handleCallback']);

});
// Admin Routes
Route::prefix('admin')->group(function(){
   Route::get('/profile', [UserDetailController::class, 'adminProfile'])->name('admin.profile');
   Route::get('/profile/edit/{id}', [UserDetailController::class, 'edit'])->name('admin.edit');
    Route::post('/profile/update/{id}', [UserDetailController::class, 'update'])->name('admin.update');
    Route::delete('/profile/delete/{id}', [UserDetailController::class, 'destroy'])->name('admin.delete');
    Route::get('/admincontroller', [AdminController::class, 'adminController'])->name('admin.admincontroller');
    Route::get('/admincontroller/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admincontroller/update/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admincontroller/delete/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/total-users', [UserDetailController::class, 'countTotalUsers'])->name('totalusers');
});

// Order Routes
Route::prefix('order')->group(function(){
  Route::get('/payment-verify', [OrderController::class, 'verifyPayment']);
    Route::get('/payment-fail', [OrderController::class, 'paymentFail']);
});


// new changes 
Route::prefix('admin/designers')->group(function () {
    Route::get('/', [DesignerAdminController::class, 'index'])->name('admin.users.index');
    Route::get('/create', [DesignerAdminController::class, 'create'])->name('admin.users.create');
    Route::post('/store', [DesignerAdminController::class, 'store'])->name('admin.users.store');
    Route::get('/show/{user}', [DesignerAdminController::class, 'show'])->name('admin.users.show');
    Route::get('/edit/{user}', [DesignerAdminController::class, 'edit'])->name('admin.users.edit');
    Route::put('/update/{user}', [DesignerAdminController::class, 'update'])->name('admin.users.update');
    Route::delete('/destroy/{user}', [DesignerAdminController::class, 'destroy'])->name('admin.users.destroy');
});
Route::prefix('admin/products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/show/{product}', [ProductController::class, 'show'])->name('admin.products.show');
    Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/update/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/destroy/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
});
Route::prefix('admin/customers')->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('admin.customers.index');
    Route::get('/show/{customer}', [CustomerController::class, 'show'])->name('admin.customers.show');
    Route::get('/edit/{customer}', [CustomerController::class, 'edit'])->name('admin.customers.edit');
    Route::put('/update/{customer}', [CustomerController::class, 'update'])->name('admin.customers.update');
    Route::delete('/destroy/{customer}', [CustomerController::class, 'destroy'])->name('admin.customers.destroy');
});
Route::prefix('admin/orders')->group(function () {
    Route::get('/', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/show/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::get('/edit/{order}', [AdminOrderController::class, 'edit'])->name('admin.orders.edit');
    Route::put('/update/{order}', [AdminOrderController::class, 'update'])->name('admin.orders.update');
});