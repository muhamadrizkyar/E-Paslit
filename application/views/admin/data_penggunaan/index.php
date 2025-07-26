<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Data Penggunaan</h4>
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
						<a href="#">Pelanggan</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('data_penggunaan'); ?>">Data Penggunaan</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<a class="btn btn-primary btn-round ml-auto" href="<?= base_url('data_penggunaan/create'); ?>">
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
											<th>Nama Pelanggan</th>
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
											<th>Nama Pelanggan</th>
											<th>Bulan</th>
											<th>Tahun</th>
											<th>Meter Awal</th>
											<th>Meter Akhir</th>
											<th>Aksi</th>
										</tr>
									</tfoot>
									<tbody>
										<?php foreach ($penggunaan as $key => $p) : ?>
										<tr>
											<td><?= $key + 1 ?></td>
											<td><?=$p['nama_pelanggan']; ?></td>
											<td><?= get_nama_bulan($p['bulan']); ?></td>
											<td><?=$p['tahun']; ?></td>
											<td><?= str_pad($p['meter_awal'], 5, '0', STR_PAD_LEFT); ?></td>
											<td><?= str_pad($p['meter_akhir'], 5, '0', STR_PAD_LEFT); ?></td>
												<td class="text-center">
												<div class="form-button-action">
													<a href="<?php echo base_url('data_penggunaan/edit/' . $p['id_penggunaan']) ?>" data-toggle="tooltip"
														title="" class="btn btn-link btn-warning btn-lg"
														data-original-title="Edit Data">
														<i class="fa fa-edit"></i>
													</a>
													<a href="<?php echo base_url('data_penggunaan/hapus/' . $p['id_penggunaan']) ?>"
														data-toggle="tooltip" title="" class="delete-data_penggunaan btn btn-link btn-danger"
														data-original-title="Hapus Data"><i class="fa fa-trash"></i></a>
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
	$(function() {
         <?php if ($this->session->flashdata('message')) { ?>
             Swal.fire({
                 icon: 'success',
                 title: 'Berhasil!',
                 text: '<?php echo $this->session->flashdata('message'); ?>'
             })
         <?php } ?>
     });
	 
	 $('.delete-data_penggunaan').on('click', function() {
         var getLink = $(this).attr('href');
         Swal.fire({
             title: "Yakin hapus data?",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#d33',
             confirmButtonText: 'Ya',
             cancelButtonColor: '#3085d6',
             cancelButtonText: "Batal"

         }).then(result => {
             //jika klik ya maka arahkan ke proses.php
             if (result.isConfirmed) {
                 window.location.href = getLink
             }
         })
         return false;
     });
</script>