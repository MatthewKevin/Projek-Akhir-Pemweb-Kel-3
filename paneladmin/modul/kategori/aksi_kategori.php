<?php  
session_start();

if(empty($_SESSION['username']) && empty($_SESSION['passuser'])) {



?>
32:35
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Note Found</title>

  <!-- Bootstrap core CSS -->
  <link href="../../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="../../lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="../../css/style.css" rel="stylesheet">
  <link href="../../css/style-responsive.css" rel="stylesheet">
  
</head>

<body>
<div class="container">
    <div class="row">
      <div class="col-lg-6 col-lg-offset-3 p404 centered">
        <img src="img/404.png" alt="">
        <h1>Jangan Panik Dulu!!</h1>
        <h3>Halaman yang Anda cari tidak ada.</h3>
        <br>
        <h5 class="mt">Silahkan Login Dulu:</h5>
        <p><a href="../../index.php">Login</a></p>
      </div>
    </div>
  </div>

<?php 
} else {

// koneksi
require_once '../../../config/koneksi.php';

$p = @$_GET['p'];
$act = $_GET['act'];
$id = @$_GET['id'];

if($act === 'hapus') {
	$query = mysqli_query($conn, "DELETE FROM tb_genre WHERE id_genre = $id") or die(mysqli_error($conn));
	if($query) {
		echo "<script>alert('Genre Berhasil Dihapus.');window.location='../../media.php?p=kategori';</script>";
	} else {
		echo "<script>alert('Data Gagal Dihapus.');window.location='media.php?p=kategori';</script>";
	}

} else if($_GET['act'] === 'tambah') {
	$nama_genre = htmlspecialchars($_POST['nama_genre']);


	$query = "INSERT INTO tb_genre (nama_genre) VALUES ('$nama_genre')";
	mysqli_query($conn, $query) or die(mysqli_error($conn));
	if($query) {
		echo "<script>alert('Data Berhasil Ditambahkan.');window.location='../../media.php?p=kategori';</script>";
	} else {
		echo "<script>alert('Data Gagal Ditambahkan.');window.location='../../media.php?p=kategori';</script>";
	}

} else if($_GET['act'] == 'edit') {
	$idk = $_POST['id_genre'];
	$nama_genre = htmlspecialchars($_POST['nama_genre']);


	$query = "UPDATE tb_genre SET nama_genre = '$nama_genre' WHERE id_genre = $idk";
	mysqli_query($conn, $query) or die(mysqli_error($conn));
	if($query) {
		echo "<script>alert('Data Berhasil Diubah.');window.location='../../media.php?p=kategori';</script>";
	} else {
		echo "<script>alert('Data Gagal Diubah.');window.location='../../media.php?p=kategori';</script>";
	}


 }	

}
?>