<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
  <?php 
include '../conn/koneksi.php';
$qr = mysqli_query($koneksi,"SELECT max(right(id_distributor,4)) FROM tb_distributor");
$q = mysqli_fetch_array($qr);
$kd_new = 'ID-'.str_pad(($q[0] + 1),4,'0',STR_PAD_LEFT);
?>
	<div class="row">
		<br>
		<h3 >Tambah Distributor</h3>
		<div class="col-md-8">
			
			<form method="POST">
				<div class="modal-body">
        <form action="distributor_act.php" method="post">
          <div class="form-group">
            <label>Id Distributor</label>
            <input name="id_distributor" readonly="readonly" type="text" class="form-control" value="<?php echo $kd_new ?>">
          </div>
				<div class="form-group">
					<label >Nama</label>
					<input name="nama" type="text" class="form-control" placeholder="Nama Distributor" required="required">
				</div>
				<div class="form-group">
					<label >Alamat</label>
					<textarea name="alamat" class="form-control" placeholder="Alamat Distributor" required="required"></textarea>
				</div>	
				<div class="form-group">
					<label >Telepon</label>
					<input name="telepon" type="number" class="form-control" placeholder="Telepon" required="required">
				</div>	

					<input name="fsimpan" type="submit" class="btn btn-sm btn-success" value="simpan">
					<a class="btn btn-sm btn-danger" href="?menu=data_distributor">Kembali</a>
			</form>

			<?php 

			if (isset($_POST['fsimpan'])) {
				$id=$_POST['id_distributor'];
				$nama = $_POST['nama'];
				$alamat = $_POST['alamat'];
				$telepon = $_POST['telepon'];

				$q = "INSERT INTO tb_distributor(id_distributor,nama_distributor, alamat, telepon)VALUES ('$id', '$nama','$alamat','$telepon')";

				mysqli_query($koneksi,$q);
				?>

				<script type="text/javascript">
					alert('Berhasil menambah Distributor !');
					document.location.href="?menu=data_distributor"
				</script>

				<?php

			}

			 ?>

		</div>
	</div>
</body>
</html>