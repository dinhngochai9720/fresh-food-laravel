@extends('admin.layouts.master')

@section('title')
    Voucher
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Voucher</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Thêm voucher</h4>
                            <div class="card-header-action">
                                <a class="btn btn-primary" href="{{ route('admin.voucher.index') }}"><i
                                        class="fa-solid fa-arrow-left"></i> Quay lại</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.voucher.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Tên voucher</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                        placeholder="Nhập tên">
                                    @if ($errors->has('name'))
                                        <code>{{ $errors->first('name') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Mã code</label>
                                    <input type="text" class="form-control" name="code" value="{{ old('code') }}"
                                        placeholder="Nhập mã code">
                                    @if ($errors->has('code'))
                                        <code>{{ $errors->first('code') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Số lượng</label>
                                    <input type="number" class="form-control" name="quantity" value="{{ old('quantity') }}"
                                        placeholder="Nhập số lượng">
                                    @if ($errors->has('quantity'))
                                        <code>{{ $errors->first('quantity') }}</code>
                                    @endif
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Ngày bắt đầu</label>
                                            <input type="text" class="form-control datepicker" name="start_date"
                                                value="{{ old('start_date') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Ngày kết thúc</label>
                                            <input type="text" class="form-control datepicker" name="end_date"
                                                value="{{ old('end_date') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="inputDiscountType">Loại voucher</label>
                                            <select id="inputDiscountType" class="form-control" name="voucher_type">
                                                <option value="">Chọn</option>
                                                <option value="percent">%</option>
                                                <option value="amount">{{ $settings->currency_icon }}</option>
                                            </select>
                                            @if ($errors->has('voucher_type'))
                                                <code>{{ $errors->first('voucher_type') }}</code>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Giá trị</label>
                                            <input type="number" class="form-control" name="discount"
                                                value="{{ old('discount') }}" placeholder="Nhập giá trị">
                                            @if ($errors->has('discount'))
                                                <code>{{ $errors->first('discount') }}</code>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputStatus">Trạng thái</label>
                                    <select id="inputStatus" class="form-control" name="status">
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>
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
