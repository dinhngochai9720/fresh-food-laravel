<div class="tab-pane fade" id="pusher-setting" role="tabpanel" aria-labelledby="pusher-settings">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.pusher-setting.update', 1) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="app_id">App ID</label>
                    <input id="app_id" type="text" class="form-control" value="{{ $pusher_setting->app_id }}"
                        name="app_id">
                    @if ($errors->has('app_id'))
                        <code>{{ $errors->first('app_id') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label for="key">Key</label>
                    <input id="key" type="text" class="form-control" value="{{ $pusher_setting->key }}"
                        name="key">
                    @if ($errors->has('key'))
                        <code>{{ $errors->first('key') }}</code>
                    @endif
                </div>


                <div class="form-group">
                    <label for="secret">Secret</label>
                    <input id="secret" type="text" class="form-control" value="{{ $pusher_setting->secret }}"
                        name="secret">
                    @if ($errors->has('secret'))
                        <code>{{ $errors->first('secret') }}</code>
                    @endif
                </div>

                <div class="form-group">
                    <label for="cluster">Cluster</label>
                    <input id="cluster" type="text" class="form-control" value="{{ $pusher_setting->cluster }}"
                        name="cluster">
                    @if ($errors->has('cluster'))
                        <code>{{ $errors->first('cluster') }}</code>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
