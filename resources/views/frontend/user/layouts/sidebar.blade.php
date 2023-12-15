<div class="dashboard_sidebar">
    <span class="close_icon">
        <i class="far fa-bars dash_bar"></i>
        <i class="far fa-times dash_close"></i>
    </span>
    <a href="{{ url('/') }}" class="dash_logo"><img src="{{ asset($settings->logo) }}" alt="logo"
            class="img-fluid"></a>
    <ul class="dashboard_link">
        <li>
            <a class="{{ setActive(['user.dashboard']) }}" href="{{ route('user.dashboard') }}"><i
                    class="fas fa-tachometer"></i>Trang chủ</a>
        </li>

        @if (auth()->user()->role !== 'vendor')
            <li>
                <a class="{{ setActive(['user.vendor-request.index']) }}"
                    href="{{ route('user.vendor-request.index') }}"><i class="fa-brands fa-shopify"></i> Trở thành nhà
                    cung
                    cấp</a>
            </li>
        @elseif (auth()->user()->role == 'vendor')
            <li>
                <a class="{{ setActive(['vendor.dashboard']) }}" href="{{ route('vendor.dashboard') }}"><i
                        class="fa-brands fa-shopify"></i>
                    Nhà cung cấp
                </a>
            </li>
        @endif


        <li>
            <a class="{{ setActive(['user.profile']) }}" href="{{ route('user.profile') }}"><i
                    class="far fa-user"></i>Hồ sơ</a>
        </li>
        <li>
            <a class="{{ setActive(['user.address.*']) }}" href="{{ route('user.address.index') }}"><i
                    class="fa-solid fa-location-dot"></i> Địa chỉ</a>
        </li>
        <li>
            <a class="{{ setActive(['user.order.*']) }}" href="{{ route('user.order.index') }}"><i
                    class="fa-solid fa-cart-shopping"></i> Đơn hàng</a>
        </li>
        <li>
            <a class="{{ setActive(['user.review.index']) }}" href="{{ route('user.review.index') }}"><i
                    class="fa-regular fa-star"></i> Đánh giá</a>
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
