    <!----------------------- Main Container -------------------------->

    <div class="container d-flex justify-content-center align-items-center min-vh-100">

    	<!----------------------- Login Container -------------------------->

    	<div class="row border rounded-5 p-3 bg-white shadow box-area">

    		<div class="d-xxl-block d-xl-block d-lg-block d-md-block d-sm-none d-none col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
    			style="background: #103cbe;">
    			<center>
    				<div class="featured-image mb-3" style="padding-top:50px">
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
    					E-PASLIT <br>
    				</p>
    				<small class="text-white text-wrap text-center" style="width: 17rem;">Silakan masukkan akun Anda yang telah terdaftar sebagai Admin atau Petugas untuk mengakses sistem ini</small>
    			</center>
    		</div>

    		<div class="col-md-6 right-box">
    			<div class="row align-items-center">
    				<div class="header-text mb-2">
    					<h2>Selamat Datang !</h2>
    					<p>Silahkan Masuk Menggunakan Akun Yang Sudah Terdaftar.</p>
    				</div>
    				<form method="POST" action="<?= base_url('login-admin'); ?>">
    					<div class="mb-2">
    						<label for="username" class="form-label">Username</label>
    						<input type="username"
    							class="form-control <?php echo form_error('username') ? 'is-invalid' : '' ?>"
    							id="username" name="username">
    						<div class="invalid-feedback">
    							<?php echo form_error('username') ?>
    						</div>
    					</div>
    					<div class="mb-2">
    						<label for="password" class="form-label">Password</label>
    						<input type="password"
    							class="form-control <?php echo form_error('password') ? 'is-invalid' : '' ?>"
    							id="password" name="password">
    						<div class="invalid-feedback">
    							<?php echo form_error('password') ?>
    						</div>
    					</div>
    					<div class="input-group mb-2">
    						<input type="submit" class="btn btn-lg btn-primary w-100 fs-6" value="MASUK">
    					</div>
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php if ($this->session->flashdata('message')) : ?>
    <script>
    	swal({
    		title: "GAGAL!",
    		text: "<?php echo $this->session->flashdata('message'); ?>",
    		icon: "error",
    		button: true,
    		timer: 5000,
    	});
    </script>

    <?php endif; ?>
    <?php if ($this->session->flashdata('daftar')) : ?>
    <script>
    	swal({
    		title: "BERHASIL!",
    		text: "<?php echo $this->session->flashdata('daftar'); ?>",
    		icon: "success",
    		button: true,
    		timer: 5000,
    	});
    </script>

    <?php endif; ?>