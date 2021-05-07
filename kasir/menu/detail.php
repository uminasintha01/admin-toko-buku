<?php 

	$id_jual = $_GET['id_jual'];
	$q = mysqli_query($koneksi,"SELECT tb_jual.*,tb_kasir.* FROM tb_jual INNER JOIN tb_kasir ON tb_kasir.id_kasir=tb_jual.id_kasir WHERE id_jual='$id_jual'");
	$d = mysqli_fetch_array($q);

 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<br>
	<h4 >Detail Penjualan</h4>
	<hr>
		
		<div class="row">
		<div class="col-md-4">
			<table class="table table-condensed">
				<tr>
					<th >Kode Penjualan</th><td ><?php echo $d['id_jual']; ?></td>
				</tr>
				<tr>
					<th >Kasir</th><td ><?php echo $d['nama']; ?></td>
				</tr>
				<tr>
					<th >Tanggal </th><td ><?php echo $d['tanggal']; ?></td>
				</tr>
			</table>
		</div>

		<div class="col-md-4">
			<table class="table table-condensed">
				<tr>
					<th >Total Harga</th><td ><?php echo number_format($d['total'],2); ?></td>
				</tr>
				<tr>
					<th >Uang Pembeli</th><td ><?php echo number_format($d['uang'],2); ?></td>
				</tr>
				<tr>
					<th >Uang Kembali </th><td ><?php echo number_format($d['kembali'],2); ?></td>
				</tr>
			</table>
		</div>
		</div>

		<div class="row">
			<table class="table table-bordered">
		<tr>
			<th >No.</th>
			<th >Buku</th>
			<th >PPN</th>
			<th >Diskon</th>
			<th >Harga</th>
			<th >Jumlah</th>
			<th >Jumlah Harga</th>
		</tr>

		<?php 

			$no = 1;
			$qbuku = mysqli_query($koneksi,"SELECT tb_penjualan.*,tb_buku.* FROM tb_penjualan INNER JOIN tb_buku ON tb_buku.id_buku=tb_penjualan.id_buku WHERE id_jual='$id_jual'");
			while ($data  = mysqli_fetch_array($qbuku)) {

		 ?>

		<tr>
			<td ><?php echo $no++; ?></td>
			<td ><?php echo $data['judul']; ?></td>
			<td >Rp.<?php echo $data['ppn']; ?></td>
			<td >Rp.<?php echo $data['diskon']; ?></td>
			<td >Rp.<?php echo $data['harga_pokok']; ?></td>
			<td ><?php echo $data['jumlah']; ?></td>
			<td >Rp.<?php echo $data['jumlah_harga']; ?></td>
			
		</tr>

		<?php } ?>

		<tr>
			<th class="text-right" colspan="6" >Total Harga</th>
			<td >
				Rp.<?php echo number_format($d['total'],2); ?>
			</td>
		</tr>
	</table>

				<a href="?menu=data_penjualan" class="btn btn-success">Kembali</a>
				<a target="blank" href="../kasir/print.php?&id_jual=<?php echo $id_jual; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-print"></span></a>

		</div>

</body>
</html>