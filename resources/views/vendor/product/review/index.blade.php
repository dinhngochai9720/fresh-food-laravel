@extends('vendor.layouts.master')

@section('title')
    Đánh giá của khách hàng
@endsection

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">

            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">

                        <h3>Đánh giá của khách hàng</h3>

                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6>Danh sách đánh giá của khách hàng</h6>
                        </div>


                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <div class="table-responsive">
                                    <table id="myDatatable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Email</th>
                                                <th>Tên</th>
                                                <th>Sản phẩm</th>
                                                <th>Đánh giá</th>
                                                <th>Bình luận</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reviews as $key => $review)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $review->user->email }}</td>
                                                    <td>{{ $review->user->name }}</td>
                                                    <td>
                                                        <a
                                                            href="{{ route('product-detail', ['slug' => $review->product->slug, 'id' => $review->product->id]) }}">{{ $review->product->name }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        @if ($review->rating == 1)
                                                            <i class="fas fa-star" style="color: orange"></i>
                                                        @elseif ($review->rating == 2)
                                                            <i class="fas fa-star" style="color: orange"></i>
                                                            <i class="fas fa-star" style="color: orange"></i>
                                                        @elseif ($review->rating == 3)
                                                            <i class="fas fa-star" style="color: orange"></i>
                                                            <i class="fas fa-star" style="color: orange"></i>
                                                            <i class="fas fa-star" style="color: orange"></i>
                                                        @elseif ($review->rating == 4)
                                                            <i class="fas fa-star" style="color: orange"></i>
                                                            <i class="fas fa-star" style="color: orange"></i>
                                                            <i class="fas fa-star" style="color: orange"></i>
                                                            <i class="fas fa-star" style="color: orange"></i>
                                                        @elseif ($review->rating == 5)
                                                            <i class="fas fa-star" style="color: orange"></i>
                                                            <i class="fas fa-star" style="color: orange"></i>
                                                            <i class="fas fa-star" style="color: orange"></i>
                                                            <i class="fas fa-star" style="color: orange"></i>
                                                            <i class="fas fa-star" style="color: orange"></i>
                                                        @endif
                                                    </td>
                                                    <td>{{ $review->review }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
