@extends('admin.layouts.master')

@section('title')
    Thương hiệu
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1> Thương hiệu</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thêm thương hiệu</h4>
                            <div class="card-header-action">
                                <a class="btn btn-primary" href="{{ route('admin.brand.index') }}"><i
                                        class="fa-solid fa-arrow-left"></i> Quay lại</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.brand.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Logo</label>
                                    <input type="file" class="form-control" name="logo">
                                    @if ($errors->has('logo'))
                                        <code>{{ $errors->first('logo') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Tên thương hiệu</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                        placeholder="Nhập tên">
                                    @if ($errors->has('name'))
                                        <code>{{ $errors->first('name') }}</code>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <label for="inputStatus">Nổi bật</label>
                                    <select id="inputStatus" class="form-control" name="is_featured">
                                        <option value="">Chọn</option>
                                        <option value="1">Có</option>
                                        <option value="0">Không</option>
                                    </select>
                                    @if ($errors->has('is_featured'))
                                        <code>{{ $errors->first('is_featured') }}</code>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <label for="inputStatus">Trạng thái</label>
                                    <select id="inputStatus" class="form-control" name="status">
                                        <option value="">Chọn</option>
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <code>{{ $errors->first('status') }}</code>
                                    @endif
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
