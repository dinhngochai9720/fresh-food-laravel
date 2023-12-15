@extends('frontend.layouts.master')

@section('title')
    Sản phẩm yêu thích
@endsection

@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Sản phẩm yêu thích</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Trang chủ</a></li>
                            <li><a href="javascript:;">Sản phẩm yêu thích</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- wishlist is empty --}}
    @if ($wishlist_products->count() === 0)
        <section id="wsus__cart_view">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="wsus__cart_list cart_empty p-3 p-sm-5 text-center">
                            <p class="mb-4">Không có sản phẩm yêu thích</p>
                            <a href="{{ url('/') }}" class="common_btn"><i class="fal fa-store me-2"
                                    aria-hidden="true"></i>Quay lại trang chủ</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section id="wsus__cart_view">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="wsus__cart_list wishlist">
                            <div class="table-responsive">
                                <table>
                                    <tbody>
                                        <tr class="d-flex">
                                            <th class="wsus__pro_img">
                                                STT
                                            </th>

                                            <th class="wsus__pro_name">
                                                Tên sản phẩm
                                            </th>

                                            <th class="wsus__pro_status">
                                                Ảnh
                                            </th>

                                            <th class="wsus__pro_select">
                                                Trạng thái
                                            </th>

                                            <th class="wsus__pro_tk">
                                                Giá
                                            </th>

                                            <th class="wsus__pro_icon">
                                                Xóa
                                            </th>
                                        </tr>


                                        @foreach ($wishlist_products as $key => $product)
                                            @php
                                                $variants = $product->product->variants;
                                                $variant_items = [];

                                                foreach ($variants as $variant) {
                                                    $variant_items = array_merge($variant_items, $variant->variantItems->toArray());
                                                }
                                                //  dd($variant_items);

                                                // find min and max (min > 0)
                                                $minPrice = PHP_INT_MAX;
                                                $maxPrice = 0;

                                                foreach ($variant_items as $item) {
                                                    $price = $item['price'];

                                                    if ($price > 0) {
                                                        if ($price < $minPrice) {
                                                            $minPrice = $price;
                                                        }

                                                        if ($price > $maxPrice) {
                                                            $maxPrice = $price;
                                                        }
                                                    }
                                                }
                                            @endphp

                                            <tr class="d-flex">
                                                <td class="wsus__pro_img">
                                                    <p>{{ $key + 1 }}</p>
                                                </td>

                                                <td class="wsus__pro_name">
                                                    <a class="link-success"
                                                        href="{{ route('product-detail', ['slug' => $product->product->slug, 'id' => $product->product_id]) }}">{{ $product->product->name }}</a>
                                                </td>

                                                <td class="wsus__pro_status"><img
                                                        src="{{ asset($product->product->thumbnail_image) }}"
                                                        alt="product_image" class="img-fluid w-100">
                                                </td>

                                                <td class="wsus__pro_select">
                                                    @if ($product->product->quantity > 0)
                                                        <span class="badge bg-success rounded-pill">Còn hàng</span>
                                                    @else
                                                        <span class="badge bg-warning rounded-pill">Hết hàng</span>
                                                    @endif
                                                </td>

                                                <td class="wsus__pro_tk">
                                                    @if (checkDiscountProduct($product->product))
                                                        <h6> {{ number_format($product->product->offer_price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                            <del
                                                                class="text-danger">{{ number_format($product->product->price, 0, '.', '.') }}{{ $settings->currency_icon }}</del>
                                                        </h6>
                                                    @else
                                                        @if ($product->product->price == 0)
                                                            @if (!empty($variant_items))
                                                                <h6>
                                                                    {{ number_format($minPrice, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                                    -
                                                                    {{ number_format($maxPrice, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                                </h6>
                                                            @else
                                                                <h6>
                                                                    {{ number_format($product->product->price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                                </h6>
                                                            @endif
                                                        @else
                                                            <h6>
                                                                {{ number_format($product->product->price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                            </h6>
                                                        @endif
                                                    @endif
                                                </td>

                                                <td class="wsus__pro_icon">
                                                    <a id='delete-item'
                                                        href="{{ route('user.wishlist.delete-product', $product->id) }}"><i
                                                            class="fa-regular fa-trash-can"></i></a>
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
        </section>
    @endif
@endsection
