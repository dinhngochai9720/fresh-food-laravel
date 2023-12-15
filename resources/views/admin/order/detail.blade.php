@php
    $address = json_decode($order->address);

    $net_final_total_price = $order->final_total_price + $order->shipping_fee;
@endphp

@extends('admin.layouts.master')

@section('title')
    Chi tiết đơn hàng
@endsection

@section('content')
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1>Chi tiết đơn hàng</h1>
            <a href="{{ route('admin.order.index') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Quay
                lại</a>
        </div>

        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <h6>Đơn hàng #{{ $order->invoice_id }}</h6>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <address>
                                        Khách hàng: <strong> {{ $address->name }}</strong><br>
                                        Email: <strong>{{ $address->email }}</strong><br>
                                        Điện thoại: <strong>{{ $address->phone }}</strong><br>
                                    </address>
                                </div>
                                <div class="col-md-4 text-center">
                                    <address>
                                        Địa chỉ: <strong>{{ $address->address }}</strong><br>
                                        Tỉnh/Thành phố: <strong>{{ $address->city }}</strong><br>
                                        Quận/Huyện: <strong>{{ $address->district }}</strong><br>
                                        Xã/Phường: <strong>{{ $address->ward }}</strong><br>
                                    </address>
                                </div>

                                <div class="col-md-4 text-right">
                                    <address>
                                        Mã giao dịch: <strong>{{ @$order->transaction->transaction_id }}</strong>
                                        <br>
                                        Phương thức thanh toán: @if ($order->payment_method == 'paypal')
                                            <b>PayPal</b>
                                        @elseif ($order->payment_method == 'stripe')
                                            <b>Stripe</b>
                                        @elseif ($order->payment_method == 'vnpay')
                                            <b>VNPay</b>
                                        @elseif ($order->payment_method == 'cash')
                                            <b>Tiền mặt</b>
                                        @endif
                                        <br>
                                        Ngày đặt hàng:
                                        <strong>{{ date('d-m-Y', strtotime($order->created_at)) }}</strong>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title">Sản phẩm</div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        <th class="text-left">STT</th>
                                        <th class="text-center">Tên sản phẩm</th>
                                        <th class="text-center">Nhà cung cấp</th>
                                        <th class="text-center">Giá</th>
                                        <th class="text-center">Số lượng</th>
                                        <th class="text-right">Tổng</th>
                                    </tr>

                                    @foreach ($order->orderDetail as $key => $product)
                                        @php
                                            $product_price = $product->product_price + $product->variant_total_price;
                                            $total_price = $product_price * $product->product_qty;
                                            $variants = json_decode($product->variants);
                                        @endphp

                                        <tr>
                                            <td class="text-left">{{ $key + 1 }}</td>
                                            <td class="text-center">
                                                <span>
                                                    {{ $product->product_name }}
                                                </span>
                                                <br>
                                                <span>
                                                    @foreach ($variants as $key => $variant)
                                                        <span>{{ $key }}: {{ $variant->name }}</span><br>
                                                    @endforeach
                                                </span>

                                            </td>
                                            <td class="text-center">
                                                {{ $product->vendor->shop_name }}
                                            </td>
                                            <td class="text-center">
                                                {{ number_format($product_price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                            </td>
                                            <td class="text-center">{{ $product->product_qty }}</td>
                                            <td class="text-right">
                                                {{ number_format($total_price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="order_status">Trạng thái đơn hàng</label>
                                                <select class="form-control" data-id="{{ $order->id }}"
                                                    name="order_status" id="order_status">
                                                    @foreach (config('order_status.admin') as $key => $status)
                                                        <option {{ $order->status == $key ? 'selected' : '' }}
                                                            value="{{ $key }}">{{ $status['status'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="payment_status">Trạng thái thanh toán</label>
                                                <select class="form-control" data-id="{{ $order->id }}"
                                                    name="payment_status" id="payment_status">
                                                    <option {{ $order->payment_status == 0 ? 'selected' : '' }}
                                                        value="0">Chưa thanh toán
                                                    </option>
                                                    <option {{ $order->payment_status == 1 ? 'selected' : '' }}
                                                        value="1">Đã thanh toán
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 text-right">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Tổng tiền hàng</div>
                                        <div class="invoice-detail-value">
                                            {{ number_format($order->total_price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                        </div>
                                    </div>

                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Giảm giá</div>
                                        <div class="invoice-detail-value">
                                            -{{ number_format($order->discount, 0, '.', '.') }}{{ $settings->currency_icon }}
                                        </div>
                                    </div>

                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Phí vận chuyển</div>
                                        <div class="invoice-detail-value">
                                            +{{ number_format($order->shipping_fee, 0, '.', '.') }}{{ $settings->currency_icon }}
                                        </div>
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Tổng thanh toán</div>
                                        <div class="invoice-detail-value">
                                            {{ number_format($net_final_total_price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-md-right">
                    <div class="float-lg-left mb-lg-0 mb-3">
                    </div>
                    <button class="btn btn-warning btn-icon icon-left btn-print-invoice-admin"><i class="fas fa-print"></i>
                        In hóa
                        đơn</button>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // laravel csrf
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            // change order status
            $('#order_status').on('change', function() {
                let order_status = $(this).val();
                let order_id = $(this).data('id');

                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.order.change-status') }}",
                    data: {
                        status: order_status,
                        id: order_id
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            toastr.success(data.message)
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                })
            })

            // change payment status
            $('#payment_status').on('change', function() {
                let payment_status = $(this).val();
                let order_id = $(this).data('id');

                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.order.change-payment-status') }}",
                    data: {
                        payment_status: payment_status,
                        id: order_id
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            toastr.success(data.message)
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                })
            })

            $('.btn-print-invoice-admin').on('click', function() {
                let invoice_body = $('.invoice-print');
                let original_contents = $('body').html();

                $('body').html(invoice_body.html());

                window.print();

                $('body').html(original_contents);
            })

        })
    </script>
@endpush
