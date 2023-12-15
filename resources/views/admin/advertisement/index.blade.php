@extends('admin.layouts.master')

@section('title')
    Banner
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Banner</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <div class="list-group" id="list-tab" role="tablist">
                                        <a class="list-group-item list-group-item-action active" id="home-page-banner-ones"
                                            data-toggle="list" href="#home-page-banner-one" role="tab">Trang chủ - 1</a>
                                        <a class="list-group-item list-group-item-action" id="home-page-banner-twos"
                                            data-toggle="list" href="#home-page-banner-two" role="tab">Trang chủ - 2
                                        </a>
                                        <a class="list-group-item list-group-item-action" id="home-page-banner-threes"
                                            data-toggle="list" href="#home-page-banner-three" role="tab">Trang chủ -
                                            3</a>
                                        <a class="list-group-item list-group-item-action" id="home-page-banner-fours"
                                            data-toggle="list" href="#home-page-banner-four" role="tab">Trang chủ -
                                            4</a>
                                        <a class="list-group-item list-group-item-action" id="product-page-banners"
                                            data-toggle="list" href="#product-page-banner" role="tab">Trang sản phẩm
                                        </a>
                                        <a class="list-group-item list-group-item-action" id="cart-page-banners"
                                            data-toggle="list" href="#cart-page-banner" role="tab">Trang giỏ hàng
                                        </a>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="tab-content" id="nav-tabContent">
                                        @include('admin.advertisement.home-page.banner-four')
                                        @include('admin.advertisement.home-page.banner-three')
                                        @include('admin.advertisement.home-page.banner-two')
                                        @include('admin.advertisement.home-page.banner-one')
                                        @include('admin.advertisement.product-page.index')
                                        @include('admin.advertisement.cart-page.index')
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
