@extends('frontend.layouts.master')

@section('title')
    Không tìm thấy trang
@endsection

@section('content')
    {{-- 404 page --}}
    <section id="wsus__404">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-10 col-lg-8 col-xxl-5 m-auto">
                    <div class="wsus__404_text">
                        <h2>404</h2>
                        <h4><span>Xin lỗi !!</span> Không tìm thấy trang</h4>
                        <p>Trang bạn đang tìm kiếm có thể không còn tồn tại
                        </p>
                        <a href="{{ url('/') }}" class="common_btn">Quay lại trang chủ</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
