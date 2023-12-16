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
                            <h4>Thêm phương thức rút tiền</h4>
                            <div class="card-header-action">
                                <a class="btn btn-primary" href="{{ route('admin.withdraw-method.index') }}"><i
                                        class="fa-solid fa-arrow-left"></i> Quay lại</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.withdraw-method.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label>Tên phương thức</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                        placeholder="Nhập tên">
                                    @if ($errors->has('name'))
                                        <code>{{ $errors->first('name') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Số tiền tối thiểu</label>
                                    <input type="number" class="form-control" name="minimum_amount"
                                        value="{{ old('minimum_amount') }}" placeholder="Nhập số tiền">
                                    @if ($errors->has('minimum_amount'))
                                        <code>{{ $errors->first('minimum_amount') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Số tiền tối đa</label>
                                    <input type="number" class="form-control" name="maximum_amount"
                                        value="{{ old('maximum_amount') }}" placeholder="Nhập số tiền">
                                    @if ($errors->has('maximum_amount'))
                                        <code>{{ $errors->first('maximum_amount') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Chiết khấu (%)</label>
                                    <input type="number" class="form-control" name="withdraw_charge"
                                        value="{{ old('withdraw_charge') }}" placeholder="Nhập chiết khấu">
                                    @if ($errors->has('withdraw_charge'))
                                        <code>{{ $errors->first('withdraw_charge') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea name="description" class="summernote"></textarea>
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
