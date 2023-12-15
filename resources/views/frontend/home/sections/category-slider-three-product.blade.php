@php
    $categories = json_decode($category_slider_three->value, true);
@endphp

<section id="wsus__weekly_best" class="home2_wsus__weekly_best_2 ">
    <div class="container">
        <div class="row">
            @php
                $products = [];
            @endphp

            @foreach ($categories as $key => $category)
                @php
                    // last_key array only has one key:value
                    $last_key = [];
                    foreach ($category as $key => $value) {
                        if ($value == null) {
                            break;
                        }
                        // get only key:value before key has value == null
                        $last_key = [$key => $value];
                    }

                    // dd($last_key); //key:value
                    // dd(array_keys($last_key)[0]); //key

                    if (array_keys($last_key)[0] == 'category') {
                        //$last_key['category'] is id of category
                        $category = \App\Models\Category::find($last_key['category']);

                        //push product to products array
                        $products = \App\Models\Product::where('category_id', $category->id)
                            ->where(['is_approved' => 1, 'status' => 1])
                            ->orderBy('id', 'DESC')
                            ->take(8)
                            ->get();
                    } elseif (array_keys($last_key)[0] == 'sub_category') {
                        //$last_key['sub_category'] is id of sub category
                        $category = \App\Models\SubCategory::find($last_key['sub_category']);

                        //push product to products array
                        $products = \App\Models\Product::where('sub_category_id', $category->id)
                            ->where(['is_approved' => 1, 'status' => 1])
                            ->orderBy('id', 'DESC')
                            ->take(8)
                            ->get();
                    } else {
                        //$last_key['child_category'] is id of child category
                        $category = \App\Models\ChildCategory::find($last_key['child_category']);

                        //push product to products array
                        $products = \App\Models\Product::where('child_category_id', $category->id)
                            ->where(['is_approved' => 1, 'status' => 1])
                            ->orderBy('id', 'DESC')
                            ->take(8)
                            ->get();
                    }
                @endphp

                <div class="col-xl-6 col-sm-6">
                    <div class="wsus__section_header">
                        <h3>{{ $category->name }}</h3>
                    </div>

                    <div class="row weekly_best2">
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
                            <div class="col-xl-4 col-lg-4">
                                <a class="wsus__hot_deals__single"
                                    href="{{ route('product-detail', ['slug' => $product->slug, 'id' => $product->id]) }}">
                                    <div class="wsus__hot_deals__single_img">
                                        <img src="{{ asset($product->thumbnail_image) }}" alt="product_image"
                                            class="img-fluid w-100">
                                    </div>
                                    <div class="wsus__hot_deals__single_text">
                                        <h5>{!! limitText($product->name, 20) !!}</h5>
                                        <p class="wsus__rating">
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
                                        @if (checkDiscountProduct($product))
                                            <p class="wsus__tk">
                                                {{ number_format($product->offer_price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                <del>{{ number_format($product->price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                </del>
                                            </p>
                                        @else
                                            <p class="wsus__tk">
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
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
