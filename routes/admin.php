<?php

use App\Http\Controllers\Backend\Admin\AccountController;
use App\Http\Controllers\Backend\Admin\AdvertisementController;
use App\Http\Controllers\Backend\Admin\BrandController;
use App\Http\Controllers\Backend\Admin\CategoryController;
use App\Http\Controllers\Backend\Admin\ChildCategoryController;
use App\Http\Controllers\Backend\Admin\DashboardController;
use App\Http\Controllers\Backend\Admin\EmailConfigSettingController;
use App\Http\Controllers\Backend\Admin\FlashSaleController;
use App\Http\Controllers\Backend\Admin\FooterCompanyController;
use App\Http\Controllers\Backend\Admin\FooterCustomerController;
use App\Http\Controllers\Backend\Admin\GeneralSettingController;
use App\Http\Controllers\Backend\Admin\HomePageSettingController;
use App\Http\Controllers\Backend\Admin\OrderController;
use App\Http\Controllers\Backend\Admin\PayPalSettingController;
use App\Http\Controllers\Backend\Admin\SettingController;
use App\Http\Controllers\Backend\Admin\ProductController;
use App\Http\Controllers\Backend\Admin\ProductMultiImageController;
use App\Http\Controllers\Backend\Admin\ProductReviewController;
use App\Http\Controllers\Backend\Admin\ProductVariantController;
use App\Http\Controllers\Backend\Admin\ProductVariantItemController;
use App\Http\Controllers\Backend\Admin\ProfileController;
use App\Http\Controllers\Backend\Admin\ShippingController;
use App\Http\Controllers\Backend\Admin\SliderController;
use App\Http\Controllers\Backend\Admin\SubCategoryController;
use App\Http\Controllers\Backend\Admin\StripeSettingController;
use App\Http\Controllers\Backend\Admin\SubscriberController;
use App\Http\Controllers\Backend\Admin\TransactionController;
use App\Http\Controllers\Backend\Admin\VendorController;
use App\Http\Controllers\Backend\Admin\VNPaySettingController;
use App\Http\Controllers\Backend\Admin\VoucherController;
use App\Http\Controllers\Backend\Admin\WithdrawController;
use Illuminate\Support\Facades\Route;

// Admin Routes
Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

// Profile Routes
Route::controller(ProfileController::class)->group(function () {
    Route::get('profile', 'index')->name('profile'); //admin.profile
    Route::post('profile/update', 'updateProfile')->name('profile.update'); //admin.profile.update
    Route::post('profile/change-password', 'changePassword')->name('profile.change-password'); //admin.profile.change-password
});

// Slider Routes
Route::put('slider/change-status', [SliderController::class, 'changeStatus'])->name('slider.change-status');
Route::resource('slider', SliderController::class);

