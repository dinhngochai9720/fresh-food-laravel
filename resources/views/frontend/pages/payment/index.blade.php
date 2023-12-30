@php
    $vnpay_setting = \App\Models\VNPaySetting::first();
    $paypal_setting = \App\Models\PayPalSetting::first();
    $stripe_setting = \App\Models\StripeSetting::first();
@endphp

@extends('frontend.layouts.master')

@section('title')
    Phương thức thanh toán
@endsection


@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Phương thức thanh toán</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Trang chủ</a></li>
                            <li><a href="javascript:;">Phương thức thanh toán</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- payment --}}
    <section id="wsus__cart_view">
        <div class="container">
            <div class="wsus__pay_info_area">
                <div class="row">
                    <div class="col-xl-3 col-lg-3">
                        <div class="wsus__payment_menu" id="sticky_sidebar">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">

                                {{-- <button class="nav-link common_btn active" id="v-pills-paypal-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-paypal" type="button" role="tab"
                                aria-controls="v-pills-paypal" aria-selected="true">PayPal
                            </button> --}}

                                @if ($paypal_setting->status == 1)
                                    <button class="nav-link common_btn" id="v-pills-paypal-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-paypal" type="button" role="tab"
                                        aria-controls="v-pills-paypal" aria-selected="true">PayPal
                                    </button>
                                @endif

                                @if ($stripe_setting->status == 1)
                                    <button class="nav-link common_btn" id="v-pills-stripe-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-stripe" type="button" role="tab"
                                        aria-controls="v-pills-stripe" aria-selected="true">Stripe
                                    </button>
                                @endif

                                @if ($vnpay_setting->status == 1)
                                    <button class="nav-link common_btn" id="v-pills-vnpay-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-vnpay" type="button" role="tab"
                                        aria-controls="v-pills-vnpay" aria-selected="false">VNPay
                                    </button>
                                @endif

                                <button class="nav-link common_btn" id="v-pills-cash-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-cash" type="button" role="tab"
                                    aria-controls="v-pills-cash" aria-selected="false">Tiền mặt
                                </button>

                                {{-- <button class="nav-link common_btn" id="v-pills-zalopay-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-zalopay" type="button" role="tab"
                                    aria-controls="v-pills-zalopay" aria-selected="false">ZaloPay
                                </button>

                                <button class="nav-link common_btn" id="v-pills-momo-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-momo" type="button" role="tab"
                                    aria-controls="v-pills-momo" aria-selected="false">MoMo
                                </button> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <div class="tab-content" id="v-pills-tabContent" id="sticky_sidebar">
                            @include('frontend.pages.payment.gateway.paypal')
                            @include('frontend.pages.payment.gateway.stripe')
                            @include('frontend.pages.payment.gateway.cash')
                            @include('frontend.pages.payment.gateway.vnpay')
                            @include('frontend.pages.payment.gateway.momo')
                            @include('frontend.pages.payment.gateway.zalopay')
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <div class="wsus__pay_booking_summary" id="sticky_sidebar2">
                            <h5>Chi tiết thanh toán</h5>
                            <p>Tổng tiền hàng: <span>
                                    {{ number_format(getTotalCartPrice(), 0, '.', '.') }}{{ $settings->currency_icon }}</span>
                            </p>
                            <p>Chi phí vận chuyển: <span>
                                    +{{ number_format(getShippingFee(), 0, '.', '.') }}{{ $settings->currency_icon }}
                                </span>
                            </p>
                            <p>Giảm giá: <span>
                                    -{{ number_format(getCartDiscount(), 0, '.', '.') }}{{ $settings->currency_icon }}</span>
                            </p>
                            <h6>Tổng thanh toán <span>
                                    {{ number_format(getNetFinalToTalCartPrice(), 0, '.', '.') }}{{ $settings->currency_icon }}</span>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
