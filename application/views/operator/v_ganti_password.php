<section class="content-header">
    <h1>
        Menu Password
        <small>Ganti Password</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Password</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <section class="col-lg-6 col-lg-offset-3">
            <?php
            if (isset($_GET['alert'])) {
                if ($_GET['alert'] == "sukses") {
                    echo "<div class='alert alert-success'>Password Sudah Berhasil Diganti</div>";
                }
            }
            ?>
            <div class="box box-info">
                <div class="box-header">
                </div>
                <div class="box-body">
                    <form action="<?php echo base_url("operator/prosesgantipas") ?>" method="post">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Masukkan Password Baru .." name="password" required="required" min="5">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-sm btn-primary" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

</section>