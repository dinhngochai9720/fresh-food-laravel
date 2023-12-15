@extends('admin.layouts.master')

@section('title')
    Sản phẩm
@endsection

@section('content')
    <section class="section">
        <div class="section-header d-flex align-items-center justify-content-between">
            <h1>{{ $product->name }}</h1>



        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $variant->name }}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.product-variant.index', ['product_id' => $product->id]) }}"
                                    class="btn btn-primary"> <i class="fa-solid fa-arrow-left"></i> Quay lại</a>
                            </div>
                        </div>
                        <div class="card-header">
                            <h4>Danh sách chi tiết thuộc tính </h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.product-variant-item.create', ['product_id' => $product->id, 'variant_id' => $variant->id]) }}"
                                    class="btn btn-primary"><i class="fa-solid fa-plus"></i> Thêm mới</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myDatatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên chi tiết thuộc tính</th>
                                            <th>Giá</th>
                                            <th>Mặc định</th>
                                            <th>Trạng thái</th>
                                            <th>Sửa/Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($variant->variantItems as $key => $variant_item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $variant_item->name }}</td>
                                                <td>{{ number_format($variant_item->price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                </td>
                                                <td>
                                                    @if ($variant_item->is_default == 1)
                                                        <span class="badge badge-success">có</span>
                                                    @elseif ($variant_item->is_default == 0)
                                                        <span class="badge badge-secondary">không</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($variant_item->status == 1)
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" checked name="custom-switch-checkbox"
                                                                data-id="{{ $variant_item->id }}"
                                                                class="custom-switch-input change-status">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    @else
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" name="custom-switch-checkbox"
                                                                data-id="{{ $variant_item->id }}"
                                                                class="custom-switch-input change-status">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('admin.product-variant-item.edit', $variant_item->id) }}"
                                                            class='btn btn-primary mr-2'><i
                                                                class='fa-regular fa-pen-to-square'></i></a>

                                                        <a href="{{ route('admin.product-variant-item.destroy', $variant_item->id) }}"
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
                // Check status button is checked or not checked
                let isChecked = $(this).is(':checked'); //if checked return true or not checked return false
                // console.log(isChecked);

                // Get id of status button (id of variant_item_id)
                let variant_item_id = $(this).data('id')

                $.ajax({
                    url: "{{ route('admin.product-variant-item.change-status') }}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: variant_item_id
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
