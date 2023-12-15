@extends('frontend.layouts.master')

@section('title')
    {{-- settings is global variable in AppServiceProvider --}}
    {{ $settings->site_name }}
@endsection

@section('content')
    {{-- quick view --}}
    @foreach ($products as $product)
        @php
            $variants = $product->variants;
            $variant_items = [];

            foreach ($variants as $variant) {
                $variant_items = array_merge($variant_items, $variant->variantItems->toArray());
            }
            //  dd($variant_items);

            // find min and max (min > 0)
            $minPrice = PHP_INT_MAX;
            $maxPrice = 0;

            foreach ($variant_items as $item) {
                $price = $item['price'];

                if ($price > 0) {
                    if ($price < $minPrice) {
                        $minPrice = $price;
                    }

                    if ($price > $maxPrice) {
                        $maxPrice = $price;
                    }
                }
            }
        @endphp

        @include('frontend.home.sections.quick-view-product')
    @endforeach


    {{-- banner-slider --}}
    @include('frontend.home.sections.banner-slider')


    {{-- flash-sale --}}
    @include('frontend.home.sections.flash-sale')


    {{-- featured-category-product --}}
    @include('frontend.home.sections.featured-category-product')


    {{-- brand-slider --}}
    @include('frontend.home.sections.brand-slider')


    {{-- single-branner --}}
    @include('frontend.home.sections.single-banner')


    {{-- type-product --}}
    @include('frontend.home.sections.type-product')


    {{-- category-slider-one-product --}}
    @include('frontend.home.sections.category-slider-one-product')


    {{-- category-slider-two-product --}}
    @include('frontend.home.sections.category-slider-two-product')


    {{-- large-banner --}}
    @include('frontend.home.sections.large-banner')


    {{-- category-slider-three-product --}}
    @include('frontend.home.sections.category-slider-three-product')


    {{-- services --}}
    {{-- @include('frontend.home.sections.services') --}}


    {{-- blog --}}
    {{-- @include('frontend.home.sections.blog') --}}
@endsection
