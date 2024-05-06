<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Informasi Inventaris</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
    <link href="<?php echo base_url() ?>assets/img/logo-sikampus.png" rel="icon">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/morris.js/morris.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/DataTables/datatables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/Chart.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <style>
        #table-datatable {
            width: 100% !important;
        }

        #table-datatable .sorting_disabled {
            border: 1px solid #f4f4f4;
        }
    </style>
    <div class="wrapper">
        <header class="main-header">
            <a href="<?php echo base_url('admin') ?>" class="logo">
                <span class="logo-mini"><b><i class="fa fa-desktop"></i></b> </span>
                <span class="logo-lg">SI-<strong>Inventaris</strong></span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle Navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav mai-top-nav header-right-menu">
                        <li class="nav-item">
                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                Sistem Informasi
                                <strong>Inventaris</strong> &nbsp;&nbsp;</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel">
                    <?php
                    $id_user = $this->session->userdata("user_id");
                    $user = $this->db->query("SELECT * FROM user where user_id = $id_user")->result();
                    foreach ($user as $s);

                    if ($s->user_foto == "") {
                    ?>
                        <div class="pull-left image">
                            <img src="<?php echo base_url() ?>file/user/df.png" class="img-circle">
                        </div>
                    <?php } else {
                    ?>
                        <div class="pull-left image">
                            <img src="<?php echo base_url() . 'file/user/' . $s->user_foto ?>" class="img-circle">
                        </div>
                    <?php
                    }
                    ?>

                    <div class="pull-left info">
                        <p><?php echo $this->session->userdata("user_nama");
                            ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <br>
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MENU UTAMA</li>

                    <li>
                        <a href="<?php echo base_url("admin") ?>">
                            <i class="fa fa-dashboard"></i> <span>DASHBOARD</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-building"></i>
                            <span>SARANA</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu" style="display: none;">
                            <li>
                                <a href="<?php echo base_url("admin/databarang") ?>">
                                    <i class="fa fa-folder"></i> <span>Data Barang</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("admin/barangkeluar") ?>">
                                    <i class="fa fa-mail-forward"></i> <span>Barang Keluar</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("admin/barangmasuk") ?>">
                                    <i class="fa fa-mail-reply"></i> <span>Barang Masuk</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("admin/peminjaman") ?>">
                                    <i class="fa fa-hand-paper-o"></i> <span>Peminjaman</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("admin/suplier") ?>">
                                    <i class="fa fa-truck"></i> <span>Suplier</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("admin/laporan") ?>">
                                    <i class="fa fa-file"></i> <span>Laporan</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo base_url("admin/prasarana") ?>">
                            <i class="fa fa-book"></i> <span>PRASARANA</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url("admin/lokasi_sebaran") ?>">
                            <i class="fa fa-table"></i> <span>SEBARAN SARPRAS</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-building"></i>
                            <span>MASTER DATA</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu" style="display: none;">
                            <li>
                                <a href="<?php echo base_url('admin/kategori') ?>">
                                    <i class="fa fa-folder"></i> <span>KATEGORI</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('admin/lokasi') ?>">
                                    <i class="fa fa-building"></i> <span>LOKASI/PENERIMA</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo base_url('admin/user') ?>">
                            <i class="fa fa-users"></i> <span>DATA USER</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('admin/gantipassword') ?>">
                            <i class="fa fa-lock"></i> <span>PASSWORD</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('login/logout') ?>">
                            <i class="fa fa-sign-out"></i> <span>LOGOUT</span>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper">
            <?php echo $tem_adm ?>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
            </div>
            Copyright &copy; 2023 - Universitas Informatika dan Bisnis Indonesia
        </footer>
    </div>
    <script src="<?php echo base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>

    <script src="<?php echo base_url() ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>

    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>

    <script src="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/select2/dist/css/select2.min.css">
    <script src="<?php echo base_url() ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/morris.js/morris.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="<?php echo base_url() ?>assets/dist/js/adminlte.min.js"></script>
    <script src="<?php echo base_url() ?>assets/dist/js/pages/dashboard.js"></script>
    <script src="<?php echo base_url() ?>assets/dist/js/demo.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/chart.js/Chart.min.js"></script>
    <script>
        $(document).ready(function() {
            var $disabledResults = $(".dropdown-cari");
            $disabledResults.select2();
            // $(".edit").hide();
            $('#table-datatable').DataTable({
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': true,
                "pageLength": 10
            });
        });
        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy',
        }).datepicker("setDate", new Date());
        $('.datepicker2').datepicker({
            autoclose: true,
            format: 'yyyy/mm/dd',
        });
    </script>
    <script>
        var randomScalingFactor = function() {
            return Math.round(Math.random() * 100)
        };
        var barChartData = {
            labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
            datasets: [{
                    label: 'Pemasukan',
                    fillColor: "rgba(51, 240, 113, 0.61)",
                    strokeColor: "rgba(11, 246, 88, 0.61)",
                    highlightFill: "rgba(220,220,220,0.75)",
                    highlightStroke: "rgba(220,220,220,1)",
                    data: [
                        <?php
                        for ($bulan = 1; $bulan <= 12; $bulan++) {
                            $thn_ini = date('Y');
                            $pemasukan = $this->db->query("select sum(transaksi_nominal) as total_pemasukan from transaksi where transaksi_jenis='Pemasukan' and month(transaksi_tanggal)='$bulan' and year(transaksi_tanggal)='$thn_ini'");
                            $pem = mysqli_fetch_assoc($pemasukan);
                            // $total = str_replace(",", "44", number_format($pem['total_pemasukan']));
                            $total = $pem['total_pemasukan'];
                            if ($pem['total_pemasukan'] == "") {
                                echo "0,";
                            } else {
                                echo $total . ",";
                            }
                        }
                        ?>
                    ]
                },
                {
                    label: 'Pengeluaran',
                    fillColor: "rgba(255, 51, 51, 0.8)",
                    strokeColor: "rgba(248, 5, 5, 0.8)",
                    highlightFill: "rgba(151,187,205,0.75)",
                    highlightStroke: "rgba(151,187,205,1)",
                    data: [
                        <?php
                        for ($bulan = 1; $bulan <= 12; $bulan++) {
                            $thn_ini = date('Y');
                            $pengeluaran = $this->db->query("select sum(transaksi_nominal) as total_pengeluaran from transaksi where transaksi_jenis='pengeluaran' and month(transaksi_tanggal)='$bulan' and year(transaksi_tanggal)='$thn_ini'");
                            $peng = mysqli_fetch_assoc($pengeluaran);
                            // $total = str_replace(",", "44", number_format($peng['total_pengeluaran']));
                            $total = $peng['total_pengeluaran'];
                            if ($peng['total_pengeluaran'] == "") {
                                echo "0,";
                            } else {

                                echo $total . ",";
                            }
                        }
                        ?>
                    ]
                }
            ]

        }
        var barChartData2 = {
            labels: [
                <?php
                $tahun = $this->db->query("select distinct year(transaksi_tanggal) as tahun from transaksi order by year(transaksi_tanggal) asc");
                while ($t = mysqli_fetch_array($tahun)) {
                ?> "<?php echo $t['tahun']; ?>",
                <?php
                }
                ?>
            ],
            datasets: [{
                    label: 'Pemasukan',
                    fillColor: "rgba(51, 240, 113, 0.61)",
                    strokeColor: "rgba(11, 246, 88, 0.61)",
                    highlightFill: "rgba(220,220,220,0.75)",
                    highlightStroke: "rgba(220,220,220,1)",
                    data: [
                        <?php
                        $tahun = $this->db->query("select distinct year(transaksi_tanggal) as tahun from transaksi order by year(transaksi_tanggal) asc");
                        while ($t = mysqli_fetch_array($tahun)) {
                            $thn = $t['tahun'];
                            $pemasukan = $this->db->query("select sum(transaksi_nominal) as total_pemasukan from transaksi where transaksi_jenis='Pemasukan' and year(transaksi_tanggal)='$thn'");
                            $pem = mysqli_fetch_assoc($pemasukan);
                            $total = $pem['total_pemasukan'];
                            if ($pem['total_pemasukan'] == "") {
                                echo "0,";
                            } else {
                                echo $total . ",";
                            }
                        }
                        ?>
                    ]
                },
                {
                    label: 'Pengeluaran',
                    fillColor: "rgba(255, 51, 51, 0.8)",
                    strokeColor: "rgba(248, 5, 5, 0.8)",
                    highlightFill: "rgba(151,187,205,0.75)",
                    highlightStroke: "rgba(254, 29, 29, 0)",
                    data: [
                        <?php
                        $tahun = $this->db->query("select distinct year(transaksi_tanggal) as tahun from transaksi order by year(transaksi_tanggal) asc");
                        while ($t = mysqli_fetch_array($tahun)) {
                            $thn = $t['tahun'];
                            $pemasukan = $this->db->query("select sum(transaksi_nominal) as total_pengeluaran from transaksi where transaksi_jenis='Pengeluaran' and year(transaksi_tanggal)='$thn'");
                            $pem = mysqli_fetch_assoc($pemasukan);
                            $total = $pem['total_pengeluaran'];
                            if ($pem['total_pengeluaran'] == "") {
                                echo "0,";
                            } else {
                                echo $total . ",";
                            }
                        }
                        ?>
                    ]
                }
            ]

        }

        window.onload = function() {
            var ctx = document.getElementById("grafik1").getContext("2d");

            window.myBar = new Chart(ctx).Bar(barChartData, {
                responsive: true,
                animation: true,
                barValueSpacing: 5,
                barDatasetSpacing: 1,
                tooltipFillColor: "rgba(0,0,0,0.8)",
                multiTooltipTemplate: "<%= datasetLabel %> - Rp.<%= value.toLocaleString() %>,-"
            });

            var ctx = document.getElementById("grafik2").getContext("2d");
            window.myBar = new Chart(ctx).Bar(barChartData2, {
                responsive: true,
                animation: true,
                barValueSpacing: 5,
                barDatasetSpacing: 1,
                tooltipFillColor: "rgba(0,0,0,0.8)",
                multiTooltipTemplate: "<%= datasetLabel %> - Rp.<%= value.toLocaleString() %>,-"
            });
        }
    </script>
</body>

</html>