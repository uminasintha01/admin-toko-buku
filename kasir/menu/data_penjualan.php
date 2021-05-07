<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<div class="row">
		<div class="col-md-8">
			<h3 >Data Penjualan</h3>

			<?php 

			$qjumlah = mysqli_query($koneksi,"SELECT * FROM tb_jual");
			$Jumlah = mysqli_num_rows($qjumlah);

			 ?>

			<button class="btn btn-sm btn-default">Jumlah Data <span class="badge"><?php echo $Jumlah; ?></span></button>
			<a href="?menu=data_penjualan" class="btn btn-sm btn-success">Refresh</a>	
		</div>
			
			<div class="col-xs-6 col-md-4">
				<div class="input-group">
					<form method="POST">
						<br>
						<br>
					<input name="inputan" type="text" class="form-control" placeholder="Cari Pegawai">
					<span class="input-group-btn">
						<input type="submit" name="cari" class="btn btn-info" value="cari">
					</span>
				</div>
					</form>
			</div>
	</div>

	<br>
	
	<table class="table table-bordered">
		<thead>
			<tr>
			<th >Kode Penjualan</th>
			<th >Kasir</th>
			<th >Total</th>
			<th >Uang Pembeli</th>
			<th >Uang Kembali</th>
			<th >Tanggal</th>
			<th >Opsi</th>
			</tr>
		</thead>

		<tbody>

			<?php 

		$no = 1;
		$inputan = $_POST['inputan'];
		if ($_POST['cari']) {
			if ($inputan=="") {
				$q = mysqli_query($koneksi,"SELECT tb_jual.*,tb_kasir.* FROM tb_jual INNER JOIN tb_kasir ON tb_kasir.id_kasir=tb_jual.id_kasir");
			}
			else if($inputan!=""){
				$q = mysqli_query($koneksi,"SELECT tb_jual.*,tb_kasir.* FROM tb_jual INNER JOIN tb_kasir ON tb_kasir.id_kasir=tb_jual.id_kasir WHERE nama LIKE '%$inputan%'");
			}
		}
		else {

			$q = mysqli_query($koneksi,"SELECT tb_jual.*,tb_kasir.* FROM tb_jual INNER JOIN tb_kasir ON tb_kasir.id_kasir=tb_jual.id_kasir");

		}

		$cek = mysqli_num_rows($q);

		if ($cek < 1) {
			?>
			<tr>
				<td colspan="7">
					<center >
					Data yang anda cari tidak tersedia !
					<a href="" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-refresh"></span></a> 
					</center>
				</td>
			</tr>
			<?php
		}
		else {
		
		while ($data = mysqli_fetch_array($q)) {	

		 ?>

		 <tr>
		 	<td ><?php echo $no++; ?></td>
		 	<td ><?php echo $data['nama']; ?></td>
		 	<td >Rp.<?php echo $data['total']; ?></td>
		 	<td >Rp.<?php echo $data['uang']; ?></td>
		 	<td >Rp.<?php echo $data['kembali']; ?></td>
		 	<td ><?php echo $data['tanggal']; ?></td>
		 	<td>
		 		<a class="btn btn-sm btn-info" href="?menu=detail&id_jual=<?php echo $data['id_jual']; ?>">detail</a>
		 	</td>
		 </tr>

		 <?php } }  ?>

		</tbody>

	</table>
</body>
</html>