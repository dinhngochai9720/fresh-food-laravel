@extends('admin.layouts.master')

@section('title')
    Giao dịch PayPal
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Giao dịch PayPal</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Danh sách giao dịch</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myDatatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Mã giao dịch</th>
                                            <th>Mã hóa đơn</th>
                                            <th>Tổng thanh toán</th>
                                            <th>Ngày giao dịch</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions_paypal as $key => $transaction)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $transaction->transaction_id }}</td>
                                                <td>{{ $transaction->order->invoice_id }}</td>
                                                <td>
                                                    @if ($transaction->currency_name == 'VND')
                                                        <span>{{ number_format($transaction->net_final_total_price, 0, '.', '.') }}{{ $settings->currency_icon }}</span>
                                                    @elseif ($transaction->currency_name == 'USD')
                                                        <span>{{ number_format($transaction->net_final_total_price, 2) }}$</span>
                                                    @endif
                                                </td>
                                                <td>{{ date('d-m-Y', strtotime($transaction->created_at)) }}</td>
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
