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
                        <a href="<?php echo base_url('operator/databarang/') ?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a>
                    </div>
                    <div class="box-body">
                        <form action="<?php echo base_url() . 'operator/prosestambah_barang/' ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Jenis Barang</label>
                                <input type="text" readonly="" class="form-control" name="jenis" required value="Sarana" placeholder="Masukkan Jenis Barang ...">
                            </div>
                            <div class="form-group">
                                <label>Kategori Barang</label>
                                <select name="kategori" class="form-control" required>
                                    <option value=""> - Pilih Kategori Barang - </option>
                                    <?php
                                    $kategori = $this->db->query("SELECT * FROM kategori order by kategori_nama asc");

                                    foreach ($kategori->result() as $dus) {
                                    ?>
                                        <option value="<?php echo $dus->kategori_id; ?>"><?php echo $dus->kategori_nama; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kode Barang</label>
                                <input type="text" class="form-control" name="kode" required placeholder="Masukkan Kode Barang ...">
                            </div>
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control" name="nama" required placeholder="Masukkan Nama Barang ...">
                            </div>
                            <div class="form-group">
                                <label>Merk Barang</label>
                                <input type="text" class="form-control" name="merk" required placeholder="Masukkan Nama Barang ...">
                            </div>
                            <div class="form-group">
                                <label>Spesifikasi Barang</label>
                                <input type="text" class="form-control" name="spesifikasi" required placeholder="Masukkan Spesifikasi Barang ...">
                            </div>
                            <div class="form-group">
                                <label>Kondisi Barang</label>
                                <select class="form-control" name="kondisi" required>
                                    <option value=""> - Pilih Kondisi Barang - </option>
                                    <option value="Bagus">Bagus</option>
                                    <option value="Rusak">Rusak</option>
                                    <option value="Sebagian Rusak">Sebagian Rusak</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jumlah Barang</label>
                                <input type="number" class="form-control" name="jumlah" required placeholder="Masukkan Jumlah Barang ...">
                            </div>
                            <div class="form-group">
                                <label>Satuan Barang</label>
                                <select class="form-control" name="satuan" required>
                                    <option value=""> - Pilih Satuan Barang - </option>
                                    <option value="Unit">Unit</option>
                                    <option value="Buah">Buah</option>
                                    <option value="Rim">Rim</option>
                                    <option value="Roll">Roll</option>
                                    <option value="Dus">Dus</option>
                                    <option value="Set">Set</option>
                                    <option value="Meter">Meter</option>
                                    <option value="M2">M2</option>
                                    <option value="Liter">Liter</option>
                                    <option value="Karung">Karung</option>
                                    <option value="Keping">Keping</option>
                                    <option value="Butir">Butir</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tahun Perolehan</label>
                                <input type="number" class="form-control" name="tahun" required placeholder="Masukkan Tahun Perolehan...">
                            </div>
                            <div class="form-group">
                                <label>Sumber Dana</label>
                                <select class="form-control" name="sumber" required>
                                    <option value=""> - Pilih Sumber Dana - </option>
                                    <option value="Hibah">Hibah</option>
                                    <option value="Yayasan">Yayasan</option>
                                    <option value="Perorangan">Perorangan</option>
                                    <option value="Perguruan Tinggi">Perguruan Tinggi</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" class="form-control" name="keterangan" placeholder="Masukkan Keterangan Barang ... (Isikan Apabila Diperlukan)">
                            </div>
                            <div class="form-group">
                                <label>Lokasi Barang</label>
                                <select name="lokasi" class="form-control" required>
                                    <option value=""> - Pilih Lokasi Barang - </option>
                                    <?php
                                    $fakultas = $this->db->query("SELECT * FROM fakultas fakultas where fakultas_id < 6 order by fakultas_nama asc");
                                    foreach ($fakultas->result() as $dus) {
                                    ?>
                                        <option value="<?php echo $dus->fakultas_id; ?>"><?php echo $dus->fakultas_nama; ?></option>
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
                                <select name="user" class="form-control" required>
                                    <?php
                                    $user = $this->db->query("SELECT * FROM user order by user_username asc");
                                    foreach ($user->result() as $w) {
                                    ?>
                                        <option value="<?php echo $w->user_id; ?>"><?php echo $w->user_username; ?></option>
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

                    </div>
                </div>
            </section>
        </div>
    </section>