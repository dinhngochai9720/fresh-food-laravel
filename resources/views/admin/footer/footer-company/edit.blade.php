@extends('admin.layouts.master')

@section('title')
    Về Fresh Food
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1> Về Fresh Food</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Sửa về Fresh Food</h4>
                            <div class="card-header-action">
                                <a class="btn btn-primary" href="{{ route('admin.footer-company.index') }}"><i
                                        class="fa-solid fa-arrow-left"></i> Quay lại</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.footer-company.update', $footer_company->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Tên</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $footer_company->name }}" placeholder="Nhập tên">
                                    @if ($errors->has('name'))
                                        <code>{{ $errors->first('name') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>URL</label>
                                    <input type="text" class="form-control" name="url"
                                        value="{{ $footer_company->url }}" placeholder="Nhập url">
                                    @if ($errors->has('url'))
                                        <code>{{ $errors->first('url') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="inputStatus">Trạng thái</label>
                                    <select id="inputStatus" class="form-control" name="status">
                                        <option {{ $footer_company->status == 1 ? 'selected' : '' }} value="1">Hiển
                                            thị
                                        </option>
                                        <option {{ $footer_company->status == 0 ? 'selected' : '' }} value="0">Ẩn
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
