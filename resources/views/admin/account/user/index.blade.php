@extends('admin.layouts.master')

@section('title')
    Quản lý tài khoản
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản lý tài khoản</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Danh sách tài khoản người dùng</h4>

                            <div class="card-header-action">
                                <a href="{{ route('admin.account-user.create') }}" class="btn btn-primary"><i
                                        class="fa-solid fa-plus"></i> Thêm mới</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myDatatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Email</th>
                                            <th>Tên</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $user)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>
                                                    @if ($user->status == 'active')
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" checked name="custom-switch-checkbox"
                                                                data-id="{{ $user->id }}"
                                                                class="custom-switch-input change-status">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    @else
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" name="custom-switch-checkbox"
                                                                data-id="{{ $user->id }}"
                                                                class="custom-switch-input change-status">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    @endif
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

                // Get id of status button (id of user)
                let user_id = $(this).data('id')

                $.ajax({
                    url: "{{ route('admin.account-user.change-status') }}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: user_id
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
