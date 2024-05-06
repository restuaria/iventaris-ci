<section class="content-header">
    <h1>
        Menu Pengguna
        <small>Tambah Data Pengguna </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Pengguna</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <section class="col-lg-6 col-lg-offset-3">
            <div class="box box-info">
                <div class="box-header">
                    <a href="<?php echo base_url('operator/user') ?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a>
                </div>
                <div class="box-body">
                    <form action="<?php echo base_url('operator/user_proses_t') ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nama Pengguna</label>
                            <input type="text" class="form-control" name="nama" required placeholder="Masukkan Nama Pengguna ...">
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" required placeholder="Masukkan Nama Username ...">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required min="5" placeholder="Masukkan Password ..">
                        </div>
                        <div class="form-group">
                            <label>Level</label>
                            <select class="form-control" name="level" required="required">
                                <option value=""> - Pilih Level - </option>
                                <option value="operator"> Operator </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" name="foto">
                            <p>Format JPG, Max 2Mb.</p>
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