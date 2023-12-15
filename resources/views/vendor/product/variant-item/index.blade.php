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
              <h5 > {{$variant->name}}</h5>
              <a class="btn btn-primary" href="{{route('vendor.product-variant.index',['product_id'=> $product->id])}}"><i class="fa-solid fa-arrow-left"></i> Quay lại</a>
            </div>

              <div class="d-flex align-items-center justify-content-between mb-2">
                <h6>Danh sách chi tiết thuộc tính</h6>
                <a href="{{route('vendor.product-variant-item.create', ['product_id'=> $product->id, 'variant_id'=>$variant->id])}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Thêm mới</a>
              </div>
           

              <div class="wsus__dashboard_profile">
                  <div class="wsus__dash_pro_area">
                    <div class="table-responsive">
                      <table id="myDatatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                              <th>STT</th>
                              <th>Tên chi tiết thuộc tính</th>
                              <th>Giá</th>
                              <th>Mặc định</th>
                              <th>Trạng thái</th>
                              <th>Sửa/Xóa</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($variant->variantItems as $key => $variant_item )
                            <tr>
                              <td>{{$key+1}}</td>
                              <td>{{$variant_item->name}}</td>
                              <td>{{number_format($variant_item->price, 0, '.', '.') . 'đ'}}</td>
                              <td>
                                @if ($variant_item->is_default == 1) 
                                  <span class="rounded-pill badge bg-success">có</span>
                                @elseif ($variant_item->is_default == 0)
                                  <span class="rounded-pill badge bg-secondary">không</span>
                              @endif
                              </td>
                              <td>
                                @if ($variant_item->status == 1) 
                                    <div class="form-check form-switch" >
                                      <input style="border-radius:2em !important;" checked class="change-status form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" data-id="{{$variant_item->id}}">
                                    </div>
                                @else 
                                  <div class="form-check form-switch">
                                      <input style="border-radius:2em !important;"   class="change-status form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" data-id="{{$variant_item->id}}">
                                    </div>
                                @endif
                              </td>
                              <td>
                                <div class="d-flex">
                                  <a href="{{route('vendor.product-variant-item.edit', $variant_item->id)}}" class='btn btn-primary me-2'><i class='fa-regular fa-pen-to-square'></i></a>
                                  <a href="{{route('vendor.product-variant-item.destroy', $variant_item->id)}}" class='btn btn-danger' id='delete-item'><i class='fa-regular fa-trash-can'></i></a>
                                </div>
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

@push('scripts')
<script>
  $(document).ready(function(){
    $('body').on('click', '.change-status', function(){
      // Check status button is checked or not checked
      let isChecked= $(this).is(':checked'); //if checked return true or not checked return false
      // console.log(isChecked);
      
      // Get id of status button (id of variant_item)
      let variant_item_id=$(this).data('id')
  
      $.ajax({
        url:"{{route('vendor.product-variant-item.change-status')}}",
        method:'PUT',
        data:{
          status: isChecked,
          id: variant_item_id
        },
        success:function (data) {
          // console.log(data);
          toastr.success(data.message);
          
        },
        error: function (xhr, status, error){
          console.log(error);
        }
      })
    })
  });
  </script>
@endpush