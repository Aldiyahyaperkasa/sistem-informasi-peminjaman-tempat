<?php

use App\Controllers\Main;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= base_url() ?>img/dispopar-logo.png" type="image/png">
    <title>SIPT - Dashboard ADMIN</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">

    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/5.0/examples/sticky-footer/sticky-footer.css" rel="stylesheet">
<style>
        .nav-item:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-light elevation-4 text-dark">
            <!-- Brand Logo -->
            <a href="#" class="brand-link bg-light border-bottom "> <!-- brand-link -->
                <img src="<?= base_url() ?>/img/dispopar-logo.png" alt="KMI-Logo" class="" style="height: 45px; margin-left:8px;"> <!-- w-100 height: 45px; margin-left:8px; -->
                <span class="brand-text font-weight-light">
                    <!-- <img src="<?= base_url() ?>/img/dispopar-logo.png" alt="KMI-Logo" class="" style="height:50px;"> w-100 -->
                    DISPORA BONTANG
                </span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar bg-light">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex border-bottom">
                    <div class="image">
                        <img src="<?= base_url() ?>/img/user.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block text-dark">
                            <?= session()->get('fullname') ? '<span>' . session()->get('fullname') . '</span>' : '' ?>
                        </a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-header mt-2 text-dark">Menu</li>
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->                        
                        <li class="nav-item mt-2 ">
                            <a href="<?= site_url('/Admin/index') ?>" class="nav-link">
                                <i class="nav-icon fas fa-home text-dark"></i>                                
                                <p class="text-dark">Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('/akunPengguna/index') ?>" class="nav-link">
                                <i class="nav-icon fa-solid fa-user text-dark"></i>                          
                                <p class="text text-dark">Kelola Akun</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('/admin_data_tempat/index') ?>" class="nav-link">
                                <i class="nav-icon fa-solid fa-address-book text-dark"></i>
                                <p class="text text-dark">Data Tempat</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('/admin_data_peminjaman/index') ?>" class="nav-link">
                                <i class="nav-icon fa-solid fa-file-signature text-dark"></i>
                                <!-- <i class="nav-icon fa-solid fa-file-circle-question"></i> -->
                                <!-- <i class="nav-icon fa-solid fa-clipboard-question"></i> -->
                                <p class="text text-dark">Data Peminjaman</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="<?= site_url('arsip_surat/index') ?>" class="nav-link">
                                <i class="nav-icon fas fa-tasks text-dark"></i>
                                <p class="text text-dark">Arsip Surat</p>
                            </a>
                        </li> -->
                        <li class="nav-header mt-2 text-dark">Sistem</li>
                        <li class="nav-item">
                            <a href="<?= site_url('login/logout') ?>" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                                <p class="text text-dark">Log Out</p>
                            </a>
                        </li>
                    </ul>
                </nav>                
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) --> 
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h3 class="">
                                <?= $this->renderSection('judul'); ?>
                           </h3>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">                
                        <?= $this->renderSection('subjudul'); ?>                        
                    </div>
                    <div class="card-body">
                        <?= $this->renderSection('isi'); ?>
                    </div>
                </div>
                    <!-- /.card-body -->

                    <!-- /.card-footer-->
             
                <!-- /.card -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

       <footer class="main-footer d-flex justify-content-end align-items-center">
            <!-- <strong>&copy; 2023 Kaltim Methanol Industri |  
                <a href="mailto:aldiyahyap@gmail.com">Design by aldi yahya perkasa</a>
            </strong> -->
            <div class="float-right d-none d-sm-block">
                <img style="height: 30px;" src="<?= base_url() ?>/img/pemkot-bontang.png" alt="">
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url() ?>/dist/js/demo.js"></script>
</body>

</html>