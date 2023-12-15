@extends('frontend.layouts.master')

@section('title')
    Tìm kiếm đơn hàng
@endsection


@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Tìm kiếm đơn hàng</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Trang chủ</a></li>
                            <li><a href="javascript:;">
                                    Tìm kiếm đơn hàng
                                </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__login_register">
        <div class="container">
            <div class="wsus__track_area">
                <div class="row">
                    <div class="col-xl-5 col-md-10 col-lg-8 m-auto">
                        <form class="tack_form" action="{{ route('user.track-order.index') }}" method="GET">
                            <h4 class="text-center">Tìm kiếm đơn hàng</h4>
                            <div class="wsus__track_input">
                                <label class="d-block mb-2">Mã đơn hàng</label>
                                <input type="text" placeholder="Nhập mã đơn hàng của bạn" name="invoice_id"
                                    value="{{ request()->invoice_id }}">
                            </div>
                            <button type="submit" class="common_btn">Tìm kiếm</button>
                        </form>
                    </div>
                </div>

                @if (isset($order))
                    @php
                        $address = json_decode($order->address);
                    @endphp
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="wsus__track_header">
                                <div class="wsus__track_header_text">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6 col-lg-3">
                                            <div class="wsus__track_header_single">
                                                <h5>Khách hàng:</h5>
                                                <p>{{ $address->name }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-lg-3">
                                            <div class="wsus__track_header_single">
                                                <h5>Địa chỉ:</h5>
                                                <p>{{ $address->address }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-lg-3">
                                            <div class="wsus__track_header_single">
                                                <h5>Trạng thái đơn hàng:</h5>
                                                @if ($order->status == 'pending')
                                                    <p>Chờ xử lý</p>
                                                @elseif ($order->status == 'confirmed')
                                                    <p>Đã xác nhận</p>
                                                @elseif ($order->status == 'preparing_the_goods')
                                                    <p>Người bán đang chuẩn bị hàng</p>
                                                @elseif ($order->status == 'warehouse')
                                                    <p>Đơn hàng đã đến kho trung chuyển</p>
                                                @elseif ($order->status == 'delivering')
                                                    <p>Đang giao hàng</p>
                                                @elseif ($order->status == 'delivered')
                                                    <p>Giao hàng thành công</p>
                                                @elseif ($order->status == 'cancelled')
                                                    <p>Hủy đơn hàng</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-lg-3">
                                            <div class="wsus__track_header_single border_none">
                                                <h5>Ngày đặt hàng:</h5>
                                                <p>{{ date('d-m-Y', strtotime($order->created_at)) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <ul class="progtrckr" data-progtrckr-steps="4">
                                <li class="progtrckr_done icon_one check_mark">Chờ xử lý</li>
                                <li
                                    class="progtrckr_done icon_two
                                @if (
                                    $order->status == 'confirmed' ||
                                        $order->status == 'preparing_the_goods' ||
                                        $order->status == 'warehouse' ||
                                        $order->status == 'delivering' ||
                                        $order->status == 'delivered' ||
                                        $order->status == 'cancelled') check_mark @endif
                                ">
                                    Đang xử lý</li>
                                <li
                                    class="icon_three 
                                @if (
                                    $order->status == 'warehouse' ||
                                        $order->status == 'delivering' ||
                                        $order->status == 'delivered' ||
                                        $order->status == 'cancelled') check_mark @endif">
                                    Đang giao hàng
                                </li>
                                <li
                                    class="icon_four 
                                    @if ($order->status == 'delivered' || $order->status == 'cancelled') check_mark @endif">
                                    Giao hàng thành công</li>
                            </ul>
                        </div>
                        <div class="col-xl-12">
                            <a href="{{ url('/') }}" class="common_btn"><i class="fas fa-chevron-left"></i> Quay lại
                                trang chủ</a>
                        </div>
                    </div>
                @else
                @endif
            </div>
        </div>
    </section>
@endsection