// Category Routes
Route::put('category/change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
Route::resource('category', CategoryController::class);

// Sub Category Routes
Route::put('sub-category/change-status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
Route::resource('sub-category', SubCategoryController::class);

// Child Category Routes
Route::put('child-category/change-status', [ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
Route::get('child-category/get-subcategories', [ChildCategoryController::class, 'getSubCategories'])->name('child-category.get-subcategories');
Route::resource('child-category', ChildCategoryController::class);

// Brand Routes
Route::put('brand/change-status', [BrandController::class, 'changeStatus'])->name('brand.change-status');
Route::resource('brand', BrandController::class);

// Product Routes
Route::controller(ProductController::class)->group(function () {
    Route::put('product/change-status', 'changeStatus')->name('product.change-status');
    Route::get('product/get-sub-categories', 'getSubCategories')->name('product.get-sub-categories');
    Route::get('product/get-child-categories', 'getChildCategories')->name('product.get-child-categories');
    Route::put('product/change-approve-status', 'changeApproveStatus')->name('product.change-approve-status');
    Route::get('product-pending/index', 'pendingProducts')->name('product-pending.index');
});
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

// Flash Sale Routes
Route::controller(FlashSaleController::class)->group(function () {
    Route::get('flash-sale', 'index')->name('flash-sale.index');
    Route::put('flash-sale-update', 'update')->name('flash-sale.update');
    Route::post('flash-sale/add-product', 'addProduct')->name('flash-sale.add-product');
    Route::put('flash-sale/change-show-home-page', 'changeShowHomePage')->name('flash-sale.change-show-home-page');
    Route::put('flash-sale/change-status', 'changeStatus')->name('flash-sale.change-status');
    Route::delete('flash-sale/{id}', 'destroy')->name('flash-sale.destroy');
});

// Order Routes
Route::controller(OrderController::class)->group(function () {
    Route::get('order/index', 'index')->name('order.index');
    Route::get('order/detail/{id}', 'showOrderDetail')->name('order.detail');
    Route::get('order/destroy/{id}', 'destroy')->name('order.destroy');
    Route::get('order/change-payment-status', 'changePaymentStatus')->name('order.change-payment-status');
    Route::get('order/change-status', 'changeStatus')->name('order.change-status');

    Route::get('order-unpaid', 'ordersUnPaidIndex')->name('order-unpaid.index');
    Route::get('order-paid', 'ordersPaidIndex')->name('order-paid.index');
    Route::get('order-pending', 'ordersPendingIndex')->name('order-pending.index');
    Route::get('order-confirmed', 'ordersConfirmedIndex')->name('order-confirmed.index');
    Route::get('order-preparing-the-goods', 'ordersPreparingTheGoodsIndex')->name('order-preparing-the-goods.index');
    Route::get('order-warehouse', 'ordersWarehouseIndex')->name('order-warehouse.index');
    Route::get('order-delivering', 'ordersDeliveringIndex')->name('order-delivering.index');
    Route::get('order-delivered', 'ordersDeliveredIndex')->name('order-delivered.index');
    Route::get('order-cancelled', 'ordersCancelledIndex')->name('order-cancelled.index');
});


// Transaction Routes
Route::controller(TransactionController::class)->group(function () {
    Route::get('transaction', 'index')->name('transaction.index');
    Route::get('transaction-paypal', 'transactionPayPalIndex')->name('transaction-paypal.index');
    Route::get('transaction-vnpay', 'transactionVNPayIndex')->name('transaction-vnpay.index');
    Route::get('transaction-stripe', 'transactionStripeIndex')->name('transaction-stripe.index');
    Route::get('transaction-cash', 'transactionCashIndex')->name('transaction-cash.index');
});


// Voucher Routes
Route::put('voucher/change-status', [VoucherController::class, 'changeStatus'])->name('voucher.change-status');
Route::resource('voucher', VoucherController::class);

// Shipping Routes
Route::put('shipping/change-status', [ShippingController::class, 'changeStatus'])->name('shipping.change-status');
Route::resource('shipping', ShippingController::class);


// Setting Routes
Route::controller(SettingController::class)->group(function () {
    Route::get('setting', 'index')->name('setting.index');
});

// General Setting Routes
Route::controller(GeneralSettingController::class)->group(function () {
    Route::put('general-setting/update/{id}', 'update')->name('general-setting.update');
});

// Paypal Setting Routes
Route::controller(PayPalSettingController::class)->group(function () {
    Route::put('paypal-setting/update/{id}', 'update')->name('paypal-setting.update');
});

// Stripe Setting Routes
Route::controller(StripeSettingController::class)->group(function () {
    Route::put('stripe-setting/update/{id}', 'update')->name('stripe-setting.update');
});

// VNPay Setting Routes
Route::controller(VNPaySettingController::class)->group(function () {
    Route::put('vnpay-setting/update/{id}', 'update')->name('vnpay-setting.update');
});

// Email Config Setting Routes
Route::controller(EmailConfigSettingController::class)->group(function () {
    Route::put('email-config-setting/update/{id}', 'update')->name('email-config-setting.update');
});


// Home Page Setting Routes
Route::controller(HomePageSettingController::class)->group(function () {
    Route::get('home-page-setting', 'index')->name('home-page-setting.index');
    Route::get('home-page-setting/get-sub-categories', 'getSubCategories')->name('home-page-setting.get-sub-categories');
    Route::get('home-page-setting/get-child-categories', 'getChildCategories')->name('home-page-setting.get-child-categories');
    Route::put('home-page-setting/featured-category/update', 'updateFeaturedCategory')->name('home-page-setting.featured-category.update');
    Route::put('home-page-setting/category-slider-one/update', 'updateCategorySliderOne')->name('home-page-setting.category-slider-one.update');
    Route::put('home-page-setting/category-slider-two/update', 'updateCategorySliderTwo')->name('home-page-setting.category-slider-two.update');
    Route::put('home-page-setting/category-slider-three/update', 'updateCategorySliderThree')->name('home-page-setting.category-slider-three.update');
});


// Footer Customer Routes
Route::put('footer-customer/change-status', [FooterCustomerController::class, 'changeStatus'])->name('footer-customer.change-status');
Route::resource('footer-customer', FooterCustomerController::class);

// Footer Company Routes
Route::put('footer-company/change-status', [FooterCompanyController::class, 'changeStatus'])->name('footer-company.change-status');
Route::resource('footer-company', FooterCompanyController::class);


// Subscriber Routes
Route::controller(SubscriberController::class)->group(function () {
    Route::get('subscriber/index', 'index')->name('subscriber.index');
    Route::post('subscriber/send-mail', 'sendMail')->name('subscriber.send-mail');
    Route::delete('subscriber/{id}', 'destroy')->name('subscriber.destroy');
});

// Advertisement Routes
Route::controller(AdvertisementController::class)->group(function () {
    Route::get('advertisement/index', 'index')->name('advertisement.index');
    Route::put('advertisement/home-page-banner-one', 'homePageBannerOne')->name('advertisement.home-page-banner-one');
    Route::put('advertisement/home-page-banner-two', 'homePageBannerTwo')->name('advertisement.home-page-banner-two');
    Route::put('advertisement/home-page-banner-three', 'homePageBannerThree')->name('advertisement.home-page-banner-three');
    Route::put('advertisement/home-page-banner-four', 'homePageBannerFour')->name('advertisement.home-page-banner-four');
    Route::put('advertisement/product-page-banner', 'productPageBanner')->name('advertisement.product-page-banner');
    Route::put('advertisement/cart-page-banner', 'cartPageBanner')->name('advertisement.cart-page-banner');
});

// Product Review Routes
Route::controller(ProductReviewController::class)->group(function () {
    Route::get('product-review/index', 'index')->name('product-review.index');
    Route::put('product-review/change-status', 'changeStatus')->name('product-review.change-status');
});

// Vendor Routes
Route::controller(VendorController::class)->group(function () {
    Route::get('vendor-approved/index', 'approvedVendors')->name('vendor-approved.index');
    Route::get('vendor-approved/detail/{id}', 'showDetailApprovedVendor')->name('vendor-approved.detail');
    Route::get('vendor-pending/index', 'pendingVendors')->name('vendor-pending.index');
    Route::get('vendor-pending/detail/{id}', 'showDetailPendingVendor')->name('vendor-pending.detail');
    Route::put('vendor-approved/change-status/{id}', 'changeStatusApprovedVendor')->name('vendor-approved.change-status');
    Route::put('vendor-pending/change-status/{id}', 'changeStatusPendingVendor')->name('vendor-pending.change-status');

    Route::get('vendor-condition/index', 'vendorCondition')->name('vendor-condition.index');
    Route::put('vendor-condition/update', 'updateVendorCondition')->name('vendor-condition.update');
});

// Customer Routes
Route::controller(AccountController::class)->group(function () {
    Route::get('account-user/index', 'getAccountUser')->name('account-user.index');
    Route::get('account-user/create', 'createAccountUser')->name('account-user.create');
    Route::post('account-user/store', 'storeAccountUser')->name('account-user.store');
    Route::put('account-user/change-status', 'changeStatusAccountUser')->name('account-user.change-status');

    Route::get('account-admin/index', 'getAccountAdmin')->name('account-admin.index');
    Route::get('account-admin/create', 'createAccountAdmin')->name('account-admin.create');
    Route::post('account-admin/store', 'storeAccountAdmin')->name('account-admin.store');
    Route::delete('account-admin/destroy/{id}', 'destroyAccountAdmin')->name('account-admin.destroy');
    Route::put('account-admin/change-status', 'changeStatusAccountAdmin')->name('account-admin.change-status');
});

// WithDrawMethod Routes
Route::controller(WithdrawController::class)->group(function () {
    Route::get('withdraw-method/index', 'getWithdrawMethod')->name('withdraw-method.index');
    Route::get('withdraw-method/create', 'createWithdrawMethod')->name('withdraw-method.create');
    Route::post('withdraw-method/store', 'storeWithdrawMethod')->name('withdraw-method.store');
    Route::get('withdraw-method/edit/{id}', 'editWithdrawMethod')->name('withdraw-method.edit');
    Route::put('withdraw-method/update/{id}', 'updateWithdrawMethod')->name('withdraw-method.update');
    Route::delete('withdraw-method/destroy/{id}', 'destroyWithdrawMethod')->name('withdraw-method.destroy');

    Route::get('withdraw-request/index', 'getWithdrawRequest')->name('withdraw-request.index');
    Route::get('withdraw-request/detail/{id}', 'showDetailWithdrawRequest')->name('withdraw-request.detail');
    Route::put('withdraw-request/update/{id}', 'updateWithdrawRequest')->name('withdraw-request.update');
});
