   @php
       $categories = json_decode($category_slider_one->value);
       $products = [];
       $last_key = [];

       foreach ($categories[0] as $key => $value) {
           if ($value == null) {
               break;
           }
           // get only key:value before key has value == null
           $last_key = [$key => $value];
       }

       //    dd(array_keys($last_key)[0]); //key
       if (array_keys($last_key)[0] == 'category') {
           //$last_key['category'] is id of category
           $category = \App\Models\Category::find($last_key['category']);

           //push product to products array
           $products = \App\Models\Product::where('category_id', $category->id)
               ->where(['is_approved' => 1, 'status' => 1])
               ->orderBy('id', 'DESC')
               ->take(4)
               ->get();
       } elseif (array_keys($last_key)[0] == 'sub_category') {
           //$last_key['sub_category'] is id of sub category
           $category = \App\Models\SubCategory::find($last_key['sub_category']);

           //push product to products array
           $products = \App\Models\Product::where('sub_category_id', $category->id)
               ->where(['is_approved' => 1, 'status' => 1])
               ->orderBy('id', 'DESC')
               ->take(4)
               ->get();
       } else {
           //$last_key['child_category'] is id of child category
           $category = \App\Models\ChildCategory::find($last_key['child_category']);

           //push product to products array
           $products = \App\Models\Product::where('child_category_id', $category->id)
               ->where(['is_approved' => 1, 'status' => 1])
               ->orderBy('id', 'DESC')
               ->take(4)
               ->get();
       }
       //    dd($products);
   @endphp


   <section id="wsus__electronic">
       <div class="container">
           <div class="row">
               <div class="col-xl-12">
                   <div class="wsus__section_header">
                       <h3>{{ $category->name }}</h3>
                       <a class="see_btn" href="{{ route('products.view', ['category' => $category->slug]) }}">Xem thêm <i
                               class="fas fa-caret-right"></i></a>
                   </div>
               </div>
           </div>
           <div class="row flash_sell_slider">
               @foreach ($products as $key => $product)
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

                   <div class="col-xl-3 col-sm-6 col-lg-4">
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
                               <li><a href="#" data-bs-toggle="modal"
                                       data-bs-target="#exampleModal-{{ $product->id }}"><i class="far fa-eye"></i></a>
                               </li>
                               <li><a href="" class="add-product-to-wishlist" data-id="{{ $product->id }}"><i
                                           class="far fa-heart"></i></a></li>
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
                                   {{ limitText($product->name, 30) }}
                               </a>

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

           </div>
       </div>
   </section>
