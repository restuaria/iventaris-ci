<section class="content-header">
    <h1>
        Menu Kategori
        <small>Data Kategori</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Kategori</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <section class="col-lg-8 col-lg-offset-2">
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
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="">
                            <i class="fa fa-plus"></i> &nbsp TAMBAH DATA KATEGORI
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <!-- Modal -->

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="table-datatable">
                            <thead>
                                <tr>
                                    <th width="1%" style="text-align:center">NO</th>
                                    <th style="text-align:center">NAMA KATEGORI</th>
                                    <th width="14%" style="text-align:center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $data = $this->db->query("SELECT * FROM kategori ORDER BY kategori_nama ASC")->result();
                                foreach ($data as $d) {
                                ?>
                                    <tr>
                                        <td style="text-align:center"><?php echo $no++; ?></td>
                                        <td><?php echo $d->kategori_nama ?></td>
                                        <td>
                                            -

                                        </td>
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