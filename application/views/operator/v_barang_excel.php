<html>

<body>
    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=file.xls");
    ?>
    <center>
        <?php
        $pts = $this->db->query("SELECT * FROM pts where pts_id = 1");
        foreach ($pts->result() as $w);
        ?>
        <h4 style="text-transform:uppercase">DATA SARANA <br><?php echo $w->pts_nama ?></h4>
    </center>
    <table border="1">
        <tr>
            <th width="1%" align="center">NO</th>
            <th align="center">KATEGORI</th>
            <th align="center">KODE</th>
            <th align="center">BARANG</th>
            <th align="center">SPESIFIKASI</th>
            <th align="center">MERK</th>
            <th align="center">KONDISI</th>
            <th align="center">JUMLAH</th>
            <th align="center">SATUAN</th>
            <th align="center">SUMBER DANA</th>
            <th align="center">KETERANGAN</th>
            <th style="text-align:center">LOKASI</th>
        </tr>
        <?php
        $no = 1;
        foreach ($barang as $d) {
        ?>
            <tr>
                <td align="center"><?php echo $no++; ?></td>
                <td align="center"><?php echo $d->barang_kategori ?></td>
                <td align="left"><?php echo $d->barang_kode ?></td>
                <td align="left"><?php echo $d->barang_nama ?></td>
                <td align="left"><?php echo $d->barang_spesifikasi ?></td>
                <td align="left"><?php echo $d->barang_merk ?></td>
                <td align="left"><?php echo $d->barang_kondisi ?></td>
                <td align="center"><?php echo $d->barang_jumlah ?></td>
                <td align="left"><?php echo $d->barang_satuan ?></td>
                <td align="left"><?php echo $d->barang_sumber ?></td>
                <td align="left"><?php echo $d->barang_keterangan ?></td>
                <td><?php echo $d->fakultas_nama ?></td>
            </tr>
            <?php
        }
            ?><?php ob_flush(); ?>
    </table>
</body>

</html>