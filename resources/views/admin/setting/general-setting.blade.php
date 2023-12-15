<div class="tab-pane fade show active" id="gerenal-setting" role="tabpanel" aria-labelledby="gerenal-settings">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.general-setting.update', 1) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Tên website</label>

                    <input type="text" class="form-control" name="site_name"
                        value="{{ $general_setting->site_name }}">
                    @if ($errors->has('site_name'))
                        <code>{{ $errors->first('site_name') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label>Logo</label>
                    <div class="form-group d-flex justify-content-center align-items-center">
                        <img src="{{ asset($general_setting->logo) }}" alt="img" class="w-25 border rounded"
                            height="100px">
                    </div>
                    <input type="file" class="form-control" name="logo">
                    @if ($errors->has('logo'))
                        <code>{{ $errors->first('logo') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label>Logo footer</label>
                    <div class="form-group d-flex justify-content-center align-items-center">
                        <img src="{{ asset($general_setting->logo_footer) }}" alt="img" class="w-25 border rounded"
                            height="100px">
                    </div>

                    <input type="file" class="form-control" name="logo_footer">
                    @if ($errors->has('logo_footer'))
                        <code>{{ $errors->first('logo_footer') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label>Favicon icon</label>
                    <div class="form-group d-flex justify-content-center align-items-center">
                        <img src="{{ asset($general_setting->favicon_icon) }}" alt="img"
                            class="w-25 border rounded" height="100px">
                    </div>
                    <input type="file" class="form-control" name="favicon_icon">
                    @if ($errors->has('favicon_icon'))
                        <code>{{ $errors->first('favicon_icon') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label>Email liên hệ</label>
                    <input type="text" class="form-control" name="email_contact"
                        value="{{ $general_setting->email_contact }}">
                    @if ($errors->has('email_contact'))
                        <code>{{ $errors->first('email_contact') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label>Tổng đài liên hệ</label>
                    <input type="number" class="form-control" name="phone_contact"
                        value="{{ $general_setting->phone_contact }}">
                    @if ($errors->has('phone_contact'))
                        <code>{{ $errors->first('phone_contact') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" class="form-control" name="address" value="{{ $general_setting->address }}">
                    @if ($errors->has('address'))
                        <code>{{ $errors->first('address') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label>Facebook</label>
                    <input type="text" class="form-control" name="facebook_link"
                        value="{{ $general_setting->facebook_link }}">
                    @if ($errors->has('facebook_link'))
                        <code>{{ $errors->first('facebook_link') }}</code>
                    @endif
                </div>


                <div class="form-group">
                    <label>Youtube</label>
                    <input type="text" class="form-control" name="youtube_link"
                        value="{{ $general_setting->youtube_link }}">
                    @if ($errors->has('youtube_link'))
                        <code>{{ $errors->first('youtube_link') }}</code>
                    @endif
                </div>


                <div class="form-group">
                    <label>Instagram</label>
                    <input type="text" class="form-control" name="instagram_link"
                        value="{{ $general_setting->instagram_link }}">
                    @if ($errors->has('instagram_link'))
                        <code>{{ $errors->first('instagram_link') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label for="inputCurrency">Tiền tệ</label>
                    <select id="inputCurrency" class="form-control select2" name="currency_name">
                        <option value="">Chọn</option>

                        {{-- config('settings.currency_list') is config/settings.php --}}
                        @foreach (config('settings.currency_list') as $currency)
                            <option {{ $general_setting->currency_name == $currency ? 'selected' : '' }}
                                value="{{ $currency }}">{{ $currency }}</option>
                        @endforeach

                    </select>
                    @if ($errors->has('currency_name'))
                        <code>{{ $errors->first('currency_name') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label>Ký hiệu tiền tệ</label>
                    <input type="text" class="form-control" name="currency_icon"
                        value="{{ $general_setting->currency_icon }}">
                    @if ($errors->has('currency_icon'))
                        <code>{{ $errors->first('currency_icon') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label for="inputTimezone">Múi giờ</label>
                    <select id="inputTimezone" class="form-control select2" name="time_zone">
                        <option value="">Chọn</option>

                        {{-- config('settings.time_zone') is config/settings.php --}}
                        @foreach (config('settings.time_zone') as $key => $time_zone)
                            <option {{ $general_setting->time_zone == $key ? 'selected' : '' }}
                                value="{{ $key }}">{{ $key }}</option>
                        @endforeach
                        {{-- Change timezone in AppServiceProvider.php --}}
                    </select>
                    @if ($errors->has('time_zone'))
                        <code>{{ $errors->first('time_zone') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label>Copyright</label>
                    <input type="text" class="form-control" name="copyright"
                        value="{{ $general_setting->copyright }}">
                    @if ($errors->has('copyright'))
                        <code>{{ $errors->first('copyright') }}</code>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
