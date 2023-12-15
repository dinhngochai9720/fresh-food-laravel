<?php

use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\Backend\Admin\LoginController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsletterController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\User\AddressController;
use App\Http\Controllers\Frontend\User\CashController;
use App\Http\Controllers\Frontend\User\CheckoutController;
use App\Http\Controllers\Frontend\User\MoMoController;
use App\Http\Controllers\Frontend\User\OrderController;
use App\Http\Controllers\Frontend\User\PaymentController;
use App\Http\Controllers\Frontend\User\PayPalController;
use App\Http\Controllers\Frontend\User\ReviewController;
use App\Http\Controllers\Frontend\User\StripeController;
use App\Http\Controllers\Frontend\User\DashboardController;
use App\Http\Controllers\Frontend\User\ProfileController;
use App\Http\Controllers\Frontend\User\VendorRequestController;
use App\Http\Controllers\Frontend\User\VNPayController;
use App\Http\Controllers\Frontend\User\WishlistController;
use App\Http\Controllers\Frontend\User\ZaloPayController;
use App\Http\Controllers\Frontend\VendorController;
// use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Flash Sale Route
Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale');

// Product Routes
Route::controller(ProductController::class)->group(function () {
    Route::get('product-detail/{slug}/{id}', 'showProductDetail')->name('product-detail');
    Route::get('products/view', 'viewProducts')->name('products.view');
});




// Google Login User Routes
Route::controller(GoogleLoginController::class)->group(function () {
    Route::get('google/login', 'googleLogin')->name('google.login');
    Route::get('auth/google/callback', 'authGoogleCallback')->name('auth.google.callback');
});

// User Routes
Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function () {
    // User Dashboard
    Route::controller(DashboardController::class)->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
    });

    // User Profile
    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile', 'index')->name('profile'); //user.profile
        Route::put('profile/update', 'updateProfile')->name('profile.update'); //user.profile.update
        Route::post('profile/change-password', 'changePassword')->name('profile.change-password'); //user.profile.change-password
    });

    // User Address
    Route::resource('address', AddressController::class);

    // Checkout 
    Route::controller(CheckoutController::class)->group(function () {
        Route::get('checkout', 'index')->name('checkout');
        Route::post('checkout/add-new-address', 'addNewAddress')->name('checkout.add-new-address');
        Route::post('checkout/submit', 'submit')->name('checkout.submit');
    });

    // Payment
    Route::controller(PaymentController::class)->group(function () {
        Route::get('payment', 'index')->name('payment');
        Route::get('payment-success', 'paymentSuccess')->name('payment-success');
    });

    // PayPal
    Route::controller(PayPalController::class)->group(function () {
        Route::get('payment/paypal', 'payWithPayPal')->name('payment.paypal');
        Route::get('payment/paypal-success', 'payWithPayPalSuccess')->name('payment.paypal-success');
        Route::get('payment/paypal-cancel', 'payWithPayPalCancel')->name('payment.paypal-cancel');
    });

    // Stripe
    Route::controller(StripeController::class)->group(function () {
        Route::post('payment/stripe', 'payWithStripe')->name('payment.stripe');
    });

    // Cash
    Route::controller(CashController::class)->group(function () {
        Route::get('payment/cash', 'payWithCash')->name('payment.cash');
    });

    // VNPay
    Route::controller(VNPayController::class)->group(function () {
        Route::post('payment/vnpay', 'payWithVNPay')->name('payment.vnpay');
        Route::get('payment/vnpay-return', 'payWithVNPayReturn')->name('payment.vnpay-return');
    });

    // MoMo
    Route::controller(MoMoController::class)->group(function () {
        Route::post('payment/momo', 'payWithMoMo')->name('payment.momo');
        Route::get('payment/momo-return', 'payWithMoMoReturn')->name('payment.momo-return');
    });

    // ZaloPay
    Route::controller(ZaloPayController::class)->group(function () {
        Route::post('payment/zalopay', 'payWithZaloPay')->name('payment.zalopay');
        // Route::get('payment/momo-return', 'payWithMoMoReturn')->name('payment.momo-return');
    });

    // Order
    Route::controller(OrderController::class)->group(function () {
        Route::get('order', 'index')->name('order.index');
        Route::get('order/detail/{id}', 'showOrderDetail')->name('order.detail');

        // Track Order
        Route::get('track-order/index', 'trackOrder')->name('track-order.index');
    });

    // Wishlist
    Route::controller(WishlistController::class)->group(function () {
        Route::get('wishlist', 'index')->name('wishlist');
        Route::get('wishlist/add-product', 'addProductToWishlist')->name('wishlist.add-product');
        Route::get('wishlist/count-product', 'countProductWishlist')->name('wishlist.count-product');
        Route::delete('wishlist/delete-product/{id}', 'deleteProductWishlist')->name('wishlist.delete-product');
    });

    // Product Review
    Route::controller(ReviewController::class)->group(function () {
        Route::get('review', 'index')->name('review.index');
        Route::post('review', 'create')->name('review.create');
    });

    // Vendor Request
    Route::controller(VendorRequestController::class)->group(function () {
        Route::get('vendor-request', 'index')->name('vendor-request.index');
        Route::post('vendor-request/create', 'create')->name('vendor-request.create');
    });
});

// Cart Routes
Route::controller(CartController::class)->group(function () {
    Route::post('cart/buy-product-now', 'buyProductNow')->name('cart.buy-product-now');
    Route::post('cart/add-product-to-cart', 'addProductToCart')->name('cart.add-product-to-cart');
    Route::get('cart/cart-detail', 'viewCartDetails')->name('cart.cart-detail');
    Route::post('cart/update-product-quantity', 'updateProductQuantity')->name('cart.update-product-quantity');
    Route::get('cart/clear-cart', 'clearCart')->name('cart.clear-cart');
    Route::get('cart/delete-product-cart/{rowId}', 'deleteProductCart')->name('cart.delete-product-cart');
    Route::get('cart/count-product-cart', 'countProductCart')->name('cart.count-product-cart');
    Route::get('cart/get-products-cart', 'getProductsCart')->name('cart.get-products-cart');
    Route::post('cart/delete-product-mini-cart', 'deleteProductMiniCart')->name('cart.delete-product-mini-cart');
    Route::get('cart/total-cart-price', 'getTotalCartPrice')->name('cart.total-cart-price');
    Route::get('cart/apply-voucher-to-cart', 'applyVoucher')->name('cart.apply-voucher-to-cart');
    Route::get('cart/delete-voucher-to-cart', 'deleteVoucher')->name('cart.delete-voucher-to-cart');
    Route::get('cart/calculate-voucher-discount', 'calculateVoucherDiscount')->name('cart.calculate-voucher-discount');
});

// News Letter Routes
Route::controller(NewsletterController::class)->group(function () {
    Route::post('newsletter/request', 'newsletterRequest')->name('newsletter.request');
    Route::get('newsletter/verify/{token}', 'newsletterEmailVerify')->name('newsletter.verify');
});

// Vendor Routes
Route::controller(VendorController::class)->group(function () {
    Route::get('vendors', 'getAllVendors')->name('vendors');
    Route::get('vendor/products/{id}', 'showVendorProducts')->name('vendor.products');
});
