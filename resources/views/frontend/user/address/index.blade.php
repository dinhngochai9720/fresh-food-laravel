@extends('frontend.user.layouts.master')

@section('title')
    Địa chỉ
@endsection

@section('content')
    <section id="wsus__dashboard">
        <div class="container-fluid">

            {{-- sidebar --}}
            @include('frontend.user.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content">
                        <h3> Địa chỉ</h3>

                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6>Danh sách địa chỉ</h6>
                            <a href="{{ route('user.address.create') }}" class="btn btn-primary"><i
                                    class="fa-solid fa-plus"></i> Thêm mới</a>
                        </div>



                        <div class="wsus__dashboard_add">
                            <div class="row">
                                @if ($addresses->count() == 0)
                                    <p class="text-center">Không có địa chỉ</p>
                                @else
                                    @foreach ($addresses as $key => $address)
                                        <div class="col-xl-6">
                                            <div class="wsus__dash_add_single">
                                                <h4>Địa chỉ {{ $key + 1 }} </h4>
                                                <ul>
                                                    <li><span>Tên:</span> {{ $address->name }}</li>
                                                    <li><span>Email:</span> {{ $address->email }}</li>
                                                    <li><span>Điện thoại:</span>{{ $address->phone }}</li>
                                                    <li><span>Tỉnh/thành phố:</span> {{ $address->city }}</li>
                                                    <li><span>Quận/huyện:</span> {{ $address->district }}</li>
                                                    <li><span>Xã/phường:</span> {{ $address->ward }}</li>
                                                    <li><span>Địa chỉ:</span> {{ $address->address }}</li>
                                                </ul>
                                                <div class="wsus__address_btn">
                                                    <a href="{{ route('user.address.edit', $address->id) }}"
                                                        class="edit"><i class="fal fa-edit"></i>
                                                        Sửa</a>
                                                    <a href="{{ route('user.address.destroy', $address->id) }}"
                                                        id="delete-item" class="del"><i class="fal fa-trash-alt"></i>
                                                        Xóa</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
