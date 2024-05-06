<section class="content-header">
    <h1>
        Menu Lokasi/Penerima
        <small>Data Lokasi/Penerima</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Lokasi/Penerima</li>
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
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-plus"></i> &nbsp TAMBAH DATA LOKASI/PENERIMA
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <!-- Modal -->
                    <form action="<?php echo base_url('operator/lokasi_tambah') ?>" method="post">
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><strong>TAMBAH DATA LOKASI/PENERIMA</strong></h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Nama Lokasi/Penerima<strong></strong></label>
                                            <input type="text" name="nama" required="required" class="form-control" placeholder="Masukan Nama Lokasi/Penerima ..">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-warning">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="table-datatable">
                            <thead>
                                <tr>
                                    <th width="1%" style="text-align:center">NO</th>
                                    <th style="text-align:center">NAMA LOKASI/PENERIMA</th>
                                    <th width="14%" style="text-align:center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $data = $this->db->query("SELECT * FROM fakultas  ORDER BY fakultas_nama ASC");
                                foreach ($data->result() as $d) {
                                ?>
                                    <tr>
                                        <td style="text-align:center"><?php echo $no++; ?></td>
                                        <td><?php echo $d->fakultas_nama; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_fakultas_<?php echo $d->fakultas_id ?>">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_fakultas_<?php echo $d->fakultas_id ?>">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <form action="<?php echo base_url('operator/lokasi_edit') ?>" method="post">
                                                <div class="modal fade" id="edit_fakultas_<?php echo $d->fakultas_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel"><strong>EDIT DATA LOKASI/PENERIMA</strong></h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group" style="width:100%">
                                                                    <label>Nama Lokasi/Penerima</label>
                                                                    <input type="hidden" name="id" required="required" class="form-control" value="<?php echo $d->fakultas_id; ?>">
                                                                    <input type="text" name="nama" required="required" class="form-control" value="<?php echo $d->fakultas_nama; ?>" style="width:100%">
                                                                </div>
                                                                <br /><br />
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-danger">Update</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- modal hapus -->
                                            <div class="modal fade" id="hapus_fakultas_<?php echo $d->fakultas_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><strong>HAPUS DATA LOKASI/PENERIMA</strong></h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Anda Yakin Akan Menghapus Data Ini ?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                                                            <a href="<?php echo base_url() . 'operator/lokasi_hapus/' .  $d->fakultas_id ?>" class="btn btn-warning">Hapus</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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