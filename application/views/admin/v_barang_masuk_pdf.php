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
        <h2 style="text-transform:uppercase">DATA BARANG MASUK<br><?php echo $w->pts_nama ?></h2>
    </center>
    <table class="table table-bordered table-striped" id="table-datatable">
        <thead>
            <tr>
                <th width="1%" align="center">NO</th>
                <th style="text-align:center">NAMA</th>
                <th style="text-align:center">TGL. MASUK</th>
                <th style="text-align:center">JUMLAH</th>
                <th style="text-align:center">SUPLIER</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $data = $this->db->query("SELECT * from barang_masuk,barang where bm_id_barang=barang_id order by bm_tgl_masuk desc");
            foreach ($data->result() as $d) {
            ?>
                <tr>
                    <td align="center"><?php echo $no++; ?></td>
                    <td><?php echo $d->barang_nama;
                        echo ' [';
                        echo $d->barang_kode;
                        echo ']'; ?></td>
                    <td style="text-align:center"><?php echo $d->bm_tgl_masuk ?></td>
                    <td style="text-align:center"><?php echo $d->bm_jumlah ?></td>
                    <td><?php echo $d->bm_nama_suplier ?></td>
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