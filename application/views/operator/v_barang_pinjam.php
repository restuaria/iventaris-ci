<section class="content-header">
    <h1>
        Menu Peminjaman
        <small>Data Peminjaman</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Peminjaman</li>
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
                        if ($_GET['alert'] == "lebih") {
                    ?>
                            <div class="alert alert-success alert-dismissible fade in">
                                <i class="fa fa-refresh"></i> &nbsp;JUMLAH BARANG YANG KELUAR <strong>MELEBIHI JUMLAH BARANG YANG ADA </strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <div class="btn-group pull-right">
                        <a href="<?php echo base_url("operator/tambahpeminjaman") ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> &nbsp TAMBAH DATA</a>
                        <a href="<?php echo base_url('operator/peminjamanpdf') ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a>
                        <a href="<?php echo base_url('operator/peminjamanexcel') ?>" target="_blank" class="btn btn-sm btn-danger"><i class="fa fa-file-pdf-o"></i> &nbsp EXPORT EXCEL</a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="container-fluid mt-5">
                        <div class="card">
                            <div class="card-body">
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
                                                <th style="text-align:center" width="11%">AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $data = $this->db->query("SELECT * from pinjam,barang,fakultas where pinjam_barang=barang_id and pinjam_peminjam=fakultas_id order by pinjam_id desc");
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
                                                    <td class="text-center">
                                                        <?php
                                                        if ($d->pinjam_status == 'Sudah Dikembalikan') {
                                                            echo "-";
                                                        } else if ($d->pinjam_status == 'Sedang Dipinjam') {
                                                        ?>
                                                            <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#konfirmasi_selesai" data-href="<?php echo base_url() . 'operator/pinjamupdate/' . $d->pinjam_id ?> "><i class='fa fa-inbox'></i></a>
                                                            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#konfirmasi_batal" data-href="<?php echo base_url() . 'operator/pinjamhapus/' . $d->pinjam_id ?> "><i class='fa fa-close'></i></a>
                                                            <!-- <?php echo "<a class='btn btn-warning btn-sm' data-toggle='modal' data-target='#konfirmasi_selesai' data-href='peminjaman_update.php?id=" . $d->pinjam_id . "'><i class='fa fa-inbox'></i></a>"; ?>
                                                            <?php echo "<a class='btn btn-danger btn-sm' data-toggle='modal' data-target='#konfirmasi_batal' data-href='peminjaman_hapus.php?id=" . $d->pinjam_id . "'><i class='fa fa-close'></i></a>"; ?> -->

                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <div class="modal fade" id="konfirmasi_selesai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"><strong>DATA PEMINJAMAN</strong></h5>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Anda Yakin Akan Menyelesaikan Data Peminjaman Ini ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a class="btn btn-danger btn-ok"> Selesai</a>
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="konfirmasi_batal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><strong>DATA PEMINJAMAN</strong></h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Anda Yakin Akan Membatalkan Data Peminjaman Ini ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a class="btn btn-danger btn-ok"> Batalkan</a>
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        //Hapus Data
                                        $(document).ready(function() {
                                            $('#konfirmasi_selesai').on('show.bs.modal', function(e) {
                                                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
                                            });
                                        });
                                    </script>
                                    <script type="text/javascript">
                                        //Hapus Data
                                        $(document).ready(function() {
                                            $('#konfirmasi_batal').on('show.bs.modal', function(e) {
                                                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
</section>