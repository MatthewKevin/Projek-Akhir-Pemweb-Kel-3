<?php 
session_start();
$id_novel = $_GET['id'];

// jikasudah ada novel di keranjang, maka produkitu akan tambah +1
if(isset($_SESSION['keranjang'][$id_novel])) {
	$_SESSION['keranjang'][$id_novel] += 1;
} else {
	// jika novel belum ada di halaman keranjang akan di anggap beli 1
	$_SESSION['keranjang'][$id_novel] = 1;
}

if(!isset($_GET['id'])) {
	header("Location: paneladmin/index.php");
	exit;
}


// if(!isset($_SESSION['username'])) {
// 	echo "<script>alert('Silahkan login terlebih dahulu.');window.location='paneladmin/index.php';</script>";
// } else {
// 	echo "<script>alert('Produk telah masuk ke keranjang belanja anda.');window.location='keranjang.php';</script>";
// }

echo "<script>alert('Novel berhasil di tambahkan ke keranjang.');window.location='keranjang.php';</script>";

?>