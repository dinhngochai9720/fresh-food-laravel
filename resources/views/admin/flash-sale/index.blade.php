@extends('admin.layouts.master')

@section('title')
    Flash Sale
@endsection

@section('content')
  
    <section class="section">
        <div class="section-header">
            <h1>Flash Sale</h1>
           
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.flash-sale.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Chọn ngày kết thúc</label>
                                            <input type="text" class="form-control datepicker" name="end_date"
                                                value="{{ @$flash_sale_date->end_date }}">
                                            @if ($errors->has('end_date'))
                                                <code>{{ $errors->first('end_date') }}</code>
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.flash-sale.add-product') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Thêm sản phẩm</label>
                                            <select name="product_id" id="" class="form-control select2">
                                                <option value="">Chọn sản phẩm</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('product_id'))
                                                <code>{{ $errors->first('product_id') }}</code>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Hiển thị trang chủ</label>
                                            <select name="show_home_page" id="" class="form-control">
                                                {{-- <option value="">Chọn</option> --}}
                                                <option value="1">Có</option>
                                                <option value="0">Không</option>
                                            </select>
                                            @if ($errors->has('show_home_page'))
                                                <code>{{ $errors->first('show_home_page') }}</code>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Trạng thái</label>
                                            <select name="status" id="" class="form-control">
                                                {{-- <option value="">Chọn</option> --}}
                                                <option value="1">Hiển thị</option>
                                                <option value="0">Ẩn</option>
                                            </select>
                                            @if ($errors->has('status'))
                                                <code>{{ $errors->first('status') }}</code>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
                                            <th>Loại sản phẩm</th>
                                            <th>Thương hiệu</th>
                                            <th>Danh mục</th>
                                            <th>Danh mục con</th>
                                            <th>Danh mục con cấp 2</th>
                                            <th>Giá</th>
                                            <th>Giá ưu đãi</th>
                                            <th>Số lượng</th>
                                            <th>Hiển thị trang chủ</th>
                                            <th>Trạng thái</th>
                                            <th>Sửa/Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($flash_sale_items as $key => $flash_sale_item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $flash_sale_item->product->vendor->shop_name }}</td>
                                                <td>
                                                    <img class="border rounded"
                                                        src="{{ asset($flash_sale_item->product->thumbnail_image) }}"
                                                        style="width: 100px; height: 100px;" />
                                                </td>

                                                {{-- Warning: Do not hidden sidebar responsive when show product name --}}
                                                <td>{{ $flash_sale_item->product->name }} </td>

                                                {{-- Warning: Do not hidden sidebar responsive when show product type --}}
                                                <td>
                                                    @if ($flash_sale_item->product->product_type == null)
                                                    @elseif ($flash_sale_item->product->product_type == 'new_arrival')
                                                        <span class="badge badge-success">mới</span>
                                                    @elseif ($flash_sale_item->product->product_type == 'featured_product')
                                                        <span class="badge badge-primary">nổi bật</span>
                                                    @elseif ($flash_sale_item->product->product_type == 'top_product')
                                                        <span class="badge badge-info">bán chạy</span>
                                                    @elseif ($flash_sale_item->product->product_type == 'best_product')
                                                        <span class="badge badge-secondary">tốt nhất</span>
                                                    @endif
                                                </td>

                                                <td>{{ $flash_sale_item->product->brand->name }}</td>
                                                <td>{{ $flash_sale_item->product->category->name }}</td>
                                                <td>
                                                    @if ($flash_sale_item->product->sub_category_id == null)
                                                    @else
                                                        {{ $flash_sale_item->product->subCategory->name }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($flash_sale_item->product->child_category_id == null)
                                                    @else
                                                        {{ $flash_sale_item->product->childCategory->name }}
                                                    @endif
                                                </td>
                                                <td>{{ number_format($flash_sale_item->product->price, 0, '.', '.') . 'đ' }}
                                                </td>

                                                <td>
                                                    @if ($flash_sale_item->product->offer_price == null)
                                                    @else
                                                        {{ number_format($flash_sale_item->product->offer_price, 0, '.', '.') . 'đ' }}
                                                    @endif
                                                </td>

                                                <td>{{ $flash_sale_item->product->quantity }}</td>

                                                <td>
                                                    @if ($flash_sale_item->show_home_page == 1)
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" checked name="custom-switch-checkbox"
                                                                data-id="{{ $flash_sale_item->id }}"class="custom-switch-input change-show-home-page">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    @else
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" name="custom-switch-checkbox"
                                                                data-id="{{ $flash_sale_item->id }}"
                                                                class="custom-switch-input change-show-home-page">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($flash_sale_item->status == 1)
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" checked name="custom-switch-checkbox"
                                                                data-id="{{ $flash_sale_item->id }}"class="custom-switch-input change-status">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    @else
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" name="custom-switch-checkbox"
                                                                data-id="{{ $flash_sale_item->id }}"
                                                                class="custom-switch-input change-status">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    @endif
                                                </td>

                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('admin.product.edit', $flash_sale_item->product_id) }}"
                                                            class='btn btn-primary mr-2'><i
                                                                class='fa-regular fa-pen-to-square'></i></a>

                                                        <a href="{{ route('admin.flash-sale.destroy', $flash_sale_item->id) }}"
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
            $('body').on('click', '.change-show-home-page', function() {
                // Check show-home-page button is checked or not checked
                let isChecked = $(this).is(':checked');
                // console.log(isChecked);

                // Get id of show-home-page button (id of flash sale item)
                let flash_sale_item_id = $(this).data('id')

                $.ajax({
                    url: "{{ route('admin.flash-sale.change-show-home-page') }}",
                    method: 'PUT',
                    data: {
                        show_home_page: isChecked,
                        id: flash_sale_item_id
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

            $('body').on('click', '.change-status', function() {
                // Check status button is checked or not checked
                let isChecked = $(this).is(':checked');
                // console.log(isChecked);

                // Get id of status button (id of flash sale item)
                let flash_sale_item_id = $(this).data('id')

                $.ajax({
                    url: "{{ route('admin.flash-sale.change-status') }}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: flash_sale_item_id
                    },
                    success: function(data) {
                        console.log(data);
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
