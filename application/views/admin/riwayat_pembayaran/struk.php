<!DOCTYPE html>
<html>
<head>
    <title>Struk Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            width: 250px;
            margin: 0 auto;
        }
        h4 {
            text-align: center;
            margin: 0;
            padding: 0;
        }
        p {
            margin: 2px 0;
        }
        .line {
            border-top: 1px dashed #000;
            margin: 5px 0;
        }
        .total {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h4>Struk Pembayaran Listrik</h4>
    <div class="line"></div>

    <p><strong>Nama:</strong> <?= $pembayaran->nama_pelanggan; ?></p>
    <p><strong>Alamat:</strong> <?= $pembayaran->alamat; ?></p>

    <div class="line"></div>

    <p><strong>Kode Tagihan:</strong> <?= str_pad($pembayaran->id_tagihan, 8, '0000000', STR_PAD_LEFT); ?></p>
    <p><strong>Tanggal Pembayaran:</strong> <?= date('d F Y', strtotime($pembayaran->tanggal_pembayaran)); ?></p>
    <p><strong>Tagihan Bulan:</strong> <?= get_nama_bulan($pembayaran->bulan_bayar); ?></p>
    <p><strong>Tagihan Tahun:</strong> <?= $pembayaran->tahun; ?></p>
    <p><strong>Jumlah Meter:</strong> <?= $pembayaran->jumlah_meter; ?> Kwh</p>
    <p><strong>Biaya Admin:</strong> Rp <?= number_format($pembayaran->biaya_admin); ?></p>
    <p class="total"><strong>Total Bayar:</strong> Rp <?= number_format($pembayaran->total_bayar); ?></p>

    <div class="line"></div>

    <p><strong>Status:</strong> <?= $pembayaran->status == 2 ? 'Lunas' : 'Belum Lunas'; ?></p>
    <p style="text-align:center; margin-top:10px;">Terima Kasih</p>

</body>
</html>
