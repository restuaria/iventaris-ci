<section class="content-header">
    <h1>
        Menu Sarana
        <small>Detail Data Sarana</small>
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
                    <a href="<?php echo base_url("admin/databarang") ?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a>
                </div>
                <div class="box-body">
                    <form action="<?php echo base_url('admin') ?>" method="post">
                        <?php
                        foreach ($data as $d) {
                        ?>
                            <table class="table table-bordered table-striped">
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
                                            <h4><strong><?php echo $d->barang_nama ?><br /><?php echo $d->barang_kode ?></strong></h4>
                                        </center>
                                    </td>
                                </tr>
                                </tr>
                                <tr>
                                    <td width="30%">
                                        <strong>Lokasi</strong>
                                    </td>
                                    <td align="center" width="7%">
                                        :
                                    </td>
                                    <td width="68%">
                                        <?php echo $d->fakultas_nama ?>
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
                                        <strong>Kategori Barang</strong>
                                    </td>
                                    <td align="center">
                                        :
                                    </td>
                                    <td>
                                        <?php echo $d->kategori_nama ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Merk Barang</strong>
                                    </td>
                                    <td align="center">
                                        :
                                    </td>
                                    <td>
                                        <?php echo $d->barang_merk ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Spesifikasi Barang</strong>
                                    </td>
                                    <td align="center">
                                        :
                                    </td>
                                    <td>
                                        <?php echo $d->barang_spesifikasi ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Kondisi Barang</strong>
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
                                        <strong>Jumlah Barang</strong>
                                    </td>
                                    <td align="center">
                                        :
                                    </td>
                                    <td>
                                        <?php echo $d->barang_jumlah ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <strong>Satuan Barang</strong>
                                    </td>
                                    <td align="center">
                                        :
                                    </td>
                                    <td>
                                        <?php echo $d->barang_satuan ?>
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
                                        <?php echo $d->barang_sumber ?>
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