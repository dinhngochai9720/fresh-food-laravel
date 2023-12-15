@extends('admin.layouts.master')

@section('title')
    Sản phẩm
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Sản phẩm</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Danh sách sản phẩm</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myDatatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Nhà cung cấp</th>
                                            <th>Ảnh</th>
                                            <th>Tên</th>
                                            <th>Thương hiệu</th>
                                            <th>Danh mục</th>
                                            <th>Danh mục con</th>
                                            <th>Danh mục con cấp 2</th>
                                            <th>Giá</th>
                                            <th>Giá ưu đãi</th>
                                            <th>Số lượng</th>
                                            <th>Trạng thái</th>
                                            <th>Chấp thuận</th>
                                            <th>Thêm/Sửa/Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $key => $product)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $product->vendor->shop_name }}</td>
                                                <td><img class="border rounded" src="{{ asset($product->thumbnail_image) }}"
                                                        style="width: 100px; height: 100px;" /></td>
                                                <td>{{ $product->name }} </td>
                                                <td>{{ $product->brand->name }}</td>
                                                <td>{{ $product->category->name }}</td>
                                                <td>
                                                    @if ($product->sub_category_id == null)
                                                    @else
                                                        {{ $product->subCategory->name }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($product->child_category_id == null)
                                                    @else
                                                        {{ $product->childCategory->name }}
                                                    @endif
                                                </td>
                                                <td>{{ number_format($product->price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                </td>

                                                <td>
                                                    @if ($product->offer_price == null)
                                                    @else
                                                        {{ number_format($product->offer_price, 0, '.', '.') }}{{ $settings->currency_icon }}
                                                    @endif
                                                </td>

                                                <td>{{ $product->quantity }}</td>
                                                <td>
                                                    @if ($product->status == 1)
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" checked name="custom-switch-checkbox"
                                                                data-id="{{ $product->id }}"class="custom-switch-input change-status">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    @else
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" name="custom-switch-checkbox"
                                                                data-id="{{ $product->id }}"
                                                                class="custom-switch-input change-status">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <select class="form-control is_approve" style="width: 130px;"
                                                        data-id="{{ $product->id }}">
                                                        <option value="0">Chờ xử lý</option>
                                                        <option selected value="1">Chấp thuận</option>
                                                    </select>
                                                </td>

                                                <td>
                                                    <div class="d-flex">
                                                        <div class="dropdown dropleft d-inline ">
                                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                                id="dropdownMenuButton2" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-cog"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item has-icon"
                                                                    href="{{ route('admin.product-multi-image.index', ['product_id' => $product->id]) }}"><i
                                                                        class="fas fa-images"></i>Thêm nhiều ảnh</a>
                                                                <a class="dropdown-item has-icon"
                                                                    href="{{ route('admin.product-variant.index', ['product_id' => $product->id]) }}"><i
                                                                        class="far fa-file"></i>Thuộc tính sản phẩm</a>
                                                            </div>
                                                        </div>

                                                        <a href="{{ route('admin.product.edit', $product->id) }}"
                                                            class='btn btn-primary ml-2 mr-2'><i
                                                                class='fa-regular fa-pen-to-square'></i></a>

                                                        <a href="{{ route('admin.product.destroy', $product->id) }}"
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

                // Get id of status button (id of slider)
                let product_id = $(this).data('id')

                $.ajax({
                    url: "{{ route('admin.product.change-status') }}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: product_id
                    },
                    success: function(data) {
                        // console.log(data);
                        toastr.success(data.message);

                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }

                })
            });


            // Change approve status
            $('body').on('change', '.is_approve', function() {
                let approve_value = $(this).val();

                //get id product
                let product_id = $(this).data('id');

                $.ajax({
                    url: "{{ route('admin.product.change-approve-status') }}",
                    method: 'PUT',
                    data: {
                        value: approve_value,
                        id: product_id,
                    },
                    success: function(data) {
                        // console.log(data);
                        toastr.success(data.message);

                        // reload page after change approval status
                        window.location.reload();

                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }

                })
            })
        });
    </script>
@endpush
