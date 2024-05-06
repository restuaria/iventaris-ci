<section class="content-header">
    <h1>
        Menu Prasarana
        <small>Tambah Data Barang (Prasarana)</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="#"><i class="fa fa-dashboard"></i> Home</a>
        </li>
        <li class="active">Data Barang</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <?php if (isset($_SESSION['error'])) { ?>
            <!-- If Error -->
            <div class="col-lg-12">
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error'] ?>
                </div>
            </div>
            <!-- End of If Error -->
        <?php unset($_SESSION['error']);
        } ?>
        <section class="col-lg-6 col-lg-offset-3">
            <div class="box box-info">
                <div class="box-header">
                    <a href="<?php echo base_url('operator/prasarana') ?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a>
                </div>
                <div class="box-body">
                    <form action="<?php echo base_url('operator/prosesprasaranatambah') ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Jenis Barang</label>
                            <input type="text" readonly="" class="form-control" name="jenis" required value="Prasarana">
                        </div>
                        <div class="form-group">
                            <label>Kode Ruangan</label>
                            <input type="text" class="form-control" name="kode" required placeholder="Masukkan Kode Ruangan ...">
                        </div>
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" class="form-control" name="ruangan" required placeholder="Masukkan Nama Ruangan ...">
                        </div>
                        <div class="form-group">
                            <label>Luas</label>
                            <input type="text" class="form-control" required name="ukuran" placeholder="Masukkan Luas ... ">
                        </div>
                        <div class="form-group">
                            <label>Konstruksi/Tingkat</label>
                            <input type="text" class="form-control" required name="konstruksi" placeholder="Masukkan Konstruksi/Tingkat ... ">
                        </div>
                        <div class="form-group">
                            <label>Kepemilikan</label>
                            <input type="text" class="form-control" required name="pemilik" placeholder="Masukkan Kepemilikan ... ">
                        </div>
                        <div class="form-group">
                            <label>No. Kepemilikan</label>
                            <input type="text" class="form-control" required name="no_pemilik" placeholder="Masukkan No. Kepemilikan ... ">
                        </div>
                        <div class="form-group">
                            <label>Tahun Perolehan</label>
                            <input type="number" class="form-control" name="tahun" required placeholder="Masukkan Tahun Perolehan ... ">
                        </div>
                        <div class="form-group">
                            <label>Sumber Dana</label>
                            <select class="form-control" name="sumber_dana" required>
                                <option value=""> - Pilih Sumber Dana -</option>
                                <option value="Hibah">Hibah</option>
                                <option value="Yayasan">Yayasan</option>
                                <option value="Perorangan">Perorangan</option>
                                <option value="Perguruan Tinggi">Perguruan Tinggi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kondisi</label>
                            <select class="form-control" name="kondisi" required>
                                <option value=""> - Pilih Kondisi -</option>
                                <option value="Bagus">Bagus</option>
                                <option value="Rusak">Rusak</option>
                                <option value="Sebagian Rusak">Sebagian Rusak</option>
                                <option value="Digunakan">Digunakan</option>
                                <option value="Tidak Digunakan">Tidak Digunakan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Lokasi</label>
                            <select name="lokasi" class="form-control" required>
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

                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" required placeholder="Masukkan Keterangan ...">
                        </div>
                        <div class="form-group">
                            <label>Foto Barang</label>
                            <input type="file" name="foto">
                            <small>Format JPG, Max 2Mb.</small>
                            <br>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-sm btn-danger" value="Simpan">
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</section>