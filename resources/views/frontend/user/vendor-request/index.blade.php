@extends('frontend.user.layouts.master')

@section('title')
    Trở thành nhà cung cấp
@endsection

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">

            {{-- sidebar --}}
            @include('frontend.user.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3>Đăng ký thông tin</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <div class="row">
                                    {{-- @if (Auth::user()->vendor->status == 0)
                                        <p class="text-danger">Chú ý: Vui lòng chờ nhà cung cấp được phê duyệt!</p>
                                    @else --}}
                                    <p class="mb-2">Chú ý: Vui lòng nhập đầy đủ thông tin và chính xác để trở thành nhà
                                        cung cấp!</p>
                                    <form action="{{ route('user.vendor-request.create') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-xl-3 col-sm-6 col-md-6 mb-4">
                                            <h6>Ảnh</h6>
                                            <img src="{{ asset('frontend/images/default-image.png') }}" alt="img"
                                                class="w-100" height="200px">
                                            <input type="file" name="banner">
                                            @if ($errors->has('banner'))
                                                <code>{{ $errors->first('banner') }}</code>
                                            @endif
                                        </div>

                                        <div class="col-xl-12">
                                            <div class="col-xl-12 col-md-12">
                                                @if ($errors->has('email'))
                                                    <code>{{ $errors->first('email') }}</code>
                                                @endif
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fal fa-envelope-open"></i>
                                                    <input type="email" name="email" placeholder="Nhập email"
                                                        value="">
                                                </div>
                                            </div>

                                            <div class="col-xl-12 col-md-12">
                                                @if ($errors->has('shop_name'))
                                                    <code>{{ $errors->first('shop_name') }}</code>
                                                @endif
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fa-solid fa-store"></i>
                                                    <input type="text" name="shop_name" placeholder="Nhập tên cửa hàng"
                                                        value="">
                                                </div>
                                            </div>

                                            <div class="col-xl-12 col-md-12">
                                                @if ($errors->has('phone'))
                                                    <code>{{ $errors->first('phone') }}</code>
                                                @endif
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fa-solid fa-phone"></i>
                                                    <input type="number" name="phone" placeholder="Nhập số điện thoại"
                                                        value="">
                                                </div>
                                            </div>

                                            <div class="col-xl-12 col-md-12">
                                                @if ($errors->has('address'))
                                                    <code>{{ $errors->first('address') }}</code>
                                                @endif
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fa-solid fa-location-dot"></i>
                                                    <input type="text" name="address" placeholder="Nhập địa chỉ"
                                                        value="">
                                                </div>
                                            </div>

                                            <div class="col-xl-12 col-md-12">
                                                @if ($errors->has('description'))
                                                    <code>{{ $errors->first('description') }}</code>
                                                @endif
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fa-solid fa-file-word"></i>
                                                    <textarea style="width: 100%;" rows="6" id="mytextarea" name="description" placeholder="Nhập mô tả cửa hàng"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="common_btn">Đăng ký</button>
                                    </form>
                                    {{-- @endif --}}
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
