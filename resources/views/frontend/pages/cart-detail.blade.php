@extends('frontend.layouts.master')

@section('title')
    Giỏ hàng
@endsection


@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Giỏ hàng</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Trang chủ</a></li>
                            <li><a href="javascript:;">Chi tiết giỏ hàng</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- cart is empty --}}
    @if ($cart_items->count() === 0)
        <section id="wsus__cart_view">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="wsus__cart_list cart_empty p-3 p-sm-5 text-center">
                            <p class="mb-4">Giỏ hàng trống</p>
                            <a href="{{ url('/') }}" class="common_btn"><i class="fal fa-store me-2"
                                    aria-hidden="true"></i>Quay lại trang chủ</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        {{-- cart is not empty --}}
        <section id="wsus__cart_view">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9">
                        <div class="wsus__cart_list">
                            <div class="table-responsive">
                                <table>
                                    <tbody>
                                        <tr class="d-flex">
                                            <th class="wsus__pro_img">
                                                Ảnh
                                            </th>

                                            <th class="wsus__pro_name">
                                                Tên sản phẩm
                                            </th>


                                            <th class="wsus__pro_tk">
                                                Giá
                                            </th>

                                            <th class="wsus__pro_select">
                                                Số lượng
                                            </th>

                                            <th class="wsus__pro_tk">
                                                Tổng
                                            </th>


                                            <th class="wsus__pro_icon">
                                                <a href="#" class="common_btn cleart-cart">
                                                    Xóa giỏ hàng</a>
                                            </th>
                                        </tr>

                                        @foreach ($cart_items as $product)
                                            <tr class="d-flex">
                                                <td class="wsus__pro_img"><img
                                                        src="{{ asset($product->options->thumbnail_image) }}" alt="product"
                                                        class="img-fluid w-100">
                                                </td>


                                                <td class="wsus__pro_name">
                                                    <a
                                                        href="{{ route('product-detail', ['slug' => $product->options->slug, 'id' => $product->id]) }}">{{ $product->name }}
                                                    </a>

                                                    @foreach ($product->options->variants as $key => $variant)
                                                        <span>
                                                            {{ $key }}: {{ $variant['name'] }}
                                                        </span>
                                                    @endforeach
                                                </td>

                                                @php

                                                @endphp
                                                <td class="wsus__pro_tk">
                                                    <h6>
                                                        @if ($product->price == 0)
                                                            {{ number_format($product->options->variant_total_price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                        @else
                                                            {{ number_format($product->price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                        @endif
                                                    </h6>
                                                </td>

                                                <td class="wsus__pro_select">
                                                    <div class="cart-pro-qty">
                                                        <button
                                                            class="cart-pro-qty-btn-decrement btn btn-secondary">-</button>
                                                        <input class="form-control cart-pro-qty-input" type="number"
                                                            min="1" value="{{ $product->qty }}"
                                                            data-id="{{ $product->rowId }}" readonly />
                                                        <button
                                                            class="cart-pro-qty-btn-increment btn btn-success">+</button>
                                                    </div>
                                                </td>

                                                <td class="wsus__pro_tk">
                                                    <h6 class="{{ $product->rowId }}">
                                                        {{ number_format(($product->price + $product->options->variant_total_price) * $product->qty, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                    </h6>
                                                </td>

                                                <td class="wsus__pro_icon">
                                                    <a class="delete-product-cart" data-id="{{ $product->rowId }}"
                                                        href="#"><i class="far fa-times"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                            <h6>Chi tiết thanh toán</h6>
                            <p>Tổng tiền hàng: <span id="total-cart-price">
                                    {{ number_format(getTotalCartPrice(), 0, '.', '.') }}{{ $settings->currency_icon }}</span>
                            </p>
                            <p>Giảm giá: <span id="discount">
                                    -{{ number_format(getCartDiscount(), 0, '.', '.') }}{{ $settings->currency_icon }}</span>
                            </p>
                            <p class="total"><span>Tổng thanh toán:</span> <span id="final_total_cart_price">
                                    {{ number_format(getFinalTotalCartPrice(), 0, '.', '.') }}{{ $settings->currency_icon }}</span>
                            </p>

                            @if (session()->has('voucher'))
                                <form class="delete-voucher-to-cart">
                                    <input type="text" placeholder="Mã giảm giá" name="voucher_code"
                                        value="{{ session()->has('voucher') ? session()->get('voucher')['voucher_code'] : '' }}">
                                    <button type="submit" class="common_btn">Hủy</button>
                                </form>
                            @else
                                <form class="apply-voucher-to-cart">
                                    <input type="text" placeholder="Mã giảm giá" name="voucher_code">
                                    <button type="submit" class="common_btn">Áp dụng</button>
                                </form>
                            @endif

                            <a class="common_btn mt-4 w-100 text-center" href="{{ route('user.checkout') }}">Thanh toán</a>
                            <a class="common_btn mt-1 w-100 text-center" href="{{ url('/') }}"><i
                                    class="fab fa-shopify"></i> Tiếp tục mua sắm</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- banner --}}
    @if ($cart_page_banner->banner_one->status_one == 0 && $cart_page_banner->banner_two->status_two == 0)
    @else
        <section id="wsus__single_banner">
            <div class="container">
                <div class="row">
                    @if ($cart_page_banner->banner_one->status_one == 1)
                        <div class="col-xl-6 col-lg-6">
                            <div class="wsus__single_banner_content">
                                <div class="wsus__single_banner_img">
                                    <a href="{{ $cart_page_banner->banner_one->url_one }}">
                                        <img src="{{ asset($cart_page_banner->banner_one->image_one) }}" alt="banner"
                                            class="img-fluid w-100">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                    @endif

                    @if ($cart_page_banner->banner_two->status_two == 1)
                        <div class="col-xl-6 col-lg-6">
                            <div class="wsus__single_banner_content single_banner_2">
                                <div class="wsus__single_banner_img">
                                    <a href="{{ $cart_page_banner->banner_two->url_two }}">
                                        <img src="{{ asset($cart_page_banner->banner_two->image_two) }}" alt="banner"
                                            class="img-fluid w-100">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                    @endif
                </div>
            </div>
        </section>
    @endif

@endsection
