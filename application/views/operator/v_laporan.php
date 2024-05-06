<section class="content-header">
    <h1>
        Menu Laporan
        <small>Data Laporan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Laporan</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <section class="col-lg-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Filter Laporan</h3>
                </div>
                <div class="box-body">
                    <form method="get" action="">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mulai Tanggal</label>
                                    <input type="date" class="form-control" type="text" value="
                                    <?php if (isset($_GET['tanggal_dari'])) {
                                        echo $_GET['tanggal_dari'];
                                    } else {
                                        echo "";
                                    } ?>" name="tanggal_dari" class="form-control datepicker2" placeholder="Mulai Tanggal" required="required">
                                </div>
                                <div class="form-group">
                                    <label>Sampai Tanggal</label>
                                    <input type="date" class="form-control" value="<?php if (isset($_GET['tanggal_sampai'])) {
                                                                                        echo $_GET['tanggal_sampai'];
                                                                                    } else {
                                                                                        echo "";
                                                                                    } ?>" name="tanggal_sampai" class="form-control datepicker2" placeholder="Sampai Tanggal" required="required">
                                </div>
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select name="jenis" class="form-control" required="required">
                                        <option value="">- Pilih -</option>
                                        <option <?php if (isset($_GET['jenis'])) {
                                                    if ($_GET['jenis'] == "barang_masuk") {
                                                        echo "selected='selected'";
                                                    }
                                                } ?> value="barang_masuk">Barang Masuk</option>
                                        <option <?php if (isset($_GET['jenis'])) {
                                                    if ($_GET['jenis'] == "barang_keluar") {
                                                        echo "selected='selected'";
                                                    }
                                                } ?> value="barang_keluar">Barang Keluar</option>
                                        <option <?php if (isset($_GET['jenis'])) {
                                                    if ($_GET['jenis'] == "peminjaman") {
                                                        echo "selected='selected'";
                                                    }
                                                } ?> value="peminjaman">Peminjaman</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="TAMPILKAN" class="btn btn-sm btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Laporan</h3>
                </div>
                <div class="box-body">
                    <?php
                    if (isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari']) && isset($_GET['jenis'])) {
                        $tgl_dari = $_GET['tanggal_dari'];
                        $tgl_sampai = $_GET['tanggal_sampai'];
                        $jenis = $_GET['jenis'];
                    ?>

                        <div class="row">
                            <div class="col-lg-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="30%">DARI TANGGAL</th>
                                        <th width="1%">:</th>
                                        <td><?php echo $tgl_dari; ?></td>
                                    </tr>
                                    <tr>
                                        <th>SAMPAI TANGGAL</th>
                                        <th>:</th>
                                        <td><?php echo $tgl_sampai; ?></td>
                                    </tr>
                                    <tr>
                                        <th>KATEGORI</th>
                                        <th>:</th>
                                        <td><?php echo $jenis; ?></td>
                                    </tr>
                                </table>

                            </div>
                        </div>

                        <?php
                        if ($jenis == "barang_masuk") {
                        ?>
                            <a href="<?php echo base_url() . 'operator/laporan_pdf' ?>?tanggal_dari=<?php echo $tgl_dari ?>&tanggal_sampai=<?php echo $tgl_sampai ?>&jenis=<?php echo $jenis ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a>
                            <br /><br />
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table-datatable">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center" width="1%">NO</th>
                                            <th style="text-align:center">NAMA</th>
                                            <th style="text-align:center">TGL. MASUK</th>
                                            <th style="text-align:center">JUMLAH</th>
                                            <th style="text-align:center">SUPLIER</th>
                                            <th style="text-align:center">SUMBER DANA</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $data = $this->db->query("SELECT * from barang_masuk,barang where bm_id_barang=barang_id and date(bm_tgl_masuk) >= '$tgl_dari' AND date(bm_tgl_masuk) <= '$tgl_sampai' order by bm_tgl_masuk desc");
                                        // $data = mysqli_query($koneksi,"SELECT * from barang_masuk,barang where bm_id_barang=barang_id ");
                                        foreach ($data->result() as $d) {
                                        ?>
                                            <tr>
                                                <td style="text-align:center"><?php echo $no++; ?></td>
                                                <td><?php echo $d->barang_nama;
                                                    echo ' [';
                                                    echo $d->barang_kode;
                                                    echo ']'; ?></td>
                                                <td style="text-align:center"><?php echo $d->bm_tgl_masuk; ?></td>
                                                <td style="text-align:center"><?php echo $d->bm_jumlah ?></td>
                                                <td><?php echo $d->bm_nama_suplier ?></td>
                                                <td><?php echo $d->bm_sumber_dana ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php
                        } elseif ($jenis == "barang_keluar") {
                        ?>
                            <a href="<?php echo base_url() . 'operator/laporan_pdf' ?>?tanggal_dari=<?php echo $tgl_dari ?>&tanggal_sampai=<?php echo $tgl_sampai ?>&jenis=<?php echo $jenis ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a>
                            <br /><br />

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table-datatable">
                                    <thead>
                                        <tr>
                                            <th width="1%">NO</th>
                                            <th style="text-align:center">NAMA BARANG</th>
                                            <th style="text-align:center">TGL.KELUAR</th>
                                            <th style="text-align:center">JUMLAH</th>
                                            <th style="text-align:center">PENERIMA</th>
                                            <th style="text-align:center">GEDUNG</th>
                                            <th style="text-align:center">RUANGAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $data = $this->db->query("SELECT * FROM barang_keluar,fakultas,barang where bk_penerima=fakultas_id and bk_id_barang=barang_id and date(bk_tgl_keluar) >= '$tgl_dari' AND date(bk_tgl_keluar) <= '$tgl_sampai' order by bk_tgl_keluar desc");
                                        //$data = mysqli_query($koneksi,"SELECT * FROM barang_keluar,barang where bk_id_barang=barang_id ");
                                        foreach ($data->result() as $d) {
                                        ?>
                                            <tr>
                                                <td style="text-align:center"><?php echo $no++; ?></td>
                                                <td><?php echo $d->barang_nama;
                                                    echo ' [';
                                                    echo $d->barang_kode;
                                                    echo ']'; ?></td>
                                                <td style="text-align:center"><?php echo $d->bk_tgl_keluar ?></td>
                                                <td style="text-align:center"><?php echo $d->bk_jumlah ?></td>
                                                <td><?php echo $d->fakultas_nama ?></td>
                                                <td><?php echo $d->bk_lokasi2 ?></td>
                                                <td><?php echo $d->bk_lokasi ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        <?php
                        } elseif ($jenis == "peminjaman") {
                        ?>
                            <a href="<?php echo base_url() . 'operator/laporan_pdf' ?>?tanggal_dari=<?php echo $tgl_dari ?>&tanggal_sampai=<?php echo $tgl_sampai ?>&jenis=<?php echo $jenis ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a>
                            <br /><br />

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table-datatable">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center">KODE</th>
                                            <th style="text-align:center">BARANG</th>
                                            <th style="text-align:center">PEMINJAM</th>
                                            <th style="text-align:center">ASAL</th>
                                            <th style="text-align:center">JUMLAH</th>
                                            <th style="text-align:center">TGL.PINJAM</th>
                                            <th style="text-align:center">TGL.KEMBALI</th>
                                            <th style="text-align:center">STATUS</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $data = $this->db->query("SELECT * from pinjam,barang,fakultas where pinjam_barang=barang_id and pinjam_peminjam=fakultas_id and date(pinjam_tgl_pinjam) >= '$tgl_dari' AND date(pinjam_tgl_kembali) <= '$tgl_sampai' order by pinjam_id desc");
                                        //$data = mysqli_query($koneksi,"SELECT * FROM barang_keluar,barang where bk_id_barang=barang_id ");
                                        foreach ($data->result() as $d) {
                                        ?>
                                            <tr>
                                                <td style="text-align:center"><?php echo $d->pinjam_kode; ?></td>
                                                <td><?php echo $d->barang_nama;
                                                    echo ' [';
                                                    echo $d->barang_kode;
                                                    echo ']'; ?></td>
                                                <td><?php echo $d->pinjam_nama; ?></td>
                                                <td><?php echo $d->fakultas_nama; ?></td>
                                                <td style="text-align:center"><?php echo $d->pinjam_jumlah; ?></td>
                                                <td style="text-align:center"><?php echo date('d-m-Y', strtotime($d->pinjam_tgl_pinjam)); ?></td>
                                                <td style="text-align:center"><?php echo date('d-m-Y', strtotime($d->pinjam_tgl_kembali)); ?></td>
                                                <td style="text-align:center">
                                                    <?php
                                                    if ($d->pinjam_status == "Sudah Dikembalikan") {
                                                        echo "<div class='badge badge-success'>Sudah Dikembalikan</div>";
                                                    } else if ($d->pinjam_status == "Sedang Dipinjam" && (strtotime($d->pinjam_tgl_kembali . " 23:59:59") >= time())) {
                                                        echo "<div class='badge badge-warning'>Sedang Dipinjam</div>";
                                                    } else if (strtotime($d->pinjam_tgl_kembali . " 23:59:59") <= time()) {
                                                        echo "<div class='badge badge-danger'>Dipinjam-Habis</div>";
                                                    }
                                                    ?>
                                                </td>

                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php
                        }
                        ?>
                    <?php
                    } else {
                    ?>
                        <div class="alert alert-info text-center">
                            Silahkan Filter Laporan Terlebih Dulu.
                        </div>

                    <?php
                    }
                    ?>

                </div>
            </div>
        </section>
    </div>
</section>