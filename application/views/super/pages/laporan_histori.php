<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body onload="window.print()">
	<h1 align="center">Data Transaksi Catering</h1>
	<br>
	<table width="100%" border="1" style="border-collapse: collapse;">
		<thead>
			<tr>

				<th>No</th>
				<th>Nama Paket</th>
				<th>Mitra</th>
				<th>Jumlah</th>
				<th>Total</th>
				<th>Tanggal</th>


			</tr>
		</thead>


		<tbody style="text-align: center">
			<?php if ($pesanan != '') { ?>
				<?php $no=1; foreach ($pesanan as $r) { ?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $r->nama_paket; ?></td>
						<td><?php echo $r->nama_mitra; ?></td>
						<td><?php echo $r->jml_pesan; ?></td>
						<td><?php echo ($r->jml_pesan * $r->harga); ?></td>
						<td><?php echo $r->tgl_transaksi; ?></td>
					</tr>
				<?php } ?>
			<?php }else{ ?>
				<h1>tidak ditemukan</h1>
			<?php } ?>



		</tbody>

		
	</table>
	<h4 style="float: right; margin-right: 50px">
	Admin</h4>

</body>
</html>