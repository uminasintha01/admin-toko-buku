<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<div class="row">
		<div class="col-md-8">
			<br>
			<h3 >Data Buku</h3>

			<?php 

			$qjumlah = mysqli_query($koneksi,"SELECT * FROM tb_buku WHERE");
			$Jumlah = mysqli_num_rows($qjumlah);

			 ?>

			<a class="btn btn-sm btn-success" href="?menu=tambah_buku">Tambah Buku</a>
			<button class="btn btn-sm btn-default">Jumlah Data <span class="badge"><?php echo $Jumlah; ?></span></button>
			<a href="?menu=data_buku" class="btn btn-sm btn-danger">Refresh</a>	
		</div>
			
			<div class="col-xs-6 col-md-4">
				<div class="input-group">
					<br>
					<br>
					<form method="POST">
					<input name="inputan" type="text" class="form-control" placeholder="Cari Buku">
					<span class="input-group-btn">
						<input type="submit" name="cari" class="btn btn-info" value="cari">
					</span>
					</form>
				</div>
					
			</div>
	</div>

	<br>
	
	 <div class="panel panel-green">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		<thead>
			<tr class="success">
			<th >Kode Buku</th>
			<th >Judul</th>
			<th >NOISBN</th>
			<th >Penulis</th>
			<th >Penerbit</th>
			<th >Tahun</th>
			<th >Stok</th>
			<th >Harga Pokok</th>
			<th >Harga Jual</th>
			<th >PPN</th>
			<th >Diskon</th>
			<th >Pilihan</th>
			</tr>
		</thead>

		<tbody>

			<?php 

			
		$no = 1;
		$inputan = $_POST['inputan'];
		if ($_POST['cari']) {
			if ($inputan=="") {
				$q = mysqli_query($koneksi,"SELECT * FROM tb_buku");
			}
			else if($inputan!=""){
				$q = mysqli_query($koneksi,"SELECT * FROM tb_buku WHERE judul AND penerbit LIKE '%$inputan%'");
			}
		}
		else {

			$q = mysqli_query($koneksi,"SELECT * FROM tb_buku");

		}

		$cek = mysqli_num_rows($q);

		if ($cek < 1) {
			?>
			<tr>
				<td colspan="12">
					<center style="color: white;">
					Buku yang anda cari tidak tersedia !
					<a href="" class="btn btn-sm btn-white"><span class="glyphicon glyphicon-refresh"></span></a> 
					</center>
				</td>
			</tr>
			<?php
		}
		else {
		
		while ($data = mysqli_fetch_array($q)) {	

		 ?>

		 <tr>
		 	<td ><?php echo $data['id_buku']; ?></td>
		 	<td ><?php echo $data['judul']; ?></td>
		 	<td ><?php echo $data['noisbn']; ?></td>
		 	<td ><?php echo $data['penulis']; ?></td>
		 	<td ><?php echo $data['penerbit']; ?></td>
		 	<td ><?php echo $data['tahun']; ?></td>
		 	<td ><?php echo $data['stok']; ?></td>
		 	<td >Rp.<?php echo $data['harga_pokok']; ?></td>
		 	<td>Rp.<?php echo $data['harga_jual']; ?></td>
		 	<td ><?php echo $data['ppn']; ?>%</td>
		 	<td >Rp.<?php echo $data['diskon']; ?></td>
		 	
		 	<td>
		 		<center>
		 		<a  title="edit" href="?menu=edit_buku&id_buku=<?php echo $data['id_buku']; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
		 		|
		 		<a  onclick="return confirm('Anda yakin ingin mengahapusnya ?')" title="Hapus" href="?menu=hapus_buku&id_buku=<?php echo $data['id_buku']; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
		 		<br>
		 		<a class="btn btn-xs btn-white" title="pasok" href="?menu=input_pemasukan&id_buku=<?php echo $data['id_buku']; ?>">Pasok</a>
		 		</center>
		 	</td>
		 </tr>

		 <?php } }  ?>

		</tbody>

	</table>

</body>
</html>
