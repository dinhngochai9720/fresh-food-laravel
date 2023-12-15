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
                            <h4>Danh sách phương thức vận chuyển</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.shipping.create') }}" class="btn btn-primary"><i
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
                                            <th>Đơn hàng tối thiểu</th>
                                            <th>Chi phí</th>
                                            <th>Trạng thái</th>
                                            <th>Sửa/Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($shippings as $key => $shipping)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $shipping->name }}</td>
                                                <td>
                                                    @if ($shipping->min_order == null)
                                                        0{{ $settings->currency_icon }}
                                                    @else
                                                        {{ number_format($shipping->min_order, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                    @endif
                                                </td>
                                                <td> {{ number_format($shipping->cost, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                </td>
                                                <td>
                                                    @if ($shipping->status == 1)
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" checked name="custom-switch-checkbox"
                                                                data-id="{{ $shipping->id }}"
                                                                class="custom-switch-input change-status">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    @else
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" name="custom-switch-checkbox"
                                                                data-id="{{ $shipping->id }}"
                                                                class="custom-switch-input change-status">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('admin.shipping.edit', $shipping->id) }}"
                                                            class='btn btn-primary'><i
                                                                class='fa-regular fa-pen-to-square'></i></a>
                                                        <a href="{{ route('admin.shipping.destroy', $shipping->id) }}"
                                                            class='btn btn-danger ml-2' id='delete-item'><i
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
                // Check status button is checked or not checked
                let isChecked = $(this).is(':checked'); //if checked return true or not checked return false
                // console.log(isChecked);

                // Get id of status button (id of shipping)
                let shipping_id = $(this).data('id')

                $.ajax({
                    url: "{{ route('admin.shipping.change-status') }}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: shipping_id
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
