@extends('admin.layouts.master')

@section('title')
    Tài khoản
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Hồ sơ</h1>
        </div>

        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card">
                        <form method="post" class="needs-validation" novalidate=""
                            action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h4>Thông tin</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <div class="d-flex justify-content-center align-items-center mb-3">
                                            <img class="rounded-circle"
                                                src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('frontend/images/default-image.png') }}"
                                                alt="avatar_image" style="width: 100px; height: 100px;">
                                        </div>
                                        <label>Ảnh</label>
                                        <input type="file" name="image" class="form-control">
                                        @if ($errors->has('image'))
                                            <code>{{ $errors->first('image') }}</code>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12 col-12">
                                        <label>Tên</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ Auth::user()->name }}" placeholder="Nhập tên">
                                        @if ($errors->has('name'))
                                            <code>{{ $errors->first('name') }}</code>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12 col-12">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ Auth::user()->email }}" placeholder="Nhập email">
                                        @if ($errors->has('email'))
                                            <code>{{ $errors->first('email') }}</code>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12 col-12">
                                        <label>Điện thoại</label>
                                        <input type="number" name="phone" class="form-control"
                                            value="{{ Auth::user()->phone }}" placeholder="Nhập số điện thoại">
                                        @if ($errors->has('phone'))
                                            <code>{{ $errors->first('phone') }}</code>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card">
                        <form method="post" class="needs-validation" novalidate=""
                            action="{{ route('admin.profile.change-password') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h4>Đổi mật khẩu</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12 col-12">
                                        <label>Mật khẩu hiện tại</label>
                                        <input type="password" name="current_password" class="form-control"
                                            placeholder="Nhập mật khẩu hiện tại">
                                        @if ($errors->has('current_password'))
                                            <code>{{ $errors->first('current_password') }}</code>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12 col-12">
                                        <label>Mật khẩu mới</label>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Nhập mật khẩu mới">
                                        @if ($errors->has('password'))
                                            <code>{{ $errors->first('password') }}</code>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12 col-12">
                                        <label>Xác nhận mật khẩu</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            placeholder="Nhập lại mật khẩu">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Đổi mật khẩu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
