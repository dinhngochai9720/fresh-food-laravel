@extends('admin.layouts.master')

@section('title')
    Yêu cầu rút tiền
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Yêu cầu rút tiền</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Danh sách yêu cầu rút tiền</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myDatatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Nhà cung cấp</th>
                                            <th>Số tiền rút</th>
                                            <th>Số tiền chiết khấu</th>
                                            <th>Số tiền nhận được</th>
                                            <th>Phương thức</th>
                                            <th>Trạng thái</th>
                                            <th>Xem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($withdraw_requests as $key => $request)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    {{ $request->vendor->shop_name }}
                                                </td>
                                                <td>
                                                    {{ number_format($request->total_amount, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                </td>

                                                <td>
                                                    {{ number_format($request->charge_amount, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                </td>
                                                <td>
                                                    {{ number_format($request->withdraw_amount, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                </td>

                                                <td>{{ $request->method }}</td>

                                                <td>
                                                    @if ($request->status == 'pending')
                                                        <span>Chờ xử lý</span>
                                                    @elseif ($request->status == 'paid')
                                                        <span>Đã thanh toán</span>
                                                    @elseif ($request->status == 'declines')
                                                        <span>Từ chối</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.withdraw-request.detail', $request->id) }}"
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
