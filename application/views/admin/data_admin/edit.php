<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Edit Data Admin-Petugas</h4>
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
						<a href="#">Edit Data Admin-Petugas</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<a class="btn btn-primary btn-round ml-auto" href="<?= base_url('admin'); ?>">
									<i class="fa fa-arrow-left"></i>
									Kembali
								</a>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-12">
									<form action="<?= base_url('admin/update/' . $getUserWhere['id_user']); ?>" method="POST" enctype="multipart/form-data">
 								<input name='id_user' type='hidden' class='form-control' value="<?= $getUserWhere['id_user'] ?>">
										<div
											class="form-group">
											<label for="largeInput">Username</label>
											<input type="text" id="username" value="<?= $getUserWhere['username'] ?>"
												class="form-control form-control <?php echo form_error('username') ? 'is-invalid' : '' ?>"
												name="username" />
											<div class="invalid-feedback" style="font-size: 12px;">
												<?php echo form_error('username') ?>
											</div>
										</div>
										<div class="form-group">
											<label for="largeInput">Nama Lengkap</label>
												<input type="text" id="nama_admin"  value="<?= $getUserWhere['nama_admin'] ?>"
												class="form-control form-control <?php echo form_error('nama_admin') ? 'is-invalid' : '' ?>"
												name="nama_admin" />
											<div class="invalid-feedback" style="font-size: 12px;">
												<?php echo form_error('nama_admin') ?>
											</div>
										</div>
										<div class="form-group">
											<label for="largeInput">Pilih Role</label>
											<select
												class="form-control form-control <?php echo form_error('id_level') ? 'is-invalid' : '' ?>"
												name="id_level" id="id_level">
												<option value="" hidden>Pilih Tarif Daya Listrik</option>
												 <?php foreach ($level as $key => $value) : ?>
                                           <option value="<?= $value['id_level']; ?>" <?= $getUserWhere['id_level'] == $value['id_level'] ? 'selected' : null; ?>><?= $value['nama_level']; ?></option>
                                       <?php endforeach; ?>
											</select>
											<div class="invalid-feedback" style="font-size: 12px;">
												<?php echo form_error('id_level') ?>
											</div>
										</div>
										<div class="form-group">
											<label for="largeInput">Foto Profile - kosongkan jika tidak di ubah</label>
											<input type="file" id="image" class="form-control form-control"
												name="image" />
											<img id="blah"
												src="<?= base_url('assets/image-petugas/') . $getUserWhere['image']; ?>"
												id="previewImg" style="max-width: 120px; margin-top: 20px;">
										</div>
										<div class="form-group">
											<label for="largeInput">Password - kosongkan jika tidak di ubah</label>
											<div class="row">
												<div class="col-6"><input type="password" id="password1"
														class="form-control form-control <?php echo form_error('password1') ? 'is-invalid' : '' ?>"
														name="password1" placeholder="Password" />
													<div class="invalid-feedback" style="font-size: 12px;">
														<?php echo form_error('password1') ?>
													</div>
												</div>
												<div class="col-6"> <input type="password" id="password2"
														class="form-control form-control <?php echo form_error('password2') ? 'is-invalid' : '' ?>"
														name="password2" placeholder="Konfirmasi Password" />
													<div class="invalid-feedback" style="font-size: 12px;">
														<?php echo form_error('password1') ?>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<input type="submit" class="btn btn-success" value="Ubah">
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
	<script>
		image.onchange = evt => {
			const [file] = image.files
			if (file) {
				blah.src = URL.createObjectURL(file)
			}
		}
	</script>