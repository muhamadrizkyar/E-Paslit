<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pembayaran Listrik</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h3 {
            text-align: center;
            margin: 0;
            padding: 0;
        }
        h5 {
            margin: 2px 0; /* Jarak atas-bawah kecil */
            padding: 0;
            font-weight: normal;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
            font-size: 12px; /* Ukuran font tabel lebih kecil */
        }
        table, th, td {
            border: 2px solid #000;
            padding: 3px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h3>Laporan Pembayaran Listrik (Status: Lunas)</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Tagihan</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal Pembayaran</th>
                <th>Bulan Bayar</th>
                <th>Tahun</th>
                <th>Jumlah Meter</th>
                <th>Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($riwayat as $key => $p) : ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= str_pad($p['id_tagihan'], 8, '0000000', STR_PAD_LEFT); ?></td>
                    <td>
                        <?php foreach ($pelanggan as $value) : ?>
                            <?= $p['id_pelanggan'] == $value['id_pelanggan'] ? $value['nama_pelanggan'] : ''; ?>
                        <?php endforeach; ?>
                    </td>
                    <td><?= date('d F Y', strtotime($p['tanggal_pembayaran'])); ?></td>
                    <td><?= get_nama_bulan($p['bulan_bayar']); ?></td>
                    <td><?= $p['tahun']; ?></td>
                    <td><?= $p['jumlah_meter']; ?> kWh</td>
                    <td><?= $p['total_bayar']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
