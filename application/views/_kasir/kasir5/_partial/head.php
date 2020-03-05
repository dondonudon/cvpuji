<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->session->flashdata('title'); ?></title>
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>assets/image/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>assets/image/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/image/favicon-16x16.png">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url(); ?>assets/image/favicon.ico" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-ui/themes/base/minified/jquery-ui.min.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/Ionicons/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/dist/css/skins/_all-skins.min.css">

    <script src="<?php echo base_url() ?>assets/js/jquery/jquery-1.9.0.min.js" type="text/javascript"></script>
    <link href="<?php echo base_url() ?>assets/js-numpad/numpad.css" rel="stylesheet">
    <script src="<?php echo base_url() ?>assets/js-numpad/numpad.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/js-numpad/easy-numpad.css">
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js-numpad/easy-numpad.js"></script>





    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work //callback function: do something with selectedData;if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="<?php echo base_url() ?>kasir1" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>ZONA</b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b></b> ZONA</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <font size="4" color="white">
                    <strong>
                        <?php
                        $query = $this->db->query("SELECT * FROM master_kasir WHERE kode_m_kasir = '$kode_m_kasir'");
                        $row   = $query->row();
                        echo "<span class=\"logo-lg\">" . $row->nama . "</span>";
                        ?>
                    </strong>
                </font>
                <button class="btn btn-info btn-lg" id="back" onclick="goBack()">KEMBALI</button>

                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <br>


                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">


                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">

                            <ul class="dropdown-menu">
                                <!-- User image -->

                                <!-- Menu Footer-->

                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        <!-- <li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li> -->
                    </ul>
                </div>

            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <style>
                    fa-database {
                        color: #2759AE;
                    }
                </style>

                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">

                    <li><a href="<?php echo base_url(); ?>kasir5_stock"><i class="fa fa-database" style="color:red"></i> <span>Master Barang</span></a></li>
                    <li><a href="<?php echo base_url(); ?>kasir5"><i class="fa fa-shopping-cart" style="color:green"></i> <span>Transaksi</span></a></li>
                    <li><a href="<?php echo base_url(); ?>kasir5_trans"><i class="fa fa-clone" style="color:yellow"></i> <span>Laporan</span></a></li>
                    <li><a href="<?php echo base_url(); ?>kasir5_mutasi"><i class="fa fa-newspaper-o" style="color:cyan"></i> <span>Mutasi</span></a></li>

                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>