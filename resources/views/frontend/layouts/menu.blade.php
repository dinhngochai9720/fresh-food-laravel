@php
    $categories = \App\Models\Category::where('status', 1)
        ->with([
            'subCategories' => function ($query) {
                //get sub categories of category have status = 1 (active)
                $query
                    ->where('status', 1)

                    //  //get child categories of sub category have status = 1 (active)
                    ->with([
                        'childCategories' => function ($query) {
                            $query->where('status', 1);
                        },
                    ]);
            },
        ])
        ->orderBy('name', 'ASC')
        ->get();

    // dd($categories);

@endphp

<nav class="wsus__main_menu d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="relative_contect d-flex">
                    <div class="wsus_menu_category_bar">
                        <i class="far fa-bars"></i>
                    </div>
                    <ul class="wsus_menu_cat_item show_home toggle_menu">
                        {{-- <li><a href="#"><img
                                    style="max-width: 20px;
                                        margin-right: 15px;"
                                    src="{{ asset('frontend/images/test.svg') }}" alt=""> hot
                                promotions</a></li> --}}

                        @foreach ($categories as $category)
                            <li><a class="{{ count($category->subCategories) > 0 ? 'wsus__droap_arrow' : '' }}"
                                    href="{{ route('products.view', ['category' => $category->slug]) }}"> <img
                                        class="rounded" src="{{ asset($category->image) }}" alt="img"
                                        style="max-width: 30px;
                                    margin-right: 15px;">
                                    {{ $category->name }} </a>

                                {{-- category have sub category --}}
                                @if (count($category->subCategories) > 0)
                                    <ul class="wsus_menu_cat_droapdown">
                                        @foreach ($category->subCategories as $sub_category)
                                            <li><a
                                                    href="{{ route('products.view', ['sub_category' => $sub_category->slug]) }}">{{ $sub_category->name }}
                                                    <i
                                                        class="{{ count($sub_category->childCategories) > 0 ? 'fas fa-angle-right' : '' }}"></i></a>

                                                {{-- sub category have child category --}}
                                                @if (count($sub_category->childCategories) > 0)
                                                    <ul class="wsus__sub_category">
                                                        @foreach ($sub_category->childCategories as $child_category)
                                                            <li><a
                                                                    href="{{ route('products.view', ['child_category' => $child_category->slug]) }}">{{ $child_category->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                        {{-- <li><a href="#"><i class="fal fa-gem"></i> View All Categories</a></li> --}}
                    </ul>

                    <ul class="wsus__menu_item">
                        <li><a class="{{ setActive(['home']) }}" href="{{ url('/') }}">Trang chủ</a></li>

                        <li><a class="{{ setActive(['flash-sale']) }}" href="{{ route('flash-sale') }}">Flash Sale</a>
                        </li>

                        <li><a class="{{ setActive(['vendors']) }}" href="{{ route('vendors') }}">Nhà cung cấp</a>
                        </li>

                    </ul>
                    <ul class="wsus__menu_item wsus__menu_item_right">
                        @if (Auth::check())
                            <li><a class="{{ setActive(['user.track-order.index']) }}"
                                    href="{{ route('user.track-order.index') }}">Theo
                                    dõi đơn hàng</a></li>
                        @else
                        @endif
                        <li><a class="{{ setActive(['cart.cart-detail']) }}"
                                href="{{ route('cart.cart-detail') }}">Giỏ hàng</a>
                        </li>

                        @if (Auth::check())
                            <li><a
                                    href="
                                @if (Auth::user()->role == 'user') {{ route('user.dashboard') }}
                                @elseif(Auth::user()->role == 'vendor')
                                {{ route('vendor.dashboard') }} 
                                @elseif (Auth::user()->role == 'admin') 
                                {{ route('admin.dashboard') }} @endif
                               ">{{ Auth::user()->name }}</a>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>


{{-- mobile menu --}}
<section id="wsus__mobile_menu">
    <span class="wsus__mobile_menu_close"><i class="fal fa-times"></i></span>
    <ul class="wsus__mobile_menu_header_icon d-inline-flex">

        <li><a href="{{ route('user.wishlist') }}"><i class="fal fa-heart"></i><span class="total-product-wishlist">
                    @if (Auth::check())
                        {{ \App\Models\Wishlist::where('user_id', Auth::user()->id)->count() }}
                    @else
                        0
                    @endif
                </span></a></li>

        {{-- <li><a href="compare.html"><i class="far fa-random"></i> </i><span>3</span></a></li> --}}
    </ul>

    <form action="{{ route('products.view') }}" method="GET">
        <input type="text" placeholder="Tìm kiếm sản phẩm" name="search" value="{{ request()->search }}">
        <button type="submit"><i class="far fa-search"></i></button>
    </form>

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                role="tab" aria-controls="pills-home" aria-selected="true">Danh mục</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                role="tab" aria-controls="pills-profile" aria-selected="false">Menu</button>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="wsus__mobile_menu_main_menu">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <ul class="wsus_mobile_menu_category">
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('products.view', ['category' => $category->slug]) }}"
                                    class="{{ count($category->subCategories) > 0 ? 'accordion-button' : '' }} collapsed"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThreew-{{ $loop->index }}" aria-expanded="false"
                                    aria-controls="flush-collapseThreew-{{ $loop->index }}">
                                    <img class="rounded" src="{{ asset($category->image) }}" alt="img"
                                        style="max-width: 30px;
                                    margin-right: 15px;">
                                    {{ $category->name }}
                                </a>

                                @if (count($category->subCategories) > 0)
                                    <div id="flush-collapseThreew-{{ $loop->index }}"
                                        class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <ul>
                                                @foreach ($category->subCategories as $sub_category)
                                                    <li><a
                                                            href="{{ route('products.view', ['sub_category' => $sub_category->slug]) }}">{{ $sub_category->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="wsus__mobile_menu_main_menu">
                <div class="accordion accordion-flush" id="accordionFlushExample2">
                    <ul>
                        @if (Auth::check())
                            <li><a
                                    href="
                                @if (Auth::user()->role == 'user') {{ route('user.dashboard') }}
                                @elseif(Auth::user()->role == 'vendor')
                                {{ route('vendor.dashboard') }} 
                                @elseif (Auth::user()->role == 'admin') 
                                {{ route('admin.dashboard') }} @endif
                               ">{{ Auth::user()->name }}</a>
                            </li>

                            <li><a href="{{ route('user.track-order.index') }}">Theo dõi đơn hàng</a></li>
                        @else
                            <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                        @endif

                        <li><a href="{{ route('flash-sale') }}">Flash Sale</a></li>
                        <li><a href="{{ route('vendors') }}">Nhà cung cấp</a></li>
                        <li><a href="{{ route('cart.cart-detail') }}">Giỏ hàng</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
