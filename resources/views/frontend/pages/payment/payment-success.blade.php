@extends('frontend.layouts.master')

@section('title')
    Phương thức thanh toán
@endsection


@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Phương thức thanh toán</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Trang chủ</a></li>
                            <li><a href="javascript:;">Phương thức thanh toán</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- payment-success --}}
    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__cart_list cart_empty p-3 p-sm-5 text-center">
                        <p class="mb-4 text-success">Thanh toán thành công!</p>
                        <a href="{{ url('/') }}" class="common_btn"><i class="fal fa-store me-2"
                                aria-hidden="true"></i>Tiếp tục mua hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
