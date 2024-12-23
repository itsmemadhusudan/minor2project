<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\DesignerController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\EsewaController;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
// Home Route
Route::get('/', [UploadController::class, 'index'])->name('index');

// Upload Routes
Route::get('/upload', [UploadController::class, 'addImage'])->name('add_image');
Route::post('/upload', [UploadController::class, 'store'])->name('save_image');
Route::get('/product/{product_id}', [UploadController::class, 'viewProduct'])->name('view_product');
Route::post('/product/store-cart', [UploadController::class, 'storeCart'])->name('store_cart');
Route::get('/upload-data', [UploadController::class, 'index'])->name('upload-data');

//designer routes
// Route::get('/designer', [DesignerController::class, 'index'])->name('designer');
Route::get('/designer', [DesignerController::class, 'showDesignerPage'])->name('designer.page');
// About Us Route
Route::get('/aboutus', [DesignerController::class, 'aboutUs'])->name('aboutus');

// Registration Routes
Route::get('/registration', [AuthManager::class, 'showRegistrationForm'])->name('registration.form');
Route::post('/registration', [AuthManager::class, 'register'])->name('register');

// Login Routes
Route::get('/login', [AuthManager::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthManager::class, 'login'])->name('login.submit');

// Logout Route
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

// Search Route
Route::get('/search', [SearchController::class, 'search'])->name('search');

// Product Detail Route
Route::post('/submit_form', [ProductDetailController::class, 'submitForm'])->name('submit_form');
// routes/web.php
Route::get('/admin-profile', [UserDetailController::class, 'adminProfile'])->name('admin.profile');


// Public Routes
// Category Routes
Route::get('/cultural', function () {
    return view('cultural');
})->name('cultural');

Route::get('/western', function () {
    return view('western');
})->name('western');

Route::get('/cultural', [DesignerController::class, 'culturalProduct'])->name('cultural');
Route::get('/western', [DesignerController::class, 'westernProduct'])->name('western');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [DesignerController::class, 'profile'])->name('profile');
    Route::post('/profile', [DesignerController::class, 'updateProfile'])->name('profile.update');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/edit-cart/{cart_id}', [CartController::class, 'editCart'])->name('edit_cart');
    Route::post('/update-cart/{cart_id}', [CartController::class, 'updateCart'])->name('update_cart');
    Route::get('/delete-cart/{cart_id}', [CartController::class, 'deleteCart'])->name('delete_cart');

    Route::get('/payment-verify', [CartController::class, 'verifyPayment'])->name('payment.verify');



    Route::get('/designer', [DesignerController::class, 'showDesignerPage'])->name('designer');
});

// Product Detail Route
Route::get('/productdetail/{id}', [ProductDetailController::class, 'show'])->name('productdetail');

// Esewa Payment Routes
Route::get('/esewa/create', [EsewaController::class, 'create'])->name('esewa.create');
Route::post('/esewa/store', [EsewaController::class, 'store'])->name('esewa.store');
Route::get('/esewa/success', [EsewaController::class, 'success'])->name('payment.success');
Route::get('/esewa/failure', [EsewaController::class, 'failure'])->name('payment.failure');

// Cart routes
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});
// Route::get('/admin-profile', function () {
//     return view('admin.adminprofile'); // Ensure this matches your view filename
// })->name('admin.profile');


Route::get('/admin-profile', [UserDetailController::class, 'adminProfile'])->name('admin.profile');
Route::get('/admin-profile/edit/{id}', [UserDetailController::class, 'edit'])->name('admin.edit');
Route::post('/admin-profile/update/{id}', [UserDetailController::class, 'update'])->name('admin.update');
Route::delete('/admin-profile/delete/{id}', [UserDetailController::class, 'destroy'])->name('admin.delete');

// Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admincontroller', [AdminController::class, 'adminController'])->name('admin.admincontroller');
Route::get('/admincontroller', [AdminController::class, 'adminController'])->name('admin.admincontroller');
Route::get('/admincontroller/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
Route::put('/admincontroller/update/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::delete('/admincontroller/delete/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

Route::get('/payment-verify', [OrderController::class, 'verifyPayment']);
Route::get('/payment-fail', [OrderController::class, 'paymentFail']);




// Route to count total users and display the total count
Route::get('/admin/total-users', [UserDetailController::class, 'countTotalUsers'])->name('totalusers');
