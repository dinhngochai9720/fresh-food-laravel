@extends('frontend.layouts.master')

@section('title')
    Thanh toán
@endsection


@section('content')
    {{-- breadcrumb --}}
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Thanh toán</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Trang chủ</a></li>
                            <li><a href="javascript:;">Chi tiết thanh toán</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>



    {{-- checkout page --}}
    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="wsus__check_form">
                        <h5 class="checkout_form_h5">Địa chỉ <a class="checkout_form_a" href="#"
                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Thêm địa chỉ mới</a></h5>
                        <div class="row">
                            @foreach ($addresses as $address)
                                <div class="col-xl-6">
                                    <div class="wsus__checkout_single_address">
                                        <div class="form-check">
                                            <input class="form-check-input address" data-id="{{ $address->id }}"
                                                type="radio" name="flexRadioDefault" id="{{ $address->id }}">
                                            <label class="form-check-label" for="{{ $address->id }}">
                                                Chọn địa chỉ
                                            </label>
                                        </div>
                                        <ul>
                                            <li><span>Họ tên :</span> {{ $address->name }}</li>
                                            <li><span>Điện thoại :</span> {{ $address->phone }}</li>
                                            <li><span>Email :</span> {{ $address->email }}</li>
                                            <li><span>Tỉnh/thành phố :</span> {{ $address->city }}</li>
                                            <li><span>Quận/huyện :</span> {{ $address->district }}</li>
                                            <li><span>Xã/phường :</span> {{ $address->ward }}</li>
                                            <li><span>Địa chỉ :</span> {{ $address->address }}</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-5">
                    <div class="wsus__order_details" id="sticky_sidebar">
                        <p class="wsus__product">Phương thức vận chuyển</p>
                        @foreach ($shippings as $shipping)
                            {{-- condition: shipping method is min_order and  total cart price >= min_order --}}
                            @if ($shipping->type = 'min_order' && getTotalCartPrice() >= $shipping->min_order)
                                <div class="form-check">
                                    <input class="form-check-input shipping-method" type="radio" name="exampleRadios"
                                        id="{{ $shipping->name }}" value="{{ $shipping->id }}"
                                        data-cost="{{ $shipping->cost }}">
                                    <label class="form-check-label" for="{{ $shipping->name }}">
                                        {{ $shipping->name }}
                                        <span>({{ number_format($shipping->cost, 0, '.', '.') }}{{ $settings->currency_icon }})</span>
                                    </label>
                                </div>
                            @elseif($shipping->type == 'cost')
                                <div class="form-check">
                                    <input class="form-check-input shipping-method" type="radio" name="exampleRadios"
                                        id="{{ $shipping->name }}" value="{{ $shipping->id }}"
                                        data-cost="{{ $shipping->cost }}">
                                    <label class="form-check-label" for="{{ $shipping->name }}">
                                        {{ $shipping->name }}
                                        <span>({{ number_format($shipping->cost, 0, '.', '.') }}{{ $settings->currency_icon }})</span>
                                    </label>
                                </div>
                            @endif
                        @endforeach

                        <div class="wsus__order_details_summery">
                            <p>Tổng tiền hàng:
                                <span>{{ number_format(getTotalCartPrice(), 0, '.', '.') }}{{ $settings->currency_icon }}</span>
                            </p>
                            <p>Chi phí vận chuyển: <span id="shipping-fee">+0{{ $settings->currency_icon }}</span></p>
                            <p>Giảm giá: <span>
                                    -{{ number_format(getCartDiscount(), 0, '.', '.') }}{{ $settings->currency_icon }}</span>
                            </p>
                            <p><b>Tổng thanh toán:</b> <span><b id="net-total-cart-price"
                                        data-final-total-cart-price="{{ getFinalTotalCartPrice() }}">
                                        {{ number_format(getFinalTotalCartPrice(), 0, '.', '.') }}{{ $settings->currency_icon }}</b></span>
                            </p>
                        </div>

                        <div class="terms_area">
                            <div class="form-check">
                                <input class="form-check-input agree-term-and-condition" type="checkbox" value=""
                                    id="flexCheckChecked3" checked>
                                <label class="form-check-label" for="flexCheckChecked3">
                                    Tôi đã đọc và đồng ý <a href="javascript:;">các điều khoản và điều kiện *</a>
                                </label>
                            </div>
                        </div>

                        <form id="checkout-cart" action="">
                            <input type="hidden" name="shipping_method_id" value="" id="shipping-method-id">
                            <input type="hidden" name="address_id" value="" id="address-id">
                        </form>

                        <a href="" class="common_btn submit-chekout-cart">Đặt hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- popup address --}}
    <div class="wsus__popup_address">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm địa chỉ mới</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="wsus__check_form p-3">
                            <form action="{{ route('user.checkout.add-new-address') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="Nhập tên" name="name"
                                                value="{{ Auth::user()->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="email" placeholder="Nhập email" name="email"
                                                value="{{ Auth::user()->email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="Nhập điện thoại" name="phone"
                                                value="{{ old('phone') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="wsus__add_address_single">
                                            <select class="form-control" name="city" id="city">
                                                <option value="">Chọn Tỉnh/Thành phố</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="wsus__add_address_single">
                                            <select class="form-control" name="district" id="district">
                                                <option value="">Chọn Quận/Huyện</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="wsus__add_address_single">
                                            <select class="form-control" name="ward" id="ward">
                                                <option value="">Chọn Phường/Xã</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="wsus__check_single_form">
                                            <input type="text" name="address" placeholder="Nhập địa chỉ">
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="wsus__check_single_form">
                                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
