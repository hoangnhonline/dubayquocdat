@extends('layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Yêu cầu thanh toán
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('payment-request.index') }}">Yêu cầu thanh toán</a></li>
      <li class="active">Cập nhật</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="{{ route('payment-request.index') }}" style="margin-bottom:5px">Quay lại</a>
    <form role="form" method="POST" action="{{ route('payment-request.update') }}" id="dataForm">
      <input type="hidden" name="id" value="{{ $detail->id }}">
    <div class="row">
      <!-- left column -->

      <div class="col-md-12">
        <div id="content_alert"></div>
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Cập nhật</h3>
          </div>
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

             <div class="form-group col-md-6">
                  <label for="email">Trạng thái</label>
                  <select class="form-control" name="status" id="status">
                    <option value="">--Chọn--</option>
                    <option value="1"  {{ old('status', $detail->status) == 1 ? "selected" : "" }}>Chưa thanh toán</option>
                    <option value="2"  {{  old('status', $detail->status) == 2 ? "selected" : "" }}>Đã thanh toán</option>
                  </select>
                </div> 
              <div class="form-group col-md-6">
                  <label for="email">Tỉnh/Thành</label>
                  <select class="form-control" name="city_id" id="city_id">
                    <option value="">--Chọn--</option>
                    <option value="1"  {{ old('city_id', $detail->city_id) == 1 ? "selected" : "" }}>Phú Quốc</option>
                    <option value="2"  {{  old('city_id', $detail->city_id) == 2 ? "selected" : "" }}>Đà Nẵng</option>
                  </select>
                </div>
                  <div class="form-group col-md-12">
                          <div class="checkbox">
                            <label style="color: red">
                              <input type="checkbox" name="urgent" value="1" {{ old('urgent', $detail->urgent) == 1 ? "checked" : "" }}>
                              <span style="color:red">THANH TOÁN GẤP</span>
                            </label>
                          </div>               
                        </div>   
                @if(Auth::user()->role == 1)
                <div class="form-group col-md-12">
                  <label for="email">Người chi</label>
                  <select class="form-control" name="payer" id="payer">
                    <option value="">--Chọn--</option>
                    <option value="1"  {{ old('payer', $detail->payer) == 1 ? "selected" : "" }}>Nguyễn Hoàng</option>
                    <option value="2"  {{  old('payer', $detail->payer) == 2 ? "selected" : "" }}>Thương Trần</option>
                    <option value="3" {{ old('payer', $detail->payer) == 3 ? "selected" : "" }}>Như Ngọc</option>
                    <option value="4" {{ old('payer', $detail->payer) == 4 ? "selected" : "" }}>Mộng Tuyền</option>
                  </select>
                </div>            
                <div class="form-group col-md-12" style="margin-top:10px;margin-bottom:10px">  
                  <label class="col-md-3 row">UNC </label>
                  <div class="col-md-9">
                    <img id="thumbnail_unc" src="{{ old('unc_url', $detail->unc_url) ? Helper::showImageNew(old('image_url', $detail->unc_url)) : URL::asset('admin/dist/img/img.png') }}" class="img-thumbnail" width="145" height="85">
                    
                    <input type="file" id="file-unc" style="display:none" />
                 
                    <button class="btn btn-default" id="btnUploadUnc" type="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload</button>
                  </div>
                  <div style="clear:both"></div>
                  <input type="hidden" name="image_url" id="image_url" value="{{ old('image_url', $detail->image_url) }}"/>          
                  <input type="hidden" name="image_name" id="image_name" value="{{ old('image_name') }}"/>
                </div>


                @endif
           
                <div class="form-group col-md-12 input-group" style="padding-left: 15px;">
                <label for="type">Tài khoản</label>
                <select class="form-control select2" name="bank_info_id" id="bank_info_id">
                  <option value="">--Tất cả--</option>
                  @foreach($bankInfoList as $cate)
                  <option value="{{ $cate->id }}" {{ old('bank_info_id', $detail->bank_info_id) == $cate->id ? "selected" : "" }}>{{ $cate->name }} - {{ $cate->bank_name }} - {{ $cate->bank_no }}</option>
                  @endforeach
                </select>
                <span class="input-group-btn">
                    <button style="margin-top:24px" class="btn btn-primary btn-sm" id="btnAddBankInfo" type="button" data-value="3">
                      Thêm  
                    </button>
                  </span>
              </div>
                @php
                    if($detail->date_pay){
                        $date_pay = old('date_pay', date('d/m/Y', strtotime($detail->date_pay)));
                    }else{
                        $date_pay = old('date_pay');
                    }
                  @endphp
               <div class="form-group col-md-6 col-xs-6">
                <label for="email">Ngày</label>
                <input type="text" name="date_pay" class="form-control datepicker" value="{{ old('date_pay', $date_pay) }}" autocomplete="off">
              </div>  
              <div class="form-group col-md-6 col-xs-6">
                <label for="email">PTT CODE</label>
                <input type="text" name="booking_id" class="form-control" value="{{ old('booking_id', $detail->booking_id) }}" autocomplete="off">
              </div>  
              <div class="form-group col-md-12 col-xs-12">
                  <label for="total_money">Tổng tiền</label>
                  <input type="text" name="total_money" class="form-control number total" placeholder="Tổng tiền" value="{{ old('total_money', $detail->total_money) }}">
                </div> 
              <div class="form-group col-md-12">
                <label for="notes">Nội dung yêu cầu</label>
                <textarea class="form-control" name="content" placeholder="Nội dung" rows="7">{!! old('content', $detail->content) !!}</textarea>
              </div>   
               
                 <div class="form-group col-md-12" style="margin-top:10px;margin-bottom:10px">  
                  <label class="col-md-3 row">Hình ảnh </label>
                  <div class="col-md-9">
                    <img id="thumbnail_image" src="{{ old('image_url', $detail->image_url) ? Helper::showImageNew(old('image_url', $detail->image_url)) : URL::asset('admin/dist/img/img.png') }}" class="img-thumbnail" width="145" height="85">
                    
                    <input type="file" id="file-image" style="display:none" />
                 
                    <button class="btn btn-default" id="btnUploadImage" type="button"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload</button>
                  </div>
                  <div style="clear:both"></div>
                  <input type="hidden" name="image_url" id="image_url" value="{{ old('image_url', $detail->image_url) }}"/>          
                  <input type="hidden" name="image_name" id="image_name" value="{{ old('image_name') }}"/>
                  <input type="hidden" name="unc_url" id="unc_url" value="{{ old('unc_url', $detail->unc_url) }}"/>          
                  <input type="hidden" name="unc_name" id="unc_name" value="{{ old('unc_name') }}"/>
                </div>
                
                         
              <div class="form-group col-md-12">
                <label for="notes">Ghi chú</label>
                <textarea class="form-control" name="notes" placeholder="Ghi chú" id="notes" rows="3">{!! old('notes', $detail->notes) !!}</textarea>
              </div> 
                           
            <div class="box-footer col-md-12">
              <button type="submit" class="btn btn-primary btn-sm">Lưu</button>
              <a class="btn btn-default btn-sm" class="btn btn-primary btn-sm" href="{{ route('cost.index')}}">Hủy</a>
            </div>            
        </div>
        <!-- /.box -->     

      </div>
      <div class="col-md-7">
             
    </div>
    </form>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<input type="hidden" id="route_upload_tmp_image" value="{{ route('image.tmp-upload') }}">
