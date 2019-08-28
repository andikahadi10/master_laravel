<?php date_default_timezone_set('Asia/Jakarta'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('public/admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('public/admin/bower_components/font-awesome/css/font-awesome.min.css') }} ">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('public/admin/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/admin/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('public/admin/dist/css/skins/_all-skins.min.css') }}">

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  @yield('css')

</head>
<body class="hold-transition skin-blue sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="../../index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>LTE</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{asset('public/admin/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                <span class="hidden-xs">{{Auth::user()->name}}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="{{asset('public/admin/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

                  <p>
                    {{Auth::user()->email}}
                    <!-- <small>Member since Nov. 2012</small> -->
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="{{route('admin_user.index')}}" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <!-- <a href="#" class="btn btn-default btn-flat">Sign out</a> -->
                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="icon ion-power"></i>
                    Sign Out
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <!-- <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> -->
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('public/admin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

        <!-- Menu ====================================================================================================================== -->

        <li class="<?php if($hal == "index") echo "active" ; ?>">
          <a href="{{url('index_admin.html')}}">
            <i class="fa fa-home"></i> <span>Beranda</span>
          </a>
        </li>

        @foreach(App\MenuModel::join('tbl_t_user','tbl_t_user.menu_id','=','tbl_menu.menu_id')->orderBy('tbl_menu.menu_id','asc')->where([
          ['menu_id_parent', '=', '0'],
          ['group_id', '=', Auth::user()->group_id],
          ])->get() as $menuItem)
        <li class="treeview <?php
        foreach(App\MenuModel::join('tbl_t_user','tbl_t_user.menu_id','=','tbl_menu.menu_id')->orderBy('tbl_menu.menu_id','asc')->where([
          ['tbl_menu.menu_id_parent', '=', $menuItem->menu_id],
          ['tbl_t_user.group_id', '=', Auth::user()->group_id],
          ])->get() as $menuItemList1){
          if ($hal == $menuItemList1->menu_link) {
            echo "active" ;
          }
        }
        ?>">
        <a href="#">
          <i class="fa fa-folder"></i> <span>{{$menuItem->menu_nama}}</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          @foreach(App\MenuModel::join('tbl_t_user','tbl_t_user.menu_id','=','tbl_menu.menu_id')->orderBy('tbl_menu.menu_id','asc')->where([
            ['tbl_menu.menu_id_parent', '=', $menuItem->menu_id],
            ['tbl_t_user.group_id', '=', Auth::user()->group_id],
            ])->get() as $menuItemList)
          <li class="<?php if($hal == $menuItemList->menu_link) echo "active" ; ?>"><a href="{{route($menuItemList->menu_link.'.index')}}"><i class="fa fa-circle-o"></i>{{$menuItemList->menu_nama}}</a></li>
          @endforeach
        </ul>
      </li>
      @endforeach

      <!-- static -->

      <!-- <li class="treeview <?php if(($hal == "barang")||($hal == "satuan")) echo "active" ; ?>">
        <a href="#">
          <i class="fa fa-folder"></i> <span>Master</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?php if($hal == "satuan") echo "active" ; ?>"><a href="{{route('satuan.index')}}"><i class="fa fa-circle-o"></i>Satuan</a></li>
          <li class="<?php if($hal == "barang") echo "active" ; ?>"><a href="{{route('barang.index')}}"><i class="fa fa-circle-o"></i>Barang</a></li>

        </ul>
      </li>

      <li class="treeview <?php if(($hal == "group")||($hal == "master_user")||($hal == "menu")) echo "active" ; ?>">
        <a href="#">
          <i class="fa fa-users"></i> <span>Manajemen User</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?php if($hal == "group") echo "active" ; ?>"><a href="{{route('group.index')}}"><i class="fa fa-circle-o"></i>Group</a></li>
          <li class="<?php if($hal == "master_user") echo "active" ; ?>"><a href="{{route('master_user.index')}}"><i class="fa fa-circle-o"></i>Users</a></li>
          <li class="<?php if($hal == "menu") echo "active" ; ?>"><a href="{{route('menu.index')}}"><i class="fa fa-circle-o"></i>Menu</a></li>

        </ul>
      </li>

      <li class="treeview <?php if(($hal == "stok")) echo "active" ; ?>">
        <a href="#">
          <i class="fa fa-users"></i> <span>Inventory</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?php if($hal == "stok") echo "active" ; ?>"><a href="{{route('stok.index')}}"><i class="fa fa-circle-o"></i>Stok Barang</a></li>
        </ul>
      </li> -->

      <!-- End Menu ====================================================================================================================== -->


    </ul>
  </section>
  <!-- /.sidebar -->
</aside>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


  @yield('content')

</div>
<!-- /.content-wrapper -->

<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 2.4.0
  </div>
  <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
  reserved.
</footer>

<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('public/admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('public/admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('public/admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('public/admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/admin/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('public/admin/dist/js/demo.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/js/validator.js') }}"></script>


@yield('js')

<script>
$(document).ready(function () {
  $('.sidebar-menu').tree()
})
</script>
</body>
</html>
