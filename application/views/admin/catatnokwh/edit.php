<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Edit Data Nomor KWH</h4>
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
						<a href="<?= base_url('catatnokwh'); ?>">Data Nomor KWH</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">Edit Data Nomor KWH</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<a class="btn btn-primary btn-round ml-auto" href="<?= base_url('catatnokwh'); ?>">
									<i class="fa fa-arrow-left"></i>
									Kembali
								</a>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-12">
								<form action="<?= base_url('catatnokwh/update/' . $catatnokwh['id_nokwh']); ?>" method="POST" enctype="multipart/form-data">
 								<input name='id_nokwh' type='hidden' class='form-control' value="<?= $catatnokwh['id_nokwh'] ?>">
											<div class="form-group">
											<label for="largeInput">Nomor KWH</label>
											<input type="number" id="nomor_kwh"
												class="form-control form-control <?php echo form_error('nomor_kwh') ? 'is-invalid' : '' ?>"
												name="nomor_kwh" value="<?= $catatnokwh['nomor_kwh']; ?>"/>
											<div class="invalid-feedback" style="font-size: 12px;">
												<?php echo form_error('nomor_kwh') ?>
											</div>
										</div>
										<div class="form-group">
											<label for="largeInput">Pilih Tarif Daya Listrik</label>
											<select
												class="form-control form-control <?php echo form_error('id_tarif') ? 'is-invalid' : '' ?>"
												name="id_tarif" id="id_tarif">
												<option value="" hidden>Pilih Tarif Daya Listrik</option>
												 <?php foreach ($tarif as $key => $value) : ?>
                                           <option value="<?= $value['id_tarif']; ?>" <?= $catatnokwh['id_tarif'] == $value['id_tarif'] ? 'selected' : null; ?>><?= $value['daya']; ?></option>
                                       <?php endforeach; ?>
											</select>
											<div class="invalid-feedback" style="font-size: 12px;">
												<?php echo form_error('id_tarif') ?>
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