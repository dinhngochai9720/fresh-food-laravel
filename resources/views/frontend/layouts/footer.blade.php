@php

    $general_setting = \App\Models\GeneralSetting::first();
    $footer_customers = \App\Models\FooterCustomer::where('status', 1)
        ->orderBy('id', 'DESC')
        ->get();
    $footer_companies = \App\Models\FooterCompany::where('status', 1)
        ->orderBy('id', 'DESC')
        ->get();
@endphp

<footer class="footer_2">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-xl-3 col-sm-7 col-md-6 col-lg-3">
                <div class="wsus__footer_content">
                    <a class="wsus__footer_2_logo" href="#">
                        <img src="{{ asset($general_setting->logo_footer) }}" alt="logo">
                    </a>
                    <a class="action" href="callto:{{ $general_setting->phone_contact }}"><i
                            class="fas fa-phone-alt"></i>
                        {{ $general_setting->phone_contact }}</a>
                    <a class="action" href="mailto:{{ $general_setting->email_contact }}"><i
                            class="far fa-envelope"></i>
                        {{ $general_setting->email_contact }}</a>
                    <p><i class="fal fa-map-marker-alt"></i> {{ $general_setting->address }}</p>
                    <ul class="wsus__footer_social">
                        <li><a class="facebook d-flex justify-content-center align-items-center"
                                href="{{ $general_setting->facebook_link }}"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a class="youtube d-flex justify-content-center align-items-center"
                                href="{{ $general_setting->youtube_link }}"><i class="fab fa-youtube"></i></a></li>
                        <li><a class="instagram d-flex justify-content-center align-items-center"
                                href="{{ $general_setting->instagram_link }}"><i class="fa-brands fa-instagram"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-sm-5 col-md-4 col-lg-2">
                <div class="wsus__footer_content">
                    <h5>Chăm sóc khách hàng</h5>
                    <ul class="wsus__footer_menu">
                        @foreach ($footer_customers as $footer_customer)
                            <li><a href="{{ $footer_customer->url }}"><i class="fas fa-caret-right"></i>
                                    {{ $footer_customer->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-sm-5 col-md-4 col-lg-2">
                <div class="wsus__footer_content">
                    <h5>Về Fresh Food</h5>
                    <ul class="wsus__footer_menu">
                        @foreach ($footer_companies as $footer_company)
                            <li><a href="{{ $footer_company->url }}"><i class="fas fa-caret-right"></i>
                                    {{ $footer_company->name }}</a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
            <div class="col-xl-4 col-sm-7 col-md-8 col-lg-5">
                <div class="wsus__footer_content wsus__footer_content_2">
                    <h3>Liên hệ</h3>
                    {{-- <p>Get all the latest information on Events, Sales and Offers.
                        Get all the latest information on Events.</p> --}}
                    <form id="newsletter">
                        @csrf
                        <input class="newsletter_email" type="text" placeholder="Nhập email của bạn" name="email">
                        <button type="submit" class="common_btn">Đăng ký</button>
                    </form>
                    <div class="footer_payment">
                        <p>Thanh toán</p>
                        <img src="{{ asset('frontend/images/credit2.png') }}" alt="card" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wsus__footer_bottom">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__copyright d-flex justify-content-center">
                        <p>{{ $general_setting->copyright }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
