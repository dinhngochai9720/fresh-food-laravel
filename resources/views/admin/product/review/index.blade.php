@extends('admin.layouts.master')

@section('title')
    Đánh giá sản phẩm
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1> Đánh giá sản phẩm</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Danh sách đánh giá sản phẩm</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myDatatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Email</th>
                                            <th>Tên</th>
                                            <th>Sản phẩm</th>
                                            <th>Nhà cung cấp</th>
                                            <th>Đánh giá</th>
                                            <th>Bình luận</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reviews as $key => $review)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $review->user->email }}</td>
                                                <td>{{ $review->user->name }}</td>
                                                <td>{{ $review->product->name }}</td>
                                                <td>{{ $review->vendor->shop_name }}</td>
                                                <td>
                                                    @if ($review->rating == 1)
                                                        <i class="fas fa-star" style="color: orange"></i>
                                                    @elseif ($review->rating == 2)
                                                        <i class="fas fa-star" style="color: orange"></i>
                                                        <i class="fas fa-star" style="color: orange"></i>
                                                    @elseif ($review->rating == 3)
                                                        <i class="fas fa-star" style="color: orange"></i>
                                                        <i class="fas fa-star" style="color: orange"></i>
                                                        <i class="fas fa-star" style="color: orange"></i>
                                                    @elseif ($review->rating == 4)
                                                        <i class="fas fa-star" style="color: orange"></i>
                                                        <i class="fas fa-star" style="color: orange"></i>
                                                        <i class="fas fa-star" style="color: orange"></i>
                                                        <i class="fas fa-star" style="color: orange"></i>
                                                    @elseif ($review->rating == 5)
                                                        <i class="fas fa-star" style="color: orange"></i>
                                                        <i class="fas fa-star" style="color: orange"></i>
                                                        <i class="fas fa-star" style="color: orange"></i>
                                                        <i class="fas fa-star" style="color: orange"></i>
                                                        <i class="fas fa-star" style="color: orange"></i>
                                                    @endif
                                                </td>
                                                <td>{{ $review->review }}</td>
                                                <td>
                                                    @if ($review->status == 1)
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" checked name="custom-switch-checkbox"
                                                                data-id="{{ $review->id }}"
                                                                class="custom-switch-input change-status">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    @else
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" name="custom-switch-checkbox"
                                                                data-id="{{ $review->id }}"
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

                // Get id of status button (id of brand)
                let review_id = $(this).data('id')

                $.ajax({
                    url: "{{ route('admin.product-review.change-status') }}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: review_id
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
