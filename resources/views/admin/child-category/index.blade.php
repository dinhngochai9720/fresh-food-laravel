@extends('admin.layouts.master')

@section('title')
    Danh mục con cấp 2
@endsection

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Danh mục con cấp 2</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Danh sách danh mục con cấp 2</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.child-category.create') }}" class="btn btn-primary"><i
                                        class="fa-solid fa-plus"></i> Thêm mới</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myDatatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên danh mục</th>
                                            <th>Tên danh mục con</th>
                                            <th>Tên danh mục con cấp 2</th>
                                            <th>Trạng thái</th>
                                            <th>Sửa/Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($child_categories as $key => $child_category)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $child_category->category->name }}</td>
                                                <td>{{ $child_category->subCategory->name }}</td>
                                                <td>{{ $child_category->name }}</td>
                                                <td>
                                                    @if ($child_category->status == 1)
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" checked name="custom-switch-checkbox"
                                                                data-id="{{ $child_category->id }}"
                                                                class="custom-switch-input change-status">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    @else
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" name="custom-switch-checkbox"
                                                                data-id="{{ $child_category->id }}"
                                                                class="custom-switch-input change-status">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('admin.child-category.edit', $child_category->id) }}"
                                                            class='btn btn-primary'><i
                                                                class='fa-regular fa-pen-to-square'></i></a>
                                                        <a href="{{ route('admin.child-category.destroy', $child_category->id) }}"
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
                // Check status button is chhecked or not checked
                let isChecked = $(this).is(':checked');
                // console.log(isChecked);

                // Get id of status button (id of child category)
                let child_category_id = $(this).data('id')

                $.ajax({
                    url: "{{ route('admin.child-category.change-status') }}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: child_category_id
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
