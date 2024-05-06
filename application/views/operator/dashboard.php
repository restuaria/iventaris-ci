<section class="content-header">
    <h1>
        Dashboard
        <small>Control Panel Sistem Informasi Inventaris</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <?php
                    $barang = $this->db->query("SELECT * FROM barang")->num_rows();
                    ?>
                    <h3><?php echo $barang; ?></h3>
                    <p>Data Sarana</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?php echo base_url('operator/databarang') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <?php
                    $barang = $this->db->query("SELECT * FROM barang_prasarana")->num_rows();
                    ?>
                    <h3><?php echo $barang ?></h3>
                    <p>Data Prasarana</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?php echo base_url('operator/prasarana') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <?php
                    $x = $this->db->query("SELECT * FROM barang_masuk")->num_rows();
                    $barang_masuk = $this->db->query("SELECT sum(bm_jumlah) as total_barang_masuk FROM barang_masuk")->result();
                    foreach ($barang_masuk as $bm);
                    if ($x == 0) {
                    ?>
                        <h3>0</h3>
                    <?php
                    } else {
                    ?>
                        <h3><?php echo $bm->total_barang_masuk ?></h3>
                    <?php
                    }
                    ?>
                    <p>Total Barang Masuk</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-list"></i>
                </div>
                <a href="<?php echo base_url('operator/barangmasuk') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <?php
                    $x = $this->db->query("SELECT * FROM barang_keluar")->num_rows();
                    $barang_keluar = $this->db->query("SELECT sum(bk_jumlah) as total_barang_keluar FROM barang_keluar")->result();
                    foreach ($barang_keluar as $bk);
                    if ($x == 0) {
                    ?>
                        <h3>0</h3>
                    <?php
                    } else {
                    ?>
                        <h3><?php echo $bk->total_barang_keluar ?></h3>
                    <?php
                    }
                    ?>
                    <p>Total Barang Keluar</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-list"></i>
                </div>
                <a href="<?php echo base_url('operator/barangkeluar') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-blue">
                <div class="inner">
                    <?php
                    $barang_masuk = $this->db->query("SELECT * FROM barang_masuk")->num_rows();
                    ?>
                    <h3><?php echo $barang_masuk ?></h3>
                    <p>Total Transaksi Barang Masuk</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-list"></i>
                </div>
                <a href="<?php echo base_url('operator/barangmasuk') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-blue">
                <div class="inner">
                    <?php
                    $barang_keluar = $this->db->query("SELECT * FROM barang_keluar")->num_rows();
                    ?>
                    <h3><?php echo $barang_keluar ?></h3>
                    <p>Total Transaksi Barang Keluar</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-list"></i>
                </div>
                <a href="<?php echo base_url('operator/barangkeluar') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <?php
                    $pinjam = $this->db->query("SELECT * FROM pinjam")->num_rows();
                    ?>
                    <h3><?php echo $pinjam ?></h3>
                    <p>Data Transaksi Peminjaman</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?php echo base_url('operator/peminjaman') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <?php
                    $peminjaman = $this->db->query("SELECT * FROM pinjam WHERE pinjam_status='Sudah Dikembalikan'")->num_rows();
                    ?>
                    <h3><?php echo $peminjaman ?></h3>
                    <p>Peminjaman Dikembalikan</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?php echo base_url('operator/peminjaman') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <?php
                    $peminjaman = $this->db->query("SELECT * FROM pinjam WHERE pinjam_status='Sedang Dipinjam'")->num_rows();
                    ?>
                    <h3><?php echo $peminjaman ?></h3>
                    <p>Peminjaman Belum Dikembalikan</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?php echo base_url('operator/peminjaman') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

    </div>

    <div class="row">
        <section class="col-lg-6">

            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Detail Login</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Nama</th>
                            <td><?php echo $this->session->userdata('user_nama'); ?></td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td><?php echo $this->session->userdata('user_username'); ?></td>
                        </tr>
                        <tr>
                            <th>Level Hak Akses</th>
                            <td>
                                <span class="label label-success text-uppercase"><?php echo $this->session->userdata('user_level'); ?></span>
                            </td>
                        </tr>
                    </table>

                </div>
        </section>
    </div>
</section>