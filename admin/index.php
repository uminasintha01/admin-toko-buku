<?php 
include "../conn/koneksi.php";
  session_start();
  if (@$_SESSION['userweb']=="") {
    header('location:../login.php');
  }
  if ($_SESSION['level']=="kasir") {
    header('location:../kasir/index.php');
  }
  $qprofil = mysqli_query($koneksi,"SELECT * FROM tb_kasir WHERE id_kasir='$_SESSION[userweb]'");
  $profil = mysqli_fetch_array($qprofil);
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="description" content="">
    <meta name="author" content="">
     <link rel="shortcut icon" href="../img/favicon.ico">

    <title>Admin</title>

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


    <div id="wrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
    <a  href="?menu=profil" class="navbar-brand">
      <span class="fa fa-user"></span> Admin (<?php echo $profil['nama']; ?>)</a>
    </div>
     
          
        <div class="navbar-collapse collapse">
          <ul <ul class="nav navbar-right navbar-top-links">
            <li><a href ="index.php">Dashboard</a></li>
            <li><a href="?menu=data_pegawai">Pegawai</a></li>
            <li><a href="?menu=data_buku">Buku</a></li>
            <li><a href="?menu=data_distributor">Distributor</a></li>
            <li class="active"><a onclick="return confirm('Anda yakin akan keluar ?')" href="../conn/keluar.php">
              <span class="glyphicon glyphicon-log-out"></span>
              Keluar <span class="sr-only">(current)</span></a></li>
          </ul>
        </div>
   </div>
<!--slider menu-->
    <div class="navbar-default sidebar" role="navigation" >
        <div  class="sidebar-nav navbar-collapse" style="background-color: yellow;">   
          <ul class="nav" id="side-menu">
         <?php 
          @$menu = $_GET['menu'];
           ?>
          <ul class="nav nav-sidebar">
            <li <?php if ($menu=="") {
              echo "class='active'";
            } ?>><a href="index.php"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>

            <li><a href="?menu=tambah_pegawai"><span class="glyphicon glyphicon-user"></span>Tambah Pegawai</a></li>

            <li><a href="?menu=tambah_buku"><span class="glyphicon glyphicon-book"></span>Tambah Buku</a></li>

            <li><a href="?menu=tambah_distributor"><span class="glyphicon glyphicon-user"></span>Tambah Distributor</a></li>

            <li><a href="?menu=data_pemasukan"><span class="glyphicon glyphicon-import"></span> Riwayat Pemasukan</a></li>

            <li><a href="?menu=data_penjualan"><span class="glyphicon glyphicon-export"></span> Laporan Penjualan</a></li>
          </ul>
        </ul>
      </div>
          <div class="navbar-default sidebar" role="navigation">
          <ul class="nav nav-sidebar">
            <li class="active"><a onclick="return confirm('Anda yakin akan keluar ?')" href="../conn/keluar.php">
              <span class="glyphicon glyphicon-log-out"></span>
              Keluar <span class="sr-only">(current)</span></a></li>
          </ul>
        </div>
   </div>
</div>
<!--end slider-->
   
          <div id="page-wrapper"  style="background-image: url(../img/kuning2.png); background-position: 100%">

            <?php 
            error_reporting(0);
            switch ($_GET['menu']) {
              case 'data_pegawai':
                include "menu/data_pegawai.php";
                echo "<br>";
                break;

            case 'hapus_pegawai': $id = $_GET['id_pegawai']; mysqli_query($koneksi,"DELETE FROM tb_kasir WHERE id_kasir='$id'"); include "menu/data_pegawai.php";
              break;

              case 'tambah_pegawai':
                include "menu/tambah_pegawai.php";
                break;

              case 'edit_pegawai':
                include "menu/edit_pegawai.php";
                break;

              case 'data_penjualan':
                include "menu/data_penjualan.php";
                break;

              case 'data_distributor':
                include "menu/data_distributor.php";
                break;

              case 'hapus_distributor': $id = $_GET['id_distributor']; mysqli_query($koneksi,"DELETE FROM tb_distributor WHERE id_distributor='$id'"); include "menu/data_distributor.php";
              break;

              case 'tambah_distributor':
                include "menu/tambah_distributor.php";
                break;

              case 'edit_distributor':
                include "menu/edit_distributor.php";
                break;

              case 'data_buku':
                include "menu/data_buku.php";
                break;

              case 'hapus_buku': $id = $_GET['id_buku']; mysqli_query($koneksi,"DELETE FROM tb_buku WHERE id_buku='$id'"); include "menu/data_buku.php";
              break;

              case 'tambah_buku':
                include "menu/tambah_buku.php";
                break;

              case 'edit_buku':
                include "menu/edit_buku.php";
                break;

              case 'data_pemasukan':
                include "menu/data_pemasukan.php";
                break;

              case 'input_pemasukan':
                include "menu/input_pemasukan.php";
                break;

              case 'hapus_pasok': $id = $_GET['id_pasok']; mysqli_query($koneksi,"DELETE FROM tb_pasok WHERE id_pasok='$id'");
               include "menu/data_pemasukan.php";
              break;

              case 'profil':
                include "menu/profil.php";
                break;

              case 'edit_profil':
                include "menu/edit_profil.php";
                break;

              case 'hapus_penjualan': $id = $_GET['id_penjualan']; mysqli_query($koneksi,"DELETE FROM tb_penjualan WHERE id_penjualan='$id'"); include "menu/data_penjualan.php";
                break;

              case 'data_pemasukan':
                include "menu/data_pemasukan.php";
                break;

              case 'detail':
                include "menu/detail.php";
                break;

              case 'print':
              mysqli_query($koneksi,"truncate table tb_keranjang");
                include "menu/print.php";
                break;

              default:
                include "menu/dashboard.php";
                break;
            }
             ?>
            </div>
      </div>
    </div>
  <script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>

  </body>
</html>
