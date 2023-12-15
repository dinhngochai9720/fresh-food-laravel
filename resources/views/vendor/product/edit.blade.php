@extends('vendor.layouts.master')

@section('title')
    Sản phẩm
@endsection

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">

            {{-- sidebar --}}
            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">

                        <h3>{{ $product->name }}</h3>

                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6>Sửa sản phẩm</h6>
                            <a href="{{ route('vendor.product.index') }}" class="btn btn-primary"><i
                                    class="fa-solid fa-arrow-left"></i> Quay lại</a>
                        </div>


                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <form action="{{ route('vendor.product.update', $product->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label>Ảnh chính</label>
                                        <div class="form-group d-flex justify-content-center align-items-center mb-2">
                                            <img src="{{ asset($product->thumbnail_image) }}" alt="thumbnail_img"
                                                class="w-25 border rounded" height="100px">
                                        </div>
                                        <input type="file" class="form-control" name="thumbnail_image">
                                        @if ($errors->has('thumbnail_image'))
                                            <code>{{ $errors->first('thumbnail_image') }}</code>
                                        @endif
                                    </div>

                                    <div class="form-group mt-4">
                                        <label>Tên sản phẩm</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $product->name }}" placeholder="Nhập tên">
                                        @if ($errors->has('name'))
                                            <code>{{ $errors->first('name') }}</code>
                                        @endif
                                    </div>

                                    <div class="row  mt-4">
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="inputStatus">Danh mục</label>
                                                <select id="inputStatus" class="form-control main-category"
                                                    name="category_id">
                                                    <option value="{{ old('category_id') }}">Chọn danh mục</option>
                                                    @foreach ($categories as $category)
                                                        <option
                                                            {{ $category->id == $product->category_id ? 'selected' : '' }}
                                                            value="{{ $category->id }}">{{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('category_id'))
                                                    <code>{{ $errors->first('category_id') }}</code>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="inputStatus">Danh mục con</label>
                                                <select id="inputStatus" class="form-control sub-category"
                                                    name="sub_category_id">
                                                    <option value="">Chọn danh mục con</option>
                                                    @foreach ($sub_categories as $sub_category)
                                                        <option
                                                            {{ $sub_category->id == $product->sub_category_id ? 'selected' : '' }}
                                                            value="{{ $sub_category->id }}">
                                                            {{ $sub_category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="inputStatus">Danh mục con cấp 2</label>
                                                <select id="inputStatus" class="form-control child-category"
                                                    name="child_category_id">
                                                    <option value="">Chọn danh mục con cấp 2</option>
                                                    @foreach ($child_categories as $child_category)
                                                        <option
                                                            {{ $child_category->id == $product->child_category_id ? 'selected' : '' }}
                                                            value="{{ $child_category->id }}">
                                                            {{ $child_category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group  mt-4">
                                        <label for="inputStatus">Thương hiệu</label>
                                        <select id="inputStatus" class="form-control" name="brand_id">
                                            <option value="{{ old('brand_id') }}">Chọn thương hiệu</option>
                                            @foreach ($brands as $brand)
                                                <option {{ $brand->id == $product->brand_id ? 'selected' : '' }}
                                                    value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('brand_id'))
                                            <code>{{ $errors->first('brand_id') }}</code>
                                        @endif
                                    </div>

                                    <div class="form-group  mt-4">
                                        <label>SKU</label>
                                        <input type="text" class="form-control" name="sku"
                                            value="{{ $product->sku }}" placeholder="Nhập SKU">
                                    </div>

                                    <div class="form-group  mt-4">
                                        <label>Giá ({{ $settings->currency_icon }}) <code>nhập giá = 0 nếu có nhiều
                                                loại sản phẩm</code> </label>
                                        <input type="number" class="form-control" name="price"
                                            value="{{ $product->price }}" placeholder="Nhập giá">
                                        @if ($errors->has('price'))
                                            <code>{{ $errors->first('price') }}</code>
                                        @endif
                                    </div>

                                    <div class="row  mt-4">
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <label>Giá ưu đãi</label>
                                                <input type="number" class="form-control" name="offer_price"
                                                    value="{{ $product->offer_price }}" placeholder="Nhập giá ưu đãi">
                                                @if ($errors->has('offer_price'))
                                                    <code>{{ $errors->first('offer_price') }}</code>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-3">
                                            <div class="form-group">
                                                <label>Ngày bắt đầu</label>
                                                <input type="text" class="form-control datepicker"
                                                    name="offer_start_date" value="{{ $product->offer_start_date }}">
                                                @if ($errors->has('offer_start_date'))
                                                    <code>{{ $errors->first('offer_start_date') }}</code>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-3">
                                            <div class="form-group">
                                                <label>Ngày kết thúc</label>
                                                <input type="text" class="form-control datepicker" name="offer_end_date"
                                                    value="{{ $product->offer_end_date }}">
                                                @if ($errors->has('offer_end_date'))
                                                    <code>{{ $errors->first('offer_end_date') }}</code>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group  mt-4">
                                        <label>Số lượng</label>
                                        <input type="number" class="form-control" name="quantity"
                                            value="{{ $product->quantity }}" placeholder="Nhập số lượng">
                                        @if ($errors->has('quantity'))
                                            <code>{{ $errors->first('quantity') }}</code>
                                        @endif
                                    </div>

                                    <div class="form-group  mt-4">
                                        <label>Link Video</label>
                                        <input type="text" class="form-control" name="video_link"
                                            value="{{ $product->video_link }}" placeholder="Nhập link video">
                                    </div>

                                    <div class="form-group  mt-4">
                                        <label>Mô tả ngắn</label>
                                        <textarea class="form-control" name="short_description" placeholder="Nhập mô tả ngắn ngắn">{!! $product->short_description !!}</textarea>
                                        @if ($errors->has('short_description'))
                                            <code>{{ $errors->first('short_description') }}</code>
                                        @endif
                                    </div>

                                    <div class="form-group  mt-4">
                                        <label>Mô tả chi tiết</label>
                                        {{-- <textarea class="summernote" name="long_description">{{old('long_description')}}</textarea> --}}
                                        <textarea style="width: 100%;" rows="6" id="mytextarea" name="long_description"
                                            placeholder="Nhập mô tả chi tiết">{!! $product->long_description !!}</textarea>
                                        @if ($errors->has('long_description'))
                                            <code>{{ $errors->first('long_description') }}</code>
                                        @endif
                                    </div>


                                    <div class="form-group  mt-4">
                                        <label>Tiêu đề SEO</label>
                                        <input type="text" class="form-control" name="seo_title"
                                            value="{{ $product->seo_title }}" placeholder="Nhập tiêu đề">
                                        @if ($errors->has('seo_title'))
                                            <code>{{ $errors->first('seo_title') }}</code>
                                        @endif
                                    </div>

                                    <div class="form-group  mt-4">
                                        <label>Mô tả SEO</label>
                                        <textarea class="form-control" name="seo_description" placeholder="Nhập mô tả SEO">{!! $product->seo_description !!}</textarea>
                                        @if ($errors->has('seo_description'))
                                            <code>{{ $errors->first('seo_description') }}</code>
                                        @endif
                                    </div>

                                    <div class="form-group  mt-4">
                                        <label for="inputStatus">Trạng thái</label>
                                        <select id="inputStatus" class="form-control" name="status">
                                            <option {{ $product->status == 1 ? 'selected' : '' }} value="1">Hiển
                                                thị
                                            </option>
                                            <option {{ $product->status == 0 ? 'selected' : '' }} value="0">Ẩn
                                            </option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary  mt-4">Cập nhật</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // get sub categories of category
            $('body').on('change', '.main-category', function(e) {
                // get id of category
                let id = $(this).val();
                // console.log(id);

                $.ajax({
                    url: '{{ route('vendor.product.get-sub-categories') }}',
                    method: 'GET',
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        // console.log(data);

                        // refesh sub categories after choose category again
                        $('.sub-category').html(`<option value="">Chọn danh mục con</option>`)

                        // refesh child categories after choose category again
                        $('.child-category').html(
                            `<option value="">Chọn danh mục con cấp 2</option>`)

                        $.each(data, function(i, item) {
                            // console.log(item.name);

                            // show subcategory after choose category
                            $('.sub-category').append(
                                `<option value="${item.id}">${item.name}</option>`)
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            })

            // get child categories of sub category
            $('body').on('change', '.sub-category', function(e) {
                // get id of sub category
                let id = $(this).val();
                // console.log(id);

                $.ajax({
                    url: '{{ route('vendor.product.get-child-categories') }}',
                    method: 'GET',
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        // console.log(data);

                        // refesh child categories after choose sub category again
                        $('.child-category').html(
                            `<option value="">Chọn danh mục con cấp 2</option>`)

                        $.each(data, function(i, item) {
                            // console.log(item.name);

                            // show child category after choose sub category
                            $('.child-category').append(
                                `<option value="${item.id}">${item.name}</option>`)
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            })
        });
    </script>
@endpush
