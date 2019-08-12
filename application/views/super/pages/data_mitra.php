<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Data Mitra</h1>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Mitra
				<!-- <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Ruangan</a> -->
			</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							
							<th>#</th>
							<th>Nama Mitra</th>
							<th>Alamat</th>
							<th>Telp</th>
							<th>Nama Pemilik</th>
							<th>Nama Bank</th>
							<th>Nomor Rekening</th>
							<th>Nama Akun Bank</th>
							<th>Action</th>
						</tr>
					</thead>

					
					<tbody>
						<?php $no = 1; foreach ($mitra as $r) { ?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $r->nama_mitra; ?></td>
								<td><?php echo $r->alamat; ?></td>
								<td><?php echo $r->no_telp; ?></td>
								<td><?php echo $r->nama_pemilik; ?></td>
								<td><?php echo $r->nama_bank; ?></td>
								<td><?php echo $r->nomor_rekening; ?></td>
								<td><?php echo $r->nama_akun_bank; ?></td>
								<td>
									<?php if ($r->verif == 1) { ?>
										<label class="btn btn-success"><i class="fas fa-check"></i>Verified</label>
									<?php }else{ ?>

										<a href="javascript:;"
										data-id="<?php echo $r->id_mitra ?>"
										data-toggle="modal" data-target="#verif-mitra" class="btn btn-danger" data-toggle="modal" data-target="#verif-mitra"><i class="fas fa-exclamation-triangle"></i>Belum diverifikasi</a>
									<?php } ?>
								</td>


							</tr>
						<?php } ?>



					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Ruangan</h5>
				<a href="#" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</a>
			</div>
			<div class="modal-body">
				<form action='<?php echo base_url() ?>Mitra/save_ruang' method="POST" enctype="multipart/form-data">

					<div class="form-group">
						<label for="inputText3" class="col-form-label">Nama Ruangan</label>
						<input id="inputText3" name="nama" type="text" class="form-control" placeholder="Nama Ruangan...">

					</div>

					<div class="form-group">
						<label for="inputText3" class="col-form-label">Kapasitas</label>
						<select class="form-control" name="kapasitas">
							<option value="" disabled selected >Pilih Kapasitas</option>
							<?php foreach ($kapasitas as $kap) { ?>
								<option value="<?php echo $kap->id_kapasitas ?>" ><?php echo $kap->keterangan; ?></option>
							<?php } ?>
						</select>
					</div>



					<div class="form-group">
						<label for="inputText3" class="col-form-label">Foto</label>
						<p>*file yang diterima hanya berekstensi .jpg, .jpeg, .png</p>
						<input type="file" accept="image/jpg, image/jpeg, image/png" name="foto">

					</div>

					<!-- <div class="form-group">
						<label for="inputText3" class="col-form-label">Detail Foto</label>
						<p>*file yang diterima hanya berekstensi .jpg, .jpeg, .png</p>
						<input type="file" accept="image/jpg, image/jpeg, image/png" name="foto">

					</div> -->

					<div class="form-group">
						<label for="inputText3" class="col-form-label">Harga</label>
						<input id="inputText3" name="harga" type="number" class="form-control" placeholder="Harga...">

					</div>

					<div class="modal-footer">
						<a href="#" class="btn btn-secondary" data-dismiss="modal">Batal</a>
						<input type="submit" value="Simpan" class="btn btn-success">
					</div>


				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#DetailRuang').on('show.bs.modal', function (e) {
			var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
            	type : 'post',
            	url : '<?php echo base_url() ?>SuperAdmin/detail',
            	data :  'id_ruang='+ rowid,
            	success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
            }
        });
        });
	});
</script>

<div class="modal fade" id="DetailRuang" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Detail Ruang</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="fetched-data"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
			</div>
		</div>
	</div>
	</div

	<!-- Modal Ubah -->
	<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="verif-mitra" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Verifikasi Mitra</h4>
					<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>

				</div>
				<form class="form-horizontal" action="<?php echo base_url('SuperAdmin/verif_mitra')?>" method="post" enctype="multipart/form-data" role="form">
					<div class="modal-body">
						<div class="form-group">
							<input type="hidden" id="id" name="id">
						</div>

						<p>Yakin Verifikasi ?</p>

					</div>
					<div class="modal-footer">
						<button class="btn btn-success" type="submit"> Verifikasi&nbsp;</button>
						<button type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function() {
        // Untuk sunting
        $('#verif-mitra').on('show.bs.modal', function (event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal          = $(this)

            // Isi nilai pada field
            modal.find('#id').attr("value",div.data('id'));
            
        });
    });
</script>
