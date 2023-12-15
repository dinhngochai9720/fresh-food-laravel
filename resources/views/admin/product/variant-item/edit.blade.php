@extends('admin.layouts.master')

@section('title')
    Sản phẩm
@endsection

@section('content')
    <section class="section">
        <div class="section-header d-flex align-items-center justify-content-between">
            <h1>{{ $variant_item->variant->product->name }}</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Sửa chi tiết thuộc tính</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.product-variant-item.index', ['product_id' => $variant_item->variant->product_id, 'variant_id' => $variant_item->variant->id]) }}"
                                    class="btn btn-primary"> <i class="fa-solid fa-arrow-left"></i> Quay lại</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.product-variant-item.update', $variant_item->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Tên thuộc tính</label>
                                    <input type="text" class="form-control" value="{{ $variant_item->variant->name }}"
                                        disabled>
                                </div>

                                <div class="form-group">
                                    <label>Tên chi tiết thuộc tính</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $variant_item->name }}" placeholder="Nhập tên">
                                    @if ($errors->has('name'))
                                        <code>{{ $errors->first('name') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Giá </label>
                                    <input type="number" class="form-control" name="price"
                                        value="{{ $variant_item->price }}" placeholder="Nhập giá">
                                    @if ($errors->has('price'))
                                        <code>{{ $errors->first('price') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="inputStatus">Mặc định</label>
                                    <select id="inputStatus" class="form-control" name="is_default">
                                        <option value="">Chọn</option>
                                        <option {{ $variant_item->is_default == 1 ? 'selected' : '' }} value="1">Có
                                        </option>
                                        <option {{ $variant_item->is_default == 0 ? 'selected' : '' }} value="0">Không
                                        </option>
                                    </select>
                                    @if ($errors->has('is_default'))
                                        <code>{{ $errors->first('is_default') }}</code>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <label for="inputStatus">Trạng thái</label>
                                    <select id="inputStatus" class="form-control" name="status">
                                        <option {{ $variant_item->status == 1 ? 'selected' : '' }} value="1">Hiển
                                            thị</option>
                                        <option {{ $variant_item->status == 0 ? 'selected' : '' }} value="0">Ẩn
                                        </option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
