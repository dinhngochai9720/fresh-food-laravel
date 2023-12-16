@extends('admin.layouts.master')

@section('title')
    Phương thức rút tiền
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Phương thức rút tiền</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Danh sách phương thức rút tiền</h4>

                            <div class="card-header-action">
                                <a href="{{ route('admin.withdraw-method.create') }}" class="btn btn-primary"><i
                                        class="fa-solid fa-plus"></i> Thêm mới</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myDatatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên phương thức</th>
                                            <th>Số tiền tối thiểu</th>
                                            <th>Số tiền tối đa</th>
                                            <th>Chiết khấu (%)</th>
                                            <th>Sửa/Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($withdraw_methods as $key => $method)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $method->name }}</td>
                                                <td> {{ number_format($method->minimum_amount, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                </td>
                                                <td> {{ number_format($method->maximum_amount, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                </td>
                                                <td>{{ $method->withdraw_charge }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('admin.withdraw-method.edit', $method->id) }}"
                                                            class='btn btn-primary'><i
                                                                class='fa-regular fa-pen-to-square'></i></a>
                                                        <a href="{{ route('admin.withdraw-method.destroy', $method->id) }}"
                                                            class='btn btn-danger ml-2' id='delete-item'><i
                                                                class='fa-regular fa-trash-can'></i></a>
                                                    </div>
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
