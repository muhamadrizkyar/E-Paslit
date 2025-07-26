<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Edit Data Pelanggan</h4>
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
						<a href="<?= base_url('data_pelanggan'); ?>">Data Pelanggan</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">Edit Data Pelanggan</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<a class="btn btn-primary btn-round ml-auto" href="<?= base_url('data_pelanggan'); ?>">
									<i class="fa fa-arrow-left"></i>
									Kembali
								</a>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-12">
									<form action="<?= base_url('data_pelanggan/update/' . $pelanggan['id_pelanggan']); ?>" method="POST" enctype="multipart/form-data">
 								<input name='id_pelanggan' type='hidden' class='form-control' value="<?= $pelanggan['id_pelanggan'] ?>">
										<div
											class="form-group">
											<label for="largeInput">Username</label>
											<input type="text" id="username" value="<?= $pelanggan['username'] ?>"
												class="form-control form-control <?php echo form_error('username') ? 'is-invalid' : '' ?>"
												name="username" />
											<div class="invalid-feedback" style="font-size: 12px;">
												<?php echo form_error('username') ?>
											</div>
										</div>
										<div class="form-group">
											<label for="largeInput">Nama Pelanggan</label>
												<input type="text" id="nama_pelanggan" value="<?= $pelanggan['nama_pelanggan'] ?>"
												class="form-control form-control <?php echo form_error('nama_pelanggan') ? 'is-invalid' : '' ?>"
												name="nama_pelanggan" />
											<div class="invalid-feedback" style="font-size: 12px;">
												<?php echo form_error('nama_pelanggan') ?>
											</div>
										</div>
										<div class="form-group">
											<label for="largeInput">Nomor KWH</label>
												<input type="number" id="nomor_kwh" value="<?= $pelanggan['nomor_kwh'] ?>"
												class="form-control form-control <?php echo form_error('nomor_kwh') ? 'is-invalid' : '' ?>"
												name="nomor_kwh" />
											<div class="invalid-feedback" style="font-size: 12px;">
												<?php echo form_error('nomor_kwh') ?>
											</div>
										</div>
                                        <div class="form-group">
											<label for="largeInput">Alamat</label>
											 <textarea class="form-control <?php echo form_error('alamat') ? 'is-invalid' : '' ?>" id="alamat" name="alamat" style="height: 100px"><?= $pelanggan['alamat'] ?></textarea>
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
<!-- CDN SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
	$(function() {

         <?php if ($this->session->flashdata('gagal')) { ?>
             Swal.fire({
                 icon: 'error',
                 title: 'Gagal!',
                 text: '<?php echo $this->session->flashdata('gagal'); ?>'
             })
         <?php } ?>
     });

</script>