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
                            <h4>Sửa danh mục con cấp 2</h4>
                            <div class="card-header-action">
                                <a class="btn btn-primary" href="{{ route('admin.child-category.index') }}"><i
                                        class="fa-solid fa-arrow-left"></i> Quay lại</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.child-category.update', $child_category->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="inputStatus">Danh mục</label>
                                    <select id="inputStatus" class="form-control main-category" name="category_id">
                                        <option value="">Chọn danh mục</option>
                                        @foreach ($categories as $category)
                                            <option {{ $category->id == $child_category->category_id ? 'selected' : '' }}
                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <code>{{ $errors->first('category_id') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="inputStatus">Danh mục con</label>
                                    <select id="inputStatus" class="form-control sub-category" name="sub_category_id">
                                        <option value="">Chọn danh mục con</option>
                                        @foreach ($sub_categories as $sub_category)
                                            <option
                                                {{ $sub_category->id == $child_category->sub_category_id ? 'selected' : '' }}
                                                value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('sub_category_id'))
                                        <code>{{ $errors->first('sub_category_id') }}</code>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <label>Tên danh mục</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $child_category->name }}" placeholder="Nhập tên">
                                    @if ($errors->has('name'))
                                        <code>{{ $errors->first('name') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="inputStatus">Trạng thái</label>
                                    <select id="inputStatus" class="form-control" name="status">
                                        <option {{ $child_category->status == 1 ? 'selected' : '' }} value="1">Hiển
                                            thị</option>
                                        <option {{ $child_category->status == 0 ? 'selected' : '' }} value="0">Ẩn
                                        </option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
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
            $('body').on('change', '.main-category', function(e) {
                // get id of category
                let category_id = $(this).val();
                // console.log(id);

                $.ajax({
                    url: "{{ route('admin.child-category.get-subcategories') }}",
                    method: 'GET',
                    data: {
                        id: category_id,
                    },
                    success: function(data) {
                        // console.log(data);

                        // refesh subcategories after choose category again
                        $('.sub-category').html(`<option value="">Chọn danh mục con</option>`)

                        $.each(data, function(i, item) {
                            // console.log(item.name);

                            // show subcategory after category
                            $('.sub-category').append(
                                `<option value="${item.id}">${item.name}</option>`)
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            })
        });
    </script>
@endpush
