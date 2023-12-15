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

            <div class="d-flex justify-content-between align-items-center mb-2">
              <h6>Danh sách ảnh sản phẩm</h6>
              <a class="btn btn-primary" href="{{route('vendor.product.index')}}"><i class="fa-solid fa-arrow-left"></i> Quay lại</a>
            </div>
           
              <div class="wsus__dashboard_profile">
                  <div class="wsus__dash_pro_area">
                    <form action="{{route('vendor.product-multi-image.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Chọn nhiều ảnh</label>
                            <input type="file" name="image[]" class="form-control" multiple>
                            @if ($errors->has('image'))
                              <code>{{$errors->first('image')}}</code>
                            @endif
                            @if ($errors->has('image.*'))
                                <code>{{$errors->first('image.*')}}</code>
                            @endif
    
                            {{-- get id of product --}}
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                          </div>
    
                        <button type="submit" class="btn btn-primary mt-2 mb-4">Tải lên</button>
                      </form>

                    <div class="table-responsive">
                      <table id="myDatatable" class="table table-striped table-bordered" style="width:100%">
                          <thead>
                              <tr>
                                  <th>STT</th>
                                  <th>Ảnh</th>
                                  <th>Xóa</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($product->images as $key => $image )
                              <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                  <img class='border rounded' width='100px' height='100px' src='{{asset($image->image)}}'/>
                                </td>
                                <td>
                                  <a href="{{route('vendor.product-multi-image.destroy', $image->id)}}" class='btn btn-danger' id='delete-item'><i class='fa-regular fa-trash-can'></i></a>
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
      </div>
    </div>
  </section>
  <!--=============================
    DASHBOARD START
  ==============================-->
@endsection
