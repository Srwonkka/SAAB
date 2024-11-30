<?php 

    session_start();
    include("../db.php");
    $url_base = "http://localhost/Tienda/";

    if (!isset($_SESSION['usuario_usuario'])) {
      header("Location:".$url_base."login.php");
    }

    $valSudoAdmin = $_SESSION['valSudoAdmin'];
    if (isset($_SESSION['link'])) {
      $link = $_SESSION['link'];
    }

    
    date_default_timezone_set('America/Bogota'); 
    $fechaActual = date("d-m-Y");
    $horaActual = date("h:i a");

    if ($valSudoAdmin) {
      $inicio_link = "index.php";
    //SECCIÓN DE PRODUCTOS
      $crear_categoria_link = 'crear_categoria.php';
      $lista_categoria_link = 'lista_categoria.php';
      $crear_producto_link = 'crear_producto.php';
      $lista_producto_link = 'index_productos.php';
      $editar_producto_link = 'editar_productos.php';
    //SECCIÓN DE CLIENTES
      $crear_cliente_link = 'crear_cliente.php';
      $lista_cliente_link = 'index_clientes.php';
      $editar_cliente_link = 'editar_clientes.php';
      $editar_cliente_link = 'editar_clientes.php';
    //SECCIÓN DE PROVEEDORES
      $crear_proveedore_link = 'crear_proveedor.php';
      $lista_proveedore_link = 'index_proveedores.php';    
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tienda</title>
  <link rel="icon" type="image/x-icon" href="../dist/img/logos/logoTienda.jpg">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- ajax -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <!-- Estilos Personalizados -->
  <link rel="stylesheet" href="../dist/css/custom_content.css">
  <!-- sweetalert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- Whatssap -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-NHunfPAzTJH7s1weDQ8q5PXdvXEZEfPeF2dQu9KcKzS0/OjLJNSU+87HwGY5HV0HdGbh+Kmt7lC3FRJ0wGF+1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <?php if ($_SESSION['logueado']) { ?>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?php echo $url_base;?>secciones/<?php echo $inicio_link;?>" class="nav-link">Inicio</a>
        </li>
        <li>          
            <a id="cerrarSesion" href="<?php echo $url_base;?>cerrar.php" class="nav-link" style="background: #17A2B8; border-radius: 17px;font-size: 15px;
              color: white;">Cerrar Sesion</a>         
        </li>
      </ul>
  
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>

        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->
      
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
       <a class="brand-link">
        <img src="../dist/img/logos/logoTienda.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">        
          <span class="brand-text font-weight-light">Admin</span>          
        </a> 
    
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a  class="d-block h5" ><?php echo $_SESSION['usuario_usuario']?></a>
          </div>
        </div>
  
        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>
  
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              
              <li class="nav-item menu-open">
                <li class="nav-item">
                  <a href="index.php" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Panel de Control</p>
                  </a>
                </li>
              </li>
          <!-- SECCIÓN DE PRODUCTOS --> 
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-shopping-basket fa-lg mr-2"></i>
                <p>
                  PRODUCTOS
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo $url_base;?>secciones/<?php echo $crear_categoria_link?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Crear Categoria</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo $url_base;?>secciones/<?php echo $lista_categoria_link?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Lista de Categorias</p>
                  </a>
                </li> 
                <li class="nav-item">
                  <a href="<?php echo $url_base;?>secciones/<?php echo $crear_producto_link?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Crear Producto</p>
                  </a>
                </li>
                  <li class="nav-item">
                  <a href="<?php echo $url_base;?>secciones/<?php echo $lista_producto_link?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Lista de Productos</p>
                  </a>
                </li>
              </ul>
            </li>

          <!-- SECCIÓN DE CLIENTES -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-address-book fa-lg mr-2"></i>
                <p>
                  CLIENTES
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="<?php echo $url_base;?>secciones/<?php echo $crear_cliente_link;?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Crear Cliente</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo $url_base;?>secciones/<?php echo $lista_cliente_link;?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Lista de Clientes</p>
                  </a>
                </li>                          
              </ul>
            </li>
            
          <!-- PROVEEDORES -->  
            <li class="nav-item">
              <a href="#" class="nav-link">
              <i class="nav-icon fas fa-truck fa-lg mr-2"></i>
                <p>
                  PROVEEDORES  
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">              
                <li class="nav-item">
                  <a href="<?php echo $url_base;?>secciones/<?php echo $crear_proveedore_link;?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Crear Proveedor</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo $url_base;?>secciones/<?php echo $lista_proveedore_link;?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Lista Proveedores</p>
                  </a>
                </li>
              </ul>
            </li>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
          
    <?php } ?>
    
    <div class="content-wrapper" >
      <!-- Main content -->
      <section class="content">
          <div class="container-fluid">
    
        