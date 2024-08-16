<?php

use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\UserController;
use App\Models\Products;
use Illuminate\Support\Facades\App;




Route::get('/', [SiteController::class, 'home'])->name('home');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'login_check'])->name('login_check');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/news/{id}', [SiteController::class, 'details'])->name('details');
Route::get('/news/categorypost/{id}', [SiteController::class, 'category_post'])->name('category.post');


Route::get('/add_order/{id}', [OrderController::class, 'addProduct'])->name('add_product');



Route::group([
    'prefix' => '/dashboard',
    'middleware' => ['IsAdmin'],
    'as' => 'dashboard.'
], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/orders', [OrderController::class, 'allorders'])->name('all_orders');
    Route::post('/delete_order/{id}', [OrderController::class, 'DeleteOrder'])->name('DeleteOrder');

    // ===== Upload Image With FillPond ===== //
    Route::post('/upload/products', [UploadController::class, 'upload_image_product'])->name('upload.products'); // للمنتج product   
    Route::post('/upload/categories', [UploadController::class, 'upload_image_category'])->name('upload.categories'); // category للتصنيفات
    // ====================================== //

    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoriesController::class);
});



Route::get('/register', [UserController::class, 'showRegistrationForm']);
Route::post('/register', [UserController::class, 'register']);
Route::get('/user/login', [UserController::class, 'showLoginForm']);
Route::post('/user/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
