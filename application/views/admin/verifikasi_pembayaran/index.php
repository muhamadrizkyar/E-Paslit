<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Data Verifikasi Pembayaran</h4>
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
						<a href="#">Transaksi</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="<?= base_url('tarif'); ?>">Data Verifikasi Pembayaran</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table id="data-table" class="data-table display table table-striped table-hover">
									<thead>
										<tr class="text-center">
											<th>No</th>
											<th>Kode Tagihan</th>
											<th>Nama Pelanggan</th>
											<th>Tanggal Pembayaran</th>
											<th>Bulan Bayar</th>
											<th>Total</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tfoot class="text-center">
										<tr>
											<th>No</th>
											<th>Kode Tagihan</th>
											<th>Nama Pelanggan</th>
											<th>Tanggal Pembayaran</th>
											<th>Bulan Bayar</th>
											<th>Total</th>
											<th>Aksi</th>
										</tr>
									</tfoot>
									<tbody>
										<?php foreach ($verifikasi as $key => $v) : ?>
										<tr>
											<td><?= $key + 1 ?></td>
											<td><?= str_pad($v['id_tagihan'], 8, '0000000', STR_PAD_LEFT); ?></td>
											<td><?php foreach ($pelanggan as $key => $value) : ?>
                                                       <?= $data = $v['id_pelanggan'] == $value['id_pelanggan'] ? $value['nama_pelanggan'] : null; ?>
                                                   <?php endforeach; ?></td>
											<td><?=$v['tanggal_pembayaran']; ?></td>
											<td><?= get_nama_bulan($v['bulan_bayar']); ?></td>
											<td><?=$v['total_bayar']; ?></td>
											<td class="text-center">
												<div class="form-button-action">
													<button type="button"
													class="btn btn-link btn-success btn-lg btn-detail-pembayaran"
													data-id="<?= $v['id_pembayaran']; ?>"
													data-bs-toggle="modal"
													data-bs-target="#exampleModal">
													<i class="fa fa-clipboard"></i>
													</button>
													<!-- Default dropup button -->
													<div class="btn-group dropup">
													<button type="button" class="btn btn-link btn-secondary btn-lg dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
														<i class="fas fa-tasks"></i>
													</button>
													<ul class="dropdown-menu">
														<li>
														<a href="<?php echo base_url('verifikasi_pembayaran/terimapembayaran/' . $v['id_pembayaran']) ?>" title="Terima" class="dropdown-item text-success">
															<i class="fas fa-check mr-1"></i>Terima</a>
														<a href="<?php echo base_url('verifikasi_pembayaran/tolakpembayaran/' . $v['id_pembayaran']) ?>" title="Tolak" class="dropdown-item text-danger">
															<i class="fas fa-times mr-1"></i>Tolak</a>
														</li>
													</ul>
													</div>
												</div>
											</td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Pembayaran</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
  <div id="detail-pembayaran"></div>
</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- CDN SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
	$(document).ready(function () {
  $('.data-table').DataTable();

  // Sweetalert
  <?php if ($this->session->flashdata('message')) { ?>
    Swal.fire({
      icon: 'success',
      title: 'Berhasil!',
      text: '<?php echo $this->session->flashdata('message'); ?>'
    })
  <?php } ?>

  $('.btn-detail-pembayaran').on('click', function () {
    var id_pembayaran = $(this).data('id');

    $.ajax({
      url: "<?= base_url('verifikasi_pembayaran/getDetailPembayaran') ?>",
      type: "POST",
      data: { id_pembayaran: id_pembayaran },
      dataType: "JSON",
      success: function(data) {
        console.log(data); // Debug

        var html = `
          <div class="row">
            <div class="col-6 text-start"><p>Nama Pelanggan</p></div>
            <div class="col-6 text-end fw-semibold">${data.nama_pelanggan}</div>

            <div class="col-6 text-start"><p>Tanggal Pembayaran</p></div>
            <div class="col-6 text-end fw-semibold">${data.tanggal_pembayaran}</div>

            <div class="col-6 text-start"><p>Bulan Bayar</p></div>
            <div class="col-6 text-end fw-semibold">${data.bulan_bayar}</div>

			<div class="col-6 text-start"><p>Biaya Admin</p></div>
            <div class="col-6 text-end fw-semibold">Rp.${data.biaya_admin}</div>

            <div class="col-6 text-start"><p>Total Bayar</p></div>
            <div class="col-6 text-end fw-semibold">Rp.${data.total_bayar}</div>


            <div class="col-12 text-center">
              <img src="<?= base_url('assets/bukti-pembayaran/') ?>${data.image}" width="250" alt="Bukti Bayar">
            </div>
          </div>
        `;
        $('#detail-pembayaran').html(html);
      }
    });
  });
});

</script>