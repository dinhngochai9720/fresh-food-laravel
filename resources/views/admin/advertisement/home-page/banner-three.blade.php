<div class="tab-pane fade" id="home-page-banner-three" role="tabpanel" aria-labelledby="home-page-banner-threes">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.advertisement.home-page-banner-three') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <h5>Banner 1</h5>
                <div class="form-group text-center">
                    <img class="w-50" src="{{ asset($home_page_banner_three->banner_one->image_one) }}"
                        alt="image">
                </div>

                <div class="form-group">
                    <label>Ảnh</label>
                    <input type="file" class="form-control" name="image_one">
                    <input type="hidden" class="form-control" name="old_image_one"
                        value="{{ $home_page_banner_three->banner_one->image_one }}">
                    @if ($errors->has('image_one'))
                        <code>{{ $errors->first('image_one') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label>URL</label>
                    <input type="text" class="form-control" name="url_one"
                        value="{{ $home_page_banner_three->banner_one->url_one }}">
                    @if ($errors->has('url_one'))
                        <code>{{ $errors->first('url_one') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <select id="" class="form-control" name="status_one">
                        <option {{ $home_page_banner_three->banner_one->status_one == 1 ? 'selected' : '' }}
                            value="1">Hiển thị</option>
                        <option {{ $home_page_banner_three->banner_one->status_one == 0 ? 'selected' : '' }}
                            value="0">Ẩn</option>
                    </select>
                    @if ($errors->has('status_one'))
                        <code>{{ $errors->first('status_one') }}</code>
                    @endif
                </div>
                <hr>

                <h5>Banner 2</h5>
                <div class="form-group text-center">
                    <img class="w-50" src="{{ asset($home_page_banner_three->banner_two->image_two) }}"
                        alt="image">
                </div>

                <div class="form-group">
                    <label>Ảnh</label>
                    <input type="file" class="form-control" name="image_two">
                    <input type="hidden" class="form-control" name="old_image_two"
                        value="{{ $home_page_banner_three->banner_two->image_two }}">
                    @if ($errors->has('image_two'))
                        <code>{{ $errors->first('image_two') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label>URL</label>
                    <input type="text" class="form-control" name="url_two"
                        value="{{ $home_page_banner_three->banner_two->url_two }}">
                    @if ($errors->has('url_two'))
                        <code>{{ $errors->first('url_two') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <select id="" class="form-control" name="status_two">
                        <option {{ $home_page_banner_three->banner_two->status_two == 1 ? 'selected' : '' }}
                            value="1">Hiển thị</option>
                        <option {{ $home_page_banner_three->banner_two->status_two == 0 ? 'selected' : '' }}
                            value="0">Ẩn</option>
                    </select>
                    @if ($errors->has('status_two'))
                        <code>{{ $errors->first('status_two') }}</code>
                    @endif
                </div>
                <hr>


                <h5>Banner 3</h5>
                <div class="form-group text-center">
                    <img class="w-50" src="{{ asset($home_page_banner_three->banner_three->image_three) }}"
                        alt="image">
                </div>

                <div class="form-group">
                    <label>Ảnh</label>
                    <input type="file" class="form-control" name="image_three">
                    <input type="hidden" class="form-control" name="old_image_three"
                        value="{{ $home_page_banner_three->banner_three->image_three }}">
                    @if ($errors->has('image_three'))
                        <code>{{ $errors->first('image_three') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label>URL</label>
                    <input type="text" class="form-control" name="url_three"
                        value="{{ $home_page_banner_three->banner_three->url_three }}">
                    @if ($errors->has('url_three'))
                        <code>{{ $errors->first('url_three') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <select id="" class="form-control" name="status_three">
                        <option {{ $home_page_banner_three->banner_three->status_three == 1 ? 'selected' : '' }}
                            value="1">Hiển thị</option>
                        <option {{ $home_page_banner_three->banner_three->status_three == 0 ? 'selected' : '' }}
                            value="0">Ẩn</option>
                    </select>
                    @if ($errors->has('status_three'))
                        <code>{{ $errors->first('status_three') }}</code>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
