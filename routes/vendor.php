<?php

use App\Http\Controllers\Backend\Vendor\DashboardController;
use App\Http\Controllers\Backend\Vendor\OrderController;
use App\Http\Controllers\Backend\Vendor\ProductController;
use App\Http\Controllers\Backend\Vendor\ProductMultiImageController;
use App\Http\Controllers\Backend\Vendor\ProductReviewController;
use App\Http\Controllers\Backend\Vendor\ProductVariantController;
use App\Http\Controllers\Backend\Vendor\ProductVariantItemController;
use App\Http\Controllers\Backend\Vendor\ShopProfileController;
use Illuminate\Support\Facades\Route;


// Vendor Routes
Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');


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
