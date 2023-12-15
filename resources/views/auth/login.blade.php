@extends('frontend.layouts.master')

@section('title')
    Đăng nhập || Đăng ký
@endsection

@section('content')
    <!--============================
                                                                             BREADCRUMB START
                                                                        ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Đăng nhập || Đăng ký</h4>
                        <ul>
                            <li><a href="#">Trang chủ</a></li>
                            <li><a href="#">Đăng nhập || Đăng ký</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
                                                                            BREADCRUMB END
                                                                        ==============================-->


    <!--============================
                                                                           LOGIN/REGISTER PAGE START
                                                                        ==============================-->
    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 m-auto">
                    <div class="wsus__login_reg_area">
                        <ul class="nav nav-pills mb-3" id="pills-tab2" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab2" data-bs-toggle="pill"
                                    data-bs-target="#pills-homes" type="button" role="tab" aria-controls="pills-homes"
                                    aria-selected="true">Đăng nhập</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab2" data-bs-toggle="pill"
                                    data-bs-target="#pills-profiles" type="button" role="tab"
                                    aria-controls="pills-profiles" aria-selected="true">Đăng ký</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent2">
                            {{-- Login --}}
                            <div class="tab-pane fade show active" id="pills-homes" role="tabpanel"
                                aria-labelledby="pills-home-tab2">
                                <div class="wsus__login">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="wsus__login_input">
                                            <i class="fas fa-user-tie"></i>
                                            <input id="email" type="email" value="{{ old('email') }}" name="email"
                                                placeholder="Nhập email">
                                        </div>

                                        <div class="wsus__login_input">
                                            <i class="fas fa-key"></i>
                                            <input id="password" type="password" name="password"
                                                placeholder="Nhập mật khẩu">
                                        </div>

                                        <div class="wsus__login_save">
                                            <div class="form-check form-switch">
                                                {{-- <input class="form-check-input" type="checkbox"
                                                    id="remember_me" name="remember_me">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Remember
                                                    me</label> --}}
                                            </div>
                                            <a class="forget_p" href="{{ route('password.request') }}">Quên mật khẩu ?</a>
                                        </div>

                                        <button class="common_btn" type="submit">Đăng nhập</button>

                                        <p class="social_text">Hoặc</p>
                                        <ul class="wsus__login_link">
                                            <li><a href="{{ route('google.login') }}"><i class="fab fa-google"></i></a></li>
                                            {{-- <li><a href="#"><i
                                                        class="fab fa-facebook-f"></i></a></li> --}}
                                        </ul>
                                    </form>
                                </div>
                            </div>

                            {{-- Register --}}
                            <div class="tab-pane fade" id="pills-profiles" role="tabpanel"
                                aria-labelledby="pills-profile-tab2">
                                <div class="wsus__login">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="wsus__login_input">
                                            <i class="fas fa-user-tie"></i>
                                            <input id="name" name="name" value="{{ old('name') }}" type="text"
                                                placeholder="Nhập tên">
                                        </div>

                                        <div class="wsus__login_input">
                                            <i class="far fa-envelope"></i>
                                            <input id="email" name="email" type="email" value="{{ old('email') }}"
                                                placeholder="Nhập email">
                                        </div>

                                        <div class="wsus__login_input">
                                            <i class="fas fa-key"></i>
                                            <input id="password" name="password" type="password"
                                                placeholder="Nhập mật khẩu">
                                        </div>
                                        <div class="wsus__login_input">
                                            <i class="fas fa-key"></i>
                                            <input id="password_confirmation" name="password_confirmation" type="password"
                                                placeholder="Xác nhận mật khẩu">
                                        </div>

                                        <button class="common_btn mt-4" type="submit">Đăng ký</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
                                                                           LOGIN/REGISTER PAGE END
                                                                        ==============================-->
@endsection
