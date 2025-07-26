<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Edit Data Profile</h4>
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
						<a href="#">Data</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('dashboard'); ?>">Dashboard</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">Ubah Data Profile</a>
					</li>
				</ul>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-8">
					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<a class="btn btn-primary btn-round ml-auto" href="<?= base_url('dashboard'); ?>">
									<i class="fa fa-arrow-left"></i>
									Kembali
								</a>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-12">
									<form action="<?= base_url('pelanggan/updateprofile/' . $pelanggan['id_pelanggan']); ?>"
										method="POST" enctype="multipart/form-data">
										<input name='id_pelanggan' type='hidden' class='form-control'
											value="<?= $pelanggan['id_pelanggan'] ?>">
										<div class="form-group">
											<label for="largeInput">Username</label>
											<input type="text" id="username"
												class="form-control form-control <?php echo form_error('username') ? 'is-invalid' : '' ?>"
												name="username" value="<?= $pelanggan['username']; ?>" disabled />
											<div class="invalid-feedback" style="font-size: 12px;">
												<?php echo form_error('username') ?>
											</div>
										</div>
										<div class="form-group">
											<label for="largeInput">Nama Lengkap</label>
											<input type="text" id="nama_pelanggan"
												class="form-control form-control <?php echo form_error('nama_pelanggan') ? 'is-invalid' : '' ?>"
												name="nama_pelanggan" value="<?= $pelanggan['nama_pelanggan']; ?>" />
											<div class="invalid-feedback" style="font-size: 12px;">
												<?php echo form_error('nama_pelanggan') ?>
											</div>
										</div>
										<div class="form-group">
											<label for="largeInput">Foto Profile - kosongkan jika tidak di ubah</label>
											<input type="file" id="image" class="form-control form-control"
												name="image" />
											<img id="blah"
												src="<?= base_url('assets/image-pelanggan/') . $pelanggan['image']; ?>"
												id="previewImg" style="max-width: 120px; margin-top: 20px;">
										</div>
											<div class="form-group">
											<label for="largeInput">Alamat</label>
											 <textarea class="form-control <?php echo form_error('alamat') ? 'is-invalid' : '' ?>" id="alamat" name="alamat" style="height: 100px"><?= $pelanggan['alamat']; ?></textarea>
											<div class="invalid-feedback" style="font-size: 12px;">
												<?php echo form_error('alamat') ?>
											</div>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
		image.onchange = evt => {
			const [file] = image.files
			if (file) {
				blah.src = URL.createObjectURL(file)
			}
		}
	</script>