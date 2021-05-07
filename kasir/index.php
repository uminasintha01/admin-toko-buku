<?php 
include "../conn/koneksi.php";
  session_start();
  if (@$_SESSION['userweb']=="") {
    header('location:../login.php');
  }
  if ($_SESSION['level']=="admin") {
    header('location:../admin/index.php');
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
    <link rel="icon" href="../../favicon.ico">

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
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">>
  </head>

  <body>

  <div id="wrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
    <a  href="?menu=profil" class="navbar-brand">
      <span class="fa fa-user"></span> Kasir (<?php echo $profil['nama']; ?>)</a>
    </div>
    
         <div class="navbar-collapse collapse">
          <ul <ul class="nav navbar-right navbar-top-links">
            <li><a style="color: ;" href ="index.php">Dashboard</a></li>
            <li class="active"><a onclick="return confirm('Anda yakin akan keluar ?')" href="../conn/keluar.php">
              <span class="glyphicon glyphicon-log-out"></span>
              Keluar <span class="sr-only">(current)</span></a></li>
          </ul>
        </div>


   <!--slider menu-->
    <div class="navbar-default sidebar" role="navigation">
        <div  class="sidebar-nav navbar-collapse" style="background-color: yellow;">   
          <ul class="nav" id="side-menu">
             <?php

          @$menu = $_GET['menu'];

           ?>

          <ul class="nav nav-sidebar">
            <li <?php if ($menu=="") {
              echo "class='active'";
            } ?>><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li <?php if ($menu=="input_penjualan" || $menu=="load_buku") {
              echo "class='active'";
            } ?>><a href="?menu=input_penjualan"><span class="glyphicon glyphicon-import"></span> Input Penjualan</a></li>
            <li <?php if ($menu=="data_penjualan") {
              echo "class='active'";
            } ?>><a href="?menu=data_penjualan"><span class="glyphicon glyphicon-file"></span> Data / Laporan Penjualan</a></li>
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
    </nav>
  </div>

<!--end slider-->
          <div id="page-wrapper" style="background-image: url(../img/kuning2.png); background-position: 100%">

           <?php 
            error_reporting(0);
            switch ($_GET['menu']) {

              case 'data_penjualan':
                include "menu/data_penjualan.php";
                break;

              case 'input_penjualan':
                include "menu/input_penjualan.php";
                break;

              case 'jual':
                include "menu/jual.php";
                break;

              case 'hapus_penjualan': $id = $_GET['id_penjualan']; mysqli_query($koneksi,"DELETE FROM tb_penjualan WHERE id_penjualan='$id'"); include "menu/data_penjualan.php";
                break;

              case 'data_pemasukan':
                include "menu/data_pemasukan.php";
                break;

              case 'profil':
                include "menu/profil.php";
                break;

              case 'edit_profil':
                include "menu/edit_profil.php";
                break;

              case 'load_buku':
                include "menu/load_buku.php";
                break;

              case 'hapus_ker': 
              $id_buku = $_GET['id_buku'];
              $id_keranjang = $_GET['id_keranjang'];
              $jumlah = $_GET['jumlah'];
              $qbuku = mysqli_query($koneksi,"select * from tb_buku where id_buku='$id_buku'");
              $buku = mysqli_fetch_array($qbuku);
              $stokupdate = $buku['stok'] + $jumlah;
              mysqli_query($koneksi,"update tb_buku set stok='$stokupdate' where id_buku='$id_buku'");
              mysqli_query($koneksi,"delete from tb_keranjang where id_keranjang='$id_keranjang'");
              include "menu/input_penjualan.php";
                break;

              case 'selesai':
                mysqli_query($koneksi,"truncate table tb_keranjang");
                include "menu/input_penjualan.php";
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
