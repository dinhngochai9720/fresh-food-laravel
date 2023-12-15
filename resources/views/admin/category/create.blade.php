@extends('admin.layouts.master')

@section('title')
    Danh mục
@endsection

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Danh mục</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thêm danh mục</h4>
                            <div class="card-header-action">
                                <a class="btn btn-primary" href="{{ route('admin.category.index') }}"><i
                                        class="fa-solid fa-arrow-left"></i> Quay lại</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Ảnh</label>
                                    <input type="file" class="form-control" name="image">
                                    @if ($errors->has('image'))
                                        <code>{{ $errors->first('image') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Tên danh mục</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                        placeholder="Nhập tên">
                                    @if ($errors->has('name'))
                                        <code>{{ $errors->first('name') }}</code>
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
