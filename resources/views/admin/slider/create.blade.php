@extends('admin.layouts.master')

@section('title')
    Slider
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Slider</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thêm slider</h4>
                            <div class="card-header-action">
                                <a class="btn btn-primary" href="{{ route('admin.slider.index') }}"><i
                                        class="fa-solid fa-arrow-left"></i> Quay lại</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Ảnh</label>
                                    <input type="file" class="form-control" name="banner">
                                    @if ($errors->has('banner'))
                                        <code>{{ $errors->first('banner') }}</code>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Loại</label>
                                    <input type="text" class="form-control" name="type" value="{{ old('type') }}"
                                        placeholder="Nhập loại">
                                    @if ($errors->has('type'))
                                        <code>{{ $errors->first('type') }}</code>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Tiêu đề</label>
                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}"
                                        placeholder="Nhập tiêu đề">
                                    @if ($errors->has('title'))
                                        <code>{{ $errors->first('title') }}</code>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Giá khởi điểm</label>
                                    <input type="number" class="form-control" name="starting_price"
                                        value="{{ old('starting_price') }}" placeholder="Nhập giá khởi điểm">
                                    @if ($errors->has('starting_price'))
                                        <code>{{ $errors->first('starting_price') }}</code>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>URL</label>
                                    <input type="text" class="form-control" name="btn_url" value="{{ old('btn_url') }}"
                                        placeholder="Nhập URL">
                                    @if ($errors->has('btn_url'))
                                        <code>{{ $errors->first('btn_url') }}</code>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Vị trí hiển thị</label>
                                    <input type="number" class="form-control" name="serial" value="{{ old('serial') }}"
                                        placeholder="Nhập vị trí hiển thị">
                                    @if ($errors->has('serial'))
                                        <code>{{ $errors->first('serial') }}</code>
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
