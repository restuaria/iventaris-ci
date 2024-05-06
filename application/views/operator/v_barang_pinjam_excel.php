<html>

<body>
    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data Peminjaman.xls");
    ?>
    <center>
        <?php
        $pts = $this->db->query("SELECT * FROM pts where pts_id = 1");
        foreach ($pts->result() as $w);
        ?>
        <h4 style="text-transform:uppercase">DATA PEMINJAMAN INVENTARIS <br><?php echo $w->pts_nama; ?></h4>
    </center>
    <table border="1">
        <tr>
            <th style="text-align:center">KODE</th>
            <th style="text-align:center">BARANG</th>
            <th style="text-align:center">PEMINJAM</th>
            <th style="text-align:center">ASAL</th>
            <th style="text-align:center">JUMLAH</th>
            <th style="text-align:center">TGL.PINJAM</th>
            <th style="text-align:center">TGL.KEMBALI</th>
            <th style="text-align:center">STATUS</th>
        </tr>
        <?php
        $no = 1;
        $data = $this->db->query("SELECT * from pinjam,barang,fakultas where pinjam_barang=barang_id and pinjam_peminjam=fakultas_id   order by pinjam_id desc");
        foreach ($data->result() as $d) {
        ?>
            <tr>
                <td style="text-align:center"><?php echo $d->pinjam_kode ?></td>
                <td><?php echo $d->barang_kode;
                    echo ' [';
                    echo $d->barang_nama;
                    echo ']'; ?></td>
                <td><?php echo $d->pinjam_nama; ?></td>
                <td><?php echo $d->fakultas_nama; ?></td>
                <td style="text-align:center"><?php echo $d->pinjam_jumlah; ?></td>
                <td style="text-align:center"><?php echo date('d-m-Y', strtotime($d->pinjam_tgl_pinjam)); ?></td>
                <td style="text-align:center"><?php echo date('d-m-Y', strtotime($d->pinjam_tgl_kembali)); ?></td>
                <td style="text-align:center">
                    <?php
                    if ($d->pinjam_status == "Sudah Dikembalikan") {
                        echo "<div class='badge badge-success'>Sudah Dikembalikan</div>";
                    } else if ($d->pinjam_status == "Sedang Dipinjam" && (strtotime($d->pinjam_tgl_kembali . " 23:59:59") >= time())) {
                        echo "<div class='badge badge-warning'>Sedang Dipinjam</div>";
                    } else if (strtotime($d->pinjam_tgl_kembali . " 23:59:59") <= time()) {
                        echo "<div class='badge badge-danger'>Dipinjam-Habis</div>";
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
            ?><?php ob_flush(); ?>
    </table>
</body>

</html>