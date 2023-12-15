@extends('vendor.layouts.master')

@section('title')
    Trang chủ
@endsection

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content">
                        <div class="wsus__dashboard">
                            <div class="row">
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item blue" href="{{ route('vendor.order.index') }}">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <p>Đơn hàng hôm nay</p>
                                        <p>{{ $total_order_today }}</p>
                                    </a>
                                </div>

                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item orange" href="{{ route('vendor.order.index') }}">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <p>Đơn hàng chờ xử lý</p>
                                        <p>{{ $total_order_pending }}</p>
                                    </a>
                                </div>

                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item green" href="{{ route('vendor.order.index') }}">
                                        <i class="fa-solid fa-check"></i>
                                        <p>Đơn hàng đã giao</p>
                                        <p>{{ $total_order_delivered }}</p>
                                    </a>
                                </div>

                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item red" href="{{ route('vendor.order.index') }}">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                        <p>Đơn hàng đã hủy</p>
                                        <p>{{ $total_order_cancelled }}</p>
                                    </a>
                                </div>

                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item blue" href="{{ route('vendor.order.index') }}">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <p>Tổng đơn hàng</p>
                                        <p>{{ $total_order }}</p>
                                    </a>
                                </div>

                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item blue" href="{{ route('vendor.product.index') }}">
                                        <i class="fa-brands fa-product-hunt"></i>
                                        <p>Sản phẩm</p>
                                        <p>{{ $total_product }}</p>
                                    </a>
                                </div>

                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item sky" href="{{ route('vendor.product-review.index') }}">
                                        <i class="fas fa-star"></i>
                                        <p>Đánh giá sản phẩm</p>
                                        <p>{{ $total_review }}</p>
                                    </a>
                                </div>

                                @php
                                    $total_invoice_today = 0;
                                @endphp
                                @foreach ($orders_delivered_today as $order)
                                    @foreach ($order->orderDetail as $key => $product)
                                        @if ($product->vendor_id == Auth::user()->vendor->id)
                                            @php
                                                $product_price = $product->product_price + $product->variant_total_price;
                                                $total_invoice_today += $product_price * $product->product_qty;
                                            @endphp
                                        @else
                                        @endif
                                    @endforeach
                                @endforeach
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item green" href="javascript:;">
                                        <i class="fa-solid fa-money-bill-1"></i>
                                        <p>Thu nhập hôm nay</p>
                                        <p>
                                            {{ number_format($total_invoice_today, 0, '.', '.') }}{{ $settings->currency_icon }}
                                        </p>
                                    </a>
                                </div>

                                @php
                                    $total_invoice_month = 0;
                                    $month = Carbon\Carbon::now()->format('m-Y');
                                @endphp
                                @foreach ($orders_delivered_month as $order)
                                    @foreach ($order->orderDetail as $key => $product)
                                        @if ($product->vendor_id == Auth::user()->vendor->id)
                                            @php
                                                $product_price = $product->product_price + $product->variant_total_price;
                                                $total_invoice_month += $product_price * $product->product_qty;
                                            @endphp
                                        @else
                                        @endif
                                    @endforeach
                                @endforeach
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item green" href="javascript:;">
                                        <i class="fa-solid fa-money-bill-1"></i>
                                        <p>Thu nhập {{ $month }} </p>
                                        <p>
                                            {{ number_format($total_invoice_month, 0, '.', '.') }}{{ $settings->currency_icon }}
                                        </p>
                                    </a>
                                </div>


                                @php
                                    $total_invoice_year = 0;
                                    $year = Carbon\Carbon::now()->format('Y');
                                @endphp
                                @foreach ($orders_delivered_year as $order)
                                    @foreach ($order->orderDetail as $key => $product)
                                        @if ($product->vendor_id == Auth::user()->vendor->id)
                                            @php
                                                $product_price = $product->product_price + $product->variant_total_price;
                                                $total_invoice_year += $product_price * $product->product_qty;
                                            @endphp
                                        @else
                                        @endif
                                    @endforeach
                                @endforeach
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item green" href="javascript:;">
                                        <i class="fa-solid fa-money-bill-1"></i>
                                        <p>Thu nhập {{ $year }} </p>
                                        <p>
                                            {{ number_format($total_invoice_year, 0, '.', '.') }}{{ $settings->currency_icon }}
                                        </p>
                                    </a>
                                </div>

                                @php
                                    $total_invoice = 0;
                                @endphp
                                @foreach ($orders_delivered as $order)
                                    @foreach ($order->orderDetail as $key => $product)
                                        @if ($product->vendor_id == Auth::user()->vendor->id)
                                            @php
                                                $product_price = $product->product_price + $product->variant_total_price;
                                                $total_invoice += $product_price * $product->product_qty;
                                            @endphp
                                        @else
                                        @endif
                                    @endforeach
                                @endforeach
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item green" href="javascript:;">
                                        <i class="fa-solid fa-money-bill-1"></i>
                                        <p>Tổng thu nhập</p>
                                        <p>
                                            {{ number_format($total_invoice, 0, '.', '.') }}{{ $settings->currency_icon }}
                                        </p>
                                    </a>
                                </div>


                                {{-- <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item blue" href="dsahboard_wishlist.html">
                                        <i class="far fa-heart"></i>
                                        <p>wishlist</p>
                                    </a>
                                </div>
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item orange" href="dsahboard_profile.html">
                                        <i class="fas fa-user-shield"></i>
                                        <p>profile</p>
                                    </a>
                                </div>
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item purple" href="dsahboard_address.html">
                                        <i class="fal fa-map-marker-alt"></i>
                                        <p>address</p>
                                    </a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
