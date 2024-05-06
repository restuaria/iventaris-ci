<section class="content-header">
    <h1>
        Menu Barang Keluar
        <small>Tambah Data Barang Keluar</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Barang Keluar</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <section class="col-lg-6 col-lg-offset-3">
            <div class="box box-info">
                <div class="box-header">
                    <a href="<?php echo base_url('operator/barangkeluar') ?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a>
                </div>
                <div class="box-body">
                    <form action="<?php echo base_url('operator/prosestambahbk') ?>" method="post">

                        <div class="form-group">
                            <label>Nama Barang</label>
                            <select class="form-control dropdown-cari" name="barang" required>
                                <option value=""> - Pilih Nama Barang - </option>
                                <?php
                                $barang = $this->db->query("SELECT * from barang")->result();
                                foreach ($barang as $b) {
                                ?>
                                    <option value="<?php echo $b->barang_id; ?>"><?php echo $b->barang_kode;
                                                                                    echo ' [';
                                                                                    echo $b->barang_nama;
                                                                                    echo ']'; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Keluar</label>
                            <input type="date" class="form-control" name="tanggal" placeholder="Masukkan tanggal pinjam sampai" required>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Barang</label>
                            <input type="number" class="form-control" name="jumlah" required placeholder="Masukan Jumlah Barang...">
                        </div>
                        <div class="form-group">
                            <label>Nama Penerima</label>
                            <select class="form-control" name="penerima" required>
                                <option value=""> - Pilih Nama Penerima - </option>
                                <?php
                                $fakultas = $this->db->query("SELECT * from fakultas")->result();
                                foreach ($fakultas as $s) {
                                ?>
                                    <option value="<?php echo $s->fakultas_id; ?>"><?php echo $s->fakultas_nama; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Gedung</label>
                            <input type="text" class="form-control" name="lokasi2" required placeholder="Masukkan Nama Gedung ...">
                        </div>
                        <div class="form-group">
                            <label>Nama Ruangan</label>
                            <input type="text" class="form-control" name="lokasi" required placeholder="Masukkan Nama Ruangan ...">
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" placeholder="Masukkan Keterangan ..">
                        </div>

                        <div class="form-group">
                            <label>User</label>
                            <select name="user" class="form-control" required>
                                <?php
                                $user = $this->db->query("SELECT * FROM user order by user_username asc")->result();
                                foreach ($user as $w) {
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
                            <input type="submit" class="btn btn-sm btn-danger" value="Tambah">
                        </div>

                    </form>
                </div>
            </div>
        </section>
    </div>
</section>