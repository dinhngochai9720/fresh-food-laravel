@extends('admin.layouts.master')

@section('title')
    Quản lý tài khoản
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1> Quản lý tài khoản</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thêm tài khoản quản trị viên</h4>
                            <div class="card-header-action">
                                <a class="btn btn-primary" href="{{ route('admin.account-admin.index') }}"><i
                                        class="fa-solid fa-arrow-left"></i> Quay lại</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.account-admin.store') }}" method="POST">
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
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                        placeholder="Nhập email">
                                    @if ($errors->has('email'))
                                        <code>{{ $errors->first('email') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Mật khẩu</label>
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Nhập mật khẩu">
                                    @if ($errors->has('password'))
                                        <code>{{ $errors->first('password') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Xác nhận mật khẩu</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        placeholder="Nhập mật khẩu">
                                    @if ($errors->has('password_confirmation'))
                                        <code>{{ $errors->first('password_confirmation') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="role">Loại tài khoản</label>
                                    <select id="role" class="form-control" name="role">
                                        <option value="admin">Quản trị viên</option>
                                    </select>
                                    @if ($errors->has('role'))
                                        <code>{{ $errors->first('role') }}</code>
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
