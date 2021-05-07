<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php 

	$id = $_GET['id_distributor'];
	$query = mysqli_query($koneksi,"SELECT * FROM tb_distributor WHERE id_distributor='$id'");
	$data = mysqli_fetch_array($query);

	 ?>

	<div class="row">
		<br>
		<h3>Edit Data Distributor</h3>
		<div class="col-md-8">
			
			<form method="POST">
				<div class="form-group">
					<label>Nama</label>
					<input name="nama" type="text" class="form-control" value="<?php echo $data['nama_distributor']; ?>">
				</div>
				<div class="form-group">
					<label >Alamat</label>
					<textarea name="alamat" class="form-control"><?php echo $data['alamat']; ?></textarea>
				</div>	
				<div class="form-group">
					<label >Telepon</label>
					<input name="telepon" type="number" class="form-control" value="<?php echo $data['telepon']; ?>">
				</div>	

					<input name="fsimpan" type="submit" class="btn btn-sm btn-success" value="simpan">
					<a class="btn btn-sm btn-danger" href="?menu=data_distributor">Kembali</a>
			</form>

			<?php 

			if (isset($_POST['fsimpan'])) {
				$nama = $_POST['nama'];
				$alamat = $_POST['alamat'];
				$telepon = $_POST['telepon'];
				
				$q = "UPDATE tb_distributor SET nama_distributor='$nama', alamat='$alamat', telepon='$telepon' WHERE id_distributor='$id'";

				mysqli_query($koneksi,$q);
				?>

				<script type="text/javascript">
					alert('Berhasil merubah data Distributor !');
					document.location.href="?menu=data_distributor"
				</script>

				<?php

			}

			 ?>

		</div>
	</div>
</body>
</html>