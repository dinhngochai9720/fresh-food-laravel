@extends('admin.layouts.master')

@section('title')
    Danh mục con
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Danh mục con</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Sửa danh mục con</h4>
                            <div class="card-header-action">
                                <a class="btn btn-primary" href="{{ route('admin.sub-category.index') }}"><i
                                        class="fa-solid fa-arrow-left"></i> Quay lại</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.sub-category.update', $sub_category->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="inputStatus">Danh mục</label>
                                    <select id="inputStatus" class="form-control" name="category_id">
                                        <option value="">Chọn danh mục</option>
                                        @foreach ($categories as $category)
                                            <option {{ $category->id == $sub_category->category_id ? 'selected' : '' }}
                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <code>{{ $errors->first('category_id') }}</code>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <label>Tên danh mục con</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $sub_category->name }}" placeholder="Nhập tên">
                                    @if ($errors->has('name'))
                                        <code>{{ $errors->first('name') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="inputStatus">Trạng thái</label>
                                    <select id="inputStatus" class="form-control" name="status">
                                        <option {{ $sub_category->status == 1 ? 'selected' : '' }} value="1">Hiển thị
                                        </option>
                                        <option {{ $sub_category->status == 0 ? 'selected' : '' }} value="0">Ẩn
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
