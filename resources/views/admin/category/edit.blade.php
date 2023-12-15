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
                            <h4>Sửa danh mục</h4>
                            <div class="card-header-action">
                                <a class="btn btn-primary" href="{{ route('admin.category.index') }}"><i
                                        class="fa-solid fa-arrow-left"></i> Quay lại</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.category.update', $category->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Ảnh</label>
                                    <div class="form-group d-flex justify-content-center align-items-center">
                                        <img src="{{ asset($category->image) }}" alt="img" class="w-25 border rounded"
                                            height="100px">
                                    </div>
                                    <input type="file" class="form-control" name="image">
                                    @if ($errors->has('image'))
                                        <code>{{ $errors->first('image') }}</code>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <label>Tên danh mục</label>
                                    <input type="text" class="form-control" name="name" value="{{ $category->name }}"
                                        placeholder="Nhập tên">
                                    @if ($errors->has('name'))
                                        <code>{{ $errors->first('name') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="inputStatus">Trạng thái</label>
                                    <select id="inputStatus" class="form-control" name="status">
                                        <option {{ $category->status == 1 ? 'selected' : '' }} value="1">Hiển thị
                                        </option>
                                        <option {{ $category->status == 0 ? 'selected' : '' }} value="0">Ẩn</option>
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
