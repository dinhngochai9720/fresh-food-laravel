@extends('admin.layouts.master')

@section('title')
    Chăm sóc khách hàng
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1> Chăm sóc khách hàng</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thêm chăm sóc khách hàng</h4>
                            <div class="card-header-action">
                                <a class="btn btn-primary" href="{{ route('admin.footer-customer.index') }}"><i
                                        class="fa-solid fa-arrow-left"></i> Quay lại</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.footer-customer.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Tên</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                        placeholder="Nhập tên">
                                    @if ($errors->has('name'))
                                        <code>{{ $errors->first('name') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>URL</label>
                                    <input type="text" class="form-control" name="url" value="{{ old('url') }}"
                                        placeholder="Nhập url">
                                    @if ($errors->has('url'))
                                        <code>{{ $errors->first('url') }}</code>
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
