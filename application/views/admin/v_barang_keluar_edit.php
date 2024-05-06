    <section class="content-header">
        <h1>
            Menu Barang Keluar
            <small>Edit Data Barang Keluar</small>
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
                        <a href="barang_keluar.php" class="btn btn-warning btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a>
                    </div>
                    <div class="box-body">
                        <form action="<?php echo base_url('admin/proseseditbk') ?>" method="post">
                            <?php
                            foreach ($data as $d) {
                            ?>
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input type="hidden" name="id" value="<?php echo $d->bk_id ?>">
                                    <select class="form-control dropdown-cari" name="barang" required="required">
                                        <option value=""> - Pilih Nama Barang - </option>
                                        <?php
                                        $barang = $this->db->query("SELECT * from barang")->result();
                                        foreach ($barang as $b) {
                                        ?>
                                            <option <?php if ($d->bk_id_barang == $b->barang_id) {
                                                        echo "selected='selected'";
                                                    } ?> value="<?php echo $b->barang_id; ?>"><?php echo $b->barang_kode;
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
                                    <input type="date" class="form-control" name="tanggal" placeholder="Masukkan tanggal pinjam sampai" required="required" value="<?php echo $d->bk_tgl_keluar ?>">
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Barang</label>
                                    <input type="number" class="form-control" name="jumlah" required="required" placeholder="Masukan Jumlah Barang..." value="<?php echo $d->bk_jumlah ?>">
                                </div>
                                <div class="form-group">
                                    <label>Nama Penerima</label>
                                    <select class="form-control" name="penerima" required="required">
                                        <option value=""> - Pilih Nama Penerima - </option>
                                        <?php
                                        $fakultas = $this->db->query("SELECT * from fakultas")->result();
                                        foreach ($fakultas as $s) {
                                        ?>
                                            <option <?php if ($d->bk_penerima == $s->fakultas_id) {
                                                        echo "selected='selected'";
                                                    } ?> value="<?php echo $s->fakultas_id; ?>"><?php echo $s->fakultas_nama; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nama Gedung</label>
                                    <input type="text" class="form-control" name="lokasi2" required="required" placeholder="Masukkan Nama Gedung ..." value="<?php echo $d->bk_lokasi2 ?>">
                                </div>
                                <div class="form-group">
                                    <label>Nama Ruangan</label>
                                    <input type="text" class="form-control" name="lokasi" required="required" placeholder="Masukkan Nama Ruangan ..." value="<?php echo $d->bk_lokasi ?>">
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" class="form-control" name="keterangan" placeholder="Masukkan Keterangan .." value="<?php echo $d->bk_keterangan ?>">
                                </div>

                                <div class="form-group">
                                    <label>User</label>
                                    <select name="user" class="form-control" required="required">
                                        <?php
                                        $user = $this->db->query("SELECT * FROM user order by user_username asc")->result();
                                        foreach ($user as $w) {
                                        ?>
                                            <option <?php if ($d->bk_user == $w->user_id) {
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
                            <?php
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </section>