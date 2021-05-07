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
					<div class="panel-heading"> Data Pegawai
						<div class="panel-body">
								<h3><div class="span3 text-left"><i class="glyphicon glyphicon-user"></i></div>
									<div class="span8 text-right"> <?php 
									$qpeg = mysqli_query($koneksi,"SELECT * FROM tb_kasir WHERE akses='kasir'");
									$jumlah = mysqli_num_rows($qpeg);
									echo $jumlah;
									 ?>
									</div>
								</h3>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="panel panel-success">
					<div class="panel-heading"> Data Buku
						<div class="panel-body">
								<h3><div class="span3 text-left"><i class="glyphicon glyphicon-book"></i></div>
									<div class="span8 text-right"> <?php 
									$qbuku = mysqli_query($koneksi,"SELECT * FROM tb_buku");
									$jm_buk = mysqli_num_rows($qbuku);
									echo $jm_buk;
									 ?> </div>
								</h3>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="panel panel-warning">
					<div class="panel-heading"> Data Distributor
						<div class="panel-body">
								<h3><div class="span3 text-left"><i class="glyphicon glyphicon-user"></i></div>
									<div class="span8 text-right"> <?php 
									$qdis = mysqli_query($koneksi,"SELECT * FROM tb_distributor");
									$jm_dis = mysqli_num_rows($qdis);
									echo $jm_dis;
									 ?> </div>
								</h3>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="panel panel-red">
					<div class="panel-heading"> Riwayat Pemasukan
						<div class="panel-body">
								<h3><div class="span3 text-left"><i class="glyphicon glyphicon-import"></i></div>
									<div class="span8 text-right"> <?php 
									$qpem = mysqli_query($koneksi,"SELECT * FROM tb_pasok");
									$jm_pem = mysqli_num_rows($qpem);
									echo $jm_pem;
									 ?> </div>
								</h3>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="panel panel-green">
					<div class="panel-heading"> Laporan Penjualan
						<div class="panel-body">
								<h3><div class="span3 text-left"><i class="glyphicon glyphicon-export"></i></div>
									<div class="span8 text-right"> <?php 
									$qpnj = mysqli_query($koneksi,"SELECT * FROM tb_penjualan");
									$jm_pnj = mysqli_num_rows($qpnj);
									echo $jm_pnj; 				
									 ?> </div>
								</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
</body>
</html>
