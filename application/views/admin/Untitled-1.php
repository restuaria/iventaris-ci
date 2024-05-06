<html>

<body>
    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=file.xls");
    ?>
    <center>
        <?php
        $pts = $this->db->query("SELECT * FROM pts where pts_id= 1")->result();
        foreach ($pts as $w)
        ?>
        <h4 style="text-transform:uppercase">DATA BARANG KELUAR INVENTARIS <br><?php echo $w->pts_nama ?></h4>
    </center>
    <table border="1">
        <tr>
            <th width="1%" align="center">NO</th>
            <th align="center">NAMA BARANG</th>
            <th align="center">TGL. KELUAR</th>
            <th align="center">JUMLAH BARANG</th>
            <th align="center">PENERIMA</th>
            <th align="center">GEDUNG</th>
            <th align="center">RUANGAN</th>
            <th align="center">KETERANGAN</th>
        </tr>
        <?php
        $no = 1;
        foreach ($barang as $d) {
        ?>
            <tr>
                <td align="center"><?php echo $no++; ?></td>
                <td><?php echo $d->barang_kode;
                    echo ' [';
                    echo $d->barang_nama;
                    echo ']'; ?></td>
                <td align="center"><?php echo $d->bk_tgl_keluar ?></td>
                <td align="center"><?php echo $d->bk_jumlah ?></td>
                <td><?php echo $d->fakultas_nama ?></td>
                <td><?php echo $d->bk_lokasi2 ?></td>
                <td><?php echo $d->bk_lokasi ?></td>
                <td><?php echo $d->bk_keterangan ?></td>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>