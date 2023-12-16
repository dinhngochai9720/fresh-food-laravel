@extends('vendor.layouts.master')

@section('title')
    Yêu cầu rút tiền
@endsection

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">

            {{-- sidebar --}}
            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">

                        <h3> Yêu cầu rút tiền</h3>

                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6>Thông tin yêu cầu rút tiền</h6>
                            <a href="{{ route('vendor.withdraw.index') }}" class="btn btn-primary"><i
                                    class="fa-solid fa-arrow-left"></i> Quay lại</a>
                        </div>

                        <div class="wsus__dashboard_profile">
                            <div class="row">
                                <div class="wsus__dash_pro_area">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>Số tiền rút</td>
                                                <td> {{ number_format($withdraw_request->total_amount, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Chiết khấu</td>
                                                <td>
                                                    {{ ($withdraw_request->charge_amount / $withdraw_request->total_amount) * 100 }}%
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Số tiền chiết khấu</td>
                                                <td> {{ number_format($withdraw_request->charge_amount, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                </td>
                                            </tr>


                                            <tr>
                                                <td>Số tiền nhận được</td>
                                                <td> {{ number_format($withdraw_request->withdraw_amount, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                </td>
                                            </tr>


                                            <tr>
                                                <td>Phương thức</td>
                                                <td> {{ $withdraw_request->method }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Trạng thái</td>
                                                <td>
                                                    @if ($withdraw_request->status == 'pending')
                                                        <span class="rounded-pill badge bg-warning">Chờ xử lý</span>
                                                    @elseif ($withdraw_request->status == 'paid')
                                                        <span class="rounded-pill badge bg-success">Đã thanh toán</span>
                                                    @elseif ($withdraw_request->status == 'declines')
                                                        <span class="rounded-pill badge bg-danger">Từ chối</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Thông tin tài khoản</td>
                                                <td>{!! $withdraw_request->account_info !!}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
