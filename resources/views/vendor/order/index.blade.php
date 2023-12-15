@extends('vendor.layouts.master')

@section('title')
    Quản lý đơn hàng
@endsection

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">

            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">

                        <h3>Quản lý đơn hàng</h3>

                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6>Danh sách đơn hàng của khách hàng</h6>
                        </div>


                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <div class="table-responsive">
                                    <table id="myDatatable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Mã hóa đơn</th>
                                                <th>Khách hàng</th>
                                                <th>Phương thức thanh toán</th>
                                                <th>Trạng thái thanh toán</th>
                                                <th>Ngày đặt hàng</th>
                                                <th>Trạng thái đơn hàng</th>
                                                <th>Xem</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $key => $order)
                                                @php
                                                    $address = json_decode($order->address);
                                                @endphp

                                                <tr>
                                                    <td>
                                                        {{ $key + 1 }}
                                                    </td>
                                                    <td>{{ $order->invoice_id }}</td>
                                                    <td>{{ $address->name }}</td>
                                                    <td>
                                                        @if ($order->payment_method == 'paypal')
                                                            <span> PayPal</span>
                                                        @elseif ($order->payment_method == 'stripe')
                                                            <span> Stripe</span>
                                                        @elseif ($order->payment_method == 'vnpay')
                                                            <span> VNPay</span>
                                                        @elseif ($order->payment_method == 'momo')
                                                            <span> MoMo</span>
                                                        @elseif ($order->payment_method == 'cash')
                                                            <span> Tiền mặt</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($order->payment_status == 1)
                                                            <span class="rounded-pill badge bg-success">Đã thanh toán</span>
                                                        @elseif ($order->payment_status == 0)
                                                            <span class="rounded-pill badge bg-warning">Chưa thanh
                                                                toán</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                                                    <td>
                                                        @if ($order->status == 'pending')
                                                            <span>Chờ xử lý</span>
                                                        @elseif ($order->status == 'confirmed')
                                                            <span>Xác nhận</span>
                                                        @elseif ($order->status == 'preparing_the_goods')
                                                            <span>Người bán đang chuẩn bị hàng</span>
                                                        @elseif ($order->status == 'warehouse')
                                                            <span>Đơn hàng đã đến kho trung chuyển</span>
                                                        @elseif ($order->status == 'delivering')
                                                            <span>Đang giao hàng</span>
                                                        @elseif ($order->status == 'delivered')
                                                            <span>Giao hàng thành công</span>
                                                        @elseif ($order->status == 'cancelled')
                                                            <span>Hủy đơn hàng</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('vendor.order.detail', $order->id) }}"
                                                            class='btn btn-primary mr-2'><i
                                                                class="fa-regular fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
