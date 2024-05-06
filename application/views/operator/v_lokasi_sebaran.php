    <section class="content-header">
        <h1>
            Menu Prasarana
            <small>Data Barang (Prasarana)</small>
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
                    </div>
                    <div class="box-body">
                        <?php
                        $pts = $this->db->query("SELECT * FROM pts where pts_id = 1");
                        foreach ($pts->result() as $w);
                        ?>
                        <center>
                            <h3 style="text-transform:uppercase">&nbsp <strong>SEBARAN SARANA PRASARANA <br /><?php echo $w->pts_nama ?></strong></h3>
                        </center>
                        <br /><br />
                        <div class="box-header">
                            <a href="<?php echo base_url('operator/lokasi_sarana_pdf') ?>" target="_blank" class="btn btn-sm btn-warning"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a> <br /><br />
                            <h3 class="box-title">Sarana</h3>
                        </div>
                        <?php
                        $dosen2 = $this->db->query("SELECT * FROM barang")->num_rows();
                        ?>
                        <?php
                        $no = 1;
                        $dosen = $this->db->query("SELECT fakultas_nama , COUNT(barang.barang_lokasi) AS jumlah FROM fakultas 
                                    LEFT JOIN barang ON (barang.barang_lokasi= fakultas.fakultas_id) where fakultas_id < 6
                                    GROUP BY fakultas_nama ");
                        ?>
                        <table class="table table-bordered " id="table-datatable">
                            <tr>
                                <td bgcolor="#CCCCCC" class="text-center"><strong>No</strong></td>
                                <td bgcolor="#CCCCCC" class="text-center"><strong>Lokasi</strong></td>
                                <td bgcolor="#CCCCCC" class="text-center"><strong>Jumlah</strong></td>
                            </tr>
                            <?php
                            foreach ($dosen->result() as $w) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td><?php echo $w->fakultas_nama ?></td>
                                    <td class="text-center"><?php echo $w->jumlah ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td colspan="2" align="center"><strong>Total</strong></td>
                                <td align="center" bgcolor="#CCCCCC"><strong><?php echo $dosen2 ?></strong></td>
                            </tr>
                            </tbody>
                        </table>
                        <br /><br />
                        <div class="box-header">
                            <a href="<?php echo base_url('operator/lokasi_prasarana_pdf') ?>" target="_blank" class="btn btn-sm btn-warning"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a> <br /><br />
                            <h3 class="box-title">Prasarana</h3>
                        </div>
                        <?php
                        $dosen22 = $this->db->query("SELECT * FROM barang_prasarana")->num_rows();
                        ?>
                        <?php
                        $no = 1;
                        $dosen33 = $this->db->query("SELECT fakultas_nama, COUNT(barang_prasarana.barang_lokasi) AS jumlah FROM fakultas 
LEFT JOIN barang_prasarana ON (barang_prasarana.barang_lokasi= fakultas.fakultas_id) where fakultas_id < 7
GROUP BY fakultas_nama");
                        ?>
                        <table class="table table-bordered " id="table-datatable">
                            <tr>
                                <td bgcolor="#CCCCCC" class="text-center"><strong>No</strong></td>
                                <td bgcolor="#CCCCCC" class="text-center"><strong>Lokasi</strong></td>
                                <td bgcolor="#CCCCCC" class="text-center"><strong>Jumlah</strong></td>
                            </tr>
                            <?php
                            foreach ($dosen33->result() as $we) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td><?php echo $we->fakultas_nama ?></td>
                                    <td class="text-center"><?php echo $we->jumlah ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td colspan="2" align="center"><strong>Total</strong></td>
                                <td align="center" bgcolor="#CCCCCC"><strong><?php echo $dosen22 ?></strong></td>
                            </tr>
                            </tbody>
                        </table>
                        <br />
                    </div>
                </div>
            </section>
        </div>
    </section>