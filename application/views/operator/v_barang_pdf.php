<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Informasi Inventaris</title>
</head>

<body>
    <style type="text/css">
        body {
            font-family: sans-serif;
            font-size: 10px;
        }

        .table {
            width: 100%;
        }

        th,
        td {}

        .table,
        .table th,
        .table td {
            padding: 5px;
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
    <center>
        <?php
        $pts = $this->db->query("SELECT * FROM pts where pts_id = 1");
        foreach ($pts->result() as $w);
        ?>
        <h2 style="text-transform:uppercase">DATA SARANA <br><?php echo $w->pts_nama ?></h2>
    </center>
    <table class="table table-bordered table-striped" id="table-datatable">
        <thead>
            <tr>
                <th width="1%" align="center">NO</th>
                <th style="text-align:center">KATEGORI</th>
                <th style="text-align:center">BARANG</th>
                <th style="text-align:center">MERK/SPESIFIKASI</th>
                <th style="text-align:center">KONDISI</th>
                <th style="text-align:center">JUMLAH</th>
                <th style="text-align:center">SATUAN</th>
                <th style="text-align:center">LOKASI</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($data as $d) {
            ?>
                <tr>
                    <td align="center"><?php echo $no++; ?></td>
                    <td><?php echo $d->kategori_nama ?></td>
                    <td><?php echo $d->barang_nama ?> [<?php echo $d->barang_kode ?>]</td>
                    <td><?php echo $d->barang_merk ?> [<?php echo $d->barang_spesifikasi ?>]</td>
                    <td><?php echo $d->barang_kondisi ?></td>
                    <td style="text-align:center"><?php echo $d->barang_jumlah ?></td>
                    <td style="text-align:center"><?php echo $d->barang_satuan ?></td>
                    <td><?php echo $d->fakultas_nama ?></td>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <script>
        window.print();
    </script>
</body>

</html>