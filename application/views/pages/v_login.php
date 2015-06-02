<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SistemInformasi Logistik PT. BONET">
    <meta name="author" content="RYD Corp - Randy Mandala - Yodi Yanwar - Dasep Purnama">

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url('dist/css/vendor/bootstrap.min.css')?>"/>
    <link rel="stylesheet" href="<?php echo base_url('asset/css/bootstrap-responsive.css')?>"/>
    <link rel="stylesheet" href="<?php echo base_url('flat/dist/css/flat-ui.css')?>"/>
     <!-- Loading Flat UI -->
    <link rel="stylesheet" href="<?php echo base_url('dist/css/flat-ui.css')?>"/>
    <link rel="stylesheet" href="<?php echo base_url('docs/assets/css/demo.css')?>"/>



    <!-- Fav icon -->
    <link rel="shortcut icon" href="<?php echo base_url('img/favicon.ico')?>">

    <!-- JS -->
    <script type="text/javascript" src="<?php echo base_url('asset/js/jquery.js')?>"></script>
    <script type="text/javascript" src="<?php echo base_url('asset/js/bootstrap.js')?>"></script>
</head>

<body>
<div class="container">
 <div class="login">
        <div class="login-screen">
          <div class="login-icon">
            <img src="img/login/icon.png" alt="Selamat Datang di SIL" />
            <h4>Welcome to <small>Sistem Informasi Logistik</small></h4>
          </div>

    <div class="loading navbar-fixed-top" style="display: none">
        <div class="progress progress-primary progress-striped active">
            <div class="bar" style="width: 100%;"></div>
        </div>
    </div>
    <br>
          
    <form class="login-form" action="<?= site_url('login/cek_login')?>" method="post">
        
        <div class="form-group">
        <input type="text" class="form-control login-field" placeholder="Masukan Username Anda" name="username" required="">
        <label class="login-field-icon fui-user" for="login-name"></label>
        </div>
        <div class="form-group">
        <input type="password" class="form-control login-field" placeholder="Password" name="password" required="">
          <label class="login-field-icon fui-lock" for="login-pass"></label>
          </div>
        <button class="btn btn-primary btn-lg btn-block" type="submit">Masuk</button>
    </div>

    </form>
      <div class="container">
    <div class="footer">
        <p>&copy; 2015: <a href="http://bogor.net.id" target="_blank"><strong>PT. Bonet Utama - Dev by RYD Corp</strong></a></p>
    </div>
    </div>
</div>
</body>

</html>
