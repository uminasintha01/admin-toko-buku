<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
 <?php 
    include '../conn/koneksi.php';
$qr = mysqli_query($koneksi,"SELECT max(right(id_kasir,4)) FROM tb_kasir");
$q = mysqli_fetch_array($qr);
$kd_new = 'KSR-'.str_pad(($q[0] + 1),4,'0',STR_PAD_LEFT);
?>
	<div class="row">
		<br>
		<h3>Tambah Pegawai Kasir</h3>
		<div class="col-md-8">
			
			<form method="POST">
				<div class="form-group">
                        <label>Id Kasir</label>
                        <input name="id_kasir" readonly="readonly" type="text" class="form-control" value="<?php echo $kd_new ?>">
                    </div>
				<div class="form-group">
					<label >Nama</label>
					<input name="nama" type="text" class="form-control" placeholder="Nama Pegawai" required="required">
				</div>
				<div class="form-group">
					<label >Alamat</label>
					<textarea name="alamat" class="form-control" placeholder="Alamat Pegawai" required="required"></textarea>
				</div>	
				<div class="form-group">
					<label >Telepon</label>
					<input name="telepon" type="number" class="form-control" placeholder="Telepon" required="required">
				</div>	
				<div class="form-group">
					<label for="exampleInputEmaill" >Status user</label>
					<select name="status" class="form-control">
						<option  class="form-control">Aktif</option>
						<option  class="form-control">Tidak Aktif</option>
					</select>
				</div>
				<div class="form-group">
					<label >User Untuk Pegawai</label>
					<input name="username" type="text" class="form-control" placeholder="Username" required="required">
				</div>
				<div class="form-group">
					<label >Password</label>
					<input name="password" type="password" class="form-control" placeholder="Password" required="required">
				</div>

					<input name="fsimpan" type="submit" class="btn btn-sm btn-success" value="simpan">
					<a class="btn btn-sm btn-danger" href="?menu=data_pegawai">Kembali</a>
			</form>

			<?php 

			if (isset($_POST['fsimpan'])) {
				$id = $_POST['id_kasir'];
				$nama = $_POST['nama'];
				$alamat = $_POST['alamat'];
				$telepon = $_POST['telepon'];
				$status = $_POST['status'];
				$username = $_POST['username'];
				$password = $_POST['password'];
				$akses = "kasir";

				$q = "INSERT INTO tb_kasir(id_kasir,nama, alamat, telepon, status, username, password, akses)VALUES ('$id','$nama','$alamat','$telepon','$status','$username','$password','$akses')";

				mysqli_query($koneksi,$q);
				?>

				<script type="text/javascript">
					alert('Berhasil menambah pegawai !');
					document.location.href="?menu=data_pegawai"
				</script>

				<?php

			}

			 ?>

		</div>
	</div>
</body>
</html>