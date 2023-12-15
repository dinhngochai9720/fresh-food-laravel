@extends('admin.layouts.master')

@section('title')
    Quản lý nhà cung cấp
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Nhà cung cấp chờ xử lý</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Danh sách nhà cung cấp chờ xử lý</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myDatatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tài khoản</th>
                                            <th>Tên nhà cung cấp</th>
                                            <th>Điện thoại</th>
                                            <th>Địa chỉ</th>
                                            <th>Xem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pending_vendors as $key => $vendor)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $vendor->user->email }}</td>
                                                <td>{{ $vendor->shop_name }}</td>
                                                <td>{{ $vendor->phone }}</td>
                                                <td>{{ $vendor->address }}</td>
                                                <td>
                                                    <a href="{{ route('admin.vendor-pending.detail', $vendor->id) }}"
                                                        class='btn btn-primary mr-2'><i class="fa-regular fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
