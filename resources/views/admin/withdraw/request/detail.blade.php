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
                            <h4>Thông tin yêu cầu rút tiền</h4>
                            <div class="card-header-action">
                                <a class="btn btn-primary" href="{{ route('admin.withdraw-request.index') }}"><i
                                        class="fa-solid fa-arrow-left"></i> Quay lại</a>
                            </div>
                        </div>
                        <div class="card-body">
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
                                                <span>Chờ xử lý</span>
                                            @elseif ($withdraw_request->status == 'paid')
                                                <span>Đã thanh toán</span>
                                            @elseif ($withdraw_request->status == 'declines')
                                                <span>Từ chối</span>
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
    </section>

    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.withdraw-request.update', $withdraw_request->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="status">Trạng thái</label>
                                    <select name="status" id="status" class="form-control">
                                        <option @selected($withdraw_request->status == 'pending') value="pending">Chờ xử lý</option>
                                        <option @selected($withdraw_request->status == 'paid') value="paid">Đã thanh toán</option>
                                        <option @selected($withdraw_request->status == 'declines') value="declines">Từ chối</option>
                                    </select>
                                </div>

                                <button class="btn btn-primary" type="submit">Cập nhật</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
