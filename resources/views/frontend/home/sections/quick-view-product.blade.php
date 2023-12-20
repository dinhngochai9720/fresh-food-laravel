<section class="product_popup_modal">
    <div class="modal fade" id="exampleModal-{{ $product->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="far fa-times"></i></button>
                    <div class="row">
                        <div class="col-xl-6 col-12 col-sm-10 col-md-8 col-lg-6 m-auto display">
                            <div class="wsus__quick_view_img">
                                @if ($product->video_link)
                                    <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                                        href="{{ $product->video_link }}">
                                        <i class="fas fa-play"></i>
                                    </a>
                                @endif

                                <div class="row modal_slider">
                                    <div class="col-xl-12">
                                        <div class="modal_slider_img">
                                            <img src="{{ asset($product->thumbnail_image) }}" alt="product"
                                                class="img-fluid w-100">
                                        </div>
                                    </div>
                                    @if ($product->images->count() <= 0)
                                        <div class="col-xl-12">
                                            <div class="modal_slider_img">
                                                <img src="{{ asset($product->thumbnail_image) }}" alt="product"
                                                    class="img-fluid w-100">
                                            </div>
                                        </div>
                                    @else
                                        @foreach ($product->images as $item)
                                            <div class="col-xl-12">
                                                <div class="modal_slider_img">
                                                    <img src="{{ asset($item->image) }}" alt="product"
                                                        class="img-fluid w-100">
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="wsus__pro_details_text">
                                <a class="title"
                                    href="{{ route('product-detail', ['slug' => $product->slug, 'id' => $product->id]) }}">{{ $product->name }}</a>

                                @if ($product->quantity > 0)
                                    <p class="wsus__stock_area">{{ $product->quantity }} Sản phẩm</p>
                                @elseif ($product->quantity == 0)
                                    <p class="wsus__stock_area"><span class="in_stock">Hết hàng</span></p>
                                @endif

                                @if (checkDiscountProduct($product))
                                    <h4>
                                        {{ number_format($product->offer_price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                        <del>{{ number_format($product->price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                        </del>
                                    </h4>
                                @else
                                    <h4>
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
                                    </h4>
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
                                <p class="description">{!! $product->short_description !!}
                                </p>


                                {{-- add-product-to-cart --}}
                                <form class="add-product-to-cart">
                                    <div class="wsus__quentity">
                                        <h5 class="me-2">Số lượng: </h5>
                                        <div class="select_number">
                                            <input class="number_area" name="quantity" type="text" min="1"
                                                max="100" value="1" />
                                        </div>
                                    </div>

                                    <div class="wsus__selectbox">
                                        <div class="row">
                                            <input type="hidden" name="product_id" value="{{ $product->id }}" />

                                            @foreach ($product->variants as $variant)
                                                @if ($variant->status !== 1)
                                                @else
                                                    @if ($variant->variantItems->count() > 0)
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
                                                    @else
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <ul class="wsus__button_area">
                                        <li><button type="submit" class="add_cart">Thêm vào giỏ hàng</button>
                                        </li>
                                </form>

                                <li><a class="d-flex justify-content-center align-items-center add-product-to-wishlist"
                                        href="" data-id="{{ $product->id }}"><i class="fal fa-heart"></i></a>
                                </li>

                                </ul>

                                <p class="brand_model"><span>SKU:</span> {{ $product->sku }}</p>
                                <p class="brand_model"><span>Thương hiệu:</span> {{ $product->brand->name }}
                                </p>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
