<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<div class="row">
		<br>
		<h3 >Tambah Buku</h3>

		<div class="col-md-6">
			    <?php 
$qr = mysqli_query($koneksi,"SELECT max(right(id_buku,4)) FROM tb_buku");
$q = mysqli_fetch_array($qr);
$kd_new = 'IB-'.str_pad(($q[0] + 1),4,'0',STR_PAD_LEFT);

?>
			<form method="POST">
				<div class="form-group">
                        <label>Id Buku</label>
                        <input name="id_buku" readonly="readonly" type="text" class="form-control" value="<?php echo $kd_new ; ?>">
                    </div>
				<div class="form-group">
					<label >Judul</label>
					<input name="judul" type="text" class="form-control" placeholder="Judul Buku" required="required">
				</div>
				<div class="form-group">
					<label >NOISBN</label>
					<input type="number" name="noisbn" class="form-control" placeholder="NOISBN" required="required">
				</div>	
				<div class="form-group">
					<label >Penulis</label>
					<input name="penulis" type="text" class="form-control" placeholder="Penulis" required="required">
				</div>	
				<div class="form-group">
					<label >Penerbit</label>
					<input name="penerbit" type="text" class="form-control" placeholder="Penerbit" required="required">
				</div>
				<div class="form-group">
					<label >Tahun</label>
					<input name="tahun" type="number" class="form-control" placeholder="Tahun" required="required">
				</div>

		</div>

		<div class="col-md-6">
				<div class="form-group">
					<label >Stok</label>
					<input name="stok" type="text" class="form-control" placeholder="Stok" required="required">
				</div>
				<div class="form-group">
					<label >Harga Pokok</label>
					<input type="number" name="hargapokok" class="form-control" placeholder="Harga Pokok" required="required" >
				</div>	
				<div class="form-group">
					<label >Harga Jual</label>
					<input name="hargajual" type="number" class="form-control" placeholder="Harga Jual" required="required">
				</div>	
				<div class="form-group">
					<label >PPN(%)</label>
					<input name="ppn" type="text" class="form-control" value="10" required="required" readonly>
				</div>
				<div class="form-group">
					<label >Diskon</label>
					<input name="diskon" type="number" class="form-control" placeholder="Diskon" required="required">
				</div>

					<input name="fsimpan" type="submit" class="btn btn-sm btn-success" value="simpan">
					<a class="btn btn-sm btn-danger" href="?menu=data_buku">Kembali</a>
			</form>

			<?php 

			if (isset($_POST['fsimpan'])) {
				$id = $_POST['id_buku'];
				$judul = $_POST['judul'];
				$noisbn = $_POST['noisbn'];
				$penulis = $_POST['penulis'];
				$penerbit = $_POST['penerbit'];
				$tahun = $_POST['tahun'];
				$stok = $_POST['stok'];
				$hargajual = $_POST['hargajual'];
				$ppn = $_POST['ppn'];

				$diskon = $_POST['diskon'];
				$harga_pokok = $_POST['hargapokok'];

				$q = "INSERT INTO tb_buku(id_buku, judul, noisbn, penulis, penerbit, tahun, stok, harga_pokok, harga_jual, ppn, diskon)VALUES ('$id','$judul','$noisbn','$penulis','$penerbit','$tahun','$stok','$harga_pokok','$hargajual','$ppn','$diskon')";

				mysqli_query($koneksi,$q);
				?>

				<script type="text/javascript">
					alert('Berhasil menambah Buku !');
					document.location.href="?menu=data_buku"
				</script>

				<?php

			}

			 ?>

		</div>

	</div>
</body>
</html>