<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Data Penggunaan Listrik</h4>
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
						<a href="<?= base_url('penggunaan'); ?>">Data Penggunaan Listrik</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<a class="btn btn-primary btn-round ml-auto" href="<?= base_url('penggunaan/create'); ?>">
									<i class="fa fa-plus"></i>
									Tambah Data
								</a>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="data-table" class="data-table display table table-striped table-hover">
									<thead>
										<tr class="text-center">
											<th>No</th>
											<th>Bulan</th>
											<th>Tahun</th>
											<th>Meter Awal</th>
											<th>Meter Akhir</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tfoot class="text-center">
										<tr>
											<th>No</th>
											<th>Bulan</th>
											<th>Tahun</th>
											<th>Meter Awal</th>
											<th>Meter Akhir</th>
											<th>Aksi</th>
										</tr>
									</tfoot>
									<tbody>
										<?php foreach ($penggunaan as $key => $p) : ?>
 										<?php if ($p['id_pelanggan'] == $pelanggan['id_pelanggan']) { ?>
										<tr>
											<td><?= $key + 1 ?></td>
											<td><?= get_nama_bulan($p['bulan']); ?></td>
											<td><?=$p['tahun']; ?></td>
											<td><?= str_pad($p['meter_awal'], 5, '0', STR_PAD_LEFT); ?> Kwh</td>
											<td><?= str_pad($p['meter_akhir'], 5, '0', STR_PAD_LEFT); ?> Kwh</td>
											<td class="text-center">
												<div class="form-button-action">
													  <?php if ($p['status'] != 2 && $p['status'] != 1): ?>
													<a href="<?php echo base_url('penggunaan/edit/' . $p['id_penggunaan']) ?>" data-toggle="tooltip"
														title="" class="btn btn-link btn-warning btn-lg"
														data-original-title="Edit Data">
														<i class="fa fa-edit"></i>
														<?php else: ?>
														<span class="badge bg-danger text-white">Tidak Bisa Di Edit</span>
													<?php endif; ?>
													</a>
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