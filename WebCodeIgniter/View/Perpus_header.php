<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Informasi Akademik SMA Cendana Pekanbaru</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>asset/AdminLTE-2.4.3/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>asset/AdminLTE-2.4.3/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>asset/AdminLTE-2.4.3/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>asset/AdminLTE-2.4.3/dist/css/AdminLTE.min.css">

   <link rel="stylesheet" href="<?php echo base_url();?>asset/AdminLTE-2.4.3/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>asset/AdminLTE-2.4.3/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url();?>asset/AdminLTE-2.4.3/<?php echo base_url();?>asset/AdminLTE-2.4.3/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url();?>asset/AdminLTE-2.4.3/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>asset/AdminLTE-2.4.3/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>asset/AdminLTE-2.4.3/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url();?>asset/AdminLTE-2.4.3/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
     <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>C</b>DN</span>
      <!-- logo for regular state and mobile devices -->

      <span class="logo-lg"> <img src="<?php echo base_url();?>asset/gambar/logo.gif " style="width:45px;height:50px;margin-bottom:5px;margin-left:-10px " alt="User Image"><b>SMA CENDANA</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
   
    
          <!-- Tasks: style can be found in dropdown.less -->
         
          <!-- User Account: style can be found in dropdown.less -->
           <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url();?>asset/gambar/admin.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata('loger');?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url();?>asset/gambar/admin.png" class="img-circle" alt="User Image">

                <p>
                  <?php echo $this->session->userdata('loger');?>
                  <small>SMA Cendana Pekanbaru</small>
                </p>
              </li>
              <!-- Menu Body -->
      
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                 
                </div>
        
                <div class="pull-right" style="margin-right:90px">
                  <a href="<?php echo site_url('Login_controller/logout') ?>" class="btn btn-default btn-flat">Log out</a>
                </div>
              </li>
            </ul>
          </li>
     
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url();?>asset/gambar/admin.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('loger');?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
    
      <!-- sidebar menu: : style can be found in sidebar.less -->
       <!-- sidebar menu: : style can be found in sidebar.less -->
 <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
       
        <li >
          <a href="<?php echo site_url('Admin_controller/Tampilperpus_beranda')?>">
            <i class="fa fa-dashboard"></i> <span>Beranda</span>
          </a>
        </li>
         <li>
          <a href="<?php echo site_url('Admin_controller/Tampilperpus_buku_jenisbuku')?>">
            <i class="fa fa-files-o"></i>
            <span>Kelola Buku</span>
      </a>
        </li>
        <li>
          <a href="<?php echo site_url('Admin_controller/Tampilperpus_rakbuku')?>">
            <i class="fa fa-files-o"></i>
            <span>Kelola Rak Buku</span>
      </a>
        </li>
        <li>
          <a href="<?php echo site_url('Admin_controller/Tampilperpus_buku')?>">
            <i class="fa fa-files-o"></i>
            <span>Kelola Peminjaman Buku</span>
      </a>
        </li>
        
       </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  