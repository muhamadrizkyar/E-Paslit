
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
							<a href="<?= base_url('dashboard-admin') ?>">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Main</h4>
						</li>
					 	<?php
						// Cek level user
						if ($this->session->userdata('id_level') == 1) { 
						?>
						<li class="nav-item <?php if ($sidebar == "petugas") {
                                echo "active";
                            } ?>">
							<a href="<?= base_url('admin') ?>">
								<i class="fas fa-user-tie"></i>
								<p>Data Petugas</p>
							</a>
						</li>
                        <li class="nav-item <?php if ($sidebar == "tarif") {
                                echo "active";
                            } ?>">
							
							<a href="<?= base_url('tarif') ?>">
								<i class="fas fa-folder-open"></i>
								<p>Data Tarif Daya</p>
							</a>
						</li>
						<?php	
						}
						?>
						<li class="nav-item  <?php if ($sidebar == "catatnokwh") {
                                echo "active";
                            } ?>">
							<a href="<?= base_url('catatnokwh')?>">
								<i class="fas fa-file-signature"></i>
								<p>Catat NoKWH</p>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Pelanggan</h4>
						</li>
						<?php
						// Cek level user
						if ($this->session->userdata('id_level') == 1) { 
						?>
						<li class="nav-item <?php if ($sidebar == "pelanggan") {
                                echo "active";
                            } ?>">
							<a href="<?= base_url('data_pelanggan') ?>">
								<i class="fas fa-user"></i>
								<p>Data Pelanggan</p>
							</a>
						</li>
						<?php	
						}
						?>
						<li class="nav-item <?php if ($sidebar == "penggunaan") {
                                echo "active";
                            } ?>">
							<a href="<?= base_url('data_penggunaan') ?>">
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
						<li class="nav-item <?php if ($sidebar == "varifikasi") {
                                echo "active";
                            } ?>">
							<a href="<?= base_url('verifikasi_pembayaran') ?>">
								<i class="fas fa-file"></i>
								<p>Verifikasi Pembayaran</p>
							</a>
						</li>
						<li class="nav-item <?php if ($sidebar == "riwayat") {
                                echo "active";
                            } ?>">
							<a href="<?= base_url('riwayat_pembayaran') ?>">
								<i class="fas fa-folder"></i>
								<p>Riwayat Pembayaran</p>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->
