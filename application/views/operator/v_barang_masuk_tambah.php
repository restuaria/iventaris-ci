<section class="content-header">
    <h1>
        Menu Barang Masuk
        <small>Tambah Data Barang Masuk</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Barang Masuk</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <section class="col-lg-6 col-lg-offset-3">
            <div class="box box-info">
                <div class="box-header">
                    <a href="barang_masuk.php" class="btn btn-warning btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a>
                </div>
                <div class="box-body">
                    <form action="<?php echo base_url('operator/prosestambahbm') ?>" method="post">
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <select class="form-control dropdown-cari" name="barang" required>
                                <option value=""> - Pilih Nama Barang - </option>
                                <?php
                                $barang = $this->db->query("SELECT * from barang order by barang_kode asc")->result();
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
                            <label>Tanggal Masuk</label>
                            <input type="date" class="form-control" name="tanggal" placeholder="Masukkan tanggal pinjam sampai" required>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Barang</label>
                            <input type="number" class="form-control" name="jumlah" required placeholder="Masukkan Jumlah Barang ...">
                        </div>
                        <div class="form-group">
                            <label>Nama Suplier</label>
                            <select class="form-control" name="suplier" required>
                                <option value=""> - Pilih Nama Suplier - </option>
                                <?php
                                $suplier = $this->db->query("SELECT * from suplier")->result();
                                foreach ($suplier as $s) {
                                ?>
                                    <option value="<?php echo $s->suplier_id ?>"><?php echo $s->suplier_nama ?></option>
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
                            <input type="submit" class="btn btn-sm btn-primary" value="Simpan">
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</section>