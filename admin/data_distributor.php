<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<div class="row">
		<div class="col-md-8">
			<br>
			<h3 >Data Distributor</h3>


			<?php 

			$qjumlah = mysqli_query($koneksi,"SELECT * FROM tb_distributor");
			$Jumlah = mysqli_num_rows($qjumlah);

			 ?>

			<a class="btn btn-sm btn-success" href="?menu=tambah_distributor">Tambah Data</a>
			<button class="btn btn-sm btn-default">Jumlah Data <span class="badge"><?php echo $Jumlah; ?></span></button>	
			<a href="?menu=data_distributor" class="btn btn-sm btn-danger">Refresh</a>
		</div>
			
			<div class="col-xs-6 col-md-4">
				<div class="input-group">
					<br>
					<br>
					<form method="POST">
					<input name="inputan" type="text" class="form-control" placeholder="Cari Distributor">
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
			<th >Kode Distributor</th>
			<th >Nama</th>
			<th >Alamat</th>
			<th >Telepon</th>
			<th >Opsi</th>
			</tr>
		</thead>

		<tbody>

			<?php 

		$no = 1;
		$inputan = $_POST['inputan'];
		if ($_POST['cari']) {
			if ($inputan=="") {
				$q = mysqli_query($koneksi,"SELECT * FROM tb_distributor");
			}
			else if($inputan!=""){
				$q = mysqli_query($koneksi,"SELECT * FROM tb_distributor WHERE nama_distributor LIKE '%$inputan%'");
			}
		}
		else {

			$q = mysqli_query($koneksi,"SELECT * FROM tb_distributor");

		}

		$cek = mysqli_num_rows($q);

		if ($cek < 1) {
			?>
			<tr>
				<td colspan="7">
					<center style="color: white;">
					Data tidak tersedia !
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
		 	<td ><?php echo $data['id_distributor']; ?></td>
		 	<td ><?php echo $data['nama_distributor']; ?></td>
		 	<td ><?php echo $data['alamat']; ?></td>
		 	<td ><?php echo $data['telepon']; ?></td>
		 	<td>
		 		<a  title="edit" href="?menu=edit_distributor&id_distributor=<?php echo $data['id_distributor']; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
		 		|
		 		<a  onclick="return confirm('Anda yakin ingin mengahapusnya ?')" title="Hapus" href="?menu=hapus_distributor&id_distributor=<?php echo $data['id_distributor']; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
		 	</td>
		 </tr>

		 <?php } }  ?>

		</tbody>

	</table>
</body>
</html>
