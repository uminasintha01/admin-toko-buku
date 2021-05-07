<?php 
include '../conn/koneksi.php';
	$id_jual = $_GET['id_jual'];
	$q = mysqli_query($koneksi,"SELECT tb_jual.*,tb_kasir.* FROM tb_jual INNER JOIN tb_kasir ON tb_kasir.id_kasir=tb_jual.id_kasir WHERE id_jual='$id_jual'");
	$d = mysqli_fetch_array($q);

 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../css/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../css/timeline.css" rel="stylesheet">
        
        <!-- DataTables CSS -->
        <link href="../css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="../css/dataTables/dataTables.responsive.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
	<center>
		<h1 >Book Store</h1>
	</center>
	<hr>
		
		<div class="table-responsive">
		<div style="width: 45%; float: left;">
			<table class="table table-striped table-bordered table-hover" id="dataTables-example">
				<tr>
					<th >Kode Penjualan</th><td ><?php echo $d['id_jual']; ?></td>
				</tr>
				<tr>
					<th >Kasir</th><td ><?php echo $d['nama']; ?></td>
				</tr>
				<tr>
					<th >Tanggal </th><td ><?php echo $d['tanggal']; ?></td>
				</tr>
			</table>
		</div>

		<div style="width: 45%; float: left; margin-left: 10%;">
			<table class="table table-condensed">
				<tr>
					<th >Total Harga</th><td ><?php echo number_format($d['total'],2); ?></td>
				</tr>
				<tr>
					<th >Uang Pembeli</th><td ><?php echo number_format($d['uang'],2); ?></td>
				</tr>
				<tr>
					<th >Uang Kembali </th><td ><?php echo number_format($d['kembali'],2); ?></td>
				</tr>
			</table>
		</div>
		</div>

		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		<tr>
			<th >No.</th>
			<th >Buku</th>
			<th >PPN</th>
			<th >Diskon</th>
			<th >Harga</th>
			<th >Jumlah</th>
			<th >Jumlah Harga</th>
		</tr>

		<?php 

			$no = 1;
			$qbuku = mysqli_query($koneksi,"SELECT tb_penjualan.*,tb_buku.* FROM tb_penjualan INNER JOIN tb_buku ON tb_buku.id_buku=tb_penjualan.id_buku WHERE id_jual='$id_jual'");
			while ($data  = mysqli_fetch_array($qbuku)) {

		 ?>

		<tr>
			<td ><?php echo $no++; ?></td>
			<td ><?php echo $data['judul']; ?></td>
			<td ><?php echo $data['ppn']; ?>%</td>
			<td >Rp.<?php echo $data['diskon']; ?></td>
			<td >Rp.<?php echo $data['harga_pokok']; ?></td>
			<td ><?php echo $data['jumlah']; ?></td>
			<td >Rp.<?php echo $data['jumlah_harga']; ?></td>
			
		</tr>

		<?php } ?>

		<tr>
			<th class="text-right" colspan="6" >Total Harga</th>
			<td >
				Rp.<?php echo number_format($d['total'],2); ?>
			</td>
		</tr>
	</table>

		</div>

</body>
</html>
<script type="text/javascript">
	window.print()
</script>