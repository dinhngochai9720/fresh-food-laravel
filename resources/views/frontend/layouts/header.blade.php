<header>
    <div class="container">
        <div class="row">
            <div class="col-2 col-md-1 d-lg-none">
                <div class="wsus__mobile_menu_area">
                    <span class="wsus__mobile_menu_icon"><i class="fal fa-bars"></i></span>
                </div>
            </div>
            <div class="col-xl-2 col-7 col-md-8 col-lg-2">
                <div class="wsus_logo_area">
                    <a class="wsus__header_logo" href="{{ url('/') }}">
                        <img src="{{ asset($settings->logo) }}" alt="logo" class="img-fluid w-100">
                    </a>
                </div>
            </div>
            <div class="col-xl-5 col-md-6 col-lg-4 d-none d-lg-block">
                <div class="wsus__search">
                    <form action="{{ route('products.view') }}" method="GET">
                        <input type="text" placeholder="Tìm kiếm sản phẩm" name="search"
                            value="{{ request()->search }}">
                        <button type="submit"><i class="far fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="col-xl-5 col-3 col-md-3 col-lg-6">
                <div class="wsus__call_icon_area">
                    <div class="wsus__call_area">
                        <div class="wsus__call">
                            <i class="fas fa-user-headset"></i>
                        </div>
                        <div class="wsus__call_text">
                            <p>{{ $settings->email_contact }}</p>
                            <p>{{ $settings->phone_contact }}</p>
                        </div>
                    </div>
                    <ul class="wsus__icon_area">
                        <li><a href="{{ route('user.wishlist') }}"><i class="fal fa-heart"></i><span
                                    class="total-product-wishlist">
                                    @if (Auth::check())
                                        {{ \App\Models\Wishlist::where('user_id', Auth::user()->id)->count() }}
                                    @else
                                        0
                                    @endif
                                </span></a></li>
                        {{-- <li><a href="compare.html"><i class="fal fa-random"></i><span>03</span></a></li> --}}
                        <li><a class="wsus__cart_icon" href="#"><i class="fal fa-shopping-bag"></i><span
                                    class="total-product-mini-cart">{{ Cart::content()->count() }}</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- mini cart --}}
    <div class="wsus__mini_cart">
        <h4>Giỏ hàng <span class="wsus_close_mini_cart d-flex justify-content-center align-items-center"><i
                    class="far fa-times"></i></span></h4>

        <ul class="mini-cart">
            @if (Cart::content()->count() == 0)
                <p class="text-center">Giỏ hàng trống!</p>
            @else
                @foreach (Cart::content() as $product)
                    <li class="product-mini-cart-{{ $product->rowId }}">
                        <div class="wsus__cart_img">
                            <a
                                href="{{ route('product-detail', ['slug' => $product->options->slug, 'id' => $product->id]) }}"><img
                                    src="{{ asset($product->options->thumbnail_image) }}" alt="product"
                                    class="img-fluid w-100"></a>

                        </div>
                        <div class="wsus__cart_text">
                            <a class="wsus__cart_title"
                                href="{{ route('product-detail', ['slug' => $product->options->slug, 'id' => $product->id]) }}">{{ $product->name }}
                            </a>

                            @foreach ($product->options->variants as $key => $variant)
                                <div>
                                    <small>
                                        {{ $key }}: {{ $variant['name'] }}
                                    </small>
                                </div>
                            @endforeach

                            <p> {{ number_format($product->price + $product->options->variant_total_price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                <span>x{{ $product->qty }}</span>
                            </p>
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>

        <div class="mini_cart_actions {{ Cart::content()->count() === 0 ? 'd-none' : '' }}">
            {{-- getTotalCartPrice() is function in helpers.php --}}
            <h5>Tổng <span
                    id="total-mini-cart-price">{{ number_format(getTotalCartPrice(), 0, '.', '.') }}{{ $settings->currency_icon }}</span>
            </h5>
            <div class="wsus__minicart_btn_area">
                <a class="common_btn" href="{{ route('cart.cart-detail') }}">Chi tiết giỏ hàng</a>
                <a class="common_btn" href="{{ route('user.checkout') }}">Thanh toán</a>
            </div>
        </div>

    </div>
</header>
