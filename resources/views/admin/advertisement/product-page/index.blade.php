<div class="tab-pane fade" id="product-page-banner" role="tabpanel" aria-labelledby="product-page-banners">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.advertisement.product-page-banner') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <img class="w-100" src="{{ asset($product_page_banner->banner_one->image) }}" alt="image">
                </div>

                <div class="form-group">
                    <label>Ảnh</label>
                    <input type="file" class="form-control" name="image">
                    <input type="hidden" class="form-control" name="old_image"
                        value="{{ $product_page_banner->banner_one->image }}">
                    @if ($errors->has('image'))
                        <code>{{ $errors->first('image') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label>URL</label>
                    <input type="text" class="form-control" name="url"
                        value="{{ $product_page_banner->banner_one->url }}">
                    @if ($errors->has('url'))
                        <code>{{ $errors->first('url') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label for="inputStatus">Trạng thái</label>
                    <select id="inputStatus" class="form-control" name="status">
                        <option {{ $product_page_banner->banner_one->status == 1 ? 'selected' : '' }} value="1">
                            Hiển thị
                        </option>
                        <option {{ $product_page_banner->banner_one->status == 0 ? 'selected' : '' }} value="0">
                            Ẩn</option>
                    </select>
                    @if ($errors->has('status'))
                        <code>{{ $errors->first('status') }}</code>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
