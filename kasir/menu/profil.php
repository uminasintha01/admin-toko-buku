<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<h3 >Profil Anda</h3>

		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3>Informasi tentang anda</h3>
					</div>
					<div class="panel-body">
						<table class="table" cellpadding="8">
							<tr>
								<th>Nama</th> <td>:</td> <td><?php echo $profil['nama']; ?></td>
							</tr>
							<tr>
								<th>Alamat</th> <td>:</td> <td><?php echo $profil['alamat']; ?></td>
							</tr>
							<tr>
								<th>Telepon</th> <td>:</td> <td><?php echo $profil['telepon']; ?></td>
							</tr>
						</table>

						<a class="btn btn-sm btn-primary" href="?menu=edit_profil">Edit Data saya</a>

					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3>Edit username atau password</h3>
					</div>
					<div class="panel-body">
						<fieldset>
							<legend>Edit Username</legend>
								<form class="form" method="POST">
									<div class="input-group">
										<span class="input-group-addon" id="basic-addon1">User saat ini</span>
										<input type="text" class="form-control" value="<?php echo $profil['username']; ?>" readonly aria-describedby="basic-addon1">
									</div>
									<br>
									<div class="input-group">
										<span class="input-group-addon" id="basic-addon1">User Baru</span>
										<input type="text" name="userbaru" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
									</div>
									<br>
									<div class="input-group">
										<span class="input-group-addon" id="basic-addon1">Password Anda</span>
										<input type="password" name="pass" class="form-control" placeholder="Password anda" aria-describedby="basic-addon1">
									</div>
									<br>

									<input type="submit" name="edit_user" value="simpan" class="btn btn-sm btn-success">

								</form>

								<?php 

								if (isset($_POST['edit_user'])) {
									$userbaru = $_POST['userbaru'];
									$pass = $_POST['pass'];

									if (md5($pass)==$profil['password']) {
										mysqli_query($koneksi,"UPDATE tb_kasir SET username='$userbaru' WHERE id_kasir='$profil[id_kasir]'");
										?>
										<script type="text/javascript">
											alert('Username anda berhasil diubah ! Silahkan Login kembali !');
											document.location.href="../conn/keluar.php";
										</script>
										<?php
									}
									else {
										echo "Password anda salah";
									}
								}

								 ?>

						</fieldset>

						<br>
						<fieldset>
							<legend>Edit Password</legend>
								<form class="form" method="POST">
									<div class="input-group">
										<span class="input-group-addon" id="basic-addon1">Password baru</span>
										<input type="password" name="pass1" class="form-control" placeholder="Password baru" aria-describedby="basic-addon1">
									</div>
									<br>
									<div class="input-group">
										<span class="input-group-addon" id="basic-addon1">Ketik Ulang Password Baru</span>
										<input type="password" name="pass2" class="form-control" placeholder="Ketikkan Ulang" aria-describedby="basic-addon1">
									</div>
									<br>
									<div class="input-group">
										<span class="input-group-addon" id="basic-addon1">Password Anda Saat Ini</span>
										<input type="password" name="pass_awal" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
									</div>
									<br>
									
									<input type="submit" name="edit_password" value="simpan" class="btn btn-sm btn-success">

								</form>

								<?php 

								if (isset($_POST['edit_password'])) {
									$pass1 = md5($_POST['pass1']);
									$pass2 = md5($_POST['pass2']);
									$pass = $_POST['pass_awal'];

									if ($pass1 != $pass2) {
										echo "Password konfirmasi salah !";
									}
									else {
										if (md5($pass)==$profil['password']) {
											mysqli_query($koneksi,"UPDATE tb_kasir SET password='$pass1' WHERE id_kasir='$profil[id_kasir]'");
											?>

											<script type="text/javascript">
												alert('Password anda berhasil dirubah ! Silahkan Login Kembali');
												document.location.href="../conn/keluar.php";
											</script>

											<?php 
										}
										else {
											echo "Password anda salah !";
										}
									}
								}

								 ?>

						</fieldset>

					</div>
				</div>
			</div>
		</div>
</body>
</html>