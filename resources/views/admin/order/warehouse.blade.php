@extends('admin.layouts.master')

@section('title')
    Đơn hàng đã đến kho
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Đơn hàng đã đến kho</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Danh sách đơn hàng</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myDatatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Mã hóa đơn</th>
                                            <th>Khách hàng</th>
                                            <th>Tổng tiền hàng</th>
                                            <th>Giảm giá</th>
                                            <th>Phí vận chuyển</th>
                                            <th>Tổng thanh toán</th>
                                            <th>Phương thức thanh toán</th>
                                            <th>Trạng thái thanh toán</th>
                                            <th>Ngày đặt hàng</th>
                                            <th>Sửa/Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders_warehouse as $key => $order)
                                            @php
                                                $net_total_price = $order->final_total_price + $order->shipping_fee;
                                            @endphp

                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $order->invoice_id }}</td>
                                                <td>{{ $order->user->name }}</td>
                                                <td>{{ number_format($order->total_price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                </td>
                                                <td>{{ number_format($order->discount, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                </td>
                                                <td>{{ number_format($order->shipping_fee, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                </td>
                                                <td>{{ number_format($net_total_price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                </td>
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
                                                        <span class="badge badge-success">Đã thanh toán</span>
                                                    @else
                                                        <span class="badge badge-warning">Chưa thanh toán</span>
                                                    @endif
                                                </td>
                                                <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <a href="{{ route('admin.order.detail', $order->id) }}"
                                                            class='btn btn-primary ml-2 mr-2'><i
                                                                class="fa-regular fa-eye"></i></a>

                                                        <a href="{{ route('admin.order.destroy', $order->id) }}"
                                                            class='btn btn-danger' id='delete-item'><i
                                                                class='fa-regular fa-trash-can'></i></a>
                                                    </div>
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
    </section>
@endsection
