@php
    $featured_category = json_decode($featured_category->value);
    // dd($featured_category);

    // get sub categories of category_one
    $sub_categories_one = \App\Models\SubCategory::where('category_id', $featured_category[0]->category)->get();
    // get child categories of sub_category_one
    $child_categories_one = \App\Models\ChildCategory::where('sub_category_id', $featured_category[0]->sub_category)->get();

    // get sub categories of category_two
    $sub_categories_two = \App\Models\SubCategory::where('category_id', $featured_category[1]->category)->get();
    // get child categories of sub_category_two
    $child_categories_two = \App\Models\ChildCategory::where('sub_category_id', $featured_category[1]->sub_category)->get();

    // get sub categories of category_three
    $sub_categories_three = \App\Models\SubCategory::where('category_id', $featured_category[2]->category)->get();
    // get child categories of sub_category_three
    $child_categories_three = \App\Models\ChildCategory::where('sub_category_id', $featured_category[2]->sub_category)->get();

    // get sub categories of category_four
    $sub_categories_four = \App\Models\SubCategory::where('category_id', $featured_category[3]->category)->get();
    // get child categories of sub_category_four
    $child_categories_four = \App\Models\ChildCategory::where('sub_category_id', $featured_category[3]->sub_category)->get();
@endphp

<div class="tab-pane fade show active" id="featured-category-setting" role="tabpanel"
    aria-labelledby="featured-category-settings">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.home-page-setting.featured-category.update') }}" method="POST">
                @csrf
                @method('PUT')

                <h6>Danh mục 1</h6>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category_one">Danh mục</label>
                            <select id="category_one" class="form-control main-category" name="category_one">
                                <option value="">Chọn danh mục</option>
                                @foreach ($categories as $key => $category)
                                    <option {{ $category->id == $featured_category[0]->category ? 'selected' : '' }}
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
                                        {{ $sub_category->id == $featured_category[0]->sub_category ? 'selected' : '' }}
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
                                        {{ $child_category->id == $featured_category[0]->child_category ? 'selected' : '' }}
                                        value="{{ $child_category->id }}">{{ $child_category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <h6>Danh mục 2</h6>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category_two">Danh mục</label>
                            <select id="category_two" class="form-control main-category" name="category_two">
                                <option value="">Chọn danh mục</option>
                                @foreach ($categories as $key => $category)
                                    <option {{ $category->id == $featured_category[1]->category ? 'selected' : '' }}
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
                                        {{ $sub_category->id == $featured_category[1]->sub_category ? 'selected' : '' }}
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
                                        {{ $child_category->id == $featured_category[1]->child_category ? 'selected' : '' }}
                                        value="{{ $child_category->id }}">{{ $child_category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>


                <h6>Danh mục 3</h6>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category_three">Danh mục</label>
                            <select id="category_three" class="form-control main-category" name="category_three">
                                <option value="">Chọn danh mục</option>
                                @foreach ($categories as $key => $category)
                                    <option {{ $category->id == $featured_category[2]->category ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_three'))
                                <code>{{ $errors->first('category_three') }}</code>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sub_category_three">Danh mục con</label>
                            <select id="sub_category_three" class="form-control sub-category" name="sub_category_three">
                                <option value="">Chọn danh mục con</option>
                                @foreach ($sub_categories_three as $sub_category)
                                    <option
                                        {{ $sub_category->id == $featured_category[2]->sub_category ? 'selected' : '' }}
                                        value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="child_category_three">Danh mục con cấp 2</label>
                            <select id="child_category_three" class="form-control child-category"
                                name="child_category_three">
                                <option value="">Chọn danh mục con cấp 2</option>
                                @foreach ($child_categories_three as $child_category)
                                    <option
                                        {{ $child_category->id == $featured_category[2]->child_category ? 'selected' : '' }}
                                        value="{{ $child_category->id }}">{{ $child_category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>


                <h6>Danh mục 4</h6>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category_four">Danh mục</label>
                            <select id="category_four" class="form-control main-category" name="category_four">
                                <option value="">Chọn danh mục</option>
                                @foreach ($categories as $key => $category)
                                    <option {{ $category->id == $featured_category[3]->category ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_four'))
                                <code>{{ $errors->first('category_four') }}</code>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sub_category_four">Danh mục con</label>
                            <select id="sub_category_four" class="form-control sub-category" name="sub_category_four">
                                <option value="">Chọn danh mục con</option>
                                @foreach ($sub_categories_four as $sub_category)
                                    <option
                                        {{ $sub_category->id == $featured_category[3]->sub_category ? 'selected' : '' }}
                                        value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="child_category_four">Danh mục con cấp 2</label>
                            <select id="child_category_four" class="form-control child-category"
                                name="child_category_four">
                                <option value="">Chọn danh mục con cấp 2</option>
                                @foreach ($child_categories_four as $child_category)
                                    <option
                                        {{ $child_category->id == $featured_category[3]->child_category ? 'selected' : '' }}
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
