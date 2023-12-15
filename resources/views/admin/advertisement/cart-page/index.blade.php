<div class="tab-pane fade" id="cart-page-banner" role="tabpanel" aria-labelledby="cart-page-banners">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.advertisement.cart-page-banner') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <h5>Banner 1</h5>
                <div class="form-group text-center">
                    <img class="w-50" src="{{ asset($cart_page_banner->banner_one->image_one) }}" alt="image">
                </div>

                <div class="form-group">
                    <label>Ảnh</label>
                    <input type="file" class="form-control" name="image_one">
                    <input type="hidden" class="form-control" name="old_image_one"
                        value="{{ $cart_page_banner->banner_one->image_one }}">
                    @if ($errors->has('image_one'))
                        <code>{{ $errors->first('image_one') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label>URL</label>
                    <input type="text" class="form-control" name="url_one"
                        value="{{ $cart_page_banner->banner_one->url_one }}">
                    @if ($errors->has('url_one'))
                        <code>{{ $errors->first('url_one') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <select id="" class="form-control" name="status_one">
                        <option {{ $cart_page_banner->banner_one->status_one == 1 ? 'selected' : '' }} value="1">
                            Hiển thị</option>
                        <option {{ $cart_page_banner->banner_one->status_one == 0 ? 'selected' : '' }} value="0">
                            Ẩn</option>
                    </select>
                    @if ($errors->has('status_one'))
                        <code>{{ $errors->first('status_one') }}</code>
                    @endif
                </div>
                <hr>

                <h5>Banner 2</h5>
                <div class="form-group text-center">
                    <img class="w-50" src="{{ asset($cart_page_banner->banner_two->image_two) }}" alt="image">
                </div>

                <div class="form-group">
                    <label>Ảnh</label>
                    <input type="file" class="form-control" name="image_two">
                    <input type="hidden" class="form-control" name="old_image_two"
                        value="{{ $cart_page_banner->banner_two->image_two }}">
                    @if ($errors->has('image_two'))
                        <code>{{ $errors->first('image_two') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label>URL</label>
                    <input type="text" class="form-control" name="url_two"
                        value="{{ $cart_page_banner->banner_two->url_two }}">
                    @if ($errors->has('url_two'))
                        <code>{{ $errors->first('url_two') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <select id="" class="form-control" name="status_two">
                        <option {{ $cart_page_banner->banner_two->status_two == 1 ? 'selected' : '' }} value="1">
                            Hiển thị</option>
                        <option {{ $cart_page_banner->banner_two->status_two == 0 ? 'selected' : '' }} value="0">
                            Ẩn</option>
                    </select>
                    @if ($errors->has('status_two'))
                        <code>{{ $errors->first('status_two') }}</code>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
