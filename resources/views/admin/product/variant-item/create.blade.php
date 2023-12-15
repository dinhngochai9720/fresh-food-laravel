@extends('admin.layouts.master')

@section('title')
    Sản phẩm
@endsection

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>{{ $variant->product->name }}</h1>
            {{-- <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Trang chủ</a></div>
              <div class="breadcrumb-item"><a href="#">Quản lý website</a></div>
              <div class="breadcrumb-item">Slider</div>
            </div> --}}
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thêm chi tiết thuộc tính</h4>
                            <div class="card-header-action">
                                <a class="btn btn-primary"
                                    href="{{ route('admin.product-variant-item.index', ['product_id' => $variant->product_id, 'variant_id' => $variant->id]) }}"><i
                                        class="fa-solid fa-arrow-left"></i> Quay lại</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.product-variant-item.store') }}" method="POST">
                                @csrf

                                <input type="hidden" name="variant_id" value="{{ $variant->id }}">

                                <div class="form-group">
                                    <label>Tên thuộc tính</label>
                                    <input type="text" class="form-control" value="{{ $variant->name }}" disabled>
                                </div>

                                <div class="form-group">
                                    <label>Tên chi tiết thuộc tính</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                        placeholder="Nhập tên">
                                    @if ($errors->has('name'))
                                        <code>{{ $errors->first('name') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Giá </label>
                                    <input type="number" class="form-control" name="price" value="{{ old('price') }}"
                                        placeholder="Nhập giá">
                                    @if ($errors->has('price'))
                                        <code>{{ $errors->first('price') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="inputStatus">Mặc định</label>
                                    <select id="inputStatus" class="form-control" name="is_default">
                                        <option value="">Chọn</option>
                                        <option value="1">Có</option>
                                        <option value="0">Không</option>
                                    </select>
                                    @if ($errors->has('is_default'))
                                        <code>{{ $errors->first('is_default') }}</code>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <label for="inputStatus">Trạng thái</label>
                                    <select id="inputStatus" class="form-control" name="status">
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
