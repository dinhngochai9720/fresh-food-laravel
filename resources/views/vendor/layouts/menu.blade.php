<div class="wsus__dashboard_menu">
    <div class="wsusd__dashboard_user">
        <img src="{{ Auth::user()->vendor->banner ? asset(Auth::user()->vendor->banner) : asset('frontend/images/default-image.png') }}"
            alt="img" class="img-fluid">
        <p>{{ Auth::user()->vendor->shop_name }}</p>
    </div>
</div>
