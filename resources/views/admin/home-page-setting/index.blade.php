@extends('admin.layouts.master')

@section('title')
    Giao diện trang chủ
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Giao diện trang chủ</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <div class="list-group" id="list-tab" role="tablist">
                                        <a class="list-group-item list-group-item-action active"
                                            id="featured-category-settings" data-toggle="list"
                                            href="#featured-category-setting" role="tab">Danh mục nổi bật</a>
                                        <a class="list-group-item list-group-item-action" id="category-slider-one-settings"
                                            data-toggle="list" href="#category-slider-one-setting" role="tab">Danh mục
                                            slider 1</a>
                                        <a class="list-group-item list-group-item-action" id="category-slider-two-settings"
                                            data-toggle="list" href="#category-slider-two-setting" role="tab">Danh mục
                                            slider 2</a>
                                        <a class="list-group-item list-group-item-action"
                                            id="category-slider-three-settings" data-toggle="list"
                                            href="#category-slider-three-setting" role="tab">Danh mục
                                            slider 3</a>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="tab-content" id="nav-tabContent">
                                        @include('admin.home-page-setting.sections.featured-category')
                                        @include('admin.home-page-setting.sections.category-slider-one')
                                        @include('admin.home-page-setting.sections.category-slider-two')
                                        @include('admin.home-page-setting.sections.category-slider-three')
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
