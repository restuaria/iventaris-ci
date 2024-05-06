    <section class="content-header">
        <h1>
            Menu Sarana
            <small>Data Sarana</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Data Sarana</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <section class="col-lg-12">
                <div class="box box-info">
                    <div class="box-header">
                        <?php if (isset($_SESSION['error'])) { ?>
                            <!-- If Error -->
                            <div class="alert alert-success alert-dismissible fade in">
                                <i class="fa fa-warning"></i> &nbsp;DATA YANG ANDA INPUT SUDAH ADA DI DATABASE. <strong><?php echo $_SESSION['error'] ?></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- End of If Error -->
                        <?php unset($_SESSION['error']);
                        } ?>
                        <?php
                        if (isset($_GET['alert'])) {
                            if ($_GET['alert'] == "gagal") {
                        ?>
                                <div class="alert alert-success alert-dismissible fade in">
                                    <i class="fa fa-warning"></i> &nbsp;DATA GAGAL DISIMPAN. <strong>CEK KEMBALI DATA ATAU DOKUMEN YANG ANDA INPUT </strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                        <?php
                            }
                        }
                        ?>
                        <?php
                        if (isset($_GET['alert'])) {
                            if ($_GET['alert'] == "berhasil") {
                        ?>
                                <div class="alert alert-success alert-dismissible fade in">
                                    <i class="fa fa-refresh"></i> &nbsp;SIMPAN DATA <strong>BERHASIL </strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                        <?php
                            }
                        }
                        ?>
                        <?php
                        if (isset($_GET['alert'])) {
                            if ($_GET['alert'] == "update") {
                        ?>
                                <div class="alert alert-success alert-dismissible fade in">
                                    <i class="fa fa-refresh"></i> &nbsp;UPDATE DATA <strong>BERHASIL </strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                        <?php
                            }
                        }
                        ?>
                        <?php
                        if (isset($_GET['alert'])) {
                            if ($_GET['alert'] == "hapus") {
                        ?>
                                <div class="alert alert-success alert-dismissible fade in">
                                    <i class="fa fa-trash"></i> &nbsp;HAPUS DATA <strong>BERHASIL </strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                        <?php
                            }
                        }
                        ?>
                        <?php
                        if (isset($_GET['alert'])) {
                            if ($_GET['alert'] == "berhasiltanpafoto") {
                        ?>
                                <div class="alert alert-success alert-dismissible fade in">
                                    <i class="fa fa-refresh"></i> &nbsp;SIMPAN DATA TANPA FOTO <strong>BERHASIL </strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                        <?php
                            }
                        }
                        ?>
                        <div class="btn-group pull-right">
                            <a href="<?php echo base_url("operator/barang_tambah") ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> &nbsp TAMBAH DATA</a>
                            <a href="<?php echo base_url("operator/barangpdf") ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a>
                            <a href="<?php echo base_url("operator/barangexcel") ?>" target="_blank" class="btn btn-sm btn-danger"><i class="fa fa-file-pdf-o"></i> &nbsp EXPORT EXCEL</a>
                            <a href="<?php echo base_url("operator/importexcel") ?>" target="_blank" class="btn btn-sm btn-warning"><i class="fa fa-file-pdf-o"></i> &nbsp IMPORT EXCEL</a>
                            <a href="<?php echo base_url("file/format/format_sarana.xlsx") ?>" target="_blank" class="btn btn-sm btn-info"><i class="fa fa-file-pdf-o"></i> &nbsp FORMAT EXPORT EXCEL</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="table-datatable">
                                <thead>
                                    <tr>
                                        <th width="1%" style="text-align:center">NO</th>
                                        <th style="text-align:center">KATEGORI</th>
                                        <th style="text-align:center">BARANG</th>
                                        <th style="text-align:center">MERK/SPESIFIKASI</th>
                                        <th style="text-align:center">KONDISI</th>
                                        <th style="text-align:center">JUMLAH</th>
                                        <th style="text-align:center">SATUAN</th>
                                        <th style="text-align:center">LOKASI</th>
                                        <th width="13%" style="text-align:center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($barang as $d) {
                                    ?>
                                        <tr>
                                            <td style="text-align:center"><?php echo $no++; ?></td>
                                            <td><?php echo $d->kategori_nama ?></td>
                                            <td><?php echo $d->barang_nama ?> [<?php echo $d->barang_kode ?>]</td>
                                            <td><?php echo $d->barang_merk ?> [<?php echo $d->barang_spesifikasi ?>]</td>
                                            <td><?php echo $d->barang_kondisi ?></td>
                                            <td style="text-align:center"><?php echo $d->barang_jumlah ?></td>
                                            <td style="text-align:center"><?php echo $d->barang_satuan ?></td>
                                            <td><?php echo $d->fakultas_nama ?></td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="<?php echo base_url() . 'operator/barangdetail/' . $d->barang_id ?>"><i class="fa fa-folder"></i></a>
                                                <a class="btn btn-warning btn-sm" href="<?php echo base_url() . 'operator/barang_edit/' . $d->barang_id ?>"><i class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_barang_<?php echo $d->barang_id ?>">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                            <!-- modal hapus -->
                                            <div class="modal fade" id="hapus_barang_<?php echo $d->barang_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><strong>HAPUS DATA BARANG</strong></h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <strong>
                                                                <p>Anda Yakin Akan Menghapus Data Ini ?</p>
                                                            </strong>
                                                            <p>Dengan Menghapus Data Barang Ini, Semua Data Barang Keluar, Barang Masuk &amp; Peminjaman Yang Berhubungan Dengan Barang Ini Akan Terhapus !!!</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                                                            <a href="<?php echo base_url() . 'operator/hapus_barang/' . $d->barang_id ?>" class="btn btn-warning">Hapus</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>