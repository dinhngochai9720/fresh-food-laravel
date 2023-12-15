@extends('admin.layouts.master')

@section('title')
    Mạng xã hội
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1> Mạng xã hội</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.footer-social.update', 1) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Facebook</label>
                                    <input type="text" class="form-control" name="facebook_link"
                                        value="{{ $footer_social->facebook_link }}" placeholder="Nhập link">
                                    @if ($errors->has('facebook_link'))
                                        <code>{{ $errors->first('facebook_link') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Youtube</label>
                                    <input type="text" class="form-control" name="youtube_link"
                                        value="{{ $footer_social->youtube_link }}" placeholder="Nhập link">
                                    @if ($errors->has('youtube_link'))
                                        <code>{{ $errors->first('youtube_link') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Instagram</label>
                                    <input type="text" class="form-control" name="instagram_link"
                                        value="{{ $footer_social->instagram_link }}" placeholder="Nhập link">
                                    @if ($errors->has('instagram_link'))
                                        <code>{{ $errors->first('instagram_link') }}</code>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
