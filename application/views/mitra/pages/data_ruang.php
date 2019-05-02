<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Data Ruangan Meeting</h1>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Ruangan  Meeting <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Ruangan</a></h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							
							<th>Nama Tempat</th>
							<th>Kapasitas</th>
							<th>Harga Sewa</th>
							<th>Foto</th>
							<th>Action</th>
						</tr>
					</thead>

					
					<tbody>
						<?php foreach ($ruangan as $r) { ?>
							<tr>
								<td><?php echo $r->nama_ruangan; ?></td>
								<td><?php echo $r->kapasitas; ?></td>
								<td><?php echo $r->harga; ?></td>
								<td><img style="height: 10%" src="<?php echo base_url() ?>foto_ruang/<?php echo $r->foto  ?>"</td>
								<td>
									<a href="#" class="btn btn-danger">Delete</a>
									<a href="#" class="btn btn-warning">Edit</a>
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
				<h5 class="modal-title" id="exampleModalLabel">Tambah Resep</h5>
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