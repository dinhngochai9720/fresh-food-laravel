@extends('frontend.user.layouts.master')

@section('title')
    Hồ sơ
@endsection

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">

            {{-- sidebar --}}
            @include('frontend.user.layouts.sidebar')

            <div class="row">

                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3> Hồ sơ</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">

                                <div class="row">

                                    <form action="{{ route('user.profile.update') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="col-xl-3 col-sm-6 col-md-6 mb-4">
                                            <h4>Ảnh</h4>
                                            <div class="wsus__dash_pro_img">
                                                <img src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('frontend/images/default-image.png') }}"
                                                    alt="img" class="w-100" height="200px">
                                                <input type="file" name="image">
                                            </div>
                                            @if ($errors->has('image'))
                                                <code>{{ $errors->first('image') }}</code>
                                            @endif
                                        </div>

                                        <div class="col-xl-9">
                                            <h4>Thông tin</h4>
                                            <div class="row">
                                                <div class="col-xl-12 col-md-12">
                                                    @if ($errors->has('email'))
                                                        <code>{{ $errors->first('email') }}</code>
                                                    @endif
                                                    <div class="wsus__dash_pro_single">
                                                        <i class="fal fa-envelope-open"></i>
                                                        <input type="email" name="email" placeholder="Nhập email"
                                                            value="{{ Auth::user()->email }}">
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-md-12">
                                                    @if ($errors->has('name'))
                                                        <code>{{ $errors->first('name') }}</code>
                                                    @endif
                                                    <div class="wsus__dash_pro_single">
                                                        <i class="fas fa-user-tie"></i>
                                                        <input type="text" name="name" placeholder="Nhập tên"
                                                            value="{{ Auth::user()->name }}">
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-md-12">
                                                    @if ($errors->has('phone'))
                                                        <code>{{ $errors->first('phone') }}</code>
                                                    @endif
                                                    <div class="wsus__dash_pro_single">
                                                        <i class="fas fa-phone-alt"></i>
                                                        <input type="number" name="phone"
                                                            placeholder="Nhập số điện thoại"
                                                            value="{{ Auth::user()->phone }}">
                                                    </div>
                                                </div>


                                                <div class="col-xl-12">
                                                    <button class="common_btn mb-4 mt-2" type="submit">Cập nhật</button>
                                                </div>
                                            </div>
                                    </form>

                                    <div class="wsus__dash_pass_change mt-2">
                                        <form action="{{ route('user.profile.change-password') }}" method="POST">
                                            @csrf
                                            <h4>Đổi mật khẩu</h4>
                                            <div class="row">
                                                <div class="col-xl-12 col-md-12">
                                                    @if ($errors->has('current_password'))
                                                        <code>{{ $errors->first('current_password') }}</code>
                                                    @endif
                                                    <div class="wsus__dash_pro_single">
                                                        <i class="fas fa-unlock-alt"></i>
                                                        <input type="password" name="current_password"
                                                            placeholder="Nhập mật khẩu hiện tại">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 col-md-12">
                                                    @if ($errors->has('password'))
                                                        <code>{{ $errors->first('password') }}</code>
                                                    @endif
                                                    <div class="wsus__dash_pro_single">
                                                        <i class="fas fa-lock-alt"></i>
                                                        <input type="password" name="password"
                                                            placeholder="Nhập mật khẩu mới">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 col-md-12">
                                                    <div class="wsus__dash_pro_single">
                                                        <i class="fas fa-lock-alt"></i>
                                                        <input type="password" name="password_confirmation"
                                                            placeholder="Xác nhận mật khẩu">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <button class="common_btn" type="submit">Đổi mật khẩu</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
