@extends('admin.layouts.master')

@section('title')
    Sản phẩm
@endsection

@section('content')
     <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>{{$product->name}}</h1>
            {{-- <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Trang chủ</a></div>
              <div class="breadcrumb-item"><a href="#">Quản lý website</a></div>
              <div class="breadcrumb-item">Slider</div>
            </div> --}}
          </div>

          <div class="section-body">
         
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Thêm thuộc tính</h4>
                    <div class="card-header-action">
                        <a class="btn btn-primary" href="{{route('admin.product-variant.index', ["product_id" => $product->id])}}"><i class="fa-solid fa-arrow-left"></i> Quay lại</a>
                    </div>
                  </div>
                  <div class="card-body">
                   <form action="{{route('admin.product-variant.store')}}" method="POST">
                    @csrf

                      <div class="form-group">
                        <label>Tên thuộc tính</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Nhập tên">
                        @if ($errors->has('name'))
                        <code>{{$errors->first('name')}}</code>
                        @endif
                      </div>

                      <input type="hidden" class="form-control" name="product_id" value="{{$product->id}}" >

                      <div class="form-group">
                        <label for="inputStatus">Trạng thái</label>
                        <select id="inputStatus" class="form-control" name="status">
                          <option value="1">Hiển thị</option>
                          <option value="0">Ẩn</option>
                        </select>
                      </div>

                      <button type="submit" class="btn btn-primary">Thêm mới</button>
                   </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
@endsection

