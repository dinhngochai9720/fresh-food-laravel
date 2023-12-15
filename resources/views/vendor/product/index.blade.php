@extends('vendor.layouts.master')

@section('title')
    Sản phẩm
@endsection

@section('content')
    <!--=============================
                            DASHBOARD START
                          ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">

            {{-- sidebar --}}
            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">

                        <h3>Sản phẩm</h3>

                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6>Danh sách sản phẩm</h6>
                            <a href="{{ route('vendor.product.create') }}" class="btn btn-primary"><i
                                    class="fa-solid fa-plus"></i> Thêm mới</a>
                        </div>


                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <div class="table-responsive">
                                    <table id="myDatatable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
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
                                                    <td><img class="border rounded"
                                                            src="{{ asset($product->thumbnail_image) }}"
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
                                                    <td>{{ number_format($product->price, 0, '.', '.') . 'đ' }} </td>


                                                    <td>
                                                        @if ($product->offer_price == null)
                                                        @else
                                                            {{ number_format($product->offer_price, 0, '.', '.') . 'đ' }}
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if ($product->quantity > 0)
                                                            {{ $product->quantity }}
                                                        @else
                                                            <span class="rounded-pill badge bg-warning">hết hàng</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($product->status == 1)
                                                            <div class="form-check form-switch">
                                                                <input style="border-radius:2em !important;" checked
                                                                    class="change-status form-check-input" type="checkbox"
                                                                    role="switch" id="flexSwitchCheckDefault"
                                                                    data-id="{{ $product->id }}">
                                                            </div>
                                                        @else
                                                            <div class="form-check form-switch">
                                                                <input style="border-radius:2em !important;"
                                                                    class="change-status form-check-input" type="checkbox"
                                                                    role="switch" id="flexSwitchCheckDefault"
                                                                    data-id="{{ $product->id }}">
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($product->is_approved == 1)
                                                            <span class="rounded-pill badge bg-success">đã chấp
                                                                thuận</span>
                                                        @elseif ($product->is_approved == 0)
                                                            <span class="rounded-pill badge bg-warning">chờ xử lý</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="btn-group dropleft">
                                                                <button type="button"
                                                                    class="btn btn-primary dropdown-toggle"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="fas fa-cog"></i>
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li> <a class="dropdown-item has-icon"
                                                                            href="{{ route('vendor.product-multi-image.index', ['product_id' => $product->id]) }}"><i
                                                                                class="fas fa-images"></i> Thêm nhiều
                                                                            ảnh</a></li>
                                                                    <li><a class="dropdown-item has-icon"
                                                                            href="{{ route('vendor.product-variant.index', ['product_id' => $product->id]) }}"><i
                                                                                class="far fa-file"></i> Thuộc tính sản
                                                                            phẩm</a></li>
                                                                </ul>
                                                            </div>

                                                            <a href="{{ route('vendor.product.edit', $product->id) }}"
                                                                class='btn btn-primary ms-2 me-2 '><i
                                                                    class='fa-regular fa-pen-to-square'></i></a>
                                                            <a href="{{ route('vendor.product.destroy', $product->id) }}"
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
        </div>
        </div>
    </section>
    <!--=============================
                            DASHBOARD START
                          ==============================-->
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
                    url: "{{ route('vendor.product.change-status') }}",
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
            })
        });
    </script>
@endpush
