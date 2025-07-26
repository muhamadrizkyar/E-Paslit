	</div>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

	<!-- Modal Logout untuk Pelanggan -->
	<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabelUser" aria-hidden="true">
		<!-- isi modal user -->
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Keluar dari Akun?</h5>
					<button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Pilih Keluar di bawah jika anda siap untuk mengakhiri sesi anda saat ini.</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
					<a class="btn btn-danger" href="<?= base_url('autentifikasi/logout_pelanggan'); ?>">Keluar</a>
				</div>
			</div>
		</div>
	</div>

	</div>
	<!--   Core JS Files   -->
	<script src="<?= base_url('') ?>/assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="<?= base_url('') ?>/assets/js/core/popper.min.js"></script>
	<script src="<?= base_url('') ?>/assets/js/core/bootstrap.min.js"></script>

	<!-- jQuery UI -->
	<script src="<?= base_url('') ?>/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="<?= base_url('') ?>/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

	<!-- jQuery Scrollbar -->
	<script src="<?= base_url('') ?>/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

	<!-- Chart JS -->
	<script src="<?= base_url('') ?>/assets/js/plugin/chart.js/chart.min.js"></script>

	<!-- jQuery Sparkline -->
	<script src="<?= base_url('') ?>/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

	<!-- Chart Circle -->
	<script src="<?= base_url('') ?>/assets/js/plugin/chart-circle/circles.min.js"></script>

	<!-- Datatables -->
	<script src="<?= base_url('') ?>/assets/js/plugin/datatables/datatables.min.js"></script>

	<!-- jQuery Vector Maps -->
	<script src="<?= base_url('') ?>/assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
	<script src="<?= base_url('') ?>/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

	<!-- Sweet Alert -->
	<script src="<?= base_url('') ?>/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

	<!-- Atlantis JS -->
	<script src="<?= base_url('') ?>/assets/js/atlantis.min.js"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="<?= base_url('') ?>/assets/js/setting-demo.js"></script>
	<script src="<?= base_url('') ?>/assets/js/demo.js"></script>
	</body>

	</html>