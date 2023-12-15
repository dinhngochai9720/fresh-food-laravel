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
                    <div class="dashboard_content mt-2 mt-md-0">

                        <h3>Địa chỉ</h3>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6>Thêm địa chỉ</h6>
                            <a href="{{ route('user.address.index') }}" class="btn btn-primary"><i
                                    class="fa-solid fa-arrow-left"></i> Quay lại</a>
                        </div>

                        <div class="wsus__dashboard_add wsus__add_address">
                            <form action="{{ route('user.address.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>Tên</label>
                                            <input type="text" placeholder="Nhập tên" name="name"
                                                value="{{ Auth::user()->name }}">
                                            @if ($errors->has('name'))
                                                <code>{{ $errors->first('name') }}</code>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>email</label>
                                            <input type="email" placeholder="Nhập email" name="email"
                                                value="{{ Auth::user()->email }}">
                                            @if ($errors->has('email'))
                                                <code>{{ $errors->first('email') }}</code>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>Điện thoại </label>
                                            <input type="text" placeholder="Nhập điện thoại" name="phone">
                                            @if ($errors->has('phone'))
                                                <code>{{ $errors->first('phone') }}</code>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>Tỉnh/Thành phố </label>
                                            <div class="wsus__topbar_select">
                                                <select class="select_2" name="city" id="city">
                                                    <option value="">Chọn Tỉnh/Thành phố</option>
                                                </select>
                                            </div>
                                            @if ($errors->has('city'))
                                                <code>{{ $errors->first('city') }}</code>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>Quận/Huyện </label>
                                            <div class="wsus__topbar_select">
                                                <select class="select_2" name="district" id="district">
                                                    <option value="">Chọn Quận/Huyện</option>
                                                </select>
                                            </div>
                                            @if ($errors->has('district'))
                                                <code>{{ $errors->first('district') }}</code>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-md-6">
                                        <div class="wsus__add_address_single">
                                            <label>Phường/Xã </label>
                                            <div class="wsus__topbar_select">
                                                <select class="select_2" name="ward" id="ward">
                                                    <option value="">Chọn Phường/Xã</option>
                                                </select>
                                            </div>
                                            @if ($errors->has('ward'))
                                                <code>{{ $errors->first('ward') }}</code>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-xl-12 col-md-12">
                                        <div class="wsus__add_address_single">
                                            <label>Địa chỉ </label>
                                            <input type="text" placeholder="Nhập địa chỉ" name="address">
                                            @if ($errors->has('address'))
                                                <code>{{ $errors->first('address') }}</code>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <button type="submit" class="common_btn">Thêm mới</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{-- select city/district/ward --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        var citis = document.getElementById("city");
        var districts = document.getElementById("district");
        var wards = document.getElementById("ward");
        var Parameter = {
            url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
            method: "GET",
            responseType: "application/json",
        };
        var promise = axios(Parameter);
        promise.then(function(result) {
            renderCity(result.data);
        });

        function renderCity(data) {
            for (const x of data) {
                citis.options[citis.options.length] = new Option(x.Name, x.Name);
            }
            citis.onchange = function() {
                district.length = 1;
                ward.length = 1;
                if (this.value != "") {
                    const result = data.filter(n => n.Name === this.value);

                    for (const k of result[0].Districts) {
                        district.options[district.options.length] = new Option(k.Name, k.Name);
                    }
                }
            };
            district.onchange = function() {
                ward.length = 1;
                const dataCity = data.filter((n) => n.Name === citis.value);
                if (this.value != "") {
                    const dataWards = dataCity[0].Districts.filter(n => n.Name === this.value)[0].Wards;

                    for (const w of dataWards) {
                        wards.options[wards.options.length] = new Option(w.Name, w.Name);
                    }
                }
            };
        }
    </script>
@endpush
