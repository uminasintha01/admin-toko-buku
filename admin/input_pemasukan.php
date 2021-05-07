<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php 

	if ($_GET['id_buku']=="") {
		header('location:?menu=data_buku');
	}

	$id_buku = $_GET['id_buku'];
	$qbuku = mysqli_query($koneksi,"SELECT * FROM tb_buku WHERE id_buku='$id_buku'");
	$dbuku = mysqli_fetch_array($qbuku);

$qr = mysqli_query($koneksi,"SELECT max(right(id_pasok,4)) FROM tb_pasok");
$qq = mysqli_fetch_array($qr);
$kd_new = 'IP-'.str_pad(($qq[0] + 1),4,'0',STR_PAD_LEFT);
	 ?>

	<div class="row">
		<br>
		<h3 >Input Pemasukan Buku</h3>
		<div class="col-md-8">
			
			<form method="POST">
				<div class="form-group">
                        <label>Id Pasok</label>
                        <input name="id_pasok" readonly="readonly" type="text" class="form-control" value="<?php echo $kd_new ?>">
                    </div>
				<div class="form-group">
					<label >Buku</label>
					<input name="buku" type="text" class="form-control" value="<?php echo $dbuku['judul'] ?>" required="required">
				</div>
				<div class="form-group">
					<label >Pilih Distributor</label>
					<select name="id_distributor" class="form-control">

						<?php

						$qdis = mysqli_query($koneksi,"SELECT * FROM tb_distributor");
						while ($ddis = mysqli_fetch_array($qdis)) {

						 ?>

						<option value="<?php echo $ddis['id_distributor']; ?>">
							<?php echo $ddis['nama_distributor']; ?>
						</option>

						<?php } ?>

					</select>
				</div>	
				<div class="form-group">
					<label >Stok Awal Buku</label>
					<input name="telepon" type="number" class="form-control" value="<?php echo $dbuku['stok']; ?>" required="required" readonly>
				</div>	

				<div class="form-group">
					<label for="exampleInputEmaill" >Jumlah</label>
					<input type="number" name="jumlah" class="form-control" placeholder="Jumlah Pemasukan" required="required">
				</div>
				
				<div class="form-group">
					<label >Tanggal</label>
					<input name="tanggal" type="text" class="form-control" value="<?php echo date('d-m-y'); ?>" required="required" readonly>
				</div>

					<input name="fsimpan" type="submit" class="btn btn-sm btn-success" value="simpan">
					<a class="btn btn-sm btn-danger" href="?menu=data_pegawai">Kembali</a>
			</form>

			<?php 

			if (isset($_POST['fsimpan'])) {
				$id_pasok = $_POST['id_pasok'];
				$id_distributor = $_POST['id_distributor'];
				$jumlah = $_POST['jumlah'];
				$tanggal = $_POST['tanggal'];
				$stokupdate = $jumlah + $dbuku['stok'];

				$q = "INSERT INTO tb_pasok(id_pasok,id_distributor, id_buku, jumlah, tanggal)VALUES ('$id_pasok','$id_distributor','$id_buku','$jumlah','$tanggal')";

				mysqli_query($koneksi,$q);
				mysqli_query($koneksi,"UPDATE tb_buku SET stok='$stokupdate' WHERE id_buku='$id_buku'");
				?>

				<script type="text/javascript">
					alert('Berhasil menambah Pemasukan Buku !');
					document.location.href="?menu=data_buku"
				</script>

				<?php

			}

			 ?>

		</div>
	</div>
</body>

</html>