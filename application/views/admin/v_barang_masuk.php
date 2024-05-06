    <section class="content-header">
        <h1>
            Menu Barang Masuk
            <small>Data Barang Masuk</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Data Barang Masuk</li>
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
                        <div class="btn-group pull-right">
                            <a href="<?php echo base_url('admin/barangmasukpdf') ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a>
                            <a href="<?php echo base_url('admin/barangmasukexcel') ?>" target="_blank" class="btn btn-sm btn-danger"><i class="fa fa-file-pdf-o"></i> &nbsp EXPORT EXCEL</a>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="table-datatable">
                                <thead>
                                    <tr>
                                        <th width="1%" style="text-align:center">NO</th>
                                        <th style="text-align:center">NAMA</th>
                                        <th style="text-align:center">TGL. MASUK</th>
                                        <th style="text-align:center">JUMLAH</th>
                                        <th style="text-align:center">SUPLIER</th>
                                        <th width="11%" style="text-align:center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $data = $this->db->query("SELECT * from barang_masuk,barang where bm_id_barang=barang_id order by bm_tgl_masuk desc")->result();
                                    foreach ($data as $d) {
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
                                            <td>
                                                <a class="btn btn-warning btn-sm" href="<?php echo base_url() . 'admin/editbarangmasuk/' . $d->bm_id ?>"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#konfirmasi_batal" data-href="<?php echo base_url() . 'admin/hapusbm/' . $d->bm_id ?> "><i class='fa fa-trash'></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="modal fade" id="konfirmasi_batal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"><strong>DATA BARANG MASUK</strong></h5>
                                            </div>
                                            <div class="modal-body">
                                                <p>Anda Yakin Akan Menghapus Data Barang Masuk Ini ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a class="btn btn-danger btn-ok"> Hapus</a>
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            </section>
        </div>
    </section>