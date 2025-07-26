<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Data Pembayaran Listrik Berhasil</h4>
				<ul class="breadcrumbs">
					<li class="nav-home">
						<a href="<?= base_url('dashboard-admin'); ?>">
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
						<a href="<?= base_url('riwayat_pembayaran'); ?>">Data Pembayaran Listrik Berhasil</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<a class="btn btn-primary btn-round ml-auto" target="_blank" href="<?= base_url('riwayat_pembayaran/cetak_semua'); ?>">
									<i class="fa fa-print"></i>
									Cetak Semua
								</a>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="data-table" class="data-table display table table-striped table-hover">
									<thead>
										<tr class="text-center">
											<th>No</th>
											<th>Kode Tagihan</th>
											<th>Nama Pelanggan</th>
											<th>Bulan Bayar</th>
											<th>Tahun</th>
											<th>Jumlah Meter</th>
											<th>Total Biaya</th>
											<th>Status</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tfoot class="text-center">
										<tr>
											<th>No</th>
											<th>Kode Tagihan</th>
											<th>Nama Pelanggan</th>
											<th>Bulan Bayar</th>
											<th>Tahun</th>
											<th>Jumlah Meter</th>
											<th>Total Biaya</th>
											<th>Status</th>
											<th>Aksi</th>
										</tr>
									</tfoot>
									<tbody>
										<?php foreach ($riwayat as $key => $p) : ?>
										<tr>
											<td><?= $key + 1 ?></td>
                                            <td> <?= str_pad($p['id_tagihan'], 8, '0000000', STR_PAD_LEFT); ?></td>
											<td><?php foreach ($pelanggan as $key => $value) : ?>
                                                       <?= $data = $p['id_pelanggan'] == $value['id_pelanggan'] ? $value['nama_pelanggan'] : null; ?>
                                                   <?php endforeach; ?></td>
											<td><?= get_nama_bulan($p['bulan_bayar']); ?></td>
											<td><?=$p['tahun']; ?></td>
											<td><?=$p['jumlah_meter']; ?> Kwh</td>
											<td>Rp. <?=$p['total_bayar']; ?></td>
                                            <?php if ($p['status'] == 2) { ?>
													<td><span class="badge bg-success text-white">Lunas</span></td>
												<?php } ?>
											<td class="text-center">
												<div class="form-button-action">
													<a href="<?php echo base_url('riwayat_pembayaran/cetak/' . $p['id_pembayaran']) ?>" data-toggle="tooltip"
														title="" class="btn btn-link btn-primary btn-lg"
														data-original-title="Cetak Data" target="_blank">
														<i class="fa fa-file-pdf"></i>
													</a>
												</div>
											</td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- CDN SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
	$(document).ready(function () {
		$('.data-table').DataTable();
	});
</script>