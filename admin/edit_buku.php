<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php 

	$idbuku = $_GET['id_buku'];
	$qbuku = mysqli_query($koneksi,"SELECT * FROM tb_buku WHERE id_buku='$idbuku'");
	$data = mysqli_fetch_array($qbuku);

	 ?>

	<div class="row">
		<br>
		<h3 >Ubah Data Buku</h3>

		<div class="col-md-6">
			
			<form method="POST">
				<div class="form-group">
					<label >Judul</label>
					<input name="judul" type="text" class="form-control" value="<?php echo $data['judul']; ?>" required="required">
				</div>
				<div class="form-group">
					<label >NOISBN</label>
					<input type="number" name="noisbn" class="form-control" value="<?php echo $data['noisbn']; ?>" required="required">
				</div>	
				<div class="form-group">
					<label >Penulis</label>
					<input name="penulis" type="text" class="form-control" value="<?php echo $data['penulis']; ?>" required="required">
				</div>	
				<div class="form-group">
					<label >Penerbit</label>
					<input name="penerbit" type="text" class="form-control" value="<?php echo $data['penerbit']; ?>" required="required">
				</div>
				<div class="form-group">
					<label >Tahun</label>
					<input name="tahun" type="number" class="form-control" value="<?php echo $data['tahun']; ?>" required="required">
				</div>

		</div>

		<div class="col-md-6">
			
			
				<div class="form-group">
					<label >Stok</label>
					<input name="stok" type="text" class="form-control" value="<?php echo $data['stok']; ?>" required="required" readonly>
				</div>
				<div class="form-group">
					<label >Harga Pokok</label>
					<input type="number" name="hargapokok" class="form-control" value="<?php echo $data['harga_pokok']; ?>" required="required" readonly>
				</div>	
				<div class="form-group">
					<label >Harga Jual</label>
					<input name="hargajual" type="number" class="form-control" value="<?php echo $data['harga_jual']; ?>" required="required">
				</div>	
				<div class="form-group">
					<label >PPN</label>
					<input name="ppn" type="text" class="form-control" value="<?php echo $data['ppn']; ?>" required="required" readonly>
				</div>
				<div class="form-group">
					<label >Diskon</label>
					<input name="diskon" type="number" class="form-control" value="<?php echo $data['diskon']; ?>" required="required">
				</div>

					<input name="fsimpan" type="submit" class="btn btn-sm btn-success" value="simpan">
					<a class="btn btn-sm btn-danger" href="?menu=data_buku">Kembali</a>
			</form>

			<?php 

			if (isset($_POST['fsimpan'])) {
				$judul = $_POST['judul'];
				$noisbn = $_POST['noisbn'];
				$penulis = $_POST['penulis'];
				$penerbit = $_POST['penerbit'];
				$tahun = $_POST['tahun'];
				$stok = $_POST['stok'];
				$hargajual = $_POST['hargajual'];
				$jml_ppn = 0.1;
				$ppn = $hargajual * $jml_ppn;

				$diskon = $_POST['diskon'];
				$harga_pokok = $hargajual + $ppn - $diskon;

				$q = "UPDATE tb_buku SET judul='$judul', noisbn='$noisbn', penulis='$penulis', penerbit='$penerbit', tahun='$tahun', stok='$stok', harga_pokok='$harga_pokok', harga_jual='$hargajual', ppn='$ppn', diskon='$diskon' WHERE id_buku='$idbuku'";

				mysqli_query($koneksi,$q);
				?>

				<script type="text/javascript">
					alert('Berhasil merubah data Buku !');
					document.location.href="?menu=data_buku"
				</script>

				<?php

			}

			 ?>

		</div>

	</div>
</body>
</html>