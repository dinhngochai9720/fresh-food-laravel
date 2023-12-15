<div class="tab-pane fade" id="stripe-setting" role="tabpanel" aria-labelledby="stripe-settings">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.stripe-setting.update', 1) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="inputStatus">Trạng thái thanh toán</label>
                    <select id="inputStatus" class="form-control" name="status">
                        <option value="">Chọn</option>
                        <option {{ $stripe_setting->status == '0' ? 'selected' : '' }} value="0">Không cho phép
                        </option>
                        <option {{ $stripe_setting->status == '1' ? 'selected' : '' }} value="1">Cho phép</option>
                    </select>
                    @if ($errors->has('status'))
                        <code>{{ $errors->first('status') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label for="inputAccountMode">Chế độ tài khoản</label>
                    <select id="inputAccountMode" class="form-control" name="account_mode">
                        <option value="">Chọn</option>
                        {{-- localhost  --}}
                        <option {{ $stripe_setting->account_mode == '0' ? 'selected' : '' }} value="0">Sandbox
                        </option>
                        {{-- live --}}
                        <option {{ $stripe_setting->account_mode == '1' ? 'selected' : '' }} value="1">Live
                        </option>
                    </select>
                    @if ($errors->has('account_mode'))
                        <code>{{ $errors->first('account_mode') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label for="inputCountry">Quốc gia</label>
                    <input type="text" class="form-control" value="United States" name="country_name" readonly>
                </div>

                <div class="form-group">
                    <label for="inputCurrency">Tiền tệ</label>
                    <input type="text" class="form-control" value="USD" name="currency_name" readonly>
                </div>

                <div class="form-group">
                    <label>Tỷ giá (1 USD)</label>
                    <input type="text" class="form-control" value="{{ $stripe_setting->currency_rate }}"
                        name="currency_rate" placeholder="Nhập">
                    @if ($errors->has('currency_rate'))
                        <code>{{ $errors->first('currency_rate') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label>Stripe Client ID</label>
                    <input type="text" class="form-control" value="{{ $stripe_setting->client_id }}" name="client_id"
                        placeholder="Nhập">
                    @if ($errors->has('client_id'))
                        <code>{{ $errors->first('client_id') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label>Stripe Secret Key</label>
                    <input type="text" class="form-control" value="{{ $stripe_setting->secret_key }}"
                        name="secret_key" placeholder="Nhập">
                    @if ($errors->has('secret_key'))
                        <code>{{ $errors->first('secret_key') }}</code>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
