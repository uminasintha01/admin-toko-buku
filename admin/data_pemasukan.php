<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<div class="row">
		<div class="col-md-8">
			<br>
			<h3 >Riwayat Pemasukan Buku</h3>

			<?php 

			$qjumlah = mysqli_query($koneksi,"SELECT * FROM tb_pasok");
			$Jumlah = mysqli_num_rows($qjumlah);

			 ?>

			<button class="btn btn-sm btn-default">Jumlah Data <span class="badge"><?php echo $Jumlah; ?></span></button>
			<a href="?menu=data_pemasukan" class="btn btn-sm btn-danger">Refresh</a>	
		</div>
			
			<div class="col-xs-6 col-md-4">
				<div class="input-group">
					<br>
					<br>
					<form method="POST">
					<input name="inputan" type="text" class="form-control" placeholder="Cari Pemasukan">
					<span class="input-group-btn">
						<input type="submit" name="cari" class="btn btn-info" value="cari">
					</span>
				</form>
				</div>
					
			</div>
	</div>

	<br>
	
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		<thead>
			<tr>
			<th >Kode Pemasukkan</th>
			<th >Nama Distributor</th>
			<th >Judul Buku</th>
			<th >Jumlah</th>
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
				$q = mysqli_query($koneksi,"SELECT tb_buku.*,tb_distributor.*,tb_pasok.* FROM tb_pasok INNER JOIN tb_distributor ON tb_distributor.id_distributor=tb_pasok.id_distributor INNER JOIN tb_buku ON tb_buku.id_buku=tb_pasok.id_buku");
			}
			else if($inputan!=""){
				$q = mysqli_query($koneksi,"SELECT tb_buku.*,tb_distributor.*,tb_pasok.* FROM tb_pasok INNER JOIN tb_distributor ON tb_distributor.id_distributor=tb_pasok.id_distributor INNER JOIN tb_buku ON tb_buku.id_buku=tb_pasok.id_buku WHERE nama_distributor LIKE '%$inputan%' OR judul LIKE '%$inputan'");
			}
		}
		else {

			$q = mysqli_query($koneksi,"SELECT tb_buku.*,tb_distributor.*,tb_pasok.* FROM tb_pasok INNER JOIN tb_distributor ON tb_distributor.id_distributor=tb_pasok.id_distributor INNER JOIN tb_buku ON tb_buku.id_buku=tb_pasok.id_buku");

		}

		$cek = mysqli_num_rows($q);

		if ($cek < 1) {
			?>
			<tr>
				<td colspan="7">
					<center style="color: white;">
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
		 	<td ><?php echo $data['id_pasok']; ?></td>
		 	<td ><?php echo $data['nama_distributor']; ?></td>
		 	<td ><?php echo $data['judul']; ?></td>
		 	<td ><?php echo $data['jumlah']; ?></td>
		 	<td ><?php echo $data['tanggal']; ?></td>
		 	<td>
		 		<a  onclick="return confirm('Anda yakin ingin mengahapusnya ?')" title="Hapus" href="?menu=hapus_pasok&id_pasok=<?php echo $data['id_pasok']; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
		 	</td>
		 </tr>

		 <?php } }  ?>

		</tbody>

	</table>
</body>
</html>