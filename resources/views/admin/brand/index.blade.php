@extends('admin.layouts.master')

@section('title')
    Thương hiệu
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1> Thương hiệu</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Danh sách thương hiệu</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.brand.create') }}" class="btn btn-primary"><i
                                        class="fa-solid fa-plus"></i> Thêm mới</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myDatatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Logo</th>
                                            <th>Tên thương hiệu</th>
                                            <th>Nổi bật</th>
                                            <th>Trạng thái</th>
                                            <th>Sửa/Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($brands as $key => $brand)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    <img class='border rounded' width='100px' height='100px'
                                                        src='{{ asset($brand->logo) }}' />
                                                </td>
                                                <td>{{ $brand->name }}</td>
                                                <td>
                                                    @if ($brand->is_featured == 1)
                                                        <span class="badge badge-success">có</span>
                                                    @else
                                                        <span class="badge badge-secondary">không</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($brand->status == 1)
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" checked name="custom-switch-checkbox"
                                                                data-id="{{ $brand->id }}"
                                                                class="custom-switch-input change-status">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    @else
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" name="custom-switch-checkbox"
                                                                data-id="{{ $brand->id }}"
                                                                class="custom-switch-input change-status">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('admin.brand.edit', $brand->id) }}"
                                                            class='btn btn-primary'><i
                                                                class='fa-regular fa-pen-to-square'></i></a>
                                                        <a href="{{ route('admin.brand.destroy', $brand->id) }}"
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
                let isChecked = $(this).is(':checked');
                // console.log(isChecked);

                // Get id of status button (id of brand)
                let brand_id = $(this).data('id')

                $.ajax({
                    url: "{{ route('admin.brand.change-status') }}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: brand_id
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
