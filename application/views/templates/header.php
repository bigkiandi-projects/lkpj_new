
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="base_url" content="<?php echo base_url() ?>">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title><?php echo $judul ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="icon" href="<?php echo base_url('assets/favicon.ico') ?>" />
  <!-- bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/lte/') ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>node_modules/@fortawesome/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/lte/') ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/lte/') ?>bower_components/select2/dist/css/select2.min.css">
  <!-- nestable -->
  <link rel="stylesheet" href="<?php echo base_url() ?>node_modules/nestable2/dist/jquery.nestable.min.css">
  <!-- icon picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>node_modules/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/lte/') ?>dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url('vendor/lte/') ?>dist/css/skins/skin-purple.min.css">
  <!-- date and time picker -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/lte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('vendor/lte/plugins/timepicker/bootstrap-timepicker.min.css') ?>">
  <!-- custom css -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/dashboard-style.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/my-style.css">

  <style>
    table.table-bordered{
      border:1px solid #dfdfdf;
      margin-top:20px;
    }
    table.table-bordered > thead > tr > th {
        border:1px solid #dfdfdf;
        text-align: center;
        vertical-align: middle;
    }
    table.table-bordered > tbody > tr > td{
        border:1px solid #dfdfdf;
    }
  </style>
  <!-- jQuery 3 -->
  <script src="<?php echo base_url('vendor/lte/') ?>bower_components/jquery/dist/jquery.min.js"></script>

  <!-- time date picker  -->
  <script src="<?= base_url('vendor/lte/plugins/timepicker/bootstrap-timepicker.min.js') ?>"></script>
  <script src="<?php echo base_url('vendor/lte/') ?>bower_components//bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- DataTables -->
  <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
  <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
  <!-- sweetalert -->
  <script src="<?php echo base_url('vendor/sweetalert/sweetalert.min.js') ?>"></script>
  
</head>
<body class="hold-transition skin-purple sidebar-collapse fixed">
  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
          <b>M</b>
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
          <img src="<?= base_url('assets/img/logo-lkpj2.png') ?>" width="220">
        </span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" style="font-size: 35px; padding: 0px 0px 0px 3px;">
          <i class="fas fa-angle-right"></i>
        </a>

        

        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <i class="fa fa-user fa-lg"></i>
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?php echo $user['nama_user'] ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="<?php echo base_url('assets/img/user/') . $user['gambar'] ?>" class="img-circle" alt="User Image">
                  <p>
                    <?php echo $user['nama_user'] ?>
                    <small><?php echo $this->session->userdata('level'); ?></small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?php echo base_url('profil') ?>" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo base_url('logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <aside class="main-sidebar">
      <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
          <li>
            <div class="form-group">
              <button type="submit" class="btn btn-md btn-flat bg-purple btn-block" data-toggle='modal' data-target='#SetTahun'>LKPJ <?= $this->session->userdata('ta') ?> <i class="fas fa-caret-down"></i></button>
            </div>
          </li>
          <li class="header">MAIN MENU</li>

          <?php 
          $this->db->select('*');
          $this->db->where('id_role', $this->session->userdata('id_role'));
          $this->db->order_by('urutan', 'asc');
          $this->db->join('menu', 'id_menu');
          $this->db->join('role', 'id_role');
          $menu = $this->db->get('akses_role')->result_array();
          ?>

          <?php foreach ($menu as $row): ?>
            <?php if ($row['ada_submenu'] == 0 && $row['submenu'] == 0 ): ?>
              <li <?php echo $row['nama_menu'] == $judul ? 'class="active"' : '' ?>><a href="<?php echo base_url($row['url']) ?>"><i class="<?php echo $row['icon'] ?>"></i> <span><?php echo $row['nama_menu'] ?></span></a></li>
              <?php elseif($row['ada_submenu'] == 1 && $row['submenu'] == 0) : ?>
                <?php
                $this->db->where('nama_menu', $judul);
                $this->db->where('submenu !=', 0);
                $menu_parent = $this->db->get('menu')->row_array();
                if ($menu_parent) {
                  $id_menu_parent = $menu_parent['submenu'];
                  $nama_menu_parent = $this->db->get_where('menu', ['id_menu' => $id_menu_parent])->row_array()['nama_menu'];
                }
                ?>
                <li class="treeview 
                <?php 
                if($menu_parent){
                  echo $row['nama_menu'] == $nama_menu_parent ? 'active' : '';
                }
                ?>
                ">
                <a href="#"><i class="<?php echo $row['icon'] ?>"></i> <span><?php echo $row['nama_menu'] ?></span>
                  <span class="pull-right-container">
                    <i class="fas fa-chevron-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <?php 
                  $this->db->select('*');
                  $this->db->where('id_role', $this->session->userdata('id_role'));
                  $this->db->where('submenu', $row['id_menu']);
                  $this->db->order_by('urutan', 'asc');
                  $this->db->join('menu', 'id_menu');
                  $this->db->join('role', 'id_role');
                  $submenu = $this->db->get('akses_role')->result_array();
                  ?>
                  <?php foreach ($submenu as $row_submenu): ?>
                    <li <?php echo $row_submenu['nama_menu'] == $judul ? 'class="active"' : '' ?>><a class="<?= $row_submenu['nama_menu'] == "Buka Laci" ? 'buka_laci' : '' ?>" href="<?php echo base_url($row_submenu['url']) ?>"><i class="<?php echo $row_submenu['icon'] ?>"></i> <?php echo $row_submenu['nama_menu'] ?></a></li>
                  <?php endforeach ?>
                </ul>
              </li>
            <?php endif ?>
          <?php endforeach ?>

          <li><a href="<?php echo base_url('logout') ?>"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>

        </ul>
        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>

    <div class="modal-tahun">
      <div class="modal modal-default fade" id="SetTahun">
          <div class="modal-dialog" style="width:250px;">>
              <div class="modal-content">
                  <div class="modal-header bg-gray">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Pilih Tahun LKPJ</h4>
                  </div>
                  <form id="thform" method="post" action="<?= base_url('dashboard/SetYear') ?>">
                  <div class="modal-body">
                      <div class="form-group">
                        <label>Pilih Tahun</label>
                        <select class="form-control select2" name="th" style="width: 100%">
                          <option value="2023">2023</option>
                          <option value="2022">2022</option>
                          <option value="2021">2021</option>
                        </select>
                      </div>
                  </div>
                  </form>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                      <button type="submit" form="thform" class="btn btn-primary">Simpan Perubahan</button>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->

      <!-- <section class="content-header">
        <h1>
          <?php echo $judul ?>
        </h1>
      </section> -->

      <section class="content container-fluid">

       <?php if ($error = $this->session->flashdata('error')): ?>
        <span class="alert-error hidden d-error"><?php echo $error ?></span>
      <?php endif ?>
      <?php if ($warning = $this->session->flashdata('warning')): ?>
        <span class="alert-warning hidden d-warning"><?php echo $warning ?></span>
      <?php endif ?>
      <?php if ($success = $this->session->flashdata('success')): ?>
        <span class="alert-success hidden d-success"><?php echo $success ?></span>
      <?php endif ?>
      <?php if ($message = $this->session->flashdata('message')): ?>
        <span class="alert-message hidden d-message"><?php echo $message ?></span>
      <?php endif ?>

      <!-- custom -->
  <script src="<?php echo base_url('assets/js/alert.js') ?>"></script>
