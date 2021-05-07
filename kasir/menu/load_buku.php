<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="background-image: url(../img/1.jpg);">
	<h1 >Input Penjualan</h1>
	<h2 >Pilih Buku</h2>

		<div class="col-md-6">

			<form action="" class="form-inline" method="POST">
				<input type="text" name="carian" placeholder="Cari buku"> <input class="btn btn-sm btn-danger" type="submit" name="cari" value="cari">
				<a class="btn btn-sm btn-success" href="?menu=load_buku">Refresh</a>
				<br>
			</form>


			<br>

			<table class="table table-bordered">
				<thead>
					<tr>
						<td>Judul Buku</td>
						<td>Stock</td>
						<td>Aksi</td>
					</tr>
				</thead>
				<?php 
					$inputan = $_POST['carian'];
					if (isset($_POST['cari'])) {
						if ($inputan=="") {
							$buku = mysqli_query($koneksi,"SELECT * FROM tb_buku");							
						}
						else if($inputan != ""){
							$buku = mysqli_query($koneksi,"SELECT * FROM tb_buku WHERE judul LIKE '%$inputan%'");
						}
					}
					else {
						$buku = mysqli_query($koneksi,"SELECT * FROM tb_buku");		
					}

				$cek = mysqli_num_rows($buku);
					if ($cek < 1) {
						?>
						<tr>
							<td >Tidak ada data <a class="btn btn-sm btn-success" href="?menu=load_buku">Refresh</a></td>
						</tr>
						<?php
					}
					else {
				while ($data = mysqli_fetch_array($buku)) {

				 ?>
				 <tr>
				 	<td ><?php echo $data['judul'] ;?></td>
				 	<td ><?php echo $data['stok'] ;?></td>
				 	<td><a class="btn btn-sm btn-block btn-primary" href="?menu=input_penjualan&id_buku=<?php echo $data['id_buku']; ?>">Pilih</a></td>
				 </tr>
				 <?php } } ?>
			</table>
		</div>
</body>
</html>