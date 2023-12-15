@extends('frontend.user.layouts.master')

@section('title')
    Trang chủ
@endsection

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">

            {{-- sidebar --}}
            @include('frontend.user.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content">
                        <div class="wsus__dashboard">
                            <div class="row">
                                {{-- <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item orange" href="{{ route('user.profile') }}">
                                        <i class="fas fa-user-shield"></i>
                                        <p>Hồ sơ</p>
                                    </a>
                                </div> --}}

                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item blue" href="{{ route('user.order.index') }}">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <p>Tổng đơn hàng</p>
                                        <p>{{ $total_order }}</p>
                                    </a>
                                </div>
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item green" href="{{ route('user.order.index') }}">
                                        <i class="fa-solid fa-check"></i>
                                        <p>Đơn hàng đã giao</p>
                                        <p>{{ $total_order_delivered }}</p>
                                    </a>
                                </div>
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item red" href="{{ route('user.order.index') }}">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                        <p>Đơn hàng đã hủy</p>
                                        <p>{{ $total_order_cancelled }}</p>
                                    </a>
                                </div>
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item sky" href="{{ route('user.review.index') }}">
                                        <i class="fas fa-star"></i>
                                        <p>Đánh giá sản phẩm</p>
                                        <p>{{ $total_review }}</p>
                                    </a>
                                </div>
                                <div class="col-xl-2 col-6 col-md-4">
                                    <a class="wsus__dashboard_item purple" href="{{ route('user.wishlist') }}">
                                        <i class="far fa-heart"></i>
                                        <p>Sản phẩm yêu thích</p>
                                        <p>{{ $total_wishlist }}</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
