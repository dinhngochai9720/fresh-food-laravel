<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">Quản trị viên</a>
        </div>

        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">QTV</a>
        </div>

        <ul class="sidebar-menu">
            {{-- <li class="menu-header">Trang chủ</li> --}}

            <li class="dropdown {{ setActive(['admin.dashboard']) }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Trang
                        chủ</span></a>

            </li>

            <li class="menu-header">Quản lý</li>

            {{-- .* is all name route  --}}
            <li class="dropdown {{ setActive(['admin.slider.*', 'admin.flash-sale.*', 'admin.advertisement.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th-large"></i>
                    <span>Quản lý website</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.slider.*']) }}"><a class="nav-link"
                            href="{{ route('admin.slider.index') }}">Slider</a>
                    </li>
                    <li class="{{ setActive(['admin.flash-sale.*']) }}"><a class="nav-link"
                            href="{{ route('admin.flash-sale.index') }}">Flash Sale</a>
                    </li>
                    {{-- <li class="{{ setActive(['admin.advertisement.*']) }}"><a class="nav-link"
                            href="{{ route('admin.advertisement.index') }}">Banner</a>
                    </li> --}}
                </ul>
            </li>

            <li
                class="dropdown {{ setActive(['admin.category.*', 'admin.sub-category.*', 'admin.child-category.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Quản lý danh mục</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.category.index') }}">Danh mục</a></li>
                    <li class="{{ setActive(['admin.sub-category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.sub-category.index') }}">Danh mục con</a></li>
                    <li class="{{ setActive(['admin.child-category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.child-category.index') }}">Danh mục con cấp 2</a></li>
                </ul>
            </li>


            <li class="{{ setActive(['admin.brand.*']) }}">
                <a class="nav-link" href="{{ route('admin.brand.index') }}">
                    <i class="far fa-copyright"></i>
                    <span>Quản lý thương hiệu</span></a>
            </li>


            <li
                class="dropdown {{ setActive([
                    'admin.product.*',
                    'admin.product-multi-image.*',
                    'admin.product-variant.*',
                    'admin.product-variant-item.*',
                    'admin.product-pending.*',
                    'admin.product-review.*',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fab fa-product-hunt"></i> <span>Quản lý sản phẩm</span>
                </a>

                <ul class="dropdown-menu">
                    <li
                        class="{{ setActive([
                            'admin.product.*',
                            'admin.product-multi-image.*',
                            'admin.product-variant.*',
                            'admin.product-variant-item.*',
                        ]) }}">
                        <a class="nav-link" href="{{ route('admin.product.index') }}">Sản phẩm chấp thuận</a>
                    </li>

                    <li class="{{ setActive(['admin.product-pending.*']) }}">
                        <a class="nav-link" href="{{ route('admin.product-pending.index') }}">Sản phẩm chờ
                            xử lý</a>
                    </li>


                    <li class="{{ setActive(['admin.product-review.*']) }}">
                        <a class="nav-link" href="{{ route('admin.product-review.index') }}">Đánh giá sản phẩm</a>
                    </li>
                </ul>
            </li>


            <li
                class="dropdown {{ setActive(['admin.order.*', 'admin.order-unpaid.*', 'admin.order-paid.*', 'admin.order-pending.*', 'admin.order-confirmed.*', 'admin.order-preparing-the-goods.*', 'admin.order-warehouse.*', 'admin.order-delivering.*', 'admin.order-delivered.*', 'admin.order-cancelled.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-shopping-cart"></i><span>Quản lý đơn hàng</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.order.*']) }}"><a class="nav-link"
                            href="{{ route('admin.order.index') }}">Tất cả đơn hàng</a>
                    </li>
                    <li class="{{ setActive(['admin.order-unpaid.*']) }}"><a class="nav-link"
                            href="{{ route('admin.order-unpaid.index') }}">Đơn hàng chưa thanh toán</a>
                    </li>
                    <li class="{{ setActive(['admin.order-paid.*']) }}"><a class="nav-link"
                            href="{{ route('admin.order-paid.index') }}">Đơn hàng đã thanh toán</a>
                    </li>
                    <li class="{{ setActive(['admin.order-pending.*']) }}"><a class="nav-link"
                            href="{{ route('admin.order-pending.index') }}">Đơn hàng chờ xử lý</a>
                    </li>
                    <li class="{{ setActive(['admin.order-confirmed.*']) }}"><a class="nav-link"
                            href="{{ route('admin.order-confirmed.index') }}">Đơn hàng đã xác nhận</a>
                    </li>
                    <li class="{{ setActive(['admin.order-preparing-the-goods.*']) }}"><a class="nav-link"
                            href="{{ route('admin.order-preparing-the-goods.index') }}">Đơn hàng đang chuẩn bị</a>
                    </li>
                    <li class="{{ setActive(['admin.order-warehouse.*']) }}"><a class="nav-link"
                            href="{{ route('admin.order-warehouse.index') }}">Đơn hàng đã đến kho</a>
                    </li>
                    <li class="{{ setActive(['admin.order-delivering.*']) }}"><a class="nav-link"
                            href="{{ route('admin.order-delivering.index') }}">Đơn hàng đang giao</a>
                    </li>
                    <li class="{{ setActive(['admin.order-delivered.*']) }}"><a class="nav-link"
                            href="{{ route('admin.order-delivered.index') }}">Đơn hàng đã giao</a>
                    </li>
                    <li class="{{ setActive(['admin.order-cancelled.*']) }}"><a class="nav-link"
                            href="{{ route('admin.order-cancelled.index') }}">Đơn hàng đã hủy</a>
                    </li>
                </ul>
            </li>


            <li
                class="dropdown {{ setActive(['admin.transaction.*', 'admin.transaction-paypal.*', 'admin.transaction-vnpay.*', 'admin.transaction-stripe.*', 'admin.transaction-cash.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-wallet"></i>
                    <span>Quản lý giao dịch</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.transaction.*']) }}"><a class="nav-link"
                            href="{{ route('admin.transaction.index') }}">Tất cả giao dịch</a></li>
                    <li class="{{ setActive(['admin.transaction-paypal.*']) }}"><a class="nav-link"
                            href="{{ route('admin.transaction-paypal.index') }}">Giao dịch PayPal</a></li>
                    <li class="{{ setActive(['admin.transaction-stripe.*']) }}"><a class="nav-link"
                            href="{{ route('admin.transaction-stripe.index') }}">Giao dịch Stripe</a></li>
                    <li class="{{ setActive(['admin.transaction-vnpay.*']) }}"><a class="nav-link"
                            href="{{ route('admin.transaction-vnpay.index') }}">Giao dịch VNPay</a></li>
                    <li class="{{ setActive(['admin.transaction-cash.*']) }}"><a class="nav-link"
                            href="{{ route('admin.transaction-cash.index') }}">Giao dịch Tiền mặt</a></li>
                </ul>
            </li>

            <li class="dropdown {{ setActive(['admin.withdraw-method.*', 'admin.withdraw-request.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"> <i
                        class="fa-solid fa-building-columns"></i>
                    <span>Quản lý thanh toán</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.withdraw-method.*']) }}"><a class="nav-link"
                            href="{{ route('admin.withdraw-method.index') }}">Phương thức rút tiền</a></li>
                    <li class="{{ setActive(['admin.withdraw-request.*']) }}"><a class="nav-link"
                            href="{{ route('admin.withdraw-request.index') }}">Yêu cầu rút tiền</a></li>
                </ul>
            </li>


            <li class="{{ setActive(['admin.voucher.*']) }}">
                <a class="nav-link" href="{{ route('admin.voucher.index') }}">
                    <i class="fas fa-tags"></i>
                    <span>Quản lý voucher</span></a>
            </li>

            <li class="dropdown {{ setActive(['admin.shipping.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-truck"></i>
                    <span>Quản lý vận chuyển</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.shipping.*']) }}"><a class="nav-link"
                            href="{{ route('admin.shipping.index') }}">Phương thức vận chuyển</a></li>
                </ul>
            </li>

            <li class="dropdown {{ setActive(['admin.vendor-approved.*', 'admin.vendor-pending.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fa-brands fa-shopify"></i>
                    <span>Quản lý nhà cung cấp</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.vendor-approved.*']) }}"><a class="nav-link"
                            href="{{ route('admin.vendor-approved.index') }}">Đã phê duyệt</a></li>
                    <li class="{{ setActive(['admin.vendor-pending.*']) }}"><a class="nav-link"
                            href="{{ route('admin.vendor-pending.index') }}">Chờ xử lý</a></li>
                </ul>
            </li>

            <li class="dropdown {{ setActive(['admin.account-user.*', 'admin.account-admin.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fa-solid fa-users"></i>
                    <span>Quản lý tài khoản</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.account-user.*']) }}"><a class="nav-link"
                            href="{{ route('admin.account-user.index') }}">Người dùng</a>
                    </li>
                    <li class="{{ setActive(['admin.account-admin.*']) }}"><a class="nav-link"
                            href="{{ route('admin.account-admin.index') }}">Quản trị viên</a></li>
                </ul>
            </li>

            {{-- <li class="{{ setActive(['admin.subscriber.*']) }}">
                <a class="nav-link" href="{{ route('admin.subscriber.index') }}">
                    <i class="fas fa-envelope"></i>
                    <span>Quản lý email đăng ký</span></a>
            </li> --}}

            <li class="menu-header">Cài đặt</li>
            <li class="{{ setActive(['admin.home-page-setting.*']) }}">
                <a class="nav-link" href="{{ route('admin.home-page-setting.index') }}">
                    <i class="fas fa-tv"></i>
                    <span>Giao diện trang chủ</span></a>
            </li>

            {{-- <li class="dropdown {{ setActive(['admin.footer-customer.*', 'admin.footer-company.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-tv"></i>
                    <span>Footer website</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.footer-customer.*']) }}"><a class="nav-link"
                            href="{{ route('admin.footer-customer.index') }}">Chăm sóc khách hàng</a></li>
                    <li class="{{ setActive(['admin.footer-company.*']) }}"><a class="nav-link"
                            href="{{ route('admin.footer-company.index') }}">Về Fresh Food</a></li>
                </ul>
            </li> --}}


            <li class="{{ setActive(['admin.setting.*']) }}"><a class="nav-link "
                    href="{{ route('admin.setting.index') }}"><i class="fas fa-cog"></i>
                    <span>Cài đặt chung</span></a>
            </li>
        </ul>
    </aside>
</div>
