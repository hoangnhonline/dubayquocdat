<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->display_name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="treeview {{ in_array($routeName, ['booking.index', 'booking.create', 'booking.edit']) && (isset($type) && $type == 1) ? 'active' : '' }}"" >
        <a href="#">
          <i class="fa fa-superpowers"></i> 
          <span>ĐẶT DỊCH VỤ</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        
        <ul class="treeview-menu">
          <li {{ in_array($routeName, ['booking.index', 'booking.edit']) ? "class=active" : "" }}><a href="{{ route('booking.index') }}"><i class="fa fa-circle-o"></i> Danh sách</a></li>
          
                    
          @if(Auth::user()->role == 1)
          <li {{ in_array($routeName, ['booking.create']) ? "class=active" : "" }}><a href="{{ route('booking.create') }}"><i class="fa fa-circle-o"></i> Thêm mới</a></li>
          @endif
        </ul>        
      </li>
      @if(Auth::user()->role == 1)
      <li {{ in_array($routeName, ['cost.index', 'cost.create', 'cost.edit']) ? "class=active" : "" }}>
        <a href="{{ route('cost.index') }}">
          <i class="glyphicon glyphicon-usd"></i> <span>CHI PHÍ</span>
        </a>
      </li>
      @endif     
      @if(Auth::user()->role < 3)
      <li {{ in_array($routeName, ['report.doanh-thu-thang']) ? "class=active" : "" }}>
        <a href="{{ route('report.doanh-thu-thang') }}">
          <i class="fa fa-bar-chart" aria-hidden="true"></i><span>LỢI NHUẬN</span>
        </a>
      </li>     
      <li {{ in_array($routeName, ['cate.index', 'cate.create', 'cate.edit']) ? "class=active" : "" }}>
        <a href="{{ route('cate.index') }}">
          <i class="fa fa-list-alt" aria-hidden="true"></i><span>Dịch vụ</span>
        </a>
      </li> 
      @elseif(Auth::user()->role == 4)
      <li {{ in_array($routeName, ['report.thong-ke-bai-bien']) ? "class=active" : "" }}>
        <a href="{{ route('report.thong-ke-bai-bien') }}">
          <i class="fa fa-bar-chart" aria-hidden="true"></i><span>THỐNG KÊ</span>
        </a>
      </li> 
      @else
      
      @endif
      
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
<style type="text/css">
  .skin-blue .sidebar-menu>li>.treeview-menu{
    padding-left: 15px !important;
  }
</style>