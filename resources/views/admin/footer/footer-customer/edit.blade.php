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
                            <h4>Sửa chăm sóc khách hàng</h4>
                            <div class="card-header-action">
                                <a class="btn btn-primary" href="{{ route('admin.footer-customer.index') }}"><i
                                        class="fa-solid fa-arrow-left"></i> Quay lại</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.footer-customer.update', $footer_customer->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Tên</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $footer_customer->name }}" placeholder="Nhập tên">
                                    @if ($errors->has('name'))
                                        <code>{{ $errors->first('name') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>URL</label>
                                    <input type="text" class="form-control" name="url"
                                        value="{{ $footer_customer->url }}" placeholder="Nhập url">
                                    @if ($errors->has('url'))
                                        <code>{{ $errors->first('url') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="inputStatus">Trạng thái</label>
                                    <select id="inputStatus" class="form-control" name="status">
                                        <option {{ $footer_customer->status == 1 ? 'selected' : '' }} value="1">Hiển
                                            thị
                                        </option>
                                        <option {{ $footer_customer->status == 0 ? 'selected' : '' }} value="0">Ẩn
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