<div id="modalNewBankInfo" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <form method="POST" action="{{ route('bank-info.ajax-save')}}" id="formAjaxBankInfo">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tạo mới tài khoản ngân hàng đối tác</h4>
      </div>
      <div class="modal-body" id="contentTag">
          <input type="hidden" name="type" value="1">
           <!-- text input -->
          <div class="col-md-12">
            <div class="form-group">
              <label>Tên đối tác<span class="red-star">*</span></label>
              <input type="text" autocomplete="off" class="form-control" id="add_name" value="{{ old('name') }}" name="name"></textarea>
            </div>
            <div class="form-group">
              <label>Tên ngân hàng<span class="red-star">*</span></label>
              <input type="text" autocomplete="off" class="form-control" id="add_bank_name" value="{{ old('bank_name') }}" name="bank_name"></textarea>
            </div>
            <div class="form-group">
              <label>Chủ tài khoản<span class="red-star">*</span></label>
              <input type="text" autocomplete="off" class="form-control" id="add_account_name" value="{{ old('account_name') }}" name="account_name"></textarea>
            </div>
            <div class="form-group">
              <label>Số tài khoản<span class="red-star">*</span></label>
              <input type="text" autocomplete="off" class="form-control" id="add_bank_no" value="{{ old('bank_no') }}" name="bank_no"></textarea>
            </div>
            <div class="form-group">
              <label>Chi nhánh</label>
              <input type="text" autocomplete="off" class="form-control" id="bank_branch" value="{{ old('bank_branch') }}" name="bank_branch"></textarea>
            </div>

            
          </div>
          <div classs="clearfix"></div>
      </div>
      <div style="clear:both"></div>
      <div class="modal-footer" style="text-align:center">
        <button type="button" class="btn btn-primary btn-sm" id="btnSaveBankAjax"> Save</button>
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="btnCloseModalTag">Close</button>
      </div>
      </form>
    </div>

  </div>
