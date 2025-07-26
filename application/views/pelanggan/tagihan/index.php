<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Data Tagihan Listrik</h4>
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
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table id="data-table" class="data-table display table table-striped table-hover">
									<thead>
										<tr class="text-center">
											<th>No</th>
											<th>Kode Tagihan</th>
											<th>Bulan</th>
											<th>Tahun</th>
											<th>Total Penggunaan Listrik</th>
											<th>Total Pembayaran</th>
											<th>Status</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tfoot class="text-center">
										<tr>
											<th>No</th>
											<th>Kode Tagihan</th>
											<th>Bulan</th>
											<th>Tahun</th>
											<th>Total Penggunaan Listrik</th>
											<th>Total Pembayaran</th>
											<th>Status</th>
											<th>Aksi</th>
										</tr>
									</tfoot>
									<tbody>
									<?php foreach ($tagihan as $key => $t) : ?>
                                        <?php if ($t['id_pelanggan'] == $pelanggan['id_pelanggan'] && $t['status'] != 2) { ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= str_pad($t['id_tagihan'], 8, '0000000', STR_PAD_LEFT); ?></td>
                                            <td><?= get_nama_bulan($t['bulan']); ?></td>
                                            <td><?= $t['tahun']; ?></td>
                                            <td><?= $t['jumlah_meter']; ?> Kwh</td>
                                            <td>
                                                <?php
                                                    $total_pembayaran = $t['jumlah_meter'] * $t['tarifperkwh'];
                                                    echo "Rp " . number_format($total_pembayaran, 0, ',', '.');
                                                ?>
                                            </td>
                                          <td>
											<?php if ($t['status'] == 0 || $t['status'] == 3) { ?>
												<span class="badge bg-danger text-white">Belum Lunas</span>
											<?php } elseif ($t['status'] == 1) { ?>
												<span class="badge bg-warning text-white">Proses Verifikasi</span>
											<?php } ?>
										</td>

										<td class="text-center">
											<div class="form-button-action">
												<?php if ($t['status'] == 0 || $t['status'] == 3) { ?>
													<a href="<?php echo base_url('tagihan/detail_pembayaran/' . $t['id_tagihan']) ?>"
													class="btn btn-primary btn-sm btn-round fw-semibold">
														Bayar Sekarang
													</a>
												<?php } elseif ($t['status'] == 1) { ?>
													<a href="<?php echo base_url('tagihan/edit_pembayaran/' . $t['id_tagihan']) ?>"
													class="btn btn-info btn-sm btn-round fw-semibold">
														Edit Bukti Pembayaran
													</a>
												<?php } ?>
											</div>
										</td>
                                        </tr>
                                        <?php } ?>
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
	$(function() {

         <?php if ($this->session->flashdata('message')) { ?>
             Swal.fire({
                 icon: 'success',
                 title: 'Berhasil!',
                 text: '<?php echo $this->session->flashdata('message'); ?>'
             })
         <?php } ?>
     });
</script>