@extends('admin.layouts.master')

@section('title')
    Sản phẩm
@endsection

@section('content')
        <section class="section">
          <div class="section-header">
            <h1>{{$variant->product->name}}</h1>
           
          </div>

          <div class="section-body">
         
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Sửa thuộc tính</h4>
                    <div class="card-header-action">
                        <a class="btn btn-primary" href="{{route('admin.product-variant.index', ["product_id"=>$variant->product_id])}}"><i class="fa-solid fa-arrow-left"></i> Quay lại</a>
                    </div>
                  </div>
                  <div class="card-body">
                   <form action="{{route('admin.product-variant.update',$variant->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                      <div class="form-group">
                        <label>Tên thuộc tính</label>
                        <input type="text" class="form-control" name="name" value="{{$variant->name}}" placeholder="Nhập tên">
                        @if ($errors->has('name'))
                        <code>{{$errors->first('name')}}</code>
                        @endif
                      </div>

                      <div class="form-group">
                        <label for="inputStatus">Trạng thái</label>
                        <select id="inputStatus" class="form-control" name="status">
                          <option {{$variant->status == 1 ? "selected" : ""}} value="1">Hiển thị</option>
                          <option {{$variant->status == 0 ? "selected" : ""}} value="0">Ẩn</option>
                        </select>
                      </div>

                      <button type="submit" class="btn btn-primary">Cập nhật</button>
                   </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
@endsection