</div>
@stop
@section('js')
<script type="text/javascript">
  $(document).on('click', '#btnSaveBankAjax', function(){
    $(this).attr('disabled', 'disabled');
      $.ajax({
        url : $('#formAjaxBankInfo').attr('action'),
        data: $('#formAjaxBankInfo').serialize(),
        type : "post", 
        success : function(id){
          $('#btnCloseModalTag').click();
          $.ajax({
            url : "{{ route('bank-info.ajax-list') }}",
            data: {
              id : id
            },
            type : "get", 
            success : function(data){
                $('#bank_info_id').html(data);
                $('#bank_info_id').select2('refresh');                
            }
          });
        },error: function (error) {
          var errrorMess = jQuery.parseJSON(error.responseText);        
          if(errrorMess.message == 'The given data was invalid.'){
            alert('Nhập đầy đủ thông tin có dấu *');      
            $('#btnSaveBankAjax').removeAttr('disabled');      
          }
          //console.log(error);
      }
      });
   });
  $(document).ready(function(){
    
  });
  $(document).ready(function(){    
    $('.tinh-toan .amount, .tinh-toan .gia').blur(function(){      
      var parent = $(this).parents('.tinh-toan');
      tinhtoangia(parent);
    });   
  });
  function tinhtong(){
    var tong = 0;
    $('.total').each(function(){
      var total = parseInt($(this).val());
      if(total > 0){
        tong += total;
      }
    });
    $('#total_money').val(tong);
  }
  function tinhtoangia(parent){ 
      var amount = parent.find('.amount').val();
      var gia = parent.find('.gia').val();
      var total = gia*amount;
      parent.find('.total').val(total);
      tinhtong();
  }
</script>
<script type="text/javascript">
  $(document).ready(function(){
     $('#btnAddBankInfo').click(function(){
          $('#modalNewBankInfo').modal('show');
      });  
    $('#cate_id').click(function(){      
      $.ajax({
        url : "{{ route('media.ajax-store') }}",
        type : 'GET',
        data : $('#formAjax').serialize(),
        success: function(data){
          alert('Lưu thành công!');
          window.location.reload();
        }
      });
    });
    $('#btnUploadUnc').click(function(){        
        $('#file-unc').click();
      }); 
      var files = "";
      $('#file-unc').change(function(e){
        $('#thumbnail_unc').attr('src', "{{ URL::asset('admin/dist/img/loading.gif') }}");
         files = e.target.files;
         
         if(files != ''){
           var dataForm = new FormData();        
          $.each(files, function(key, value) {
             dataForm.append('file', value);
          });   
          
          dataForm.append('date_dir', 1);
          dataForm.append('folder', 'tmp');

          $.ajax({
            url: $('#route_upload_tmp_image').val(),
            type: "POST",
            async: false,      
            data: dataForm,
            processData: false,
            contentType: false,
            beforeSend : function(){
              $('#thumbnail_unc').attr('src', "{{ URL::asset('admin/dist/img/loading.gif') }}");
            },
            success: function (response) {
              if(response.image_path){
                $('#thumbnail_unc').attr('src',$('#upload_url').val() + response.image_path);
                $( '#unc_url' ).val( response.image_path );
                $( '#unc_name' ).val( response.image_name );
              }
              console.log(response.image_path);
                //window.location.reload();
            },
            error: function(response){                             
                var errors = response.responseJSON;
                for (var key in errors) {
                  
                }
                //$('#btnLoading').hide();
                //$('#btnSave').show();
            }
          });
        }
      }); 
    $('#btnUploadImage').click(function(){        
        $('#file-image').click();
      });      
      var files = "";
      $('#file-image').change(function(e){
        $('#thumbnail_image').attr('src', "{{ URL::asset('admin/dist/img/loading.gif') }}");
         files = e.target.files;
         
         if(files != ''){
           var dataForm = new FormData();        
          $.each(files, function(key, value) {
             dataForm.append('file', value);
          });   
          
          dataForm.append('date_dir', 1);
          dataForm.append('folder', 'tmp');

          $.ajax({
            url: $('#route_upload_tmp_image').val(),
            type: "POST",
            async: false,      
            data: dataForm,
            processData: false,
            contentType: false,
            beforeSend : function(){
              $('#thumbnail_image').attr('src', "{{ URL::asset('admin/dist/img/loading.gif') }}");
            },
            success: function (response) {
              if(response.image_path){
                $('#thumbnail_image').attr('src',$('#upload_url').val() + response.image_path);
                $( '#image_url' ).val( response.image_path );
                $( '#image_name' ).val( response.image_name );
              }
              console.log(response.image_path);
                //window.location.reload();
            },
            error: function(response){                             
                var errors = response.responseJSON;
                for (var key in errors) {
                  
                }
                //$('#btnLoading').hide();
                //$('#btnSave').show();
            }
          });
        }
      });
  });
</script>
@stop