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
        <h2 style="text-transform:uppercase">DATA PRASARANA <br><?php echo $w->pts_nama ?></h2>
    </center>
    <table border="1">
        <tr>
            <th width="1%" align="center">NO</th>
            <th style="text-align:center">JENIS BARANG</th>
            <th style="text-align:center">KODE BARANG</th>
            <th style="text-align:center">NAMA BARANG</th>
            <th style="text-align:center">LUAS</th>
            <th style="text-align:center">KONSTRUKSI/TINGKAT</th>
            <th style="text-align:center">KEPEMILIKAN</th>
            <th style="text-align:center">NO. KEPEMILIKAN</th>
            <th style="text-align:center">TAHUN PEROLEHAN</th>
            <th style="text-align:center">SUMBER DANA</th>
            <th style="text-align:center">KONDISI</th>
            <th style="text-align:center">LOKASI</th>
            <th style="text-align:center">KETERANGAN</th>
        </tr>
        <?php
        $no = 1;
        foreach ($data as $d) {
        ?>
            <tr>
                <td align="center"><?php echo $no++; ?></td>
                <td><?php echo $d->barang_jenis ?></td>
                <td style="text-align:center"><?php echo $d->barang_kode ?></td>
                <td><?php echo $d->barang_ruangan ?></td>
                <td style="text-align:center"><?php echo $d->barang_ukuran ?></td>
                <td><?php echo $d->barang_konstruksi ?></td>
                <td><?php echo $d->barang_pemilik ?></td>
                <td><?php echo $d->barang_no_pemilik ?></td>
                <td style="text-align:center"><?php echo $d->barang_tahun ?></td>
                <td><?php echo $d->barang_sumber_dana ?></td>
                <td><?php echo $d->barang_kondisi ?></td>
                <td><?php echo $d->fakultas_nama ?></td>
                <td><?php echo $d->barang_keterangan ?></td>
            </tr>
        <?php
        }
        ?>
        <?php ob_flush(); ?>
    </table>
</body>

</html>