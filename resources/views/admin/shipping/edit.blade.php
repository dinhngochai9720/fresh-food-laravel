@extends('admin.layouts.master')

@section('title')
    Phương thức vận chuyển
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Phương thức vận chuyển</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Sửa phương thức vận chuyển</h4>
                            <div class="card-header-action">
                                <a class="btn btn-primary" href="{{ route('admin.shipping.index') }}"><i
                                        class="fa-solid fa-arrow-left"></i> Quay lại</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.shipping.update', $shipping->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Tên phương thức vận chuyển</label>
                                    <input type="text" class="form-control" name="name" value="{{ $shipping->name }}"
                                        placeholder="Nhập tên">
                                    @if ($errors->has('name'))
                                        <code>{{ $errors->first('name') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="inputTypeShipping">Loại vận chuyển</label>
                                    <select id="inputTypeShipping" class="form-control type-shipping" name="type">
                                        <option value="">Chọn</option>
                                        <option {{ $shipping->type == 'min_order' ? 'selected' : '' }} value="min_order">
                                            Đơn
                                            hàng
                                            tối thiểu</option>
                                        <option {{ $shipping->type == 'cost' ? 'selected' : '' }} value="cost">Chi phí
                                        </option>
                                    </select>
                                    @if ($errors->has('type'))
                                        <code>{{ $errors->first('type') }}</code>
                                    @endif
                                </div>

                                <div class="form-group min_order {{ $shipping->type == 'min_order' ? '' : 'd-none' }} ">
                                    <label>Đơn hàng tối thiểu</label>
                                    <input type="number" class="form-control" name="min_order"
                                        value="{{ $shipping->min_order }}" placeholder="Nhập đơn hàng tối thiểu">
                                    @if ($errors->has('min_order'))
                                        <code>{{ $errors->first('min_order') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Chi phí</label>
                                    <input type="number" class="form-control" name="cost" value="{{ $shipping->cost }}"
                                        placeholder="Nhập chi phí">
                                    @if ($errors->has('cost'))
                                        <code>{{ $errors->first('cost') }}</code>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <label for="inputStatus">Trạng thái</label>
                                    <select id="inputStatus" class="form-control" name="status">
                                        <option {{ $shipping->status == 1 ? 'selected' : '' }} value="1">Hiển thị
                                        </option>
                                        <option {{ $shipping->status == 0 ? 'selected' : '' }} value="0">Ẩn</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
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
            $('body').on('change', '.type-shipping', function() {
                let value = $(this).val();

                if (value !== 'min_order') {
                    $('.min_order').addClass('d-none')
                } else {
                    $('.min_order').removeClass('d-none')
                }
            })
        })
    </script>
@endpush
