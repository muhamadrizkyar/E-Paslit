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

    <h3>Laporan Pembayaran Listrik</h3>
    <h5>Nama Pelanggan: <?= $pelanggan->nama_pelanggan; ?></h5>
    <h5>Alamat: <?= $pelanggan->alamat; ?></h5>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Tagihan</th>
                <th>Tanggal Pembayaran</th>
                <th>Bulan Bayar</th>
                <th>Tahun</th>
                <th>Jumlah Meter</th>
                <th>Biaya Admin</th>
                <th>Total Biaya</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($history as $h): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= str_pad($h['id_tagihan'], 8, '0000000', STR_PAD_LEFT); ?></td>
                    <td><?= date('d F Y', strtotime($h['tanggal_pembayaran'])); ?></td>
                    <td><?= get_nama_bulan($h['bulan_bayar']); ?></td>
                    <td><?= $h['tahun']; ?></td>
                    <td><?= $h['jumlah_meter']; ?> Kwh</td>
                    <td>Rp <?= number_format($h['biaya_admin']); ?></td>
                    <td>Rp <?= number_format($h['total_bayar']); ?></td>
                    <td>
                        <?= $h['status'] == 2 ? 'Lunas' : 'Belum Lunas'; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
