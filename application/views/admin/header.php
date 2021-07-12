<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fashion Station</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href= "<?php echo base_url()?>public/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>public/admin/dist/css/adminlte.min.css">
  <link rel="stylesheet" href= "<?php echo base_url()?>public/admin/plugins/summernote/summernote-bs4.css">

  <style>
    .invalid-feedback{
      display:block;
    }
  </style>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light" >
    <!-- Left navbar links -->
    <div><b >Welcome, Administrator</b>   </div>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#"><b>LOGOUT</b></a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="<?= base_url('admin/login/logout')?>" class="dropdown-item dropdown-footer" style="text-align:left;">LOGOUT</a>
          <a href="#" class="dropdown-item dropdown-footer" style="text-align:left;">CANCEL</a>
        </div>
      </li>  
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
   <div>
    <a href="index3.html" class="brand-link bg-white"> 
      <span class="brand-text ml-4 "><strong>Fashion Station</strong></span>
    </a>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="<?=base_url('admin/home')?>" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview <?= (!empty($mainModule) && $mainModule=='category')? 'menu-open' : '';?> ">
            <a href="#" class="nav-link ">
              <i class="far fa-circle nav-icon"></i>
              <p>
              Categories
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url('admin/category/create')?>" class="nav-link <?= (!empty($mainModule) && $mainModule=='category' && !empty($subModule) && $subModule=='addCategory')? 'active' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('admin/category/index')?>" class="nav-link <?= (!empty($mainModule) && $mainModule=='category' && !empty($subModule) && $subModule=='viewCategory')? 'active' : '';?> ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Category</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview <?= (!empty($mainModule) && $mainModule=='article')? 'menu-open' : '';?>">
            <a href="#" class="nav-link ">
            <i class="far fa-circle nav-icon"></i>
              <p>
              Article
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url('admin/article/create')?>" class="nav-link <?= (!empty($mainModule) && $mainModule=='article' && !empty($subModule) && $subModule=='addArticle')? 'active' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Article</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('admin/article/index')?>" class="nav-link <?= (!empty($mainModule) && $mainModule=='article' && !empty($subModule) && $subModule=='viewArticle')? 'active' : '';?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Article</p>
                </a>
              </li>
            </ul>
          </li>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>