<section class="content-header">
    <h1>
        Menu Pengguna
        <small>Data Pengguna</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Pengguna</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <section class="col-lg-10 col-lg-offset-1">
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
                    <a href="<?php echo base_url('admin/user_tambah') ?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-plus"></i> &nbsp TAMBAH DATA PENGGUNA</a>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="table-datatable">
                            <thead>
                                <tr>
                                    <th width="1%" style="text-align:center">NO</th>
                                    <th style="text-align:center">NAMA</th>
                                    <th style="text-align:center">USERNAME</th>
                                    <th style="text-align:center">LEVEL</th>
                                    <th style="text-align:center" width="15%">FOTO</th>
                                    <th style="text-align:center" width="13%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $no = 1;
                                $data = $this->db->query("SELECT * FROM user")->result();
                                foreach ($data as $d) {
                                ?>
                                    <tr>
                                        <td style="text-align:center"><?php echo $no++; ?></td>
                                        <td><?php echo $d->user_nama; ?></td>
                                        <td style="text-align:center"><?php echo $d->user_username; ?></td>
                                        <td style="text-align:center"><?php echo $d->user_level; ?></td>
                                        <td>
                                            <center>
                                                <?php if ($d->user_foto == "") { ?>
                                                    <img src="<?php echo base_url() ?>file/sistem/user.png" style="width: 80px;height: auto">
                                                <?php } else { ?>
                                                    <img src="<?php echo base_url() ?>file/user/<?php echo $d->user_foto ?>" style="width: 80px;height: auto">
                                                <?php } ?>
                                            </center>
                                        </td>
                                        <td>
                                            <a class="btn btn-warning btn-sm" href="<?php echo base_url() . 'admin/user_edit/' . $d->user_id ?>"><i class="fa fa-edit"></i></a>
                                            <?php if ($d->user_id != 1) { ?>
                                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#konfirmasi_hapus" data-href="<?php echo base_url('admin/user_hapus/' . $d->user_id) ?>"><i class="fa fa-trash"></i></a>

                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal fade" id="konfirmasi_hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><strong>HAPUS DATA PENGGUNA</strong></h5>
                            </div>
                            <div class="modal-body">

                                <p>Anda Yakin Akan Menghapus Data Ini ?</p>

                            </div>

                            <div class="modal-footer">

                                <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>

                                <a class="btn btn-danger btn-ok">Hapus</a>

                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    //Hapus Data
                    $(document).ready(function() {
                        $('#konfirmasi_hapus').on('show.bs.modal', function(e) {
                            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
                        });

                    });
                </script>

            </div>

        </section>

    </div>

</section>