<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplikasi inventori sederhana dengan CI & Bootstrap">
    <meta name="author" content="Djava-ui">

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url('asset/css/bootstrap.css')?>"/>
    <link rel="stylesheet" href="<?php echo base_url('asset/css/bootstrap-responsive.css')?>"/>
    <link rel="stylesheet" href="<?php echo base_url('asset/css/chosen.css')?>"/>
    <link rel="stylesheet" href="<?php echo base_url('asset/css/style.css')?>"/>
    <style type="text/css">
        .chzn-container-single .chzn-search input{
            width: 100%;
        }
    </style>

    <!-- Fav icon -->
    <link rel="shortcut icon" href="<?php echo base_url('asset/img/favicon.ico')?>">

    <!-- JS -->
    <script type="text/javascript" src="<?php echo base_url('asset/js/jquery.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('asset/js/bootstrap.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('asset/js/chosen.jquery.js');?>"></script>
    <script type="text/javascript">
        $(function(){
            $('.chzn-select').chosen();
            $('.chzn-select-deselect').chosen({allow_single_deselect:true});
        });

    </script>

</head>

<body>
<div class="container">

    <!--========================= Header + Navbar ==============================-->
    <?php if ($this->session->userdata('LEVEL') == 'admin'){ ?>
        <div class="navbar hidden-print">
            <div class="navbar-inner">
                <div class="container">
                    <ul class="nav">
                        <li class="<?php if(isset($active_dashboard)){echo $active_dashboard ;}?>">
                            <a href="<?php echo site_url('dashboard')?>"><i class="icon-home"></i> Dashboard</a>
                        </li>
                        <li class="<?php if(isset($active_penjualan)){echo $active_penjualan ;}?>">
                            <a href="<?php echo site_url('penjualan')?>"><i class="icon-barcode"></i> Penjualan</a>
                        </li>
                        <li class="<?php if(isset($active_laporan)){echo $active_laporan ;}?>">
                            <a href="<?php echo site_url('laporan')?>"><i class="icon-file"></i> Laporan</a>
                        </li>
                        <li class="<?php if(isset($active_master)){echo $active_master ;}?>">
                            <a href="<?php echo site_url('master')?>"><i class="icon-cog"></i> Master Data</a>
                        </li>
                        <li><a href="<?php echo site_url('login/logout')?>" style="background: #333; color: #fff";><i class="icon-white icon-remove-sign"></i>  Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <br>
    <?php } else { ?>

    <div class="navbar hidden-print">
        <div class="navbar-inner">
            <div class="container">
                <ul class="nav">
                    <li class="<?php if(isset($active_dashboard)){echo $active_dashboard ;}?>">
                        <a href="<?php echo site_url('dashboard')?>"><i class="icon-home"></i> Dashboard</a>
                    </li>
                    <li class="<?php if(isset($active_penjualan)){echo $active_penjualan ;}?>">
                        <a href="<?php echo site_url('penjualan')?>"><i class="icon-barcode"></i> Penjualan</a>
                    </li>
                    <li class="<?php if(isset($active_laporan)){echo $active_laporan ;}?>">
                        <a href="<?php echo site_url('laporan')?>"><i class="icon-file"></i> Laporan</a>
                    </li>
                    <li><a href="<?php echo site_url('login/logout')?>" style="background: #333; color: #fff"><i class="icon-white icon-remove-sign"></i>  Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    <br>

<?php } ?>