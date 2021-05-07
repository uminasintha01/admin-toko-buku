<?php 

	$id_buku = $_GET['id_buku'];
	$qbuku = mysqli_query($koneksi,"select * from tb_buku where id_buku='$id_buku'");
	$buku = mysqli_fetch_array($qbuku);

	//kode otomatis
	$qkode = mysqli_query($koneksi,"select max(id_jual) from tb_jual");
	$kode = mysqli_fetch_array($qkode);
	if ($kode) {
		$nilai = $kode[0];
		$nilai = substr($nilai, 3);
		$nilai =(int)$nilai;
		$kodebaru = $nilai + 1;
		$kode_otomatis = "PJN".str_pad($kodebaru,4,"0",STR_PAD_LEFT);
	}
	else {
		$kode_otomatis = "PJN0001";
	}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
 <?php 
    include '../conn/koneksi.php';
$qr = mysqli_query($koneksi,"SELECT max(right(id_keranjang,4)) FROM tb_keranjang");
$q = mysqli_fetch_array($qr);
$kd_new = 'KRJ-'.str_pad(($q[0] + 1),4,'0',STR_PAD_LEFT);
?>
<br> <br>
	<h4 >Input Penjualan</h4>
	<p >Kode Penjualan = <?php echo $kode_otomatis; ?></p>
	
		<form action="" class="form-inline" method="POST">
			<a href="?menu=load_buku" class="btn btn-info">Load Buku</a>		
			<input type="text" placeholder="Pilih buku" readonly="readonly" class="form-control" required="required" value="<?php echo $buku['judul']; ?>">
			<input type="number" max="<?php echo $buku['stok']; ?>" name="jumlah" placeholder="Jumlah Beli max <?php echo $buku['stok']; ?>" class="form-control">

			<input type="submit" name="tambah" value="tambah ke keranjang" class="btn btn-danger">

		</form>

		<?php 

			if (isset($_POST['tambah'])) {
				$ppn = $buku['ppn'];
				$diskon = $buku['diskon'];
				$jumlah = $_POST['jumlah'];
				$id_kasir = $profil['id_kasir'];
				$jml_ppn = 0.1;
				$jumlah_harga1 = $buku['harga_jual'] * $jumlah;
				$jumlah_harga2 = $jumlah_harga1 * $jml_ppn;
				$jumlah_harga = $jumlah_harga1 + $jumlah_harga2 - $diskon;
				mysqli_query($koneksi,"insert into tb_keranjang(id_keranjang,id_buku,id_kasir,jumlah,jumlah_harga) values('$kd_new', '$id_buku','$id_kasir','$jumlah','$jumlah_harga')");
				$updatestok = $buku['stok'] - $jumlah;
				mysqli_query($koneksi,"update tb_buku set stok='$updatestok' where id_buku='$id_buku'");

		 ?>
		 	<div class="alert alert-success">
		 		Berhasil tambah keranjang
		 	</div>
		 	<meta http-equiv="refresh" content="1; url='?menu=input_penjualan'">
		 <?php } ?>

		<hr>
		<h3 ><span class="glyphicon glyphicon-shopping-cart"></span> Keranjang</h3>
		<table class="table table-bordered">
			<tr>
				<th >Kode Penjualan</th>
				<th >Buku</th>
				<th >Harga</th>
				<th >Jumlah</th>
				<th >PPN</th>
				<th >Diskon</th>
				<th >Jumlah Harga</th>
				<th >Aksi</th>
			</tr>

			<?php 

				$no = 1;
				$qker = mysqli_query($koneksi,"SELECT tb_buku.*,tb_kasir.*,tb_keranjang.* FROM tb_keranjang INNER JOIN tb_buku ON tb_buku.id_buku=tb_keranjang.id_buku INNER JOIN tb_kasir ON tb_kasir.id_kasir=tb_keranjang.id_kasir");
				while ($data = mysqli_fetch_array($qker)) {

			 ?>

			<tr>
				<td ><?php echo $data['id_keranjang']; ?></td>
				<td ><?php echo $data['judul']; ?></td>
				<td >Rp.<?php echo $data['harga_jual']; ?></td>
				<td ><?php echo $data['jumlah'] ?></td>
				<td ><?php echo $data['ppn']; ?>%</td>
				<td >Rp.<?php echo $data['diskon']; ?></td>
				<td >Rp.<?php echo $data['jumlah_harga']; ?></td>
				<td>
					<a onclick="return confirm('data keranjang akan dihapus ?')" href="?menu=hapus_ker&id_keranjang=<?php echo $data['id_keranjang']; ?>&id_buku=<?php echo $data['id_buku']; ?>&jumlah=<?php echo $data['jumlah']; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-trash"></span></a>
				</td>
			</tr>
			<?php } ?>
			<tr>
				<td  class="text-right" colspan="6">Total Harga</td>
				<td > Rp.
					<?php 

						$qtotal = mysqli_query($koneksi,"select sum(jumlah_harga) as total from tb_keranjang");
						$total = mysqli_fetch_array($qtotal);
						echo number_format($total['total'],2);

					 ?>
				</td>
			</tr>
		</table>
		<hr>
		<?php 

			$qk = mysqli_query($koneksi,"select * from tb_keranjang");
			$cek = mysqli_num_rows($qk);
			if ($cek > 0) {

		 ?>
	<div class="col-md-4">
		<h1 ><small >Harga Total</small><br>
			Rp.<?php echo number_format($total['total'],2); ?>
		</h1>
		<form action="" class="form-inline" method="POST">
			<input type="number" name="uang" placeholder="masukkan uang pembeli" class="form-control" required="required" min="<?php echo $total['total']; ?>">
			<input type="submit" name="proses" value="proses" class="btn btn-success">
		</form>
	</div>
	<div class="col-md-4">
		<?php 

			if (isset($_POST['proses'])) {
				$uang = $_POST['uang'];
				$kembali = $uang - $total['total'];

				$tanggal = date('Y-m-d');
				mysqli_query($koneksi,"insert into tb_penjualan(id_buku,jumlah,jumlah_harga,id_jual) select id_buku,jumlah,jumlah_harga, '$kode_otomatis' from tb_keranjang");

				mysqli_query($koneksi,"insert into tb_jual(id_jual,total,uang,kembali,id_kasir,tanggal) values('$kode_otomatis','$total[total]','$uang','$kembali','$profil[id_kasir]','$tanggal')");
		?>
			<blockquote>
				<h3 ><small >Uang Pembeli</small>
					Rp.<?php echo number_format($uang,2); ?>
				</h3>
				<h2 ><small >Uang Kembali</small>
					Rp.<?php echo number_format($kembali,2); ?>
				</h2>
			</blockquote>
				
	</div>

	<div class="col-md-4">
		<br><br>
		<a href="?menu=selesai" class="btn btn-success">Selesai dan bersihkan keranjang</a>
		
	</div>
		<?php } } ?>

</body>
</html>