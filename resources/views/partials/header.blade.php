<header class="main-header">
  <!-- Logo -->
  <a href="{{ route('booking.index')}}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">
      <img src="{{ asset('images/logo-small.png')}}" width="45" style="margin-top: 5px;">
    </span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>DÙ BAY QUỐC ĐẠT</b></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  @if(!isset($codeUser))
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

     <div class="input-group input-group-sm " style="width: 150px;position: absolute;left: 45px; top: 10px;" id="div_search_fast">
  
          <input type="text" class="form-control" id="keyword" name="keyword" placeholder="ID/Điện thoại" value="{{ isset($keyword) ? $keyword : "" }}">
          <span class="input-group-btn">
              <button type="button" id="btnQuickSearch" class="btn btn-danger btn-flat btn-preview">Tìm</button>
          </span>
      </div>
   
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">   
        <!-- <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-usd"></i>
              <span style="font-weight: bold;">120,000,000
            </a>            
          </li> -->
          
          <?php 
          $no_noti = $notiList->count();
          ?>
        <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-danger">{{ $no_noti }}</span>
            </a>
            <ul class="dropdown-menu">
              @if($no_noti > 0)
              <li class="header">Bạn có {{ $no_noti }} thông báo chưa đọc!</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  @foreach($notiList as $noti)
                  <li>
                    <a href="{{ route('noti.index') }}">
                      @if($noti->type == 1)
                      <i class="fa fa-bolt"></i>
                      @else
                      <i class="fa fa-usd"></i>                      
                      @endif 
                      {{ $noti->title }}
                    </a>
                  </li>
                  @endforeach
                </ul>
              </li>
              <li class="footer"><a href="{{ route('noti.index') }}">Xem tất cả</a></li>
              @else
              <li class="header">Bạn không có thông báo mới nào!</li>
              @endif
            </ul>
          </li>
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="setting_top_1">            
            <i class="fa fa-gears" id="setting_top_2"></i><span class="hidden-xs">Chào {{ Auth::user()->name }}</span>
          </a>
          <ul class="dropdown-menu">            
            <li class="user-footer">
            <div class="pull-left">
                <a href="{{ route('account.change-pass') }}" class="btn btn-success btn-flat">Đổi mật khẩu</a>
              </div>             
              <div class="pull-right">

                <a href="{{ route('logout') }}" class="btn btn-danger btn-flat" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Thoát</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </div>
            </li>
          </ul>
        </li>         

      </ul>
    </div>
  </nav>
  @else
  <div style="clear:both;"></div>
   @endif

</header>