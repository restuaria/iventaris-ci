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
        <h3 style="text-transform:uppercase"><strong>SEBARAN SARANA<br /><?php echo $w->pts_nama ?></strong></h3>
    </center>
    <div class="box-header">
    </div>
    <div class="box-body">
        <?php
        $dosen2 = $this->db->query("SELECT * FROM barang ")->num_rows();
        ?>
        <?php
        $no = 1;
        $dosen = $this->db->query("SELECT fakultas_nama , COUNT(barang.barang_lokasi) AS jumlah FROM fakultas 
LEFT JOIN barang ON (barang.barang_lokasi= fakultas.fakultas_id) where fakultas_id < 6
GROUP BY fakultas_nama ");
        ?>
        <table class="table table-bordered " id="table-datatable">
            <tr>
                <td bgcolor="#CCCCCC" style="text-align: center"><strong>No</strong></td>
                <td bgcolor="#CCCCCC" style="text-align: center"><strong>Lokasi</strong></td>
                <td bgcolor="#CCCCCC" style="text-align: center"><strong>Jumlah</strong></td>
            </tr>
            <?php
            foreach ($dosen->result() as $w) {
            ?>
                <tr>
                    <td style="text-align: center"><?php echo $no++; ?></td>
                    <td><?php echo $w->fakultas_nama ?></td>
                    <td style="text-align: center"><?php echo $w->jumlah ?></td>
                </tr>
            <?php
            }
            ?>
            <tr>
                <td colspan="2" style="text-align: center"><strong>Total</strong></td>
                <td style="text-align: center" bgcolor="#CCCCCC"><strong><?php echo $dosen2 ?></strong></td>
            </tr>
            </tbody>
        </table>
        <br><br>
    </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>