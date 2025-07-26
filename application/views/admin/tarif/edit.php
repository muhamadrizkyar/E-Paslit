<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Edit Tarif Daya</h4>
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
						<a href="<?= base_url('tarif'); ?>">Data Tarif Daya</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">edit Data Tarif Daya</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="d-flex align-items-center">
								<a class="btn btn-primary btn-round ml-auto" href="<?= base_url('tarif'); ?>">
									<i class="fa fa-arrow-left"></i>
									Kembali
								</a>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-12">
									<form action="<?= base_url('tarif/update/' . $tarif['id_tarif']); ?>" method="POST"
 								enctype="multipart/form-data">

 								<input name='id_tarif' type='hidden' class='form-control' value="<?= $tarif['id_tarif'] ?>">
										<div
											class="form-group">
											<label for="largeInput">Daya Listrik</label>
											<input type="number" id="daya"
												class="form-control form-control <?php echo form_error('daya') ? 'is-invalid' : '' ?>"
												name="daya"  value="<?= $tarif['daya']; ?>" />
											<div class="invalid-feedback" style="font-size: 12px;">
												<?php echo form_error('daya') ?>
											</div>
										</div>
										<div class="form-group">
											<label for="largeInput">Tarif PerKWH</label>
												<input type="number" id="tarifperkwh"
												class="form-control form-control <?php echo form_error('tarifperkwh') ? 'is-invalid' : '' ?>"
												name="tarifperkwh" value="<?= $tarif['tarifperkwh']; ?>" />
											<div class="invalid-feedback" style="font-size: 12px;">
												<?php echo form_error('tarifperkwh') ?>
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