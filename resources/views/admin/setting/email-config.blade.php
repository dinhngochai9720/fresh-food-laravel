<div class="tab-pane fade" id="email-config" role="tabpanel" aria-labelledby="email-configs">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.email-config-setting.update', 1) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <input id="inputEmail" type="text" class="form-control"
                        value="{{ $email_config_setting->email }}" name="email">
                    @if ($errors->has('email'))
                        <code>{{ $errors->first('email') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label for="inputMailHost">Mail Host</label>
                    <input id="inputMailHost" type="text" class="form-control"
                        value="{{ $email_config_setting->mail_host }}" name="mail_host">
                    @if ($errors->has('mail_host'))
                        <code>{{ $errors->first('mail_host') }}</code>
                    @endif
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputUsernameSMTP">Username SMTP</label>
                            <input id="inputUsernameSMTP" type="text" class="form-control"
                                value="{{ $email_config_setting->username_smtp }}" name="username_smtp">
                            @if ($errors->has('username_smtp'))
                                <code>{{ $errors->first('username_smtp') }}</code>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputPasswordSMTP">Password SMTP</label>
                            <input id="inputPasswordSMTP" type="text" class="form-control"
                                value="{{ $email_config_setting->password_smtp }}" name="password_smtp">
                            @if ($errors->has('password_smtp'))
                                <code>{{ $errors->first('password_smtp') }}</code>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputMailPort">Mail Port</label>
                            <input id="inputMailPort" type="text" class="form-control"
                                value="{{ $email_config_setting->mail_port }}" name="mail_port">
                            @if ($errors->has('mail_port'))
                                <code>{{ $errors->first('mail_port') }}</code>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputMailEncryption">Mail Encryption</label>
                            <select id="inputMailEncryption" class="form-control" name="mail_encryption">
                                <option value="">Chọn</option>
                                <option {{ $email_config_setting->mail_encryption == 'tls' ? 'selected' : '' }}
                                    value="tls">TLS
                                </option>
                                <option {{ $email_config_setting->mail_encryption == 'ssl' ? 'selected' : '' }}
                                    value="ssl">SSL
                                </option>
                            </select>
                            @if ($errors->has('mail_encryption'))
                                <code>{{ $errors->first('mail_encryption') }}</code>
                            @endif
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
