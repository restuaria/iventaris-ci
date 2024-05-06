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
        <h4 style="text-transform:uppercase">DATA BARANG MASUK<br><?php echo $w->pts_nama ?></h4>

    </center>
    <table border="1">
        <tr>
            <th width="1%" align="center">NO</th>
            <th align="center">NAMA BARANG</th>
            <th align="center">TGL. MASUK</th>
            <th align="center">JUMLAH BARANG</th>
            <th align="center">NAMA SUPLIER</th>
        </tr>
        <?php
        $no = 1;
        $data = $this->db->query("SELECT * from barang_masuk,barang where bm_id_barang=barang_id  order by bm_id desc")->result();
        foreach ($data as $d) {
        ?>
            <tr>
                <td align="center"><?php echo $no++; ?></td>
                <td><?php echo $d->barang_kode;
                    echo ' [';
                    echo $d->barang_nama;
                    echo ']'; ?></td>
                <td align="center"><?php echo $d->bm_tgl_masuk ?></td>
                <td align="center"><?php echo $d->bm_jumlah ?></td>
                <td><?php echo $d->bm_nama_suplier ?></td>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>