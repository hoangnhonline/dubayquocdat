@extends('layout')
@section('content')
<div class="content-wrapper">
  
  <!-- Content Header (Page header) -->
  <section class="content-header">
  <h1 style="text-transform: uppercase;">  
      Đặt Xe Đà Nẵng : cập nhật <span style="color: red">PTX{{ $detail->id }}</span>
    </h1>    
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="{{ route('booking-car-dn.index') }}" style="margin-bottom:5px">Quay lại</a>
    <a class="btn btn-success btn-sm" href="{{ route('booking-car-dn.index') }}" style="margin-bottom:5px">Xem danh sách booking</a>
    <a href="{{ route('drivers.create') }}" class="btn btn-primary btn-sm" style="margin-bottom:5px">Thêm đối tác xe</a>
     
    <form role="form" method="POST" action="{{ route('booking-car-dn.update-car') }}" id="dataForm">
      <input type="hidden" name="id" value="{{ $detail->id }}">
    <div class="row">
      <!-- left column -->

      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          
          <!-- /.box-header -->               
            {!! csrf_field() !!}

            <div class="box-body">
              @if (count($errors) > 0)
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif                
              <input type="hidden" name="type" value="4">
              <div class="row">
                <div class="form-group col-md-6" >
                   <label>Đối tác xe</label>
                  <select class="form-control select2" id="driver_id" name="driver_id">     
                    <option value="">--Chọn--</option>                
                      @foreach($driverList as $driver)
                      <option value="{{ $driver->id }}" {{ old('driver_id', $detail->driver_id) == $driver->id  ? "selected" : "" }}>{{ $driver->name }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group col-md-6">
                   <label>Trạng thái <span class="red-star">*</span></label>
                    <select class="form-control" name="status" id="status">                        
                      <option value="1" {{ old('status', $detail->status) == 1 ? "selected" : "" }}>Mới</option>
                      <option value="2" {{ old('status', $detail->status) == 2 ? "selected" : "" }}>Hoàn tất</option>
                      <option value="4" {{ old('status', $detail->status) == 4 ? "selected" : "" }}>Dời ngày</option>
                      <option value="3" {{ old('status', $detail->status) == 3 ? "selected" : "" }}>Hủy</option>
                    </select>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-4">                    
                  <label>Loại xe<span class="red-star">*</span></label>
                  <select class="form-control select2" id="tour_id" name="tour_id">     
                    <option value="">--Chọn--</option>                
                      @foreach($carCate as $cate)
                      <option value="{{ $cate->id }}" {{ old('tour_id', $detail->tour_id) == $cate->id  ? "selected" : "" }}>{{ $cate->name }}</option>
                      @endforeach
                  </select>
                </div>  
                @php
                    if($detail->use_date){
                        $use_date = old('use_date', date('d/m/Y', strtotime($detail->use_date)));
                    }else{
                        $use_date = old('use_date');
                    }
                  @endphp  
                <div class="form-group col-md-4" >                    
                    <label>Ngày đi <span class="red-star">*</span></label>
                    <input type="text" class="form-control datepicker" name="use_date" id="use_date" value="{{ $use_date }}" autocomplete="off">
                  </div>
                  <div class="form-group col-md-4" >                    
                    <label>Giờ đi <span class="red-star">*</span></label>
                    <input type="text" class="form-control" name="time_pickup" id="time_pickup" value="{{ old('time_pickup', $detail->time_pickup) }}" autocomplete="off">
                  </div>
                </div>
               <!--  <div class="row">
                  <div class="form-group col-sm-3 col-xs-6" >                    
                    <label>Ngày về <span class="red-star">*</span></label>
                    <input type="text" class="form-control datepicker" name="use_date_2" id="use_date_2" value="{{ old('use_date_2') }}" autocomplete="off">
                  </div>
                  <div class="form-group col-sm-3 col-xs-6" >                    
                    <label>Giờ về <span class="red-star">*</span></label>
                    <input type="text" class="form-control" name="time_pickup_2" id="time_pickup_2" value="{{ old('time_pickup_2') }}" autocomplete="off">
                  </div>
                </div> -->
              <div class="row">
                <div class="form-group col-md-4 col-xs-4">                    
                  <label>Tên KH <span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $detail->name) }}">
                </div>  
                <div class="form-group col-md-4 col-xs-4">                  
                  <label>Điện thoại <span class="red-star">*</span></label>
                  <input type="text" maxlength="20" class="form-control" name="phone" id="phone" value="{{ old('phone', $detail->phone) }}">
                </div>
                <div class="form-group col-md-4 col-xs-4">                  
                  <label>Điện thoại 2</label>
                  <input type="text"  maxlength="20" class="form-control" name="phone_1" id="phone_1" value="{{ old('phone_1', $detail->phone_1) }}">
                </div>
                </div>              
                <div class="row">
                    
                  <div class="input-group col-md-12" style="padding-left: 15px; padding-right: 15px">                  
                  <label>Nơi đón <span class="red-star">*</span></label>

                  <select class="form-control select2" name="location_id" id="location_id">
                    <option value="">--Chọn--</option>
                    @foreach($listTag as $location)        
                    <option value="{{ $location->id }}" {{ old('location_id', $detail->location_id) == $location->id ? "selected" : "" }}>{{ $location->name }}</option>
                    @endforeach
                  </select>
                  <span class="input-group-btn">
                    <button style="margin-top:24px" class="btn btn-primary btn-sm" id="btnAddTag" type="button" data-value="3">
                      Thêm
                    </button>
                  </span>
                </div>
                <div class="input-group col-md-12" style="padding-left: 15px; padding-right: 15px">                  
                  <label>Nơi trả <span class="red-star">*</span></label>

                  <select class="form-control select2" name="location_id_2" id="location_id_2">
                    <option value="">--Chọn--</option>
                    @foreach($listTag as $location)        
                    <option value="{{ $location->id }}" {{ old('location_id_2', $detail->location_id_2) == $location->id ? "selected" : "" }}>{{ $location->name }}</option>
                    @endforeach
                  </select>
                  <span class="input-group-btn">
                    <button style="margin-top:24px" class="btn btn-primary btn-sm" id="btnAddTag2" type="button" data-value="3">
                      Thêm
                    </button>
                  </span>
                </div>
                </div>                             
                <div class="row">
                  <div class="form-group col-xs-4">
                      <label>Người lớn <span class="red-star">*</span></label>
                      <select class="form-control select2" name="adults" id="adults">
                        @for($i = 1; $i <= 100; $i++)            
                        <option value="{{ $i }}" {{ old('adults', $detail->adults) == $i ? "selected" : "" }}>{{ $i }}</option>
                        @endfor
                      </select>
                  </div>
                  <div class="form-group col-xs-4">
                      <label>Trẻ em<span class="red-star">*</span></label>
                      <select class="form-control" name="childs" id="childs">
                        @for($i = 0; $i <= 10; $i++)            
                        <option value="{{ $i }}" {{ old('childs', $detail->childs) == $i ? "selected" : "" }}>{{ $i }}</option>
                        @endfor
                      </select>
                  </div>
                  <div class="form-group col-xs-4">
                      <label>Em bé</label>
                      <select class="form-control" name="infants" id="infants">
                        @for($i = 0; $i <= 10; $i++)            
                        <option value="{{ $i }}" {{ old('infants', $detail->infants) == $i ? "selected" : "" }}>{{ $i }}</option>
                        @endfor
                      </select>
                  </div>
                </div>
                <input type="hidden" name="total_price_adult">
                <input type="hidden" name="total_price_child">
                <input type="hidden" name="meals">
                <input type="hidden" name="ngay_coc">
                <input type="hidden" name="extra_fee">
                <input type="hidden" name="discount">
                <input type="hidden" name="danh_sach">
                <div class="row">
                  <div class="form-group col-xs-4">
                      <label>TỔNG TIỀN <span class="red-star">*</span></label>
                    <input type="text" class="form-control number" name="total_price" id="total_price" value="{{ old('total_price', $detail->total_price) }}">
                  </div>
                  <div class="form-group col-xs-4">
                      <label>Tiền cọc</label>
                    <input type="text" class="form-control number" name="tien_coc" id="tien_coc" value="{{ old('tien_coc', $detail->tien_coc) }}">
                  </div>
                  <div class="form-group col-xs-4" >
                      <label>Người thu cọc <span class="red-star">*</span></label>
                      <select class="form-control" name="nguoi_thu_coc" id="nguoi_thu_coc">
                        <option value="">--Chọn--</option>
                        <option value="1" {{ old('nguoi_thu_coc', $detail->nguoi_thu_coc, $detail->notes) == 1 ? "selected" : "" }}>Sales</option>
                        <option value="2" {{ old('nguoi_thu_coc', $detail->nguoi_thu_coc) == 2 ? "selected" : "" }}>CTY</option>
                      </select>
                  </div>
                  
                </div>
                <div class="row">
                  
                  <div class="form-group col-xs-4">
                      <label>CÒN LẠI <span class="red-star">*</span></label>
                      <input type="text" style="border: 1px solid red" class="form-control number" name="con_lai" id="con_lai" value="{{ old('con_lai', $detail->con_lai) }}">
                  </div>
                  <div class="form-group col-xs-4">
                      <label>Thực thu <span class="red-star">*</span></label>
                      <input type="text" style="border: 1px solid red" class="form-control number" name="tien_thuc_thu" id="tien_thuc_thu" value="{{ old('tien_thuc_thu', $detail->tien_thuc_thu) }}">
                  </div>
                  <div class="form-group col-xs-4">
                      <label>Người thu $ <span class="red-star">*</span></label>
                      <select class="form-control" name="nguoi_thu_tien" id="nguoi_thu_tien">
                        <option value="">--Chọn--</option>
                        <option value="1" {{ old('nguoi_thu_tien', $detail->nguoi_thu_tien) == 1 ? "selected" : "" }}>Sales</option>
                        <option value="2" {{ old('nguoi_thu_tien', $detail->nguoi_thu_tien) == 2 ? "selected" : "" }}>CTY</option>
                        <option value="3" {{ old('nguoi_thu_tien', $detail->nguoi_thu_tien) == 3 ? "selected" : "" }}>Tài xế</option>
                      </select>
                  </div>
                </div>
                <div class="row">
                  @if(Auth::user()->role == 1)
                  <div class="form-group col-xs-5">
                     <label>Sales <span class="red-star">*</span></label>
                      <select class="form-control select2" name="user_id" id="user_id">
                        <option value="0">--Chọn--</option>
                        @foreach($listUser as $user)        
                        <option value="{{ $user->id }}" {{ old('user_id', $detail->user_id) == $user->id ? "selected" : "" }}>{{ $user->name }}</option>
                        @endforeach
                      </select>
                  </div>
                  @endif
                  <input type="hidden" name="book_date" value="">
                </div>
               
               
                <div class="form-group">
                  <label>Ghi chú</label>
                  <textarea class="form-control" rows="6" name="notes" id="notes">{{ old('notes', $detail->notes) }}</textarea>
                </div>                  
            </div>          
                              
            <div class="box-footer">
              <button type="button" class="btn btn-default btn-sm" id="btnLoading" style="display:none"><i class="fa fa-spin fa-spinner"></i> Đang xử lý...</button>              
              <button type="submit" id="btnSave" class="btn btn-primary btn-sm">Lưu</button>
              <a class="btn btn-default btn-sm" class="btn btn-primary btn-sm" href="{{ route('booking-car-dn.index')}}">Hủy</a>
            </div>
        </div>
        <!-- /.box -->
      </div>      
    </form>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<div id="tagTag" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <form method="POST" action="{{ route('location.ajax-save')}}" id="formAjaxTag">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tạo mới điểm đón</h4>
      </div>
      <div class="modal-body" id="contentTag">
          <input type="hidden" name="type" value="4">
           <!-- text input -->
          <div class="col-md-12">
            <div class="form-group">
              <label>Tên địa điểm<span class="red-star">*</span></label>
              <input type="text" class="form-control" id="add_address" value="{{ old('address') }}" name="str_tag"></textarea>
            </div>
            
          </div>
          <div classs="clearfix"></div>
      </div>
      <div style="clear:both"></div>
      <div class="modal-footer" style="text-align:center">
        <button type="button" class="btn btn-primary btn-sm" id="btnSaveTagAjax"> Save</button>
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="btnCloseModalTag">Close</button>
      </div>
      </form>
    </div>

  </div>
