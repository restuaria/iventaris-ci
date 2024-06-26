<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Informasi INVENTARIS</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <link href="<?php echo base_url() ?>assets/img/logo-sikampus.png" rel="icon">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body style="background-color:#00b4aa;">
    <div class="container">
        <div class="login-box">
            <center>
                <br />
                <?php
                if (isset($_GET['alert'])) {
                    if ($_GET['alert'] == "gagal") {
                        echo "<div class='alert alert-warning'>Login Gagal, Username dan Password Salah</div>";
                    } else if ($_GET['alert'] == "logout") {
                        echo "<div class='alert alert-warning'>Anda Telah Berhasil Logout</div>";
                    } else if ($_GET['alert'] == "belum_login") {
                        echo "<div class='alert alert-warning'>Anda Harus Login Terlebih Dahulu</div>";
                    }
                }
                ?>
            </center>
            <div class="login-box-body">
                <center>
                    <h4><strong>SISTEM INFORMASI INVENTARIS</strong></h4>
                    <h4 style="text-transform:uppercase">Universitas Informatika dan Binis Indonesia</h4>
                </center>
                <center>
                    <img src="<?php echo base_url() ?>assets/img/logo-sikampus.png" class="img-responsive" style="width: 150px">
                </center><br>
                <form action="<?php echo base_url('login/proseslogin/') ?>" method="POST">
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Username" name="user_username" required="required" pattern="[a-zA-Z0-9]+" autocomplete="off">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="user_password" required="required" autocomplete="off">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-offset-8 col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>