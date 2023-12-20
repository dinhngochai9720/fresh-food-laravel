@extends('frontend.layouts.master')

@section('title')
    Sản phẩm
@endsection


@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Sản phẩm</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Trang chủ</a></li>
                            <li><a href="javascript:;">
                                    Sản phẩm
                                </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section id="wsus__product_page">
        <div class="container">
            <div class="row">
                @if ($product_page_banner->banner_one->status == 0)
                @else
                    <div class="col-xl-12">
                        <div class="wsus__pro_page_bammer">
                            <a href="{{ $product_page_banner->banner_one->url }}">
                                <img src="{{ asset($product_page_banner->banner_one->image) }}" alt="banner"
                                    class="img-fluid w-100">
                            </a>
                        </div>
                    </div>
                @endif

                <div class="col-xl-3 col-lg-4">
                    <div class="wsus__sidebar_filter ">
                        <p>Bộ lọc</p>
                        <span class="wsus__filter_icon">
                            <i class="far fa-minus" id="minus"></i>
                            <i class="far fa-plus" id="plus"></i>
                        </span>
                    </div>
                    <div class="wsus__product_sidebar" id="sticky_sidebar">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Tất cả danh mục
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            @foreach ($categories as $category)
                                                <li><a
                                                        href="{{ route('products.view', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Giá
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="price_ranger">
                                            <form action="{{ url()->current() }}">
                                                @foreach (request()->query() as $key => $value)
                                                    @if ($key !== 'price_range')
                                                        <input type="hidden" name="{{ $key }}"
                                                            value="{{ $value }}" />
                                                    @endif
                                                @endforeach
                                                <input type="hidden" id="slider_range" class="flat-slider"
                                                    name="price_range" value="0;1000000" />
                                                <button type="submit" class="common_btn">Lọc</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree3">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree3" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        Thương hiệu
                                    </button>
                                </h2>
                                <div id="collapseThree3" class="accordion-collapse collapse show"
                                    aria-labelledby="headingThree3" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            @foreach ($brands as $brand)
                                                <li><a
                                                        href="{{ route('products.view', ['brand' => $brand->slug]) }}">{{ $brand->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="row">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                aria-labelledby="v-pills-home-tab">
                                <div class="row">
                                    @if ($products->count() == 0)
                                        <p class="text-center">Không tìm thấy sản phẩm!</p>
                                    @else
                                        @foreach ($products as $product)
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

                                            <div class="col-xl-4 col-sm-6">
                                                <div class="wsus__product_item">
                                                    @if ($product->quantity == 0)
                                                        <span class="wsus__new bg-warning">
                                                            Hết hàng
                                                        </span>
                                                    @endif

                                                    @if (checkDiscountProduct($product))
                                                        <span
                                                            class="wsus__minus">-{{ calculatePercentDiscountProduct($product->price, $product->offer_price) }}%</span>
                                                    @else
                                                    @endif

                                                    <a class="wsus__pro_link"
                                                        href="{{ route('product-detail', ['slug' => $product->slug, 'id' => $product->id]) }}">
                                                        <img src="{{ asset($product->thumbnail_image) }}" alt="product"
                                                            class="img-fluid w-100 img_1" />

                                                        <img src="
                                             @if (isset($product->images[0]->image)) {{ asset($product->images[0]->image) }}
                                             @else
                                             {{ asset($product->thumbnail_image) }} @endif
                                         "
                                                            alt="product" class="img-fluid w-100 img_2" />
                                                    </a>

                                                    <ul class="wsus__single_pro_icon">
                                                        <li><a class="d-flex justify-content-center align-items-center"
                                                                href="#" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal-{{ $product->id }}"><i
                                                                    class="far fa-eye"></i></a>
                                                        </li>


                                                        <li><a class="d-flex justify-content-center align-items-center add-product-to-wishlist"
                                                                href="" data-id="{{ $product->id }}"><i
                                                                    class="fal fa-heart"></i></a>
                                                        </li>

                                                    </ul>
                                                    <div class="wsus__product_details">
                                                        <a class="wsus__category"
                                                            href="{{ route('products.view', ['category' => $product->category->slug]) }}">{{ $product->category->name }}
                                                        </a>

                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p class="wsus__pro_rating">
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
                                                            </p>

                                                            @php
                                                                $sold_product = 0;

                                                                foreach ($orders as $order) {
                                                                    foreach ($order->orderDetail->where('product_id', $product->id) as $key => $value) {
                                                                        $sold_product += $value->product_qty;
                                                                    }
                                                                }
                                                            @endphp
                                                            <p class="wsus__pro_rating">
                                                                <span>Đã bán {{ $sold_product }}</span>
                                                            </p>
                                                        </div>


                                                        <a class="wsus__pro_name"
                                                            href="{{ route('product-detail', ['slug' => $product->slug, 'id' => $product->id]) }}">
                                                            {{ limitText($product->name, 30) }}
                                                        </a>

                                                        @if (checkDiscountProduct($product))
                                                            <p class="wsus__price">
                                                                {{ number_format($product->offer_price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                                <del>{{ number_format($product->price, 0, '.', '.') }}{{ $settings->currency_icon }}</del>
                                                            </p>
                                                        @else
                                                            <p class="wsus__price">
                                                                @if ($product->price == 0)
                                                                    @if (!empty($variant_items))
                                                                        {{ number_format($minPrice, 0, '.', '.') }}{{ $settings->currency_icon }}-
                                                                        {{ number_format($maxPrice, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                                    @else
                                                                        {{ number_format($product->price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                                    @endif
                                                                @else
                                                                    {{ number_format($product->price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                                @endif
                                                            </p>
                                                        @endif

                                                        {{-- add default value product to cart --}}
                                                        <form class="buy-product-now">
                                                            <input type="hidden" name="product_id"
                                                                value="{{ $product->id }}" />

                                                            @foreach ($product->variants as $variant)
                                                                @if ($variant->status !== 1)
                                                                @else
                                                                    <select class="form-control d-none"
                                                                        name="variant_items[]">
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

                                                            <input name="quantity" type="hidden" min="1"
                                                                value="1" />
                                                            <button type="submit" class="add_cart">Mua ngay</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12">
                    {{-- use Bootstrap to pagination in AppService Provider --}}
                    <div class="mt-5 d-flex justify-content-center align-items-center">
                        @if ($products->hasPages())
                            {{ $products->withQueryString()->links() }}
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    >
@endsection


{{-- quick view --}}
@foreach ($products as $product)
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

    @include('frontend.home.sections.quick-view-product')
@endforeach
