@extends('admin.layouts.master')

@section('title')
    Thông tin
@endsection

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Thông tin</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.footer-info.update', 1) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Logo</label>
                                    <div class="form-group d-flex justify-content-center align-items-center">
                                        <img src="{{ asset($footer_info->logo) }}" alt="img_logo"
                                            class="w-25 border rounded" height="100px">
                                    </div>
                                    <input type="file" class="form-control" name="logo">
                                    @if ($errors->has('logo'))
                                        <code>{{ $errors->first('logo') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email"
                                        value="{{ $footer_info->email }}" placeholder="Nhập email">
                                    @if ($errors->has('email'))
                                        <code>{{ $errors->first('email') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Điện thoại</label>
                                    <input type="text" class="form-control" name="phone"
                                        value="{{ $footer_info->phone }}" placeholder="Nhập điện thoại">
                                    @if ($errors->has('phone'))
                                        <code>{{ $errors->first('phone') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input type="text" class="form-control" name="address"
                                        value="{{ $footer_info->address }}" placeholder="Nhập địa chỉ">
                                    @if ($errors->has('address'))
                                        <code>{{ $errors->first('address') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Copyright</label>
                                    <input type="text" class="form-control" name="copyright"
                                        value="{{ $footer_info->copyright }}" placeholder="Nhập copyright">
                                    @if ($errors->has('copyright'))
                                        <code>{{ $errors->first('copyright') }}</code>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
