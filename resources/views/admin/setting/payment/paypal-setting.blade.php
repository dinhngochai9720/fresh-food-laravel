<div class="tab-pane fade" id="paypal-setting" role="tabpanel" aria-labelledby="paypal-settings">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.paypal-setting.update', 1) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="inputStatus">Trạng thái thanh toán</label>
                    <select id="inputStatus" class="form-control" name="status">
                        <option value="">Chọn</option>
                        <option {{ $paypal_setting->status == '0' ? 'selected' : '' }} value="0">Không cho phép
                        </option>
                        <option {{ $paypal_setting->status == '1' ? 'selected' : '' }} value="1">Cho phép</option>
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
                        <option {{ $paypal_setting->account_mode == '0' ? 'selected' : '' }} value="0">Sandbox
                        </option>
                        {{-- live --}}
                        <option {{ $paypal_setting->account_mode == '1' ? 'selected' : '' }} value="1">Live
                        </option>
                    </select>
                    @if ($errors->has('account_mode'))
                        <code>{{ $errors->first('account_mode') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label for="inputCountry">Quốc gia</label>
                    {{-- <select id="inputCountry" class="form-control select2" name="country_name">
                        <option value="">Chọn</option>
                        @foreach (config('settings.country_list') as $country)
                            <option {{ $paypal_setting->country_name == $country ? 'selected' : '' }}
                                value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select> --}}
                    {{-- @if ($errors->has('country_name'))
                        <code>{{ $errors->first('country_name') }}</code>
                    @endif --}}
                    <input type="text" class="form-control" value="United States" name="country_name" readonly>
                </div>

                <div class="form-group">
                    <label for="inputCurrency">Tiền tệ</label>
                    {{-- <select id="inputCurrency" class="form-control select2" name="currency_name">
                        <option value="">Chọn</option>
                        @foreach (config('settings.currency_list') as $curency)
                            <option {{ $paypal_setting->currency_name == $curency ? 'selected' : '' }}
                                value="{{ $curency }}">{{ $curency }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('currency_name'))
                        <code>{{ $errors->first('currency_name') }}</code>
                    @endif --}}

                    <input type="text" class="form-control" value="USD" name="currency_name" readonly>
                </div>

                <div class="form-group">
                    <label>Tỷ giá (1 USD)</label>
                    <input type="text" class="form-control" value="{{ $paypal_setting->currency_rate }}"
                        name="currency_rate" placeholder="Nhập">
                    @if ($errors->has('currency_rate'))
                        <code>{{ $errors->first('currency_rate') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label>Paypal Client ID</label>
                    <input type="text" class="form-control" value="{{ $paypal_setting->client_id }}" name="client_id"
                        placeholder="Nhập">
                    @if ($errors->has('client_id'))
                        <code>{{ $errors->first('client_id') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label>Paypal Secret Key</label>
                    <input type="text" class="form-control" value="{{ $paypal_setting->secret_key }}"
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
