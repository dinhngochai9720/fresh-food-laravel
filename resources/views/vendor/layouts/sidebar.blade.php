<div class="dashboard_sidebar">
    <span class="close_icon">
        <i class="far fa-bars dash_bar"></i>
        <i class="far fa-times dash_close"></i>
    </span>
    <a href="{{ url('/') }}" class="dash_logo"><img src="{{ asset('frontend/images/freshfood-logo.webp') }}"
            alt="logo" class="img-fluid"></a>
    <ul class="dashboard_link">
        <li><a class="{{ setActive(['vendor.dashboard']) }}" href="{{ route('vendor.dashboard') }}"><i
                    class="fas fa-tachometer"></i>Trang chủ</a>
        </li>

        <li><a class="{{ setActive(['user.dashboard']) }}" href="{{ route('user.dashboard') }}"><i
                    class="far fa-user"></i> Tài khoản</a>
        </li>

        <li><a class="{{ setActive(['vendor.message.*']) }}" href="{{ route('vendor.message.index') }}">
                <i class="fa-solid fa-message"></i> Chat</a>
        </li>

        <li><a class="{{ setActive(['vendor.shop-profile.*']) }}" href="{{ route('vendor.shop-profile.index') }}"><i
                    class="fa-solid fa-shop"></i> Cửa hàng</a></li>

        <li><a class="{{ setActive([
            'vendor.product.*',
            'vendor.product-multi-image.*',
            'vendor.product-variant.*',
            'vendor.product-variant-item.*',
        ]) }}"
                href="{{ route('vendor.product.index') }}"><i class="fa-brands fa-product-hunt"></i> Quản lý sản
                phẩm</a></li>

        <li><a class="{{ setActive(['vendor.order.*']) }}" href="{{ route('vendor.order.index') }}"><i
                    class="fa-solid fa-cart-shopping"></i>Quản lý đơn
                hàng</a>
        </li>

        <li><a class="{{ setActive(['vendor.product-review.*']) }}"
                href="{{ route('vendor.product-review.index') }}"><i class="fa-regular fa-star"></i>
                Đánh giá của khách hàng</a>
        </li>

        <li><a class="{{ setActive(['vendor.withdraw.*']) }}" href="{{ route('vendor.withdraw.index') }}"><i
                    class="fa-solid fa-building-columns"></i>
                Yêu cầu rút tiền</a>
        </li>


        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
              this.closest('form').submit();">
                    <i class="far fa-sign-out-alt"></i>
                    Đăng xuất
                </a>
            </li>
        </form>
    </ul>
</div>
