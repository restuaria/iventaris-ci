    <section class="content-header">
        <h1>
            Menu Prasarana
            <small>Edit Data Prasarana</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Data Prasarana</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <section class="col-lg-6 col-lg-offset-3">
                <div class="box box-info">
                    <div class="box-header">
                        <a href="<?php echo base_url('admin/prasarana') ?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a>
                    </div>
                    <div class="box-body">
                        <?php
                        foreach ($data as $w) {
                        ?>
                            <form action="<?php echo base_url('admin/prasaranaedit_p/' . $w->barang_id) ?>" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label>Jenis Barang</label>
                                    <!-- <input type="hidden" name="id" value="<?php echo $w->barang_id ?>"> -->
                                    <input type="text" readonly="" class="form-control" name="jenis" required="required" placeholder="Masukkan Nama Gedung ..." value="<?php echo $w->barang_jenis ?>">
                                </div>
                                <div class="form-group">
                                    <label>Kode Barang</label>
                                    <input type="text" class="form-control" name="kode" required="required" placeholder="Masukkan Kode Barang ..." value="<?php echo $w->barang_kode ?>">
                                </div>
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input type="text" class="form-control" name="ruangan" required="required" placeholder="Masukkan Nama Barang ..." value="<?php echo $w->barang_ruangan ?>">
                                </div>
                                <div class="form-group">
                                    <label>Luas</label>
                                    <input type="text" class="form-control" name="ukuran" required="required" placeholder="Masukkan Luas ..." value="<?php echo $w->barang_ukuran ?>">
                                </div>
                                <div class="form-group">
                                    <label>Konstruksi/Tingkat</label>
                                    <input type="text" class="form-control" name="konstruksi" required="required" placeholder="Masukkan Nama Konstruksi ..." value="<?php echo $w->barang_konstruksi ?>">
                                </div>
                                <div class="form-group">
                                    <label>Kepemilikan</label>
                                    <input type="text" class="form-control" name="pemilik" required="required" placeholder="Masukkan Kepemilikan ..." value="<?php echo $w->barang_pemilik ?>">
                                </div>
                                <div class="form-group">
                                    <label>No. Kepemilikan</label>
                                    <input type="text" class="form-control" name="no_pemilik" required="required" placeholder="Masukkan No. Kepemilikan ..." value="<?php echo $w->barang_no_pemilik ?>">
                                </div>
                                <div class="form-group">
                                    <label>Tahun Perolehan</label>
                                    <input type="number" class="form-control" name="tahun" required="required" placeholder="Masukkan Tahun Perolehan..." value="<?php echo $w->barang_tahun ?>">
                                </div>
                                <div class="form-group">
                                    <label>Sumber Dana</label>
                                    <select class="form-control" name="sumber_dana" required="required">
                                        <option value=""> - Pilih Sumber Dana - </option>
                                        <option <?php if ($w->barang_sumber_dana == "Hibah") {
                                                    echo "selected='selected'";
                                                } ?> value="Hibah">Hibah</option>
                                        <option <?php if ($w->barang_sumber_dana == "Yayasan") {
                                                    echo "selected='selected'";
                                                } ?> value="Yayasan">Yayasan</option>
                                        <option <?php if ($w->barang_sumber_dana == "Perorangan") {
                                                    echo "selected='selected'";
                                                } ?> value="Perorangan">Perorangan</option>
                                        <option <?php if ($w->barang_sumber_dana == "Perguruan Tinggi") {
                                                    echo "selected='selected'";
                                                } ?> value="Perguruan Tinggi">Perguruan Tinggi</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Kondisi</label>
                                    <select class="form-control" name="kondisi" required="required">
                                        <option value=""> - Pilih Kondisi - </option>
                                        <option <?php if ($w->barang_kondisi == "Bagus") {
                                                    echo "selected='selected'";
                                                } ?> value="Bagus">Bagus</option>
                                        <option <?php if ($w->barang_kondisi == "Rusak") {
                                                    echo "selected='selected'";
                                                } ?> value="Rusak">Rusak</option>
                                        <option <?php if ($w->barang_kondisi == "Sebagian Rusak") {
                                                    echo "selected='selected'";
                                                } ?> value="Sebagian Rusak">Sebagian Rusak</option>
                                        <option <?php if ($w->barang_kondisi == "Belum Digunakan") {
                                                    echo "selected='selected'";
                                                } ?> value="elum Digunakan">elum Digunakan</option>
                                        <option <?php if ($w->barang_kondisi == "Digunakan") {
                                                    echo "selected='selected'";
                                                } ?> value="Digunakan">Digunakan</option>
                                        <option <?php if ($w->barang_kondisi == "Tidak Digunakan") {
                                                    echo "selected='selected'";
                                                } ?> value="Tidak Digunakan">Tidak Digunakan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Lokasi</label>
                                    <select name="lokasi" class="form-control" required="required">
                                        <option value=""> - Pilih Lokasi Barang - </option>
                                        <?php
                                        $fakultas = $this->db->query("SELECT * FROM fakultas where fakultas_id < 7 order by fakultas_nama asc")->result();
                                        foreach ($fakultas as $dus) {
                                        ?>
                                            <option <?php if ($w->barang_lokasi == $dus->fakultas_id) {
                                                        echo "selected='selected'";
                                                    } ?> value="<?php echo $dus->fakultas_id; ?>"><?php echo $dus->fakultas_nama; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>

                                    <input type="text" class="form-control" name="keterangan" required="required" placeholder="Masukkan Keterangan ..." value="<?php echo $w->barang_keterangan ?>">
                                </div>

                                <div class="form-group">
                                    <label>Foto Barang</label>
                                    <input type="file" name="foto">
                                    <p>Format JPG, Max 2Mb. Lakukan Perubahan Apabila Diperlukan</p>
                                </div>
                                <div class="form-group">
                                    <label>User</label>
                                    <select name="user" class="form-control" required="required">
                                        <?php
                                        $user = $this->db->query("SELECT * FROM user order by user_username asc")->result();
                                        foreach ($user as $d) {
                                        ?>
                                            <option <?php if ($w->barang_user == $d->user_id) {
                                                        echo "selected='selected'";
                                                    } ?> value="<?php echo $d->user_id; ?>"><?php echo $d->user_username; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <small>Dirubah Apabila Diperlukan</small>
                                    <br>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-sm btn-danger" value="Update">
                                </div>

                            </form>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </section>