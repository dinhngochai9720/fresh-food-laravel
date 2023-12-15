@extends('admin.layouts.master')

@section('title')
    Thông tin nhà cung cấp đã phê duyệt
@endsection

@section('content')
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1> Thông tin nhà cung cấp đã phê duyệt</h1>
            <a href="{{ route('admin.vendor-approved.index') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i>
                Quay
                lại</a>
        </div>

        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        <td>Ảnh</td>
                                        <td><img src="{{ asset($vendor->banner) }}" alt="image" class="img-fluid border"
                                                style="height: 150px;"></td>
                                    </tr>
                                    <tr>
                                        <td>Tài khoản</td>
                                        <td>{{ $vendor->user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tên nhà cung cấp</td>
                                        <td>{{ $vendor->shop_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Điện thoại</td>
                                        <td>{{ $vendor->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Địa chỉ</td>
                                        <td>{{ $vendor->address }}</td>
                                    </tr>
                                    <tr>
                                        <td>Mô tả </td>
                                        <td>{!! $vendor->description !!}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="row">
                                <div class="col-lg-2">
                                    <form action="{{ route('admin.vendor-approved.change-status', $vendor->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="status">Trạng thái</label>
                                            <select class="form-control" data-id="" name="status" id="status">
                                                <option {{ $vendor->status == 0 ? 'selected' : '' }} value="0">Chờ
                                                    xử lý</option>
                                                <option {{ $vendor->status == 1 ? 'selected' : '' }} value="1">Phê
                                                    duyệt</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary">Lưu</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
