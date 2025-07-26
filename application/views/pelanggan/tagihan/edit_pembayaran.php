<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Edit Tagihan Listrik</h4>
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
						<a href="#">Edit Tagihan Listrik</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-8 col-12">
					<div class="card">
						<div class="card-body">
							<p class="fw-semibold fs-6">Pembayaran Tagihan</p>
							<p class="text-body-secondary">Berikut adalah daftar rekening untuk pembayaran tagihan
								listrik Anda. Silakan unggah bukti transfer Anda. Pastikan nominal pembayaran sebesar
								<b><?php 
									$total = ($tagihan['jumlah_meter'] * $tagihan['tarifperkwh']) + 2500;
									echo "Rp " . number_format($total, 0, ',', '.');
							        ?></b> atas nama <b>E-Paslit</b>.</p>
							<div class="row">
								<div class="col-12">
									<div class="card shadow-none">
										<div class="card-body bg-secondary-subtle">
											<p class="fw-bolder text-center">Rekening Bank Dan E-Wallet</p>
											<div class="row">
												<div class="col-6">
													<div class="card mb-3 shadow-sm" style="max-width: 350px;">
														<div class="row g-0 align-items-center">
															<div class="col-3">
																<img src="<?= base_url('') ?>/assets/bank-logo/bca.png"
																	alt="BCA" class="img-fluid"
																	style="max-width: 80px;">
															</div>
															<div class="col-9">
																<div class="card-body py-2">
																	<p class="card-text mb-0">No.
																		Rekening<br><strong>11470-1004-147</strong></p>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-6">
													<div class="card mb-3 shadow-sm" style="max-width: 350px;">
														<div class="row g-0 align-items-center">
															<div class="col-3">
																<img src="<?= base_url('') ?>/assets/bank-logo/bjb.png"
																	alt="BCA" class="img-fluid"
																	style="max-width: 80px;">
															</div>
															<div class="col-9">
																<div class="card-body py-2">
																	<p class="card-text mb-0">No.
																		Rekening<br><strong>11470-1004-149</strong></p>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-6">
													<div class="card mb-3 shadow-sm" style="max-width: 350px;">
														<div class="row g-0 align-items-center">
															<div class="col-3">
																<img src="<?= base_url('') ?>/assets/bank-logo/bri.png"
																	alt="BCA" class="img-fluid"
																	style="max-width: 80px;">
															</div>
															<div class="col-9">
																<div class="card-body py-2">
																	<p class="card-text mb-0">No.
																		Rekening<br><strong>11470-1004-148</strong></p>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-6">
													<div class="card mb-3 shadow-sm" style="max-width: 350px;">
														<div class="row g-0 align-items-center">
															<div class="col-3">
																<img src="<?= base_url('') ?>/assets/bank-logo/gopay.png"
																	alt="BCA" class="img-fluid"
																	style="max-width: 80px;">
															</div>
															<div class="col-9">
																<div class="card-body py-2">
																	<p class="card-text mb-0">No.
																		Telepon<br><strong>082125253683</strong></p>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-12">
														<form action="<?= base_url('tagihan/updatepembayaran/' . $pembayaran['id_pembayaran']); ?>"
                                                        method="POST" enctype="multipart/form-data">
                                                        <input type="hidden" name='id_pembayaran' class='form-control'
                                                            value="<?= $pembayaran['id_pembayaran'] ?>">
														<label for="largeInput" class="mb-2">Ubah Bukti Pembayaran Tagihan</label>
															<input type="file" id="image"
															class="form-control form-control "
															name="image"/>
															<img class="mb-1" id="blah"
												            src="<?= base_url('assets/bukti-pembayaran/') . $pembayaran['image']; ?>"
												            id="previewImg" style="max-width: 200px; margin-top: 20px;">
														<div class="mt-3">
															<input type="submit" class="btn btn-success" value="Ubah Pembayaran">
															<input type="reset" class="btn btn-danger" value="Batal">
														</div>
													</form>
												</div>
											</div>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
        $(document).ready(function () {
		$('.data-table').DataTable();
	});
	$(function() {

         <?php if ($this->session->flashdata('gagal')) { ?>
             Swal.fire({
                 icon: 'error',
                 title: 'Gagal!',
                 text: '<?php echo $this->session->flashdata('gagal'); ?>'
             })
         <?php } ?>
     });
		image.onchange = evt => {
			const [file] = image.files
			if (file) {
				blah.src = URL.createObjectURL(file)
			}
		}
	</script>
