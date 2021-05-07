<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<br>
	<br>
	<h4 >SELAMAT DATANG</h4>

	<div class="col-md-4">
				<div class="panel panel-danger">
					<div class="panel-heading"> Laporan Penjualan
						<div class="panel-body">
								<h3><div class="span3 text-left"><i class="glyphicon glyphicon-file"></i></div>
									<div class="span8 text-right"> <?php 
									$qpeg = mysqli_query($koneksi,"SELECT * FROM tb_jual");
									$jumlah = mysqli_num_rows($qpeg);
									echo $jumlah;
									 ?>
									</div>
								</h3>
						</div>
					</div>
				</div>
			</div>

</body>
</html>
