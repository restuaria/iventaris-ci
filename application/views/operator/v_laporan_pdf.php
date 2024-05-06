<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Informasi INVENTARIS</title>
    <link href="<?php echo base_url() ?>assets/img/logo-sikampus.png" rel="icon">
</head>

<body>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        .table {
            width: 100%;
        }

        th,
        td {}

        .table,
        .table th,
        .table td {
            padding: 5px;
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
    <center>
        <?php
        $pts = $this->db->query("SELECT * FROM pts where pts_id = 1");
        foreach ($pts->result() as $w);
        ?>
        <h4 style="text-transform:uppercase">LAPORAN DATA BARANG INVENTARIS <br><?php echo $w->pts_nama ?></h4>
    </center>
    <?php
    if (isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari']) && isset($_GET['jenis'])) {
        $tgl_dari = $_GET['tanggal_dari'];
        $tgl_sampai = $_GET['tanggal_sampai'];
        $jenis = $_GET['jenis'];
    ?>
        <table>
            <tr>
                <td width="40%">DARI TANGGAL</td>
                <td width="10%" style="text-align: center;">:</td>
                <td><?php echo $tgl_dari; ?></td>
            </tr>
            <tr>
                <td>SAMPAI TANGGAL</td>
                <td style="text-align: center;">:</td>
                <td><?php echo $tgl_sampai; ?></td>
            </tr>
            <tr>
                <td>KATEGORI</td>
                <td style="text-align: center;">:</td>
                <td><?php echo $jenis; ?></td>
            </tr>
        </table>
        <br />

        <?php
        if ($jenis == "barang_masuk") {
        ?>
            <table class="table">
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
                    foreach ($data->result() as $d) {
                    ?>
                        <tr>
                            <td style="text-align:center"><?php echo $no++; ?></td>
                            <td><?php echo $d->barang_nama;
                                echo ' [';
                                echo $d->barang_kode;
                                echo ']'; ?></td>
                            <td style="text-align:center"><?php echo $d->bm_tgl_masuk ?></td>
                            <td style="text-align:center"><?php echo $d->bm_jumlah ?></td>
                            <td><?php echo $d->bm_nama_suplier ?></td>
                            <td><?php echo $d->bm_sumber_dana ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        } elseif ($jenis == "barang_keluar") {
        ?>
            <table class="table">
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
                    // $data = mysqli_query($koneksi,"SELECT * FROM barang_keluar WHERE date(bk_tgl_keluar) >= '$tgl_dari' AND date(bk_tgl_keluar) <= '$tgl_sampai'");
                    $data = $this->db->query("SELECT * FROM barang_keluar,fakultas,barang where bk_penerima=fakultas_id and bk_id_barang=barang_id and date(bk_tgl_keluar) >= '$tgl_dari' AND date(bk_tgl_keluar) <= '$tgl_sampai' order by bk_tgl_keluar desc");
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
                            <td><?php echo $d->bk_lokasi ?></td>=============
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        } elseif ($jenis == "peminjaman") {
        ?>
            <table class="table">
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
                    include '../koneksi.php';
                    $no = 1;
                    // $data = mysqli_query($koneksi,"SELECT * FROM barang_keluar WHERE date(bk_tgl_keluar) >= '$tgl_dari' AND date(bk_tgl_keluar) <= '$tgl_sampai'");
                    $data = $this->db->query("SELECT * from pinjam,barang,fakultas where pinjam_barang=barang_id and pinjam_peminjam=fakultas_id and date(pinjam_tgl_pinjam) >= '$tgl_dari' AND date(pinjam_tgl_kembali) <= '$tgl_sampai' order by pinjam_id desc");
                    foreach ($data->result() as $d) {
                    ?>
                        <tr>
                            <td style="text-align:center"><?php echo $d->pinjam_kode ?></td>
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
    <script>
        window.print();
    </script>

</body>

</html>