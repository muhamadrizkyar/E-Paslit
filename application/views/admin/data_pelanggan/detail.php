<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Detail Data Pelanggan</h4>
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
						<a href="<?= base_url('data_pelanggan'); ?>">Data Pelanggan</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">Detail Data Pelanggan</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<a class="btn btn-primary btn-round ml-auto" href="<?= base_url('data_pelanggan'); ?>">
									<i class="fas fa-arrow-left"></i>
									Kembali
								</a>
							</div>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="data-table" class="data-table display table table-striped table-hover">
									<thead>
										<tr class="text-center">
											<th>No</th>
											<th>Username</th>
											<th>Nama Pelanggan</th>
											<th>Nomor KWH</th>
											<th>Harga Tarif</th>
											<th>Alamat</th>
											<th>Image</th>
										</tr>
									</thead>
									<tfoot class="text-center">
										<tr>
											<th>No</th>
											<th>Username</th>
											<th>Nama Pelanggan</th>
											<th>Nomor KWH</th>
											<th>Harga Tarif PerKWH</th>
											<th>Alamat</th>
											<th>Image</th>
										</tr>
									</tfoot>
									<tbody>
										<tr>
											<td>1</td>
											<td><?=$pelanggan['username']; ?></td>
											<td><?=$pelanggan['nama_pelanggan']; ?></td>
											<td><?=$pelanggan['nomor_kwh']; ?></td>
											<td><?php foreach ($tarif as $key => $value) : ?>
												<?= $data = $pelanggan['id_tarif'] == $value['id_tarif'] ? $value['tarifperkwh'] : null; ?>
												<?php endforeach; ?></td>
											<td><?=$pelanggan['alamat']; ?></td>
                                            <td align="center">
												<img src="<?= base_url('assets/image-pelanggan/') . $pelanggan['image']; ?>"
													alt="<?php $pelanggan['nama_pelanggan'] ?>" width="100px"
													class="shadow-sm rounded m-2" loading="lazy">
											</td>
										</tr>
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
