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
        <h2 style="text-transform:uppercase">DATA PRASARANA <br><?php echo $w->pts_nama ?></h2>

    </center>
    <table class="table table-bordered table-striped" id="table-datatable">
        <thead>
            <tr>
                <th width="1%" align="center">NO</th>
                <th style="text-align:center">NAMA</th>
                <th style="text-align:center">KODE</th>
                <th style="text-align:center">LUAS/BANGUNAN</th>
                <th style="text-align:center">TAHUN/KEPEMILIKAN</th>
                <th style="text-align:center">DANA</th>
                <th style="text-align:center">LOKASI</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $data = $this->db->query("SELECT * FROM barang_prasarana,fakultas where barang_lokasi=fakultas_id   order by barang_ruangan asc");
            foreach ($data->result() as $d) {
            ?>
                <tr>
                    <td align="center"><?php echo $no++; ?></td>
                    <td><?php echo $d->barang_ruangan ?></td>
                    <td style="text-align:center"><?php echo $d->barang_kode ?></td>
                    <td><?php echo $d->barang_ukuran ?> / <?php echo $d->barang_konstruksi ?></td>
                    <td><?php echo $d->barang_tahun ?> / <?php echo $d->barang_pemilik ?></td>
                    <td><?php echo $d->barang_sumber_dana ?></td>
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