<section class="content-header">
    <h1>
        Menu Peminjaman
        <small>Tambah Data Peminjaman</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Peminjaman</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <section class="col-lg-6 col-lg-offset-3">
            <div class="box box-info">
                <div class="box-header">
                    <a href="<?php echo base_url("operator/peminjaman") ?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a>
                </div>
                <div class="box-body">
                    <form action="<?php echo base_url("operator/prosestambahpinjam") ?>" method="post">
                        <?php
                        $query = $this->db->query("SELECT max(pinjam_kode) as kodeTerbesar FROM pinjam")->result();
                        foreach ($query as $data);
                        $kodeBarang = $data->kodeTerbesar;
                        $urutan = (int) substr($kodeBarang, 4, 4);
                        $urutan++;
                        $huruf = "PJM-";
                        $kodeBarang = $huruf . sprintf("%03s", $urutan);
                        ?>
                        <div class="form-group">
                            <label>Kode</label>
                            <input type="text" name="kode" class="form-control" placeholder="Masukan Nama Anggota .." required="required" value="<?php echo $kodeBarang ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <select class="form-control dropdown-cari" name="barang" required="required">
                                <option value=""> - Pilih Nama Barang - </option>
                                <?php
                                $barang = $this->db->query("SELECT * from barang order by barang_kode asc")->result();
                                //  $barang = mysqli_query($koneksi,"SELECT DISTINCT barang_kode,barang_nama from barang order by barang_kode asc");
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
                            <label>Nama Peminjam</label>
                            <input autocomplete="off" type="text" class="form-control" name="nama" required="required" placeholder="Masukkan Nama Peminjam ...">
                        </div>
                        <div class="form-group">
                            <label>Peminjam</label>
                            <select class="form-control dropdown-cari" name="peminjam" required="required">
                                <option value=""> - Pilih Peminjam - </option>
                                <?php
                                $peminjam = $this->db->query("SELECT * from fakultas order by fakultas_nama asc")->result();
                                foreach ($peminjam as $b) {
                                ?>
                                    <option value="<?php echo $b->fakultas_id ?>"><?php echo $b->fakultas_nama ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Barang</label>
                            <input autocomplete="off" type="number" class="form-control" name="jumlah" required="required" placeholder="Masukkan Jumlah Barang ...">
                        </div>

                        <div class="form-group">
                            <label>Tgl. Pinjam</label>
                            <input type="date" class="form-control" name="tgl_pinjam" placeholder="Masukkan tanggal pinjam sampai" required="required">
                        </div>
                        <div class="form-group">
                            <label>Tgl. Kembali</label>
                            <input type="date" class="form-control" name="tgl_kembali" placeholder="Masukkan tanggal pinjam sampai" required="required">
                        </div>
                        <div class="form-group">
                            <label>Keperluan</label>
                            <input type="text" name="alasan" class="form-control" placeholder="Masukan Keperluan .." required="required">
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