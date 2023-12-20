@php
    $address = json_decode($order->address);
    $net_final_total_price = $order->final_total_price + $order->shipping_fee;
@endphp

@extends('frontend.user.layouts.master')


@section('title')
    Chi tiết đơn hàng
@endsection

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">

            {{-- sidebar --}}
            @include('frontend.user.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h3>Chi tiết đơn hàng</h3>
                        <a href="{{ route('user.order.index') }}" class="btn btn-primary"><i
                                class="fa-solid fa-arrow-left"></i> Quay
                            lại</a>
                    </div>

                    <div class="dashboard_content">
                        <div class="wsus__invoice_area">
                            <div class="wsus__invoice_header">
                                <div class="wsus__invoice_content">
                                    <div class="row">
                                        <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                            <div class="wsus__invoice_single">
                                                <h5>Đơn hàng: #{{ $order->invoice_id }}</h5>
                                                <h6>Khách hàng: {{ $address->name }}</h6>
                                                <p>Email: {{ $address->email }}</p>
                                                <p>Điện thoại: {{ $address->phone }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                            <div class="wsus__invoice_single text-md-center">
                                                <h5>Thông tin vận chuyển</h5>
                                                <h6>Địa chỉ: {{ $address->address }}</h6>
                                                <p>Tỉnh/Thành phố: {{ $address->city }}</p>
                                                <p>Quận/Huyện: {{ $address->district }}</p>
                                                <p>Xã/Phường: {{ $address->ward }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-4">
                                            <div class="wsus__invoice_single text-md-end">
                                                <h5>Chi tiết thanh toán</h5>
                                                <h6>Mã giao dịch: {{ @$order->transaction->transaction_id }}</h6>
                                                <p>Phương thức thanh toán: @if ($order->payment_method == 'paypal')
                                                        PayPal
                                                    @elseif ($order->payment_method == 'stripe')
                                                        Stripe
                                                    @elseif ($order->payment_method == 'vnpay')
                                                        VNPay
                                                    @elseif ($order->payment_method == 'cash')
                                                        Tiền mặt
                                                    @endif
                                                </p>
                                                <p>Ngày đặt hàng: {{ date('d-m-Y', strtotime($order->created_at)) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wsus__invoice_description">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th class="images">
                                                    STT
                                                </th>

                                                <th class="name">
                                                    Tên sản phẩm
                                                </th>

                                                <th class="amount">
                                                    Giá
                                                </th>

                                                <th class="quentity">
                                                    Số lượng
                                                </th>
                                                <th class="total">
                                                    Tổng
                                                </th>
                                            </tr>

                                            @foreach ($order->orderDetail as $key => $product)
                                                @php
                                                    $product_price = $product->product_price + $product->variant_total_price;

                                                    $total_price = $product_price * $product->product_qty;

                                                    $variants = json_decode($product->variants);
                                                @endphp

                                                <tr>
                                                    <td class="images">
                                                        {{ $key + 1 }}
                                                    </td>

                                                    <td class="name">
                                                        <p>
                                                            {{ $product->product_name }}
                                                        </p>

                                                        @foreach ($variants as $key => $variant)
                                                            <span>{{ $key }}:
                                                                {{ $variant->name }}</span><br>
                                                        @endforeach
                                                    </td>
                                                    <td class="amount">
                                                        {{ number_format($product_price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                    </td>

                                                    <td class="quentity">
                                                        {{ $product->product_qty }}
                                                    </td>
                                                    <td class="total">
                                                        {{ number_format($total_price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="wsus__invoice_footer text-end">
                                <p>
                                    <span>Tổng tiền hàng:</span>
                                    <strong>
                                        {{ number_format($order->total_price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                    </strong>
                                </p>
                                <br>

                                <p>
                                    <span>Giảm giá:</span>
                                    <strong>
                                        -{{ number_format($order->discount, 0, '.', '.') }}{{ $settings->currency_icon }}
                                    </strong>
                                </p>
                                <br>

                                <p>
                                    <span>Phí vận chuyển:</span>
                                    <strong>
                                        +{{ number_format($order->shipping_fee, 0, '.', '.') }}{{ $settings->currency_icon }}
                                    </strong>
                                </p>
                                <hr>

                                <p>
                                    <span>Tổng thanh toán:</span>
                                    <strong>
                                        {{ number_format($net_final_total_price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                    </strong>
                                </p>
                            </div>

                            <div class="row mt-4">
                                <p>Trạng thái đơn hàng: @if ($order->status == 'pending')
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
                                </p>
                            </div>

                            <div class="row mt-4 d-flex justify-content-end">
                                <div class="col-2 text-center ">
                                    <button class="btn btn-warning btn-print-invoice-user">
                                        <i class="fa-solid fa-print"></i>
                                        <span class="ml-1">In hóa đơn</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
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

            $('.btn-print-invoice-user').on('click', function() {
                let invoice_body = $('.wsus__invoice_area');
                let original_contents = $('body').html();

                $('body').html(invoice_body.html());

                window.print();

                $('body').html(original_contents);
            })

        })
    </script>
@endpush
