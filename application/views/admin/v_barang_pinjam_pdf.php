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
        <h2 style="text-transform:uppercase">DATA PEMINJAMAN INVENTARIS<br><?php echo $w->pts_nama ?></h2>
    </center>
    <table class="table table-bordered table-striped" id="table-datatable">
        <thead>
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
        </thead>
        <tbody>
            <?php
            $no = 1;
            $data = $this->db->query("SELECT * from pinjam,barang,fakultas where pinjam_barang=barang_id and pinjam_peminjam=fakultas_id   order by pinjam_id desc");
            foreach ($data->result() as $d) {
            ?>
                <tr>
                    <td style="text-align:center"><?php echo $d->pinjam_kode ?></td>
                    <td><?php echo $d->barang_nama;
                        echo ' [';
                        echo $d->barang_kode;
                        echo ']'; ?></td>
                    <td><?php echo $d->pinjam_nama ?></td>
                    <td><?php echo $d->fakultas_nama ?></td>
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
            ?>
        </tbody>
    </table>
    <script>
        window.print();
    </script>
</body>

</html>