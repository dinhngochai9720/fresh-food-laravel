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
                            <h6>Tạo yêu cầu rút tiền</h6>
                            <a href="{{ route('vendor.withdraw.index') }}" class="btn btn-primary"><i
                                    class="fa-solid fa-arrow-left"></i> Quay lại</a>
                        </div>

                        <div class="wsus__dashboard_profile">
                            <div class="row">
                                <div class="wsus__dash_pro_area col-md-6">
                                    <form action="{{ route('vendor.withdraw.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label>Chọn phương thức rút tiền</label>
                                            <select name="method" id="method" class="form-control">
                                                <option value="">Chọn</option>
                                                @foreach ($withdraw_methods as $method)
                                                    <option value="{{ $method->id }}">{{ $method->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('method'))
                                                <code>{{ $errors->first('method') }}</code>
                                            @endif
                                        </div>

                                        <div class="form-group mt-4">
                                            <label>Số tiền rút</label>
                                            <input type="number" class="form-control" name="total_amount">
                                            @if ($errors->has('total_amount'))
                                                <code>{{ $errors->first('total_amount') }}</code>
                                            @endif
                                        </div>

                                        <div class="form-group  mt-4">
                                            <label>Thông tin tài khoản</label>
                                            <textarea style="width: 100%;" rows="6" id="mytextarea" name="account_info"
                                                placeholder="Nhập thông tin tài khoản"></textarea>
                                            @if ($errors->has('account_info'))
                                                <code>{{ $errors->first('account_info') }}</code>
                                            @endif
                                        </div>

                                        <button type="submit" class="btn btn-primary mt-4">Gửi</button>
                                    </form>
                                </div>

                                <div class="withdraw_method_desc col-md-6">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('#method').on('change', function(e) {

                let method_id = $(this).val();

                $.ajax({
                    method: 'GET',
                    url: "{{ route('vendor.withdraw-method-desc', ':id') }}".replace(':id',
                        method_id),
                    success: function(response) {
                        $(".withdraw_method_desc").html(`
                        <h4>Yêu cầu:</h4>
                        <p>Số tiền rút tối thiểu: ${Number(response.minimum_amount).toLocaleString('vi-VN', {
                            minimumFractionDigits: 0
                        })}{{ $settings->currency_icon }}</p>
                        <p>Số tiền rút tối đa: ${Number(response.maximum_amount).toLocaleString('vi-VN', {
                            minimumFractionDigits: 0
                        })}{{ $settings->currency_icon }}</p>
                        <p>Chiết khấu: ${response.withdraw_charge}%</p>
                        <p>${response.description}</p>
                        `);
                    },

                    error: function(error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
