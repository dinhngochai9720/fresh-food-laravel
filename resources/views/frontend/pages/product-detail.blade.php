@extends('frontend.layouts.master')

@section('title')
    {{ $product->name }}
@endsection


@section('content')
    {{-- quick view --}}
    {{-- <section class="product_popup_modal">
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                class="far fa-times"></i></button>
                        <div class="row">
                            <div class="col-xl-6 col-12 col-sm-10 col-md-8 col-lg-6 m-auto display">
                                <div class="wsus__quick_view_img">
                                    <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                                        href="https://youtu.be/7m16dFI1AF8">
                                        <i class="fas fa-play"></i>
                                    </a>
                                    <div class="row modal_slider">
                                        <div class="col-xl-12">
                                            <div class="modal_slider_img">
                                                <img src="images/zoom1.jpg" alt="product" class="img-fluid w-100">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="modal_slider_img">
                                                <img src="images/zoom2.jpg" alt="product" class="img-fluid w-100">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="modal_slider_img">
                                                <img src="images/zoom3.jpg" alt="product" class="img-fluid w-100">
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="modal_slider_img">
                                                <img src="images/zoom4.jpg" alt="product" class="img-fluid w-100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-12 col-sm-12 col-md-12 col-lg-6">
                                <div class="wsus__pro_details_text">
                                    <a class="title" href="#">Electronics Black Wrist Watch</a>
                                    <p class="wsus__stock_area"><span class="in_stock">in stock</span> (167 item)</p>
                                    <h4>$50.00 <del>$60.00</del></h4>
                                    <p class="review">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <span>20 review</span>
                                    </p>
                                    <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

                                    <div class="wsus_pro_hot_deals">
                                        <h5>offer ending time : </h5>
                                        <div class="simply-countdown simply-countdown-one"></div>
                                    </div>
                                    <div class="wsus_pro_det_color">
                                        <h5>color :</h5>
                                        <ul>
                                            <li><a class="blue" href="#"><i class="far fa-check"></i></a></li>
                                            <li><a class="orange" href="#"><i class="far fa-check"></i></a></li>
                                            <li><a class="yellow" href="#"><i class="far fa-check"></i></a></li>
                                            <li><a class="black" href="#"><i class="far fa-check"></i></a></li>
                                            <li><a class="red" href="#"><i class="far fa-check"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="wsus_pro__det_size">
                                        <h5>size :</h5>
                                        <ul>
                                            <li><a href="#">S</a></li>
                                            <li><a href="#">M</a></li>
                                            <li><a href="#">L</a></li>
                                            <li><a href="#">XL</a></li>
                                        </ul>
                                    </div>
                                    <div class="wsus__quentity">
                                        <h5>quentity :</h5>
                                        <form class="select_number">
                                            <input class="number_area" type="text" min="1" max="100"
                                                value="1" />
                                        </form>
                                        <h3>$50.00</h3>
                                    </div>
                                    <div class="wsus__selectbox">
                                        <div class="row">
                                            <div class="col-xl-6 col-sm-6">
                                                <h5 class="mb-2">select:</h5>
                                                <select class="select_2" name="state">
                                                    <option>default select</option>
                                                    <option>select 1</option>
                                                    <option>select 2</option>
                                                    <option>select 3</option>
                                                    <option>select 4</option>
                                                </select>
                                            </div>
                                            <div class="col-xl-6 col-sm-6">
                                                <h5 class="mb-2">select:</h5>
                                                <select class="select_2" name="state">
                                                    <option>default select</option>
                                                    <option>select 1</option>
                                                    <option>select 2</option>
                                                    <option>select 3</option>
                                                    <option>select 4</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="wsus__button_area">
                                        <li><a class="add_cart" href="#">add to cart</a></li>
                                        <li><a class="buy_now" href="#">buy now</a></li>
                                        <li><a href="#"><i class="fal fa-heart"></i></a></li>
                                        <li><a href="#"><i class="far fa-random"></i></a></li>
                                    </ul>
                                    <p class="brand_model"><span>model :</span> 12345670</p>
                                    <p class="brand_model"><span>brand :</span> The Northland</p>
                                    <div class="wsus__pro_det_share">
                                        <h5>share :</h5>
                                        <ul class="d-flex">
                                            <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a>
                                            </li>
                                            <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a class="whatsapp" href="#"><i class="fab fa-whatsapp"></i></a>
                                            </li>
                                            <li><a class="instagram" href="#"><i class="fab fa-instagram"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}


    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Chi tiết sản phẩm</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Trang chủ</a></li>
                            <li><a href="javascript:;">{{ $product->name }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @php
        $variants = $product->variants;
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

    {{-- product details --}}
    <section id="wsus__product_details">
        <div class="container">
            <div class="wsus__details_bg">
                <div class="row">
                    <div class="col-xl-4 col-md-5 col-lg-5" style="z-index: 9999 !important;">
                        <div id="sticky_pro_zoom">
                            <div class="exzoom hidden" id="exzoom">
                                <div class="exzoom_img_box">
                                    @if ($product->video_link)
                                        <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                                            href="{{ $product->video_link }}">
                                            <i class="fas fa-play"></i>
                                        </a>
                                    @endif

                                    <ul class='exzoom_img_ul'>
                                        <li><img class="zoom ing-fluid w-100" src="{{ asset($product->thumbnail_image) }}"
                                                alt="product"></li>

                                        @foreach ($product->images as $item)
                                            <li><img class="zoom ing-fluid w-100" src="{{ asset($item->image) }}"
                                                    alt="product"></li>
                                        @endforeach

                                    </ul>
                                </div>
                                <div class="exzoom_nav"></div>
                                <p class="exzoom_btn">
                                    <a href="javascript:void(0);" class="exzoom_prev_btn"> <i
                                            class="far fa-chevron-left"></i> </a>
                                    <a href="javascript:void(0);" class="exzoom_next_btn"> <i
                                            class="far fa-chevron-right"></i> </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-md-7 col-lg-7">
                        <div class="wsus__pro_details_text">
                            <a class="title" href="javascript:;">{{ $product->name }}</a>
                            @if ($product->quantity > 0)
                                <p class="wsus__stock_area">{{ $product->quantity }} Sản phẩm</p>
                            @elseif ($product->quantity == 0)
                                <p class="wsus__stock_area"><span class="in_stock">Hết hàng</span></p>
                            @endif

                            @if (checkDiscountProduct($product))
                                <h4> {{ number_format($product->offer_price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                    <del>{{ number_format($product->price, 0, '.', '.') }}{{ $settings->currency_icon }}</del>
                                </h4>
                            @else
                                @if ($product->price == 0)
                                    @if (!empty($variant_items))
                                        <h4>
                                            {{ number_format($minPrice, 0, '.', '.') }}{{ $settings->currency_icon }} -
                                            {{ number_format($maxPrice, 0, '.', '.') }}{{ $settings->currency_icon }}
                                        </h4>
                                    @else
                                        <h4>
                                            {{ number_format($product->price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                        </h4>
                                    @endif
                                @else
                                    <h4>
                                        {{ number_format($product->price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                    </h4>
                                @endif
                            @endif

                            <p class="review">
                                @php
                                    $avg_rating = $product
                                        ->reviews()
                                        ->where('status', 1)
                                        ->avg('rating');
                                    $round_avg_rating = round($avg_rating);
                                @endphp

                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $round_avg_rating)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor

                                @php
                                    $sold_product = 0;

                                    foreach ($orders as $order) {
                                        foreach ($order->orderDetail->where('product_id', $product->id) as $key => $value) {
                                            $sold_product += $value->product_qty;
                                        }
                                    }
                                @endphp
                                <span>Đã bán {{ $sold_product }}</span>
                            </p>

                            <p class="description">{!! $product->short_description !!}</p>

                            <form class="add-product-to-cart">
                                <div class="wsus__selectbox">
                                    <div class="row">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}" />

                                        @foreach ($product->variants as $variant)
                                            @if ($variant->status !== 1)
                                            @else
                                                @if ($variant->variantItems->count() <= 0)
                                                @else
                                                    <div class="col-xl-12 col-sm-12 mb-2">
                                                        <h5 class="mb-2">{{ $variant->name }}:</h5>
                                                        <select class="form-control" name="variant_items[]">
                                                            @foreach ($variant->variantItems as $variant_item)
                                                                @if ($variant_item->status !== 1)
                                                                @else
                                                                    <option value="{{ $variant_item->id }}"
                                                                        {{ $variant_item->is_default == 1 ? 'selected' : '' }}>

                                                                        {{ $variant_item->name }}

                                                                        @if ($variant_item->price == 0)
                                                                        @else
                                                                            ({{ number_format($variant_item->price, 0, '.', '.') }}{{ $settings->currency_icon }})
                                                                        @endif
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                                <div class="wsus__quentity">
                                    <h5 class="me-2">Số lượng: </h5>
                                    <div class="select_number">
                                        <input class="number_area" name="quantity" type="text" min="1"
                                            max="100" value="1" />
                                    </div>
                                </div>
                                <ul class="wsus__button_area">
                                    <li><button type="submit" class="add_cart">Thêm vào giỏ hàng</button></li>
                            </form>

                            <form class="buy-product-now">
                                <input type="hidden" name="product_id" value="{{ $product->id }}" />

                                @foreach ($product->variants as $variant)
                                    @if ($variant->status !== 1)
                                    @else
                                        <select class="form-control d-none" name="variant_items[]">
                                            @foreach ($variant->variantItems as $variant_item)
                                                @if ($variant_item->status !== 1)
                                                @else
                                                    <option value="{{ $variant_item->id }}"
                                                        @if ($variant_item->is_default == 1) selected @endif>
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    @endif
                                @endforeach

                                <input name="quantity" type="hidden" min="1" value="1" />
                                {{-- <li><button class="buy_now border-0" type="submit">Mua ngay</button></li> --}}
                            </form>

                            <li><a href="" class="add-product-to-wishlist" data-id="{{ $product->id }}"><i
                                        class="fal fa-heart"></i></a></li>
                            {{-- <li><a href="#"><i class="far fa-random"></i></a></li> --}}
                            </ul>

                            <p class="brand_model"><span>SKU :</span> {{ $product->sku }}</p>
                            <p class="brand_model"><span>Thương hiệu :</span> {{ $product->brand->name }}</p>

                        </div>
                    </div>
                    <div class="col-xl-3 col-md-12 mt-md-5 mt-lg-0">
                        <div class="wsus_pro_det_sidebar" id="sticky_sidebar">
                            <ul>
                                <li>
                                    <span><i class="fal fa-truck"></i></span>
                                    <div class="text">
                                        <h4>Giao hàng nhanh và tiết kiệm</h4>
                                    </div>
                                </li>
                                <li>
                                    <span><i class="far fa-shield-check"></i></span>
                                    <div class="text">
                                        <h4>Nhiều chương trình khuyến mãi</h4>
                                    </div>
                                </li>
                                <li>
                                    <span><i class="fal fa-envelope-open-dollar"></i></span>
                                    <div class="text">
                                        <h4>Phương thức thanh toán đa dạng</h4>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__pro_det_description">
                        <div class="wsus__details_bg">
                            <ul class="nav nav-pills mb-3" id="pills-tab3" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab7" data-bs-toggle="pill"
                                        data-bs-target="#pills-home22" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">Miêu tả sản phẩm</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">Nhà cung
                                        cấp</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab2" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact2" type="button" role="tab"
                                        aria-controls="pills-contact2" aria-selected="false">Đánh giá</button>
                                </li>

                            </ul>
                            <div class="tab-content" id="pills-tabContent4">
                                <div class="tab-pane fade  show active " id="pills-home22" role="tabpanel"
                                    aria-labelledby="pills-home-tab7">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="wsus__description_area">
                                                {!! $product->long_description !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                    aria-labelledby="pills-contact-tab">
                                    <div class="wsus__pro_det_vendor">
                                        <div class="row">
                                            <div class="col-xl-6 col-xxl-2 col-md-6">
                                                <div class="wsus__vebdor_img">
                                                    <img src="{{ asset($product->vendor->banner) }}" alt="image"
                                                        class="img-fluid">
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-xxl-10 col-md-6 mt-4 mt-md-0">
                                                <div class="wsus__pro_det_vendor_text">
                                                    <h4>{{ $product->vendor->shop_name }}</h4>
                                                    <p><span>Địa chỉ:</span> {{ $product->vendor->address }}</p>
                                                    <p><span>Điện thoại:</span> {{ $product->vendor->phone }}</p>
                                                    <p><span>Email:</span> {{ $product->vendor->email }}</p>
                                                    <a href="{{ route('vendor.products', $product->vendor->id) }}"
                                                        class="see_btn">Xem nhà cung cấp</a>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="wsus__vendor_details">
                                                    {!! $product->vendor->description !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pills-contact2" role="tabpanel"
                                    aria-labelledby="pills-contact-tab2">
                                    <div class="wsus__pro_det_review">
                                        <div class="wsus__pro_det_review_single">
                                            <div class="row">
                                                <div class="col-xl-8 col-lg-7">
                                                    <div class="wsus__comment_area">
                                                        <h4>Đánh giá <span>{{ count($reviews) }}</span></h4>

                                                        @foreach ($reviews as $key => $review)
                                                            <div class="wsus__main_comment">
                                                                <div class="wsus__comment_img">
                                                                    <img src="{{ asset($review->user->image) }}"
                                                                        alt="user" class="img-fluid w-100">
                                                                </div>
                                                                <div class="wsus__comment_text reply">
                                                                    <h6>{{ $review->user->name }}
                                                                        <span>{{ $review->rating }} <i
                                                                                class="fas fa-star"></i></span>
                                                                    </h6>
                                                                    <span>{{ date('d-m-Y', strtotime($review->created_at)) }}</span>
                                                                    <p>{{ $review->review }}
                                                                    </p>
                                                                    <ul class="">
                                                                        @if (count($review->images) > 0)
                                                                            @foreach ($review->images as $image)
                                                                                <li><img src="{{ asset($image->image) }}"
                                                                                        alt="product"
                                                                                        class="img-fluid w-100">
                                                                                </li>
                                                                            @endforeach
                                                                        @else
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        @endforeach


                                                        <div class="col-xl-12">
                                                            {{-- use Bootstrap to pagination in AppService Provider --}}
                                                            <div
                                                                class="mt-5 d-flex justify-content-center align-items-center">
                                                                @if ($reviews->hasPages())
                                                                    {{ $reviews->withQueryString()->links() }}
                                                                @else
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                @php
                                                    $is_flag = false;

                                                    // user logged in
                                                    if (auth()->check()) {
                                                        // get all orders of users (status = deliverd)
                                                        $orders = \App\Models\Order::where(['user_id' => auth()->user()->id, 'status' => 'delivered'])->get();

                                                        // check user already review or not
                                                        $check_exist_review = \App\Models\ProductReview::where(['user_id' => auth()->user()->id, 'product_id' => $product->id])->first();

                                                        foreach ($orders as $key => $order) {
                                                            // get product exist in order_details == current product detail
                                                            $exist_product = $order
                                                                ->orderDetail()
                                                                ->where('product_id', $product->id)
                                                                ->first();

                                                            if ($exist_product) {
                                                                $is_flag = true;
                                                            }
                                                        }

                                                        if ($check_exist_review) {
                                                            $is_flag = false;
                                                        }
                                                    }
                                                @endphp

                                                {{-- if product delivered -> show write review --}}
                                                @if ($is_flag)
                                                    <div class="col-xl-4 col-lg-5 mt-4 mt-lg-0">
                                                        <div class="wsus__post_comment rev_mar" id="sticky_sidebar3">
                                                            <h4>Đánh giá sản phẩm</h4>
                                                            <form action="{{ route('user.review.create') }}"
                                                                enctype="multipart/form-data" method="POST">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-xl-12 mb-4">
                                                                        <div class="wsus__single_com">
                                                                            <select name="rating" id=""
                                                                                class="form-control">
                                                                                <option value="">Chọn đánh giá
                                                                                </option>
                                                                                <option value="1">
                                                                                    1 sao
                                                                                </option>
                                                                                <option value="2">
                                                                                    2 sao
                                                                                </option>
                                                                                <option value="3">
                                                                                    3 sao
                                                                                </option>
                                                                                <option value="4">
                                                                                    4 sao
                                                                                </option>
                                                                                <option value="5">
                                                                                    5 sao
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-xl-12">
                                                                        <div class="col-xl-12">
                                                                            <div class="wsus__single_com">
                                                                                <textarea name="review" cols="3" rows="3" placeholder="Viết đánh giá của bạn"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="img_upload">
                                                                    <input type="file" name="images[]" multiple>
                                                                </div>

                                                                <input type="hidden" name="product_id" id=""
                                                                    value="{{ $product->id }}">
                                                                <input type="hidden" name="vendor_id" id=""
                                                                    value="{{ $product->vendor_id }}">

                                                                <button class="common_btn" type="submit">Gửi</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @else
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    {{-- realated product --}}
    {{-- <section id="wsus__flash_sell">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__section_header">
                        <h3>Related Products</h3>
                        <a class="see_btn" href="#">see more <i class="fas fa-caret-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row flash_sell_slider">
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <div class="wsus__product_item">
                        <span class="wsus__new">New</span>
                        <span class="wsus__minus">-20%</span>
                        <a class="wsus__pro_link" href="product_details.html">
                            <img src="images/pro3.jpg" alt="product" class="img-fluid w-100 img_1" />
                            <img src="images/pro3_3.jpg" alt="product" class="img-fluid w-100 img_2" />
                        </a>
                        <ul class="wsus__single_pro_icon">
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i
                                        class="far fa-eye"></i></a></li>
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="far fa-random"></i></a>
                        </ul>
                        <div class="wsus__product_details">
                            <a class="wsus__category" href="#">Electronics </a>
                            <p class="wsus__pro_rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(133 review)</span>
                            </p>
                            <a class="wsus__pro_name" href="#">hp 24" FHD monitore</a>
                            <p class="wsus__price">$159 <del>$200</del></p>
                            <a class="add_cart" href="#">add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <div class="wsus__product_item">
                        <span class="wsus__new">New</span>
                        <a class="wsus__pro_link" href="product_details.html">
                            <img src="images/pro4.jpg" alt="product" class="img-fluid w-100 img_1" />
                            <img src="images/pro4_4.jpg" alt="product" class="img-fluid w-100 img_2" />
                        </a>
                        <ul class="wsus__single_pro_icon">
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i
                                        class="far fa-eye"></i></a></li>
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="far fa-random"></i></a>
                        </ul>
                        <div class="wsus__product_details">
                            <a class="wsus__category" href="#">fashion </a>
                            <p class="wsus__pro_rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(17 review)</span>
                            </p>
                            <a class="wsus__pro_name" href="#">men's casual fashion watch</a>
                            <p class="wsus__price">$159 <del>$200</del></p>
                            <a class="add_cart" href="#">add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <div class="wsus__product_item">
                        <span class="wsus__minus">-20%</span>
                        <a class="wsus__pro_link" href="product_details.html">
                            <img src="images/pro9.jpg" alt="product" class="img-fluid w-100 img_1" />
                            <img src="images/pro9_9.jpg" alt="product" class="img-fluid w-100 img_2" />
                        </a>
                        <ul class="wsus__single_pro_icon">
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i
                                        class="far fa-eye"></i></a></li>
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="far fa-random"></i></a>
                        </ul>
                        <div class="wsus__product_details">
                            <a class="wsus__category" href="#">fashion </a>
                            <p class="wsus__pro_rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(120 review)</span>
                            </p>
                            <a class="wsus__pro_name" href="#">men's fashion sholder bag</a>
                            <p class="wsus__price">$159 <del>$200</del></p>
                            <a class="add_cart" href="#">add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <div class="wsus__product_item">
                        <span class="wsus__new">New</span>
                        <span class="wsus__minus">-20%</span>
                        <a class="wsus__pro_link" href="product_details.html">
                            <img src="images/pro2.jpg" alt="product" class="img-fluid w-100 img_1" />
                            <img src="images/pro2_2.jpg" alt="product" class="img-fluid w-100 img_2" />
                        </a>
                        <ul class="wsus__single_pro_icon">
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i
                                        class="far fa-eye"></i></a></li>
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="far fa-random"></i></a>
                        </ul>
                        <div class="wsus__product_details">
                            <a class="wsus__category" href="#">fashion </a>
                            <p class="wsus__pro_rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(72 review)</span>
                            </p>
                            <a class="wsus__pro_name" href="#">men's casual shoes</a>
                            <p class="wsus__price">$159 <del>$200</del></p>
                            <a class="add_cart" href="#">add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <div class="wsus__product_item">
                        <span class="wsus__minus">-20%</span>
                        <a class="wsus__pro_link" href="product_details.html">
                            <img src="images/pro4.jpg" alt="product" class="img-fluid w-100 img_1" />
                            <img src="images/pro4_4.jpg" alt="product" class="img-fluid w-100 img_2" />
                        </a>
                        <ul class="wsus__single_pro_icon">
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal2"><i
                                        class="far fa-eye"></i></a></li>
                            <li><a href="#"><i class="far fa-heart"></i></a></li>
                            <li><a href="#"><i class="far fa-random"></i></a>
                        </ul>
                        <div class="wsus__product_details">
                            <a class="wsus__category" href="#">fashion </a>
                            <p class="wsus__pro_rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(17 review)</span>
                            </p>
                            <a class="wsus__pro_name" href="#">men's casual fashion watch</a>
                            <p class="wsus__price">$159 <del>$200</del></p>
                            <a class="add_cart" href="#">add to cart</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section> --}}
@endsection
