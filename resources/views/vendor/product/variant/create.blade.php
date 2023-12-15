@extends('vendor.layouts.master')

@section('title')
  Sản phẩm
@endsection

@section('content')
     <!--=============================
    DASHBOARD START
  ==============================-->
  <section id="wsus__dashboard">
    <div class="container-fluid">
        
      {{-- sidebar --}}
    @include('vendor.layouts.sidebar')
      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            
              <h3>{{$product->name}}</h3>

              <div class="d-flex align-items-center justify-content-between mb-2">
                <h6>Thêm thuộc tính</h6>
                <a href="{{route('vendor.product-variant.index', ['product_id'=>$product->id])}}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Quay lại</a>
              </div>
           

              <div class="wsus__dashboard_profile">
                  <div class="wsus__dash_pro_area">
                    <form action="{{route('vendor.product-variant.store')}}" method="POST">
                        @csrf
                          <div class="form-group">
                            <label>Tên thuộc tính</label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Nhập tên">
                            @if ($errors->has('name'))
                            <code>{{$errors->first('name')}}</code>
                            @endif
                          </div>
    
                          <input type="hidden" class="form-control" name="product_id" value="{{$product->id}}" >
    
                          <div class="form-group  mt-4">
                            <label for="inputStatus">Trạng thái</label>
                            <select id="inputStatus" class="form-control" name="status">
                              <option value="1">Hiển thị</option>
                              <option value="0">Ẩn</option>
                            </select>
                          </div>
    
                          <button type="submit" class="btn btn-primary  mt-4">Thêm mới</button>
                       </form>
                  </div> 
              </div>
            </div> 
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--=============================
    DASHBOARD START
  ==============================-->
@endsection
