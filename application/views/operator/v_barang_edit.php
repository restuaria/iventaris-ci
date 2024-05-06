    <section class="content-header">
        <h1>
            Menu Sarana
            <small>Edit Data Barang (Sarana)</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Data Sarana</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <section class="col-lg-6 col-lg-offset-3">
                <div class="box box-info">
                    <div class="box-header">
                        <a href="barang.php" class="btn btn-warning btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a>
                    </div>
                    <div class="box-body">
                        <?php
                        foreach ($data as $d) {
                        ?>
                            <form action="<?php echo base_url() . 'operator/prosesedit_barang/' . $d->barang_id ?>" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label>Jenis Barang</label>
                                    <input type="text" readonly="" class="form-control" name="jenis" required="required" placeholder="Masukkan Jenis Barang ..." value="<?php echo $d->barang_jenis ?>">
                                </div>
                                <div class="form-group">
                                    <label>Kategori Barang</label>
                                    <select name="kategori" class="form-control" required="required">
                                        <option value=""> - Pilih Kategori Barang - </option>
                                        <?php
                                        $kategori = $this->db->query("SELECT * FROM kategori order by kategori_nama asc");

                                        foreach ($kategori->result() as $dus) {
                                        ?>
                                            <option <?php if ($d->barang_kategori == $dus->kategori_id) {
                                                        echo "selected='selected'";
                                                    } ?> value="<?php echo $dus->kategori_id; ?>"><?php echo $dus->kategori_nama; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kode Barang</label>
                                    <input type="text" class="form-control" name="kode" required="required" placeholder="Masukkan Kode Barang ..." value="<?php echo $d->barang_kode ?>">
                                </div>
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input type="hidden" name="id" value="<?php echo $d->barang_id ?>">
                                    <input type="text" class="form-control" name="nama" required="required" placeholder="Masukkan Nama Barang ..." value="<?php echo $d->barang_nama ?>">
                                </div>
                                <div class="form-group">
                                    <label>Merk Barang</label>
                                    <input type="text" class="form-control" name="merk" required="required" placeholder="Masukkan Nama Barang ..." value="<?php echo $d->barang_merk ?>">
                                </div>
                                <div class="form-group">
                                    <label>Spesifikasi Barang</label>
                                    <input type="text" class="form-control" name="spesifikasi" required="required" placeholder="Masukkan Spesifikasi Barang ..." value="<?php echo $d->barang_spesifikasi ?>">
                                </div>
                                <div class="form-group">
                                    <label>Kondisi Barang</label>
                                    <select class="form-control" name="kondisi" required="required">
                                        <option value=""> - Pilih Kondisi Barang - </option>
                                        <option <?php if ($d->barang_kondisi == "Bagus") {
                                                    echo "selected='selected'";
                                                } ?> value="Bagus">Bagus</option>

                                        <option <?php if ($d->barang_kondisi == "Rusak") {
                                                    echo "selected='selected'";
                                                } ?> value="Rusak">Rusak</option>

                                        <option <?php if ($d->barang_kondisi == "Sebagian Rusak") {
                                                    echo "selected='selected'";
                                                } ?> value="Sebagian Rusak">Sebagian Rusak</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Barang</label>
                                    <input type="number" class="form-control" name="jumlah" required="required" placeholder="Masukkan Jumlah Barang ..." value="<?php echo $d->barang_jumlah ?>">
                                </div>
                                <div class="form-group">
                                    <label>Satuan Barang</label>
                                    <select class="form-control" name="satuan" required="required">
                                        <option value=""> - Pilih Satuan Barang - </option>
                                        <option <?php if ($d->barang_satuan == "Unit") {
                                                    echo "selected='selected'";
                                                } ?> value="Unit">Unit</option>
                                        <option <?php if ($d->barang_satuan == "Buah") {
                                                    echo "selected='selected'";
                                                } ?> value="Buah">Buah</option>
                                        <option <?php if ($d->barang_satuan == "Rim") {
                                                    echo "selected='selected'";
                                                } ?> value="Rim">Rim</option>
                                        <option <?php if ($d->barang_satuan == "Roll") {
                                                    echo "selected='selected'";
                                                } ?> value="Roll">Roll</option>
                                        <option <?php if ($d->barang_satuan == "Dus") {
                                                    echo "selected='selected'";
                                                } ?> value="Dus">Dus</option>
                                        <option <?php if ($d->barang_satuan == "Set") {
                                                    echo "selected='selected'";
                                                } ?> value="Set">Set</option>
                                        <option <?php if ($d->barang_satuan == "Meter") {
                                                    echo "selected='selected'";
                                                } ?> value="Meter">Meter</option>
                                        <option <?php if ($d->barang_satuan == "M2") {
                                                    echo "selected='selected'";
                                                } ?> value="M2">M2</option>
                                        <option <?php if ($d->barang_satuan == "Liter") {
                                                    echo "selected='selected'";
                                                } ?> value="Liter">Liter</option>
                                        <option <?php if ($d->barang_satuan == "Karung") {
                                                    echo "selected='selected'";
                                                } ?> value="Karung">Karung</option>
                                        <option <?php if ($d->barang_satuan == "Keping") {
                                                    echo "selected='selected'";
                                                } ?> value="Keping">Keping</option>
                                        <option <?php if ($d->barang_satuan == "Butir") {
                                                    echo "selected='selected'";
                                                } ?> value="Butir">Butir</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tahun Perolehan</label>
                                    <input type="number" class="form-control" name="tahun" required="required" placeholder="Masukkan Tahun Perolehan..." value="<?php echo $d->barang_tahun ?>">
                                </div>
                                <div class="form-group">
                                    <label>Sumber Dana</label>
                                    <select class="form-control" name="sumber" required="required">
                                        <option value=""> - Pilih Sumber Dana - </option>
                                        <option <?php if ($d->barang_sumber == "Hibah") {
                                                    echo "selected='selected'";
                                                } ?> value="Hibah">Hibah</option>
                                        <option <?php if ($d->barang_sumber == "Yayasan") {
                                                    echo "selected='selected'";
                                                } ?> value="Yayasan">Yayasan</option>
                                        <option <?php if ($d->barang_sumber == "Perorangan") {
                                                    echo "selected='selected'";
                                                } ?> value="Perorangan">Perorangan</option>
                                        <option <?php if ($d->barang_sumber == "Perguruan Tinggi") {
                                                    echo "selected='selected'";
                                                } ?> value="Perguruan Tinggi">Perguruan Tinggi</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" class="form-control" name="keterangan" placeholder="Masukkan Keterangan Barang ... (Isikan Apabila Diperlukan)" value="<?php echo $d->barang_keterangan ?>">
                                </div>
                                <div class="form-group">
                                    <label>Lokasi Barang</label>
                                    <select name="lokasi" class="form-control" required="required">
                                        <option value=""> - Pilih Lokasi Barang - </option>
                                        <?php
                                        $fakultas = $this->db->query("SELECT * FROM fakultas fakultas where fakultas_id < 6 order by fakultas_nama asc");
                                        foreach ($fakultas->result() as $dus) {
                                        ?>
                                            <option <?php if ($d->barang_lokasi == $dus->fakultas_id) {
                                                        echo "selected='selected'";
                                                    } ?> value="<?php echo $dus->fakultas_id; ?>"><?php echo $dus->fakultas_nama; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Foto Barang</label>
                                    <input type="file" name="foto">
                                    <p>Format JPG, Max 2Mb. Lakukan Perubahan Apabila Diperlukan</p>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>User</label>
                                    <select name="user" class="form-control" required="required">
                                        <?php
                                        $user = $this->db->query("SELECT * FROM user order by user_username asc");
                                        foreach ($user->result() as $w) {
                                        ?>
                                            <option <?php if ($d->barang_user == $w->user_id) {
                                                        echo "selected='selected'";
                                                    } ?> value="<?php echo $w->user_id; ?>"><?php echo $w->user_username; ?></option>
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