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

              <div class="text-end mb-2">
                <a class="btn btn-primary" href="{{route('vendor.product.index')}}"><i class="fa-solid fa-arrow-left"></i> Quay lại</a>
              </div>
            
              <div class="d-flex align-items-center justify-content-between mb-2">
                <h6>Danh sách thuộc tính</h6>
                <a href="{{route('vendor.product-variant.create', ['product_id'=>$product->id])}}" class="btn btn-primary "><i class="fa-solid fa-plus"></i> Thêm mới</a>
              </div>
           

              <div class="wsus__dashboard_profile">
                  <div class="wsus__dash_pro_area">
                    <div class="d-flex justify-content-end mb-2">
                      
                    </div>
                   
                    <div class="table-responsive">
                      <table id="myDatatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                              <th>STT</th>
                              <th>Tên thuộc tính</th>
                              <th>Trạng thái</th>
                              <th>Thêm/Sửa/Xóa</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($product->variants as $key => $variant )
                          <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$variant->name}}</td>
                            <td>
                              @if ($variant->status == 1) 
                                  <div class="form-check form-switch" >
                                    <input style="border-radius:2em !important;" checked class="change-status form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" data-id="{{$variant->id}}">
                                  </div>
                              @else 
                                <div class="form-check form-switch">
                                    <input style="border-radius:2em !important;"   class="change-status form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" data-id="{{$variant->id}}">
                                  </div>
                              @endif
                            </td>
                            <td>
                              <div class="d-flex">
                                <a href="{{route('vendor.product-variant-item.index', ['product_id' => request()->product_id, 'variant_id' => $variant->id])}}" class='btn btn-success'><i class='fas fa-plus'></i></a>
                                <a href="{{route('vendor.product-variant.edit', $variant->id)}}" class='btn btn-primary ms-2 me-2'><i class='fa-regular fa-pen-to-square'></i></a>
                                <a href="{{route('vendor.product-variant.destroy', $variant->id)}}" class='btn btn-danger' id='delete-item'><i class='fa-regular fa-trash-can'></i></a>
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
      
      // Get id of status button (id of variant)
      let variant_id=$(this).data('id')
  
      $.ajax({
        url:"{{route('vendor.product-variant.change-status')}}",
        method:'PUT',
        data:{
          status: isChecked,
          id: variant_id
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