@extends('vendor.layouts.master')

@section('title')
    Hồ sơ cửa hàng
@endsection

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">

            {{-- sidebar --}}
            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3>Hồ sơ cửa hàng</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <div class="row">
                                    <form action="{{ route('vendor.shop-profile.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-xl-3 col-sm-6 col-md-6 mb-4">
                                            <h6>Ảnh</h6>
                                            <img src="{{ $profile->banner ? asset($profile->banner) : asset('frontend/images/default-image.png') }}"
                                                alt="img" class="w-100 border" height="200px">
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
                                                        value="{{ $profile->email }}">
                                                </div>
                                            </div>

                                            <div class="col-xl-12 col-md-12">
                                                @if ($errors->has('shop_name'))
                                                    <code>{{ $errors->first('shop_name') }}</code>
                                                @endif
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fa-solid fa-store"></i>
                                                    <input type="text" name="shop_name" placeholder="Nhập tên cửa hàng"
                                                        value="{{ $profile->shop_name }}">
                                                </div>
                                            </div>

                                            <div class="col-xl-12 col-md-12">
                                                @if ($errors->has('phone'))
                                                    <code>{{ $errors->first('phone') }}</code>
                                                @endif
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fa-solid fa-phone"></i>
                                                    <input type="number" name="phone" placeholder="Nhập số điện thoại"
                                                        value="{{ $profile->phone }}">
                                                </div>
                                            </div>

                                            <div class="col-xl-12 col-md-12">
                                                @if ($errors->has('address'))
                                                    <code>{{ $errors->first('address') }}</code>
                                                @endif
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fa-solid fa-location-dot"></i>
                                                    <input type="text" name="address" placeholder="Nhập địa chỉ"
                                                        value="{{ $profile->address }}">
                                                </div>
                                            </div>

                                            <div class="col-xl-12 col-md-12">
                                                @if ($errors->has('description'))
                                                    <code>{{ $errors->first('description') }}</code>
                                                @endif
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fa-solid fa-file-word"></i>
                                                    {{-- <textarea class="summernote" name="description" >{{$profile->description}}</textarea> --}}
                                                    <textarea style="width: 100%;" rows="6" id="mytextarea" name="description" placeholder="Nhập mô tả cửa hàng">{{ $profile->description }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-xl-12 col-md-12">
                                                @if ($errors->has('facebook_link'))
                                                    <code>{{ $errors->first('facebook_link') }}</code>
                                                @endif
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fa-brands fa-facebook"></i>
                                                    <input type="text" name="facebook_link"
                                                        placeholder="Nhập link facebook"
                                                        value="{{ $profile->facebook_link }}">
                                                </div>
                                            </div>

                                            <div class="col-xl-12 col-md-12">
                                                @if ($errors->has('youtube_link'))
                                                    <code>{{ $errors->first('youtube_link') }}</code>
                                                @endif
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fa-brands fa-youtube"></i>
                                                    <input type="text" name="youtube_link"
                                                        placeholder="Nhập link youtube"
                                                        value="{{ $profile->youtube_link }}">
                                                </div>
                                            </div>


                                            <div class="col-xl-12 col-md-12">
                                                @if ($errors->has('instagram_link'))
                                                    <code>{{ $errors->first('instagram_link') }}</code>
                                                @endif
                                                <div class="wsus__dash_pro_single">
                                                    <i class="fa-brands fa-instagram"></i>
                                                    <input type="text" name="instagram_link"
                                                        placeholder="Nhập link instagram"
                                                        value="{{ $profile->instagram_link }}">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="common_btn">Cập nhật</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