</div>
@stop
@section('js')
<script type="text/javascript">
  $(document).on('click','#btnSave', function(){
    
    if(parseInt($('#tien_coc').val()) > 0 && $('#nguoi_thu_coc').val() == ''){
      alert('Bạn chưa chọn người thu cọc');
      return false;
    }
  });
$(document).on('click', '#btnSaveTagAjax', function(){
  $(this).attr('disabled', 'disabled');
    $.ajax({
      url : $('#formAjaxTag').attr('action'),
      data: $('#formAjaxTag').serialize(),
      type : "post", 
      success : function(str_id){          
        $('#btnCloseModalTag').click();
        $.ajax({
          url : "{{ route('location.ajax-list') }}",
          data: {
            str_id : str_id
          },
          type : "get", 
          success : function(data){
              $('#location_id').html(data);
              $('#location_id').select2('refresh');
              
          }
        });
      }
    });
 });
  $(document).ready(function(){
    $('#dataForm').submit(function(){      
      $('#btnSave').hide();
      $('#btnLoading').show();
    });
    $('#btnAddTag').click(function(){
          $('#tagTag').modal('show');
      });  
    $('#btnAddTag2').click(function(){
          $('#tagTag2').modal('show');
      });  
   
    $('#tien_coc').blur(function(){
      setPrice();
    });
    
  });
  function setPrice(){    
    priceGhep();   
  }
  function priceGhep(){      
      //tien_coc
      var tien_coc = 0;
      if($('#tien_coc').val() != ''){
       tien_coc = parseInt($('#tien_coc').val());
      }        
    
      var total_price = 0;
      if($('#total_price').val() != ''){
       total_price = parseInt($('#total_price').val());
      }  
      $('#total_price').val(total_price);

      $('#con_lai').val(total_price - tien_coc);
    
  }
</script>
@stop