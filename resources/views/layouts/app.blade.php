
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Klik Apotek</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
   <link rel="stylesheet" href={{asset("plugins/fontawesome-free/css/all.min.css")}}> -->
  <!-- Ionicons -->
 <link rel="stylesheet" href={{asset("https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css")}}>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.all.min.js">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <!-- <link rel="stylesheet" href={{asset("plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css")}}>
  iCheck -->
  <!-- <link rel="stylesheet" href={{asset("plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}> -->
  <!-- JQVMap -->
  <!-- <link rel="stylesheet" href={{asset("plugins/jqvmap/jqvmap.min.css")}}> --> -->
  <!-- Theme style -->
  <link rel="stylesheet" href={{asset("dist/css/adminlte.min.css")}}>
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href={{asset("plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}>
  <link rel="stylesheet" href={{asset("plugins/datatables/datatables.css")}}>
  <!-- Daterange picker -->
  <!-- <link rel="stylesheet" href={{asset("plugins/daterangepicker/daterangepicker.css")}}> -->
  <!-- summernote -->
  <!-- <link rel="stylesheet" href={{asset("plugins/summernote/summernote-bs4.css")}}> -->
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">   
      </li>
      <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" class="btn btn-sm btn-info"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
  <div class="image">
         
         </div>
    <a href="index3.html" class="brand-link">
    <i class="fas fa-hospital"></i>
      <span class="brand-text font-weight-light">Apotek</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
     
        <div class="info">
        
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        @role("owner")
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-folder"></i>
              <p>
                Data Master
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('obat.index')}}" class="nav-link">
                <i class="fas fa-book-medical"></i>
                  <p>Katalog Obat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('stock.index')}}" class="nav-link">
                <i class="fas fa-cubes"></i>
                  <p>Stock Obat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{('penjualan.datajual')}}" class="nav-link">
                <i class="fas fa-chart-bar"></i>
                  <p>Data Penjualan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('supplier.index')}}" class="nav-link">
                <i class="fas fa-users"></i>
                  <p>Data Supplier</p>
                </a>
              </li>
              
              <li class="nav-item">
                
              </li>
            </ul>
          </li>
              <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fas fa-file-invoice-dollar"></i>
              <p>
                Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{('penjualan')}}" class="nav-link">
                <i class="fas fa-cash-register"></i>
                  <p>Penjualan Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('cetak')}}" class="nav-link">
                <i class="fas fa-print"></i>
                  <p>Cetak Nota</p>
                </a>
              </li>
              
              
          
          <li class="nav-header"></li>
          
        
          @endrole
          @role('gudang')
          <li class="nav-item">
            <a href="{{route('obat.index')}}" class="nav-link">
            <i class="fas fa-book-medical"></i>
              <p>Katalog Obat</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('stock.index')}}" class="nav-link">
            <i class="fas fa-cubes"></i>
              <p>Stock Obat</p>
            </a>
          </li>
          
          @endrole
          @role('kasir')
          <li class="nav-item">
            <a href="{{route('stock.index')}}" class="nav-link">
            <i class="fas fa-cubes"></i>
              <p>Stock Obat</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{('penjualan')}}" class="nav-link">
            <i class="fas fa-cash-register"></i>
              <p>Transaksi Penjualan</p>
            </a>
          </li>
          <li class="nav-item">
                <a href="{{route('cetak')}}" class="nav-link">
                <i class="fas fa-print"></i>
                  <p>Cetak Nota</p>
                </a>
              </li>
          @endrole
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        @role('owner')
      
        @endrole
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <!-- <i class="fas fa-chart-pie mr-1"></i> -->
                  <!-- Sales -->
                </h3>
                <main>
                {{ $slot }} 
            </main>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src={{asset("plugins/bootstrap/js/bootstrap.bundle.min.js")}}></script>
<script src={{asset("plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}></script>
<script src="dist/js/adminlte.js"></script>
<script src="dist/js/pages/dashboard.js"></script>
<script src="dist/js/demo.js"></script>
@stack('js')
</body>
</html>