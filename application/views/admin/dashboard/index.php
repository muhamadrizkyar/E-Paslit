<div class="main-panel">
	<div class="content">
		<div class="panel-header bg-primary-gradient">
			<div class="page-inner py-5">
				<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
					<div>
						<h2 class="text-white pb-2 fw-bold">Dashboard</h2>
					</div>
					<div class="ml-md-auto py-2 py-md-0">
						<a href="#" disabled
							class="btn btn-secondary btn-round"><?php echo date('d F Y || H:i:s') ?></a>
					</div>
				</div>
			</div>
		</div>
		<div class="page-inner mt--5">
			<div class="row mt--2 justify-content-center">
				<?php
				// Cek level user
				if ($this->session->userdata('id_level') == 1) { 
				?>
				<div class="col-6 col-md-4">
					<div class="card card-stats card-primary card-round">
						<div class="card-body">
							<div class="row">
								<div class="col-5">
									<div class="icon-big text-center">
										<i class="flaticon-user"></i>
									</div>
								</div>
								<div class="col-7 col-stats">
									<div class="numbers">
										<p class="card-category">Total Data Petugas</p>
										<h4 class="card-title"><?= $sum_user; ?></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-md-4">
					<div class="card card-stats card-secondary card-round">
						<div class="card-body">
							<div class="row">
								<div class="col-5">
									<div class="icon-big text-center">
										<i class="flaticon-user-6"></i>
									</div>
								</div>
								<div class="col-7 col-stats">
									<div class="numbers">
										<p class="card-category">Total Data Pelanggan</p>
										<h4 class="card-title"><?= $pelanggan; ?></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-md-4">
					<div class="card card-stats card-warning card-round">
						<div class="card-body">
							<div class="row">
								<div class="col-5">
									<div class="icon-big text-center">
										<i class="flaticon-shapes-1"></i>
									</div>
								</div>
								<div class="col-7 col-stats">
									<div class="numbers">
										<p class="card-category">Total Data Tarif Daya</p>
										<h4 class="card-title"><?= $tarif; ?></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php	
						}
						?>
				<div class="col-6 col-md-4">
					<div class="card card-stats card-primary card-round">
						<div class="card-body">
							<div class="row">
								<div class="col-5">
									<div class="icon-big text-center">
										<i class="flaticon-file-1"></i>
									</div>
								</div>
								<div class="col-7 col-stats">
									<div class="numbers">
										<p class="card-category">Total Data NoKWH</p>
										<h4 class="card-title"><?= $datanokwh; ?></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-md-4">
					<div class="card card-stats card-secondary card-round">
						<div class="card-body">
							<div class="row">
								<div class="col-5">
									<div class="icon-big text-center">
										<i class="flaticon-list"></i>
									</div>
								</div>
								<div class="col-7 col-stats">
									<div class="numbers">
										<p class="card-category">Total Data Penggunaan</p>
										<h4 class="card-title"><?= $penggunaan; ?></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-md-4">
					<div class="card card-stats card-warning card-round">
						<div class="card-body">
							<div class="row">
								<div class="col-5">
									<div class="icon-big text-center">
										<i class="flaticon-attachment"></i>
									</div>
								</div>
								<div class="col-7 col-stats">
									<div class="numbers">
										<p class="card-category">Total Verifikasi Tagihan</p>
										<h4 class="card-title"><?= $verifikasi; ?></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-md-4">
					<div class="card card-stats card-success card-round">
						<div class="card-body">
							<div class="row">
								<div class="col-5">
									<div class="icon-big text-center">
										<i class="flaticon-success"></i>
									</div>
								</div>
								<div class="col-7 col-stats">
									<div class="numbers">
										<p class="card-category">Total Tagihan Lunas</p>
										<h4 class="card-title"><?= $tagihan_lunas; ?></h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12">
				<div class="card">
					<div class="card-header justify-content-center">
						<div class="d-flex justify-content-between align-items-center w-100">
							<h4 style="color:#98A6AD">STATISTIK TAGIHAN TAHUN</h4>
							<select id="tahunFilter" class="form-control" style="width:auto; display:inline-block;">
								<?php 
									$currentYear = date('Y');
									for ($year = $currentYear; $year >= $currentYear - 5; $year--) {
										echo "<option value='$year'>$year</option>";
									}
								?>
							</select>
						</div>
					</div>
					<div class="card-body">
						<canvas id="tagihanChart" height="158"></canvas>
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

         <?php if ($this->session->flashdata('ubah-profile')) { ?>
             Swal.fire({
                 icon: 'success',
                 title: 'Berhasil!',
                 text: '<?php echo $this->session->flashdata('ubah-profile'); ?>'
             })
         <?php } ?>
     });

	$(function () {

		<?php
		if ($this->session-> flashdata('message')) {
			?>
			Swal.fire({
				position: 'top-end',
				icon: 'success',
				title: 'Berhasil!',
				text: '<?php echo $this->session->flashdata('
				message '); ?>',
				showConfirmButton: false,
				timer: 5000,
			}) <?php
		} ?>
	});
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
let chartInstance;

function loadChart(tahun) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            renderTagihanChart(data);
        }
    };
    xhttp.open("GET", "<?php echo base_url('Dashboard_Admin/getTagihanChartData'); ?>?tahun=" + tahun, true);
    xhttp.send();
}

function renderTagihanChart(data) {
    var ctx = document.getElementById('tagihanChart').getContext('2d');
    if (chartInstance) {
        chartInstance.destroy();
    }
    chartInstance = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.labels,
            datasets: data.datasets
        },
        options: {
            responsive: true,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        precision: 0
                    }
                }]
            }
        }
    });
}

// Load awal
loadChart(document.getElementById('tahunFilter').value);

// Event ganti tahun
document.getElementById('tahunFilter').addEventListener('change', function() {
    loadChart(this.value);
});
</script>
