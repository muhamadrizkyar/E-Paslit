    <!----------------------- Main Container -------------------------->

    <div class="container d-flex justify-content-center align-items-center min-vh-100">

    	<!----------------------- Login Container -------------------------->

    	<div class="row border rounded-5 p-3 bg-white shadow box-area">

    		<!--------------------------- Left Box ----------------------------->

    		<div class="d-xxl-block d-xl-block d-lg-block d-md-block d-sm-none d-none col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
    			style="background: #103cbe;">
    			<center>
					<div class="featured-image mb-3" style="padding-top:200px">
    				<div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
    						<div class="carousel-inner">
    							<div class="carousel-item active">
    								<img src="<?= base_url() ?>/assets/template_auth/img/image-1.svg"
    									style="width:200px; height:200px;" class="d-block w-100" alt="Image Corousel">
    							</div>
    							<div class="carousel-item">
    								<img src="<?= base_url() ?>/assets/template_auth/img/image-2.svg"
    									style="width:200px; height:200px;" class="d-block w-100" alt="Image Corousel">
    							</div>
    							<div class="carousel-item">
    								<img src="<?= base_url() ?>/assets/template_auth/img/image-3.svg"
    									style="width:200px; height:200px;" class="d-block w-100" alt="Image Corousel">
    							</div>
    						</div>
    						<button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
    							data-bs-slide="prev">
    							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
    							<span class="visually-hidden">Previous</span>
    						</button>
    						<button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
    							data-bs-slide="next">
    							<span class="carousel-control-next-icon" aria-hidden="true"></span>
    							<span class="visually-hidden">Next</span>
    						</button>
    					</div>
    			</div>
    			<p class="text-white fs-2" style="font-weight: 600;">
    				E-PASLIT</p>
    			<small class="text-white text-wrap text-center"
    				style="width: 17rem;">Daftarkan Akun Anda Dan Pastikan Nomor KWH Sudah Terdaftar Di Sistem, Jika Sudah
    				Memiliki Akun Silahkan Masuk.</small>
				</center>
    		</div>

    		<!-------------------- ------ Right Box ---------------------------->

    		<div class="col-md-6 right-box">
    			<div class="row align-items-center">
    				<div class="header-text mb-2">
    					<h2>Selamat Datang !</h2>
    					<p>Silahkan Mengisi Form Untuk Membuat Akun.</p>
    				</div>
    				<form method="POST" action="<?= base_url('autentifikasi/DaftarProses'); ?>" enctype="multipart/form-data">
    					<div class="mb-2">
    						<label for="nama_pelanggan" class="form-label">Nama Lengkap</label>
    						<input type="text" class="form-control <?php echo form_error('nama_pelanggan') ? 'is-invalid' : '' ?>"
    							id="nama_pelanggan" name="nama_pelanggan">
    						<div class="invalid-feedback">
    							<?php echo form_error('nama_pelanggan') ?>
    						</div>
    					</div>
    					<div class="form-group">
    						<label for="image">Foto Profil - kosongkan jika tidak di ubah </label>
							<!-- <input type="file" name="image" class="form-control input-custom" id="image"> -->
									<input type="file" class="form-control input-custom" id="image" name="image">
    						<img class="mb-2" id="blah" src="<?= base_url('') ?>/assets/image-pelanggan/default.jpg"
    							id="previewImg" style="max-width: 120px; margin-top: 20px;">
    					</div>
    					<div class="mb-2">
    						<label for="username" class="form-label">Username</label>
    						<input type="username"
    							class="form-control <?php echo form_error('username') ? 'is-invalid' : '' ?>" id="username"
    							name="username">
    						<div class="invalid-feedback">
    							<?php echo form_error('username') ?>
    						</div>
    					</div>
                        	<div class="mb-2">
    						<label for="nomor_kwh" class="form-label">Nomor KWH</label>
    						<input type="number" class="form-control <?php echo form_error('nomor_kwh') ? 'is-invalid' : '' ?>"
    							id="nomor_kwh" name="nomor_kwh">
    						<div class="invalid-feedback">
    							<?php echo form_error('nomor_kwh') ?>
    						</div>
    					</div>
                        	<div class="mb-2">
    						<label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control <?php echo form_error('alamat') ? 'is-invalid' : '' ?>" id="alamat" name="alamat" style="height: 100px"></textarea>
    						<div class="invalid-feedback">
    							<?php echo form_error('alamat') ?>
    						</div>
    					</div>
    					<div class="mb-2">
    						<div class="form-group">
    							<label for="password1">Password</label>
    							<input type="password"
    								class="form-control <?php echo form_error('password1') ? 'is-invalid' : '' ?>"
    								id="password1" name="password1">
    							<div class="invalid-feedback">
    								<?php echo form_error('password1') ?>
    							</div>
    						</div>
    					</div>
    					<div class="mb-2">
    						<div class="form-group">
    							<label for="password2">Konfirmasi Password</label>
    							<input type="password"
    								class="form-control <?php echo form_error('password2') ? 'is-invalid' : '' ?>"
    								id="password2" name="password2">
    							<div class="invalid-feedback">
    								<?php echo form_error('password1') ?>
    							</div>
    						</div>
    					</div>
    					<div class="input-group mb-2">
    						<input type="submit" class="btn btn-lg btn-primary w-100 fs-6" value="DAFTAR">
    					</div>
    					<div class="row">
    						<small>Sudah Memiliki Akun ? <a href="<?= base_url('autentifikasi'); ?>">Masuk</a></small>
    					</div>
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php if ($this->session->flashdata('gagal')) : ?>
    <script>
    	swal({
    		title: "GAGAL!",
    		text: "<?php echo $this->session->flashdata('gagal'); ?>",
    		icon: "error",
    		button: true,
    		timer: 5000,
    	});
    </script>

    <?php endif; ?>
    </script>
    <script>
    	image.onchange = evt => {
    		const [file] = image.files
    		if (file) {
    			blah.src = URL.createObjectURL(file)
    		}
    	}
    </script>