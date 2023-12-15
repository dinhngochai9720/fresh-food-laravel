@php
    $category_slider_three = json_decode($category_slider_three->value);
    // get sub categories of category

    // get sub categories of category_one
    $sub_categories_one = \App\Models\SubCategory::where('category_id', $category_slider_three[0]->category)->get();
    // get child categories of sub_category_one
    $child_categories_one = \App\Models\ChildCategory::where('sub_category_id', $category_slider_three[0]->sub_category)->get();

    // get sub categories of category_two
    $sub_categories_two = \App\Models\SubCategory::where('category_id', $category_slider_three[1]->category)->get();
    // get child categories of sub_category_two
    $child_categories_two = \App\Models\ChildCategory::where('sub_category_id', $category_slider_three[1]->sub_category)->get();
@endphp

<div class="tab-pane fade" id="category-slider-three-setting" role="tabpanel"
    aria-labelledby="category-slider-three-settings">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.home-page-setting.category-slider-three.update') }}" method="POST">
                @csrf
                @method('PUT')

                <h6>Phần 1</h6>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category_one">Danh mục</label>
                            <select id="category_one" class="form-control main-category" name="category_one">
                                <option value="">Chọn danh mục</option>
                                @foreach ($categories as $key => $category)
                                    <option {{ $category->id == $category_slider_three[0]->category ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_one'))
                                <code>{{ $errors->first('category_one') }}</code>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sub_category_one">Danh mục con</label>
                            <select id="sub_category_one" class="form-control sub-category" name="sub_category_one">
                                <option value="">Chọn danh mục con</option>
                                @foreach ($sub_categories_one as $sub_category)
                                    <option
                                        {{ $sub_category->id == $category_slider_three[0]->sub_category ? 'selected' : '' }}
                                        value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="child_category_one">Danh mục con cấp 2</label>
                            <select id="child_category_one" class="form-control child-category"
                                name="child_category_one">
                                <option value="">Chọn danh mục con cấp 2</option>
                                @foreach ($child_categories_one as $child_category)
                                    <option
                                        {{ $child_category->id == $category_slider_three[0]->child_category ? 'selected' : '' }}
                                        value="{{ $child_category->id }}">{{ $child_category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <h6>Phần 2</h6>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category_two">Danh mục</label>
                            <select id="category_two" class="form-control main-category" name="category_two">
                                <option value="">Chọn danh mục</option>
                                @foreach ($categories as $key => $category)
                                    <option
                                        {{ $category->id == $category_slider_three[1]->category ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_two'))
                                <code>{{ $errors->first('category_two') }}</code>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sub_category_two">Danh mục con</label>
                            <select id="sub_category_two" class="form-control sub-category" name="sub_category_two">
                                <option value="">Chọn danh mục con</option>
                                @foreach ($sub_categories_two as $sub_category)
                                    <option
                                        {{ $sub_category->id == $category_slider_three[1]->sub_category ? 'selected' : '' }}
                                        value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="child_category_two">Danh mục con cấp 2</label>
                            <select id="child_category_two" class="form-control child-category"
                                name="child_category_two">
                                <option value="">Chọn danh mục con cấp 2</option>
                                @foreach ($child_categories_two as $child_category)
                                    <option
                                        {{ $child_category->id == $category_slider_three[1]->child_category ? 'selected' : '' }}
                                        value="{{ $child_category->id }}">{{ $child_category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            // get sub-category of category
            $('body').on('change', '.main-category', function(e) {
                // get id of category
                let category_id = $(this).val();
                // console.log(id);

                // find element have class='row' nearest class='main-category'
                let row = $(this).closest('.row');

                $.ajax({
                    url: "{{ route('admin.home-page-setting.get-sub-categories') }}",
                    method: 'GET',
                    data: {
                        id: category_id,
                    },
                    success: function(data) {
                        let selector_subcategory = row.find('.sub-category');
                        let selector_child_category = row.find('.child-category');

                        // refesh subcategories after choose category again
                        selector_subcategory.html(
                            `<option value="">Chọn danh mục con</option>`)

                        // refesh child categories after choose category again
                        selector_child_category.html(
                            `<option value="">Chọn danh mục con cấp 2</option>`)

                        $.each(data, function(i, item) {
                            // console.log(item.name);

                            // show subcategory after category
                            selector_subcategory.append(
                                `<option value="${item.id}">${item.name}</option>`)
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            })

            // get child categories of sub category
            $('body').on('change', '.sub-category', function(e) {
                // get id of sub category
                let id = $(this).val();
                // console.log(id);

                // find element have class='row' nearest class='sub-category'
                let row = $(this).closest('.row');

                $.ajax({
                    url: "{{ route('admin.home-page-setting.get-child-categories') }}",
                    method: 'GET',
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        let selector = row.find('.child-category');

                        // refesh child categories after choose sub category again
                        selector.html(
                            `<option value="">Chọn danh mục con cấp 2</option>`)

                        $.each(data, function(i, item) {
                            // console.log(item.name);

                            // show child category after choose sub category
                            selector.append(
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
