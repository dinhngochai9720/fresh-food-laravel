@extends('vendor.layouts.master')

@section('title')
    Yêu cầu rút tiền
@endsection

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">

            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">

                        <h3> Yêu cầu rút tiền</h3>

                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div>
                                <h6>Số dư hiện tại:
                                    {{ number_format($current_balance, 0, '.', '.') }}{{ $settings->currency_icon }} </h6>
                                <h6>Số tiền rút chờ xử lý:
                                    {{ number_format($withdraw_pending_total_amount, 0, '.', '.') }}{{ $settings->currency_icon }}
                                </h6>
                                <h6>Số tiền đã rút:
                                    {{ number_format($withdraw_paid_total_amount, 0, '.', '.') }}{{ $settings->currency_icon }}
                                </h6>
                            </div>
                            <a href="{{ route('vendor.withdraw.create') }}" class="btn btn-primary"><i
                                    class="fa-solid fa-plus"></i> Tạo yêu cầu</a>
                        </div>




                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <div class="table-responsive">
                                    <table id="myDatatable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
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
                                                            <span class="rounded-pill badge bg-warning">Chờ xử lý</span>
                                                        @elseif ($request->status == 'paid')
                                                            <span class="rounded-pill badge bg-success">Đã thanh toán</span>
                                                        @elseif ($request->status == 'declines')
                                                            <span class="rounded-pill badge bg-danger">Từ chối</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('vendor.withdraw.detail', $request->id) }}"
                                                            class='btn btn-primary mr-2'><i
                                                                class="fa-regular fa-eye"></i></a>
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
        </div>
        </div>
    </section>
@endsection
