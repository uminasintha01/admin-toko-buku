<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<div class="row">
		<h3 >Ubah Informasi Profil</h3>

		<div class="col-md-8">

			<form method="POST">
				<div class="form-group">
					<label >Nama </label>
					<input type="text" name="nama" class="form-control" value="<?php echo $profil['nama']; ?>">
				</div>
				<div class="form-group">
					<label >Alamat </label>
					<textarea class="form-control" name="alamat"><?php echo $profil['alamat']; ?></textarea>
				</div>
				<div class="form-group">
					<label >Telepon </label>
					<input type="text" name="telepon" class="form-control" value="<?php echo $profil['telepon']; ?>">
				</div>

				<input type="submit" name="edit_profil" class="btn btn-sm btn-success" value="simpan">

				<a class="btn btn-sm btn-danger" href="?menu=profil">Cancel</a>

				<?php 

				if (isset($_POST['edit_profil'])) {
					$nama =$_POST['nama'];
					$alamat = $_POST['alamat'];
					$telepon = $_POST['telepon'];
					mysqli_query($koneksi,"UPDATE tb_kasir SET nama='$nama', alamat='$alamat', telepon='$telepon' WHERE id_kasir='$profil[id_kasir]'");
					?>

					<script type="text/javascript">
						alert('Berhasil Update');
						document.location.href="?menu=profil";
					</script>

					<?php

				}

				 ?>

			</form>

		</div>
	</div>

</body>
</html>