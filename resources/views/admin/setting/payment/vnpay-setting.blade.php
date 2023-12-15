<div class="tab-pane fade" id="vnpay-setting" role="tabpanel" aria-labelledby="vnpay-settings">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.vnpay-setting.update', 1) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="inputStatus">Trạng thái thanh toán</label>
                    <select id="inputStatus" class="form-control" name="status">
                        <option value="">Chọn</option>
                        <option {{ $vnpay_setting->status == '0' ? 'selected' : '' }} value="0">Không cho phép
                        </option>
                        <option {{ $vnpay_setting->status == '1' ? 'selected' : '' }} value="1">Cho phép</option>
                    </select>
                    @if ($errors->has('status'))
                        <code>{{ $errors->first('status') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label>VNPay TMNCODE</label>
                    <input type="text" class="form-control" value="{{ $vnpay_setting->tmncode }}" name="tmncode"
                        placeholder="Nhập">
                    @if ($errors->has('tmncode'))
                        <code>{{ $errors->first('tmncode') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label>VNPay HASHSECRET</label>
                    <input type="text" class="form-control" value="{{ $vnpay_setting->hashsecret }}"
                        name="hashsecret" placeholder="Nhập">
                    @if ($errors->has('hashsecret'))
                        <code>{{ $errors->first('hashsecret') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label>VNPay URL</label>
                    <input type="text" class="form-control" value="{{ $vnpay_setting->url }}" name="url"
                        placeholder="Nhập">
                    @if ($errors->has('url'))
                        <code>{{ $errors->first('url') }}</code>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
