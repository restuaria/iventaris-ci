    <section class="content-header">
        <h1>
            Menu Prasarana
            <small>Data Prasarana</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Data Prasarana</li>
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
                        <form method="post" action="<?php echo base_url('admin/filterprasarana') ?>">
                            <div class="form-group">
                                <label><b>FILTER DATA</b></label>
                                <select name="fakultas" class="form-control" required="required">
                                    <option value=""> - Pilih Lokasi - </option>
                                    <?php
                                    $fakultas = $this->db->query("SELECT * FROM fakultas where fakultas_id < 7 order by fakultas_nama asc");
                                    foreach ($fakultas->result() as $d) {
                                    ?>
                                        <option value="<?php echo $d->fakultas_id ?>"><?php echo $d->fakultas_nama ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <input type="submit" value="Tampilkan Data" class="btn btn-primary btn-sm">
                        </form>
                        <div class="btn-group pull-right">
                            <a href="#" class="btn btn-sm btn-success"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a>
                            <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-file-pdf-o"></i> &nbsp EXPORT EXCEL</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="table-datatable">
                                <thead>
                                    <tr>
                                        <th width="1%" style="text-align:center">NO</th>
                                        <th style="text-align:center">NAMA</th>
                                        <th style="text-align:center">KODE</th>
                                        <th style="text-align:center">LUAS/BANGUNAN</th>
                                        <th style="text-align:center">TAHUN/KEPEMILIKAN</th>
                                        <th style="text-align:center">SUMBER DANA</th>
                                        <th style="text-align:center">LOKASI</th>
                                        <th width="13%" style="text-align:center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data as $d) {
                                    ?>
                                        <tr>

                                            <td style="text-align:center"><?php echo $no++; ?></td>

                                            <td><?php echo $d->barang_ruangan ?></td>
                                            <td style="text-align:center"><?php echo $d->barang_kode ?></td>
                                            <td><?php echo $d->barang_ukuran ?> / <?php echo $d->barang_konstruksi ?></td>
                                            <td><?php echo $d->barang_tahun ?> / <?php echo $d->barang_pemilik ?></td>
                                            <td><?php echo $d->barang_sumber_dana ?></td>
                                            <td><?php echo $d->fakultas_nama ?></td>
                                            <td>
                                                -
                                            </td>
                                            <!-- modal hapus -->

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