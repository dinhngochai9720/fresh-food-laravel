@extends('admin.layouts.master')

@section('title')
    Trang chủ
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Trang chủ</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Đơn hàng hôm nay</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_order_today }}
                        </div>
                    </div>
                </div>
            </div>

            @php
                $month = Carbon\Carbon::now()->format('m-Y');
            @endphp
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Đơn hàng {{ $month }}</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_order_month }}
                        </div>
                    </div>
                </div>
            </div>

            @php
                $year = Carbon\Carbon::now()->format('Y');
            @endphp
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Đơn hàng {{ $year }}</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_order_year }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Tổng đơn hàng</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_order }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Đơn hàng chờ xử lý</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_order_pending }}
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Đơn hàng xác nhận</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_order_confirmed }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Đơn hàng đã giao</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_order_delivered }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Đơn hàng đã hủy</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_order_cancelled }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon">
                        <i class="fa-solid fa-money-bill-1"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Thu nhập hôm nay</h4>
                        </div>
                        <div class="card-body">
                            {{ number_format($total_price_order_today, 0, '.', '.') }}{{ $settings->currency_icon }}
                        </div>
                    </div>
                </div>
            </div>

            @php
                $month = Carbon\Carbon::now()->format('m-Y');
            @endphp
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon">
                        <i class="fa-solid fa-money-bill-1"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Thu nhập {{ $month }}</h4>
                        </div>
                        <div class="card-body">
                            {{ number_format($total_price_order_month, 0, '.', '.') }}{{ $settings->currency_icon }}
                        </div>
                    </div>
                </div>
            </div>

            @php
                $year = Carbon\Carbon::now()->format('Y');
            @endphp
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon">
                        <i class="fa-solid fa-money-bill-1"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Thu nhập {{ $year }}</h4>
                        </div>
                        <div class="card-body">
                            {{ number_format($total_price_order_year, 0, '.', '.') }}{{ $settings->currency_icon }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon">
                        <i class="fa-solid fa-money-bill-1"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Tổng phí vận chuyển</h4>
                        </div>
                        <div class="card-body">
                            {{ number_format($total_shipping_fee_order, 0, '.', '.') }}{{ $settings->currency_icon }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon">
                        <i class="fa-solid fa-money-bill-1"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Tổng thu nhập</h4>
                        </div>
                        <div class="card-body">
                            {{ number_format($total_price_order, 0, '.', '.') }}{{ $settings->currency_icon }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon">
                        <i class="fa-solid fa-money-bill-1"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Tổng giảm giá</h4>
                        </div>
                        <div class="card-body">
                            {{ number_format($total_discount, 0, '.', '.') }}{{ $settings->currency_icon }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon">
                        <i class="fa-solid fa-money-bill-1"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Tổng lợi nhuận</h4>
                        </div>
                        <div class="card-body">
                            {{ number_format($total_final_price_order, 0, '.', '.') }}{{ $settings->currency_icon }}
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon">
                        <i class="fa-solid fa-tags"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Voucher</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_voucher }}
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon">
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Đánh giá sản phẩm</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_review }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon">
                        <i class="fa-solid fa-copyright"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Thương hiệu</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_brand }}
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon">
                        <i class="fa-solid fa-list"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Danh mục</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_category }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon">
                        <i class="fa-brands fa-product-hunt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Sản phẩm chấp thuận</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_approved_product }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon">
                        <i class="fa-brands fa-product-hunt"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Sản phẩm chờ xử lý</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_pending_product }}
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Tài khoản</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_account }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon">
                        <i class="fa-brands fa-shopify"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Nhà cung cấp</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_vendor }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Quản trị viên</h4>
                        </div>
                        <div class="card-body">
                            {{ $total_admin }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
