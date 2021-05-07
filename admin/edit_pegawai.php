<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php 

	$id = $_GET['id_pegawai'];
	$query = mysqli_query($koneksi,"SELECT * FROM tb_kasir WHERE id_kasir='$id'");
	$data = mysqli_fetch_array($query);

	 ?>

	<div class="row">
		<h3 style="color: white;">Edit Pegawai Kasir</h3>
		<div class="col-md-8">
			
			<form method="POST">
				<div class="form-group">
					<label >Nama</label>
					<input name="nama" type="text" class="form-control" value="<?php echo $data['nama']; ?>">
				</div>
				<div class="form-group">
					<label >Alamat</label>
					<textarea name="alamat" class="form-control"><?php echo $data['alamat']; ?></textarea>
				</div>	
				<div class="form-group">
					<label >Telepon</label>
					<input name="telepon" type="number" class="form-control" value="<?php echo $data['telepon']; ?>">
				</div>	
				<div class="form-group">
					<label for="exampleInputEmaill">Status user</label>
					<select name="status" class="form-control">
						<option <?php if($data['status']=="aktif"){ echo "selected";} ?> class="form-control">Aktif</option>
						<option <?php if($data['status']=="nonaktif"){ echo "selected";} ?> class="form-control">Tidak Aktif</option>
					</select>
				</div>

					<input name="fsimpan" type="submit" class="btn btn-sm btn-success" value="simpan">
					<a class="btn btn-sm btn-danger" href="?menu=data_pegawai">Kembali</a>
			</form>

			<?php 

			if (isset($_POST['fsimpan'])) {
				$nama = $_POST['nama'];
				$alamat = $_POST['alamat'];
				$telepon = $_POST['telepon'];
				$status = $_POST['status'];

				$q = "UPDATE tb_kasir SET nama='$nama', alamat='$alamat', telepon='$telepon', status='$status' WHERE id_kasir='$id'";

				mysqli_query($koneksi,$q);
				?>

				<script type="text/javascript">
					alert('Berhasil merubah data pegawai !');
					document.location.href="?menu=data_pegawai"
				</script>

				<?php

			}

			 ?>

		</div>
	</div>
</body>
</html>