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
                            <h4>Danh sách voucher</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.voucher.create') }}" class="btn btn-primary"><i
                                        class="fa-solid fa-plus"></i> Thêm mới</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myDatatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên</th>
                                            <th>Loại voucher</th>
                                            <th>Giá trị</th>
                                            <th>Số lượng</th>
                                            <th>Ngày bắt đầu</th>
                                            <th>Ngày kết thúc</th>
                                            <th>Trạng thái</th>
                                            <th>Sửa/Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vouchers as $key => $voucher)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $voucher->name }}</td>
                                                <td>
                                                    @if ($voucher->voucher_type == 'percent')
                                                        <span>%</span>
                                                    @elseif ($voucher->voucher_type == 'amount')
                                                        <span>{{ $settings->currency_icon }}</span>
                                                    @endif


                                                </td>
                                                <td>
                                                    @if ($voucher->voucher_type == 'percent')
                                                        <span>
                                                            {{ $voucher->discount }}%
                                                        </span>
                                                    @elseif ($voucher->voucher_type == 'amount')
                                                        <span>
                                                            {{ number_format($voucher->discount, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $voucher->quantity }}
                                                </td>
                                                <td>{{ date('d-m-Y', strtotime($voucher->start_date)) }}</td>
                                                <td>{{ date('d-m-Y', strtotime($voucher->end_date)) }}</td>
                                                <td>
                                                    @if ($voucher->status == 1)
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" checked name="custom-switch-checkbox"
                                                                data-id="{{ $voucher->id }}"class="custom-switch-input change-status">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    @else
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" name="custom-switch-checkbox"
                                                                data-id="{{ $voucher->id }}"
                                                                class="custom-switch-input change-status">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('admin.voucher.edit', $voucher->id) }}"
                                                            class='btn btn-primary mr-2'><i
                                                                class='fa-regular fa-pen-to-square'></i></a>

                                                        <a href="{{ route('admin.voucher.destroy', $voucher->id) }}"
                                                            class='btn btn-danger' id='delete-item'><i
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('click', '.change-status', function() {
                // Check status button is chhecked or not checked
                let isChecked = $(this).is(':checked');
                // console.log(isChecked);

                // Get id of status button (id of voucher_id)
                let voucher_id = $(this).data('id')

                $.ajax({
                    url: "{{ route('admin.voucher.change-status') }}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: voucher_id
                    },
                    success: function(data) {
                        // console.log(data);
                        toastr.success(data.message);

                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }

                })
            })
        });
    </script>
@endpush
