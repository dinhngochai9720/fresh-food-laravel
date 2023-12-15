@extends('admin.layouts.master')

@section('title')
    Email đăng ký
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Email đăng ký</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Gửi email</h4>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.subscriber.send-mail') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Chủ đề</label>
                                    <input type="text" class="form-control" name="subject">
                                    @if ($errors->has('subject'))
                                        <code>{{ $errors->first('subject') }}</code>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="">Nội dung</label>
                                    <textarea class="summernote" name="content"></textarea>
                                    @if ($errors->has('content'))
                                        <code>{{ $errors->first('content') }}</code>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary">Gửi</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Danh sách email đăng ký</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myDatatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Email</th>
                                            <th>Trạng thái</th>
                                            <th>Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subscribers as $key => $subscriber)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $subscriber->email }}</td>
                                                <td>
                                                    @if ($subscriber->is_verified == 1)
                                                        <span class="badge badge-success">Đã xác nhận</span>
                                                    @elseif($subscriber->is_verified == 0)
                                                        <span class="badge badge-warning">Chưa xác nhận</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.subscriber.destroy', $subscriber->id) }}"
                                                        class='btn btn-danger ml-2' id='delete-item'><i
                                                            class='fa-regular fa-trash-can'></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
