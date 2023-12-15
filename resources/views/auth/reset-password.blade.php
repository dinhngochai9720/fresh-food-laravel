@extends('frontend.layouts.master')

@section('title')
    Đặt lại mật khẩu
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
                        <h4> Đặt lại mật khẩu</h4>
                        <ul>
                            <li><a href="#">Đăng nhập</a></li>
                            <li><a href="#">Đặt lại mật khẩu</a></li>
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
        CHANGE PASSWORD START
    ==============================-->
    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-md-10 col-lg-7 m-auto">
                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf

                      

                        <div class="wsus__change_password">
                            <h4 class="d-flex justify-content-center align-items-center">Đặt lại mật khẩu</h4>

                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div class="wsus__single_pass">
                                <label>Email</label>
                                <input id="email" name="email" value="{{old('email',$request->email)}}" type="email" placeholder="Nhập email">
                            </div>
                            <div class="wsus__single_pass">
                                <label>Mật khẩu mới</label>
                                <input id="password" name="password" type="password" placeholder="Nhập mật khẩu mới">
                            </div>
                            <div class="wsus__single_pass">
                                <label>Xác nhận mật khẩu</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Xác nhận mật khẩu">
                            </div>
                            <button class="common_btn" type="submit">Đặt lại mật khẩu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        CHANGE PASSWORD END
    ==============================-->

@endsection