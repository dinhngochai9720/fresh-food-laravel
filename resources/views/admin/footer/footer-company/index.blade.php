@extends('admin.layouts.master')

@section('title')
    Về Fresh Food
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1> Về Fresh Food</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Danh sách về Fresh Food</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.footer-company.create') }}" class="btn btn-primary"><i
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
                                            <th>Trạng thái</th>
                                            <th>Sửa/Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($footer_companies as $key => $footer_company)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $footer_company->name }}</td>
                                                <td>
                                                    @if ($footer_company->status == 1)
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" checked name="custom-switch-checkbox"
                                                                data-id="{{ $footer_company->id }}"
                                                                class="custom-switch-input change-status">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    @else
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" name="custom-switch-checkbox"
                                                                data-id="{{ $footer_company->id }}"
                                                                class="custom-switch-input change-status">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="flex">
                                                        <a href="{{ route('admin.footer-company.edit', $footer_company->id) }}"
                                                            class='btn btn-primary'><i
                                                                class='fa-regular fa-pen-to-square'></i></a>
                                                        <a href="{{ route('admin.footer-company.destroy', $footer_company->id) }}"
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
                let footer_company_id = $(this).data('id')

                $.ajax({
                    url: "{{ route('admin.footer-company.change-status') }}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: footer_company_id
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
