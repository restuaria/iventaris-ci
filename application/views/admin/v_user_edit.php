<section class="content-header">
    <h1>
        Menu Pengguna
        <small>Edit Data Pengguna</small>
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
                    <a href="<?php echo base_url('admin/user') ?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp; Kembali</a>
                </div>
                <div class="box-body">
                    <?php
                    foreach ($user as $d) {
                    ?>
                        <form action="<?php echo base_url("admin/user_proses_e/$d->user_id") ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Nama Pengguna</label>
                                <input type="text" class="form-control" name="nama" value="<?php echo $d->user_nama ?>" required="required">
                                <input type="hidden" class="form-control" name="id" value="<?php echo $d->user_id ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" value="<?php echo $d->user_username ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" min="5">
                                <p>Lakukan Perubahan Apabila Diperlukan</p>
                            </div>

                            <div class="form-group">
                                <label>Level</label>
                                <select class="form-control" name="level" required="required">
                                    <option <?php if ($d->user_level == "admin") {
                                                echo "selected='selected'";
                                            } ?> value="admin"> Admin </option>
                                    <option <?php if ($d->user_level == "operator") {
                                                echo "selected='selected'";
                                            } ?> value="operator"> Operator </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Foto</label>
                                <input type="file" name="foto">
                                <p>Format JPG, Max 2Mb. Lakukan Perubahan Apabila Diperlukan</p>
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



</div>

<?php include 'footer.php'; ?>