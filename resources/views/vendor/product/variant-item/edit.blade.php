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

                        <h3>{{ $variant_item->variant->product->name }}</h3>

                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6>Sửa chi tiết thuộc tính</h6>
                            <a href="{{ route('vendor.product-variant-item.index', ['product_id' => $variant_item->variant->product_id, 'variant_id' => $variant_item->variant->id]) }}"
                                class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Quay lại</a>
                        </div>

                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <form action="{{ route('vendor.product-variant-item.update', $variant_item->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label>Tên thuộc tính</label>
                                        <input type="text" class="form-control"
                                            value="{{ $variant_item->variant->name }}" disabled>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label>Tên chi tiết thuộc tính</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $variant_item->name }}" placeholder="Nhập tên">
                                        @if ($errors->has('name'))
                                            <code>{{ $errors->first('name') }}</code>
                                        @endif
                                    </div>

                                    <div class="form-group mb-4">
                                        <label>Giá </label>
                                        <input type="number" class="form-control" name="price"
                                            value="{{ $variant_item->price }}" placeholder="Nhập giá">
                                        @if ($errors->has('price'))
                                            <code>{{ $errors->first('price') }}</code>
                                        @endif
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="inputStatus">Mặc định</label>
                                        <select id="inputStatus" class="form-control" name="is_default">
                                            <option value="">Chọn</option>
                                            <option {{ $variant_item->is_default == 1 ? 'selected' : '' }} value="1">
                                                Có</option>
                                            <option {{ $variant_item->is_default == 0 ? 'selected' : '' }} value="0">
                                                Không</option>
                                        </select>
                                        @if ($errors->has('is_default'))
                                            <code>{{ $errors->first('is_default') }}</code>
                                        @endif
                                    </div>


                                    <div class="form-group mb-4">
                                        <label for="inputStatus">Trạng thái</label>
                                        <select id="inputStatus" class="form-control" name="status">
                                            <option {{ $variant_item->status == 1 ? 'selected' : '' }} value="1">Hiển
                                                thị</option>
                                            <option {{ $variant_item->status == 0 ? 'selected' : '' }} value="0">Ẩn
                                            </option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary mb-4">Cập nhật</button>
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
