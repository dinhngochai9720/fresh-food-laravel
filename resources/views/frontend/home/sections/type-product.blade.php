 <section id="wsus__hot_deals" class="wsus__hot_deals_2">
     <div class="container">
         <div class="wsus__hot_large_item">
             <div class="row">
                 <div class="col-xl-12">
                     <div class="wsus__section_header justify-content-between">
                         <h3>Sản phẩm </h3>
                         <div class="monthly_top_filter2 mb-1">
                             <button class="active auto-click" data-filter=".new_arrival">Mới</button>
                             <button data-filter=".best_product">Tốt nhất</button>
                             <button data-filter=".top_product">Bán chạy</button>
                         </div>
                     </div>
                 </div>
             </div>

             <div class="row grid2">
                 @foreach ($type_products as $key)
                     @if ($key == 'new_arrival')
                         @foreach ($new_arrival_products as $product)
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

                             <div class="col-xl-3 col-sm-6 col-md-4 col-lg-4 new_arrival">
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
                                         <img src="@if (isset($product->images[0]->image)) {{ asset($product->images[0]->image) }}
                              @else
                              {{ asset($product->thumbnail_image) }} @endif"
                                             alt="product" class="img-fluid w-100 img_2" />
                                     </a>
                                     <ul class="wsus__single_pro_icon">
                                         <li><a href="#" data-bs-toggle="modal"
                                                 data-bs-target="#exampleModal-{{ $product->id }}"><i
                                                     class="far fa-eye"></i></a>
                                         </li>
                                         <li><a href="" class="add-product-to-wishlist"
                                                 data-id="{{ $product->id }}"><i class="far fa-heart"></i></a></li>
                                         {{-- <li><a href="#"><i class="far fa-random"></i></a> --}}
                                     </ul>
                                     <div class="wsus__product_details">
                                         <a class="wsus__category" href="#">{{ $product->category->name }} </a>

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
                                             {{ limitText($product->name, 30) }}</a>

                                         @if (checkDiscountProduct($product))
                                             <p class="wsus__price">
                                                 {{ number_format($product->offer_price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                 <del>{{ number_format($product->price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                 </del>
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
                                             <button type="submit" class="add_cart">Mua ngay</button>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         @endforeach
                     @elseif ($key == 'best_product')
                         @foreach ($best_products as $product)
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

                             <div class="col-xl-3 col-sm-6 col-md-4 col-lg-4 best_product">
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
                                         <img src="@if (isset($product->images[0]->image)) {{ asset($product->images[0]->image) }}
                      @else
                      {{ asset($product->thumbnail_image) }} @endif"
                                             alt="product" class="img-fluid w-100 img_2" />
                                     </a>
                                     <ul class="wsus__single_pro_icon">
                                         <li><a href="#" data-bs-toggle="modal"
                                                 data-bs-target="#exampleModal-{{ $product->id }}"><i
                                                     class="far fa-eye"></i></a>
                                         </li>
                                         <li><a href="" class="add-product-to-wishlist"
                                                 data-id="{{ $product->id }}"><i class="far fa-heart"></i></a></li>
                                         {{-- <li><a href="#"><i class="far fa-random"></i></a> --}}
                                     </ul>
                                     <div class="wsus__product_details">
                                         <a class="wsus__category" href="#">{{ $product->category->name }} </a>

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
                                             {{ limitText($product->name, 30) }}</a>

                                         @if (checkDiscountProduct($product))
                                             <p class="wsus__price">
                                                 {{ number_format($product->offer_price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                 <del>{{ number_format($product->price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                 </del>
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
                                             <button type="submit" class="add_cart">Mua ngay</button>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         @endforeach
                     @elseif ($key == 'top_product')
                         @foreach ($top_products as $product)
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

                             <div class="col-xl-3 col-sm-6 col-md-4 col-lg-4 top_product">
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
                                         <img src="@if (isset($product->images[0]->image)) {{ asset($product->images[0]->image) }}
                      @else
                      {{ asset($product->thumbnail_image) }} @endif"
                                             alt="product" class="img-fluid w-100 img_2" />
                                     </a>
                                     <ul class="wsus__single_pro_icon">
                                         <li><a href="#" data-bs-toggle="modal"
                                                 data-bs-target="#exampleModal-{{ $product->id }}"><i
                                                     class="far fa-eye"></i></a>
                                         </li>
                                         <li><a href="" class="add-product-to-wishlist"
                                                 data-id="{{ $product->id }}"><i class="far fa-heart"></i></a></li>
                                         {{-- <li><a href="#"><i class="far fa-random"></i></a> --}}
                                     </ul>
                                     <div class="wsus__product_details">
                                         <a class="wsus__category" href="#">{{ $product->category->name }} </a>


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
                                             {{ limitText($product->name, 30) }}</a>

                                         @if (checkDiscountProduct($product))
                                             <p class="wsus__price">
                                                 {{ number_format($product->offer_price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                 <del>{{ number_format($product->price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                 </del>
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
                                             <button type="submit" class="add_cart">Mua ngay</button>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         @endforeach
                     @endif
                 @endforeach
             </div>
         </div>


         @if (
             $home_page_banner_three->banner_one->status_one == 0 &&
                 $home_page_banner_three->banner_two->status_two == 0 &&
                 $home_page_banner_three->banner_three->status_three == 0)
         @else
             <section id="wsus__single_banner" class="home_2_single_banner">
                 <div class="container">
                     <div class="row">
                         @if ($home_page_banner_three->banner_one->status_one == 1)
                             <div class="col-xl-6 col-lg-6">
                                 <div class="wsus__single_banner_content banner_1">
                                     <div class="wsus__single_banner_img">
                                         <a href="{{ $home_page_banner_three->banner_one->url_one }}">
                                             <img src="{{ asset($home_page_banner_three->banner_one->image_one) }}"
                                                 alt="banner" class="img-fluid w-100">
                                         </a>
                                     </div>
                                 </div>
                             </div>
                         @else
                         @endif


                         @if ($home_page_banner_three->banner_two->status_two == 0 && $home_page_banner_three->banner_three->status_three == 0)
                         @else
                             <div class="col-xl-6 col-lg-6">
                                 <div class="row">
                                     @if ($home_page_banner_three->banner_two->status_two == 1)
                                         <div class="col-12">
                                             <div class="wsus__single_banner_content single_banner_2">
                                                 <div class="wsus__single_banner_img">
                                                     <a href="{{ $home_page_banner_three->banner_two->url_two }}">
                                                         <img src="{{ asset($home_page_banner_three->banner_two->image_two) }}"
                                                             alt="banner" class="img-fluid w-100">
                                                     </a>
                                                 </div>
                                             </div>
                                         </div>
                                     @else
                                     @endif

                                     @if ($home_page_banner_three->banner_three->status_three == 1)
                                         <div class="col-12 mt-lg-4">
                                             <div class="wsus__single_banner_content">
                                                 <div class="wsus__single_banner_img">
                                                     <a href="{{ $home_page_banner_three->banner_three->url_three }}">
                                                         <img src="{{ asset($home_page_banner_three->banner_three->image_three) }}"
                                                             alt="banner" class="img-fluid w-100">
                                                     </a>
                                                 </div>
                                             </div>
                                         </div>
                                     @else
                                     @endif

                                 </div>
                             </div>
                         @endif
                     </div>
                 </div>
             </section>
         @endif


     </div>
 </section>
