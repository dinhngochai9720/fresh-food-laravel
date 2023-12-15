@extends('frontend.layouts.master')

@section('title')
    Nhà cung cấp
@endsection


@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Nhà cung cấp</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Trang chủ</a></li>
                            <li><a href="javascript:;">Danh sách nhà cung cấp</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__product_page" class="wsus__vendors">
        <div class="container">
            <div class="row">

                <div class="col-xl-12 col-lg-12">
                    <div class="row">
                        @foreach ($vendors as $key => $vendor)
                            <div class="col-xl-6 col-md-6">
                                <div class="wsus__vendor_single">
                                    <img src="{{ asset($vendor->banner) }}" alt="vendor" class="img-fluid w-100">
                                    <div class="wsus__vendor_text">
                                        <div class="wsus__vendor_text_center">
                                            <h4>{{ $vendor->shop_name }}</h4>

                                            <a href="callto:{{ $vendor->phone }}"><i class="far fa-phone-alt"></i>
                                                {{ $vendor->phone }}</a>
                                            <a href="mailto:{{ $vendor->email }}"><i class="fal fa-envelope"></i>
                                                {{ $vendor->email }}</a>
                                            <a href="{{ route('vendor.products', $vendor->id) }}" class="common_btn">Xem</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-xl-12">
                    {{-- use Bootstrap to pagination in AppService Provider --}}
                    <div class="mt-5 d-flex justify-content-center align-items-center">
                        @if ($vendors->hasPages())
                            {{ $vendors->withQueryString()->links() }}
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
