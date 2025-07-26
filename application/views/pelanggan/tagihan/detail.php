<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Detail Tagihan Listrik</h4>
				<ul class="breadcrumbs">
					<li class="nav-home">
						<a href="<?= base_url('dashboard'); ?>">
							<i class="flaticon-home"></i>
						</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">Transaksi</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('tagihan'); ?>">Data Tagihan Listrik</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">Detail Tagihan Listrik</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-8 col-12">
					<div class="card">
						<div class="card-body">
							<p class="fw-semibold fs-6">Detail Tagihan</p>
							<p class="text-body-secondary">
								Periksa detail tagihan Anda dengan seksama sebelum melanjutkan ke langkah selanjutnya.
							</p>
							<div class="card shadow-none">
								<div class="card-body bg-secondary-subtle">
									<div class="row">
										<div class="col-6 text-start">
											<p class="fs-6 text-body-secondary">Nama Pelanggan</p>
										</div>
										<div class="col-6 text-end">
											<p class="fw-semibold fs-6 text-body-secondary">
												<?= $pelanggan['nama_pelanggan']; ?>
											</p>
										</div>

										<div class="col-6 text-start">
											<p class="fs-6 text-body-secondary">Kode Tagihan</p>
										</div>
										<div class="col-6 text-end">
											<p class="fw-semibold fs-6 text-body-secondary">
												<?= str_pad($tagihan['id_tagihan'], 8, '0000000', STR_PAD_LEFT); ?>
											</p>
										</div>

										<div class="col-6 text-start">
											<p class="fs-6 text-body-secondary">Nomor Kwh</p>
										</div>
										<div class="col-6 text-end">
											<p class="fw-semibold fs-6 text-body-secondary">
												<?= $pelanggan['nomor_kwh']; ?>
											</p>
										</div>

										<div class="col-6 text-start">
											<p class="fs-6 text-body-secondary">Bulan/Tahun</p>
										</div>
										<div class="col-6 text-end">
											<p class="fw-semibold fs-6 text-body-secondary">
												<?= get_nama_bulan($tagihan['bulan']); ?> <?= $tagihan['tahun']; ?>
											</p>
										</div>

										<div class="col-6 text-start">
											<p class="fs-6 text-body-secondary">Tarif PerKWH</p>
										</div>
										<div class="col-6 text-end">
											<p class="fw-semibold fs-6 text-body-secondary">
												Rp <?= number_format($tagihan['tarifperkwh'], 0, ',', '.'); ?>
											</p>
										</div>

										<div class="col-6 text-start">
											<p class="fs-6 text-body-secondary">Total Penggunaan Listrik</p>
										</div>
										<div class="col-6 text-end">
											<p class="fw-semibold fs-6 text-body-secondary">
												<?= $tagihan['jumlah_meter']; ?> Kwh
											</p>
										</div>

										<div class="col-6 text-start">
											<p class="fs-6 text-body-secondary">Biaya Admin</p>
										</div>
										<div class="col-6 text-end">
											<p class="fw-semibold fs-6 text-body-secondary">
												Rp 2.500
											</p>
										</div>

										<div class="col-6 text-start">
											<p class="fs-6 text-body-secondary">Total Keseluruhan</p>
										</div>
										<div class="col-6 text-end">
											<p class="fw-semibold fs-6 text-body-secondary">
												<?php 
									            $total = ($tagihan['jumlah_meter'] * $tagihan['tarifperkwh']) + 2500;
									            echo "Rp " . number_format($total, 0, ',', '.');
							            	    ?>
											</p>
										</div>

										<div class="col-12">
											<hr class="border border-secondary border-3 opacity-75">
										</div>
										<div class="col-12 text-end">
											<a href="<?php echo base_url('tagihan/pembayaran/' . $tagihan['id_tagihan']) ?>"
												class="btn fw-semibold btn-success btn-round">
												Lanjut Pembayaran Ke Rekening
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-12">
					<div class="card">
						<div class="card-body">
							<p class="fw-semibold fs-6">Cara Pembayaran</p>
							<p class="text-body-secondary">
								Berikut adalah langkah-langkah pembayaran tagihan listrik Anda.
							</p>
							<div class="row">
								<div class="col-sm-3 mb-3">
									<button type="button" class="btn btn-primary fw-semibold">1</button>
								</div>
								<div class="col-sm-9">
									<div class="row">
										<div class="col-12 text-body-secondary mb-3">
											Pilih tagihan yang ingin Anda bayar.
										</div>
									</div>
								</div>
								<div class="col-sm-3 mb-3">
									<button type="button" class="btn btn-primary fw-semibold">2</button>
								</div>
								<div class="col-sm-9">
									<div class="row">
										<div class="col-12 text-body-secondary mb-3">
											Periksa kembali detail tagihan Anda dengan teliti.
										</div>
									</div>
								</div>
								<div class="col-sm-3 mb-3">
									<button type="button" class="btn btn-primary fw-semibold">3</button>
								</div>
								<div class="col-sm-9">
									<div class="row">
										<div class="col-12 text-body-secondary mb-3">
											Unggah bukti transfer, kemudian klik tombol <em>Kirim Pembayaran</em>.
										</div>
									</div>
								</div>
								<div class="col-sm-3 mb-3">
									<button type="button" class="btn btn-primary fw-semibold">4</button>
								</div>
								<div class="col-sm-9">
									<div class="row">
										<div class="col-12 text-body-secondary mb-3">
											Bukti pembayaran akan diverifikasi oleh Admin/Petugas. Mohon menunggu hingga
											status pembayaran Anda disetujui.
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
