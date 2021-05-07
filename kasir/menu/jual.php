<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php 

		$id = $_GET['id_buku'];
		$qbuku = mysqli_query($koneksi,"SELECT * FROM tb_buku WHERE id_buku='$id'");
		$data = mysqli_fetch_array($qbuku);

	 ?>

	 <h1 >Penjualan</h1>
	 	<div class="col-md-5">
	 		<form action="" class="form-horizontal" method="POST">
	 			<label >Buku</label>
	 			<input class="form-control" type="text" value="<?php echo $data['judul']; ?>" readonly>
	 			<label >Stok</label>
	 			<input class="form-control" type="text" value="<?php echo $data['stok']; ?>" readonly>
	 			<label >Harga Pokok</label>
	 			<input class="form-control" type="text" value="<?php echo $data['harga_pokok']; ?>" readonly>
	 			<label >Jumlah</label>
	 			<input class="form-control" type="number" name="jumlah" placeholder="Jumlah Penjualan">
	 			<label >Uang Pelanggan</label>
	 			<input class="form-control" type="text" name="uang" placeholder="Uang Pelanggan">
	 			
	 			<br>
	 			<input class="btn btn-block btn-success" type="submit" name="proses" value="Proses">
	 			<a href="?menu=input_penjualan" class="btn btn-block btn-danger">Cancel</a>
	 		</form>

	 		<?php 

	 			if (isset($_POST['proses'])) {
	 				$id_kasir = $profil['id_kasir'];
	 				$jumlah = $_POST['jumlah'];
	 				$uang = $_POST['uang'];
	 				$tanggal = date('d-m-y');
	 				$total = $jumlah * $data['harga_pokok'];
	 				$kembali = $uang - $total;
	 					$stokupdate = $data['stok'] - $jumlah;
	 				mysqli_query($koneksi,"INSERT INTO tb_penjualan(id_buku, id_kasir, jumlah, total, tanggal)VALUES('$id','$id_kasir','$jumlah','$total','$tanggal')");

	 				mysqli_query($koneksi,"UPDATE tb_buku SET stok='$stokupdate' WHERE id_buku='$id'");
	 			
	 		 ?>
	 	</div>
	 		<div class="col-md-5">
	 			<tr>
	 				<td >Total Bayar	: <h2 ><?php echo $total; ?></h2></td>
	 			</tr>
	 			<tr>
	 				<td >Uang Bayar	: <h2 ><?php echo $uang; ?></h2></td>
	 			</tr>
	 			<tr>
	 				<td >Kembalian	: <h2 ><?php echo $kembali; ?></h2></td>
	 			</tr>
	 			<a class="btn btn-success" href="?menu=input_penjualan">SELESAI</a>
	 			<a class="btn btn-primary" href=""><span class="glyphicon glyphicon-print"></span></a>
	 		</div>
	 	<?php } ?>

</body>
</html>