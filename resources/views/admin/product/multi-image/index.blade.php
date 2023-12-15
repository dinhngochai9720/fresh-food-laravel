@extends('admin.layouts.master')

@section('title')
    Sản phẩm
@endsection

@section('content')
        <section class="section">
          <div class="section-header">
            <h1>{{$product->name}}</h1>
           

          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Danh sách ảnh</h4>
                    <a class="btn btn-primary" href="{{route('admin.product.index')}}"><i class="fa-solid fa-arrow-left"></i> Quay lại</a>
                  </div>
                 
                  <div class="card-body">
                   <form action="{{route('admin.product-multi-image.store')}}" method="POST" enctype="multipart/form-data">
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
                      <button type="submit" class="btn btn-primary mb-4">Tải lên</button>
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
                              <a href="{{route('admin.product-multi-image.destroy', $image->id)}}" class='btn btn-danger' id='delete-item'><i class='fa-regular fa-trash-can'></i></a>
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
