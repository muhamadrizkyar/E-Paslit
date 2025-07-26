<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Tambah Data Penggunaan Listrik</h4>
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
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">Tambah Data Penggunaan Listrik</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<a class="btn btn-primary btn-round ml-auto" href="<?= base_url('penggunaan'); ?>">
									<i class="fa fa-arrow-left"></i>
									Kembali
								</a>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-12">
									<form action="<?= base_url('penggunaan/save'); ?>" method="POST"
										enctype="multipart/form-data">
										<div class="form-group">
										<label for="bulan">Bulan</label>
										<select id="bulan" name="bulan" class="form-control <?php echo form_error('bulan') ? 'is-invalid' : '' ?>">
											<option value="">Pilih Bulan</option>
											<?php 
											$bulan = [
												1 => 'Januari',
												2 => 'Februari',
												3 => 'Maret',
												4 => 'April',
												5 => 'Mei',
												6 => 'Juni',
												7 => 'Juli',
												8 => 'Agustus',
												9 => 'September',
												10 => 'Oktober',
												11 => 'November',
												12 => 'Desember',
											];
												foreach ($bulan as $key => $nama_bulan) {
													echo '<option value="' . $key . '">' . $nama_bulan . '</option>';
												}
												?>
											</select>
											<div class="invalid-feedback" style="font-size: 12px;">
												<?php echo form_error('bulan') ?>
											</div>
										</div>
										<div class="form-group">
											<label for="largeInput">Tahun</label>
											<input type="number" id="tahun"
												class="form-control form-control <?php echo form_error('tahun') ? 'is-invalid' : '' ?>"
												name="tahun" />
											<div class="invalid-feedback" style="font-size: 12px;">
												<?php echo form_error('tahun') ?>
											</div>
										</div>
										<div class="form-group">
                                        <label for="largeInput">Meter Awal</label>
                                        <input type="number" id="meter_awal"
                                            class="form-control form-control <?php echo form_error('meter_awal') ? 'is-invalid' : '' ?>"
                                            name="meter_awal" value="<?= $meter_awal; ?>" disabled />
                                        <div class="invalid-feedback" style="font-size: 12px;">
                                            <?php echo form_error('meter_awal') ?>
                                        </div>
                                        </div>
										<div class="form-group">
											<label for="largeInput">Meter Akhir</label>
											<input type="number" id="meter_akhir"
												class="form-control form-control <?php echo form_error('meter_akhir') ? 'is-invalid' : '' ?>"
												name="meter_akhir" />
											<div class="invalid-feedback" style="font-size: 12px;">
												<?php echo form_error('meter_akhir') ?>
											</div>
										</div>
										<div class="form-group">
											<input type="submit" class="btn btn-success" value="Simpan">
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

         <?php if ($this->session->flashdata('message')) { ?>
             Swal.fire({
                 icon: 'error',
                 title: 'Gagal!',
                 text: '<?php echo $this->session->flashdata('message'); ?>'
             })
         <?php } ?>
     });

</script>