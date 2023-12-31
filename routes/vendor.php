<?php

use App\Http\Controllers\Backend\Vendor\DashboardController;
use App\Http\Controllers\Backend\Vendor\MessageController;
use App\Http\Controllers\Backend\Vendor\OrderController;
use App\Http\Controllers\Backend\Vendor\ProductController;
use App\Http\Controllers\Backend\Vendor\ProductMultiImageController;
use App\Http\Controllers\Backend\Vendor\ProductReviewController;
use App\Http\Controllers\Backend\Vendor\ProductVariantController;
use App\Http\Controllers\Backend\Vendor\ProductVariantItemController;
use App\Http\Controllers\Backend\Vendor\ShopProfileController;
use App\Http\Controllers\Backend\Vendor\WithdrawController;
use Illuminate\Support\Facades\Route;


// Vendor Routes
Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

// Message Routes
Route::controller(MessageController::class)->group(function () {
    Route::get('message/index', 'index')->name('message.index');
    Route::get('get-message', 'getMessage')->name('get-message');
    Route::post('send-message', 'sendMessage')->name('send-message');
});

// Shop Profile Routes
Route::resource('shop-profile', ShopProfileController::class);

// Product Routes
Route::put('product/change-status', [ProductController::class, 'changeStatus'])->name('product.change-status');
Route::get('product/get-sub-categories', [ProductController::class, 'getSubCategories'])->name('product.get-sub-categories');
Route::get('product/get-child-categories', [ProductController::class, 'getChildCategories'])->name('product.get-child-categories');
Route::resource('product', ProductController::class);

// Product Multi Image Routes
Route::resource('product-multi-image', ProductMultiImageController::class);

// Product Variant Routes
Route::put('product-variant/change-status', [ProductVariantController::class, 'changeStatus'])->name('product-variant.change-status');
Route::resource('product-variant', ProductVariantController::class);

// Product Variant Item Routes
Route::controller(ProductVariantItemController::class)->group(function () {
    Route::put('product-variant-item/change-status', 'changeStatus')->name('product-variant-item.change-status');
    Route::get('product-variant-item/{product_id}/{variant_id}', 'index')->name('product-variant-item.index');
    Route::get('product-variant-item/{product_id}/{variant_id}/create', 'create')->name('product-variant-item.create');
    Route::post('product-variant-item', 'store')->name('product-variant-item.store');
    Route::get('product-variant-item-edit/{variant_item_id}', 'edit')->name('product-variant-item.edit');
    Route::put('product-variant-item-update/{variant_item_id}', 'update')->name('product-variant-item.update');
    Route::delete('product-variant-item/{variant_item_id}', 'destroy')->name('product-variant-item.destroy');
});


// Order Routes
Route::controller(OrderController::class)->group(function () {
    Route::get('order/index', 'index')->name('order.index');
    Route::get('order/detail/{id}', 'showOrderDetail')->name('order.detail');
});

// Product Review Routes
Route::controller(ProductReviewController::class)->group(function () {
    Route::get('product-review/index', 'index')->name('product-review.index');
});


// Withdraw Routes
Route::controller(WithdrawController::class)->group(function () {
    Route::get('withdraw/index', 'index')->name('withdraw.index');
    Route::get('withdraw/create', 'create')->name('withdraw.create');
    Route::post('withdraw/store', 'store')->name('withdraw.store');
    Route::get('withdraw/detail/{id}', 'showDetailWithdrawRequest')->name('withdraw.detail');

    Route::get('withdraw-method-desc/{id}', 'withdrawMethodDescription')->name('withdraw-method-desc');
});
