<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Detail Data Admin-Petugas</h4>
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
						<a href="#">Main</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('admin'); ?>">Data Admin-Petugas</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">Detail Data Admin-Petugas</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<a class="btn btn-primary btn-round ml-auto" href="<?= base_url('admin'); ?>">
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
											<th>Nama Lengkap</th>
											<th>Role</th>
											<th>Foto Profile</th>
										</tr>
									</thead>
									<tfoot class="text-center">
										<tr>
											<th>No</th>
											<th>Username</th>
											<th>Nama Lengkap</th>
											<th>Role</th>
											<th>Foto Profile</th>
										</tr>
									</tfoot>
									<tbody>
										<tr>
											<td>1</td>
											<td><?=$users['username']; ?></td>
											<td><?=$users['nama_admin']; ?></td>
											<td><?php foreach ($level as $key => $value) : ?>
												<?= $data = $users['id_level'] == $value['id_level'] ? $value['nama_level'] : null; ?>
												<?php endforeach; ?></td>
											<td align="center">
												<img src="<?= base_url('assets/image-petugas/') . $users['image']; ?>"
													alt="<?php $user['nama_admin'] ?>" width="100px"
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
