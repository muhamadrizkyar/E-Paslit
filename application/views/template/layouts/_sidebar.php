
		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<ul class="nav nav-primary">
							<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Data</h4>
						</li>
						<li class="nav-item <?php if ($sidebar == "dashboard") {
                                echo "active";
                            } ?>">
							<a href="<?= base_url('dashboard') ?>">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
							<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Catat Meter</h4>
						</li>
						<li class="nav-item <?php if ($sidebar == "penggunaan") {
                                echo "active";
                            } ?>">
							<a href="<?= base_url('penggunaan') ?>">
								<i class="fas fa-folder"></i>
								<p>Data Penggunaan</p>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Transaksi</h4>
						</li>
						<li class="nav-item <?php if ($sidebar == "tagihan") {
                                echo "active";
                            } ?>">
							<a href="<?= base_url('tagihan') ?>">
								<i class="fas fa-folder"></i>
								<p>Data Tagihan</p>
							</a>
						</li>
						<li class="nav-item <?php if ($sidebar == "history") {
                                echo "active";
                            } ?>">
							<a href="<?= base_url('history') ?>">
								<i class="fas fa-folder"></i>
								<p>Pembayaran Berhasil</p>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->
