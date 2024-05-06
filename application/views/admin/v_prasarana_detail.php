<section class="content-header">
    <h1>
        Menu Prasarana
        <small>Detail Data Prasarana</small>
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
                    foreach ($data as $d) {
                    ?>
                        <table class="table table-bordered table-striped" id="table-datatable">
                            <tr>
                                <td align="center">
                                    <?php if ($d->barang_foto == "") { ?>
                                        <img src="<?php echo base_url() ?>file/barang/noimage.jpg" style="width: 150px;height: auto">
                                    <?php } else { ?>
                                        <img src="<?php echo base_url() ?>file/barang/<?php echo $d->barang_foto ?>" style="width: 150px;height: auto">
                                    <?php } ?>
                                </td>
                                <td colspan="2">
                                    <br />
                                    <center>
                                        <h4><strong><?php echo $d->barang_ruangan ?><br /><?php echo $d->barang_kode ?></strong></h4>
                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">
                                    <strong>Jenis Barang</strong>
                                </td>
                                <td align="center" width="7%">
                                    :
                                </td>
                                <td width="68%">
                                    <?php echo $d->barang_jenis ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Kode Barang</strong>
                                </td>
                                <td align="center">
                                    :
                                </td>
                                <td>
                                    <?php echo $d->barang_kode ?>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <strong>Nama Barang</strong>
                                </td>
                                <td align="center">
                                    :
                                </td>
                                <td>
                                    <?php echo $d->barang_ruangan ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Luas</strong>
                                </td>
                                <td align="center">
                                    :
                                </td>
                                <td>
                                    <?php echo $d->barang_ukuran ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Konstruksi/Tingkat</strong>
                                </td>
                                <td align="center">
                                    :
                                </td>
                                <td>
                                    <?php echo $d->barang_konstruksi ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Kepemilikan</strong>
                                </td>
                                <td align="center">
                                    :
                                </td>
                                <td>
                                    <?php echo $d->barang_pemilik ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>No. Kepemilikan</strong>
                                </td>
                                <td align="center">
                                    :
                                </td>
                                <td>
                                    <?php echo $d->barang_no_pemilik ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Tahun Perolehan</strong>
                                </td>
                                <td align="center">
                                    :
                                </td>
                                <td>
                                    <?php echo $d->barang_tahun ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Sumber Dana</strong>
                                </td>
                                <td align="center">
                                    :
                                </td>
                                <td>
                                    <?php echo $d->barang_sumber_dana ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Kondisi</strong>
                                </td>
                                <td align="center">
                                    :
                                </td>
                                <td>
                                    <?php echo $d->barang_kondisi ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Lokasi</strong>
                                </td>
                                <td align="center">
                                    :
                                </td>
                                <td>
                                    <?php echo $d->fakultas_nama ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Keterangan</strong>
                                </td>
                                <td align="center">
                                    :
                                </td>
                                <td>
                                    <?php echo $d->barang_keterangan ?>
                                </td>
                            </tr>
                        </table>

                    <?php

                    }

                    ?>

                    </form>

                </div>



            </div>

        </section>

    </div>

</section>