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
        <h3 style="text-transform:uppercase"><strong>SEBARAN PRASARANA<br /><?php echo $w->pts_nama ?></strong></h3>
    </center>
    <div class="box-header">
    </div>
    <div class="box-body">
        <?php
        $dosen22 = $this->db->query("SELECT * FROM barang_prasarana  ")->num_rows();
        ?>
        <?php
        $no = 1;
        $dosen33 = $this->db->query("SELECT fakultas_nama, COUNT(barang_prasarana.barang_lokasi) AS jumlah FROM fakultas 
LEFT JOIN barang_prasarana ON (barang_prasarana.barang_lokasi= fakultas.fakultas_id) where fakultas_id < 7
GROUP BY fakultas_nama")->result();
        ?>
        <table class="table table-bordered " id="table-datatable">
            <tr>
                <td bgcolor="#CCCCCC" style="text-align: center"><strong>No</strong></td>
                <td bgcolor="#CCCCCC" style="text-align: center"><strong>Lokasi</strong></td>
                <td bgcolor="#CCCCCC" style="text-align: center"><strong>Jumlah</strong></td>
            </tr>
            <?php
            foreach ($dosen33 as $we) {
            ?>
                <tr>
                    <td style="text-align: center"><?php echo $no++; ?></td>
                    <td><?php echo $we->fakultas_nama ?></td>
                    <td style="text-align: center"><?php echo $we->jumlah ?></td>
                </tr>
            <?php
            }
            ?>
            <tr>
                <td colspan="2" style="text-align: center"><strong>Total</strong></td>
                <td style="text-align: center" bgcolor="#CCCCCC"><strong><?php echo $dosen22; ?></strong></td>
            </tr>
            </tbody>
        </table>
        <br><br>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>