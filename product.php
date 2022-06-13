<!--A Design by W3layouts 
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
session_start();
require_once 'config/koneksi.php';
require_once 'config/functions.php';

$idH = $_GET['id'];
// query untuk jumlah pencarian di produk.php
$genreB = "SELECT * FROM tb_novel WHERE id_genre = $idH";
// query untuk menampilkan genre di bagian titile html
$genreH = mysqli_query($conn, "SELECT * FROM tb_genre WHERE id_genre = $idH");
$judulH = mysqli_fetch_assoc($genreH);

?>
<!DOCTYPE html>
<html>

<head>
	<title><?= $judulH['nama_genre'] ?> | NOVERUKUN</title>
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<!--theme-style-->
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="paneladmin/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<!--//theme-style-->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!--fonts-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
	<!--//fonts-->
	<script src="js/jquery.min.js"></script>


	<!--script-->
</head>

<body>
	<!--header-->
	<div class="header">
		<div class="top-header">
			<div class="container">
				<div class="top-header-left">
					<ul class="support">
						<li><a href="#"><label> </label></a></li>
						<li><a href="contact.php">24x7 Chat<span class="live"> Bantuan</span></a></li>
					</ul>
					<ul class="support">
						<li class="van"><a href="#"><label> </label></a></li>
						<li><a href="#">Gratis Ongkir <span class="live">Pesanan diatas Rp.500.000</span></a></li>
					</ul>
					<div class="clearfix"> </div>
				</div>
				<div class="top-header-right">
					<div class="down-top">
						<select class="in-drop">
							<option value="English" class="in-of">English</option>
							<option value="Japanese" class="in-of">Japanese</option>
							<option value="Indonesia" class="in-of">Indonesia</option>
						</select>
					</div>
					<div class="down-top top-down">
						<select class="in-drop">
							<option value="Dollar" class="in-of">Dollar</option>
							<option value="Yen" class="in-of">Yen</option>
							<option value="Rupiah" class="in-of">Rupiah</option>
						</select>
					</div>
					<!---->
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="bottom-header">
			<div class="container">
				<div class="header-bottom-left">
					<div class="logo">
						<a href="<?= base_url(); ?>"><img src="images/n2.png" alt=" " /></a>
					</div>
					<div class="search">
						<form action="pencarian.php" method="get">
							<input type="text" name="keyword">
							<button type="submit" class="btn btn-primary">Search</button>
						</form>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="header-bottom-right">
					<!-- <div class="account"><a href="login.html"><span> </span>YOUR ACCOUNT</a></div> -->
					<?php if (isset($_SESSION['username'])) : ?>
						<ul class="login">
							<li><a href="<?= base_url('paneladmin/index.php'); ?>"><span> </span>USER</a></li> |
							<li><a href="<?= base_url('paneladmin/logout.php'); ?>"><i class="fa fa-sign-out"></i> LOGOUT</a></li>
						</ul>
					<?php else : ?>
						<ul class="login">
							<li><a href="<?= base_url('paneladmin/index.php'); ?>"><span> </span>MASUK</a></li> |
							<li><a href="<?= base_url('paneladmin/index.php'); ?>">DAFTAR</a></li>
						</ul>
					<?php endif; ?>
					<!-- <div class="cart"><a href="#"><span> </span>KERANJANG</a></div> -->
					<div class="cart"><a href="<?= base_url('paneladmin/index.php'); ?>"><span> </span></a></div>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!---->
	<!-- start content -->
	<div class="container">

		<div class="women-product">
			<div class=" w_content">
				<div class="women">
					<?php
					$jmlH = mysqli_num_rows(mysqli_query($conn, $genreB));
					?>
					<h4>Barang Ditemukan - <span><?= $jmlH; ?> items</span> </h4>
					<ul class="w_nav">
						<li>Sort : </li>
						<li><a class="active" href="#">popular</a></li> |
						<li><a href="#">new </a></li> |
						<li><a href="#">discount</a></li> |
						<li><a href="#">price: Low High </a></li>
						<div class="clearfix"> </div>
					</ul>
					<div class="clearfix"> </div>
				</div>
			</div>
			<!-- grids_of_4 -->
			<div class="grid-product">
				<?php
				$id = $_GET['id'];
				$genre = "SELECT * FROM tb_novel WHERE id_genre = $id";
				$ktg = mysqli_query($conn, $genre) or die(mysqli_error($conn));
				while ($rowT = mysqli_fetch_assoc($ktg)) {

				?>
					<div class="product-grid">
						<div class="content_box"><a href="single.php?id=<?= $rowT['kd_novel']; ?>">
								<div class="left-grid-view grid-view-left">
									<img src="paneladmin/modul/produk/img/<?= $rowT['foto']; ?>" class="img-responsive watch-right" alt="" />
									<div class="mask">
										<div class="info">Quick View</div>
									</div>
							</a>
						</div>
						<h5><a href="single.php?id=<?= $rowT['kd_novel']; ?>"><?= $rowT['nama']; ?></a></h5>
						<p>It is a long established fact that a reader</p>
						Rp. <?= number_format($rowT['hrg_jual'], 2, ",", "."); ?>
					</div>
			</div>
		<?php }  ?>
		<div class="clearfix"> </div>
		</div>
	</div>
	<div class="sub-cate">
		<?php require_once 'menu.php'; ?>
	</div>
	<div class="clearfix"> </div>
	</div>
	<!---->
	<div class="footer">
		<div class="footer-top">
			<div class="container">
				<div class="latter-right">
					<p>FOLLOW US</p>
					<ul class="face-in-to">
						<li><a href="#"><span> </span></a></li>
						<li><a href="#"><span class="facebook-in"> </span></a></li>
						<div class="clearfix"> </div>
					</ul>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="container">
				<div class="footer-bottom-cate">
					<h6>GENRE</h6>
					<ul>
						<?php
						$menu = mysqli_query($conn, "SELECT * FROM tb_genre") or die(mysqli_error($conn));
						while ($row = mysqli_fetch_assoc($menu)) { ?>
							<li><a href="product.php?id=<?= $row['id_genre']; ?>"><?= $row['nama_genre']; ?></a></li>
						<?php } ?>
					</ul>
				</div>
				<div class="footer-bottom-cate bottom-grid-cat">
					<h6>BEST SELLING TITLES</h6>
						<ul>
							<li><a href="#">TENSEI SHITTARA SLIME DATTA KEN</a></li>
							<li><a href="#">OVERLORD</a></li>
							<li><a href="#">DUNGEON NI DEAI MOTOMERU NO WA MACHIGATTEIRU DAROU KA</a></li>
							<li><a href="#">DATE A LIVE</a></li>
							<li><a href="#">NO GAME NO LIFE</a></li>
							<li><a href="#">SWORD ART ONLINE</a></li>
							<li><a href="#">CLASSROOM OF THE ELITE</a></li>
						</ul>
				</div>
				<div class="footer-bottom-cate">
					<h6>BEST SELLING AUTHORS</h6>
						<ul>
							<li><a href="#">Kumo Kagyu</a></li>
							<li><a href="#">Aneko Yusagi</a></li>
							<li><a href="#">Ryo Shirakome</a></li>
							<li><a href="#">Hiro Ainana</a></li>
							<li><a href="#">Fuse</a></li>
							<li><a href="#">Shogo Kinugasa</a></li>
							<li><a href="#">Fujino Omori</a></li>
							<li><a href="#">Tsutomu Sato</a></li>
							<li><a href="#">Wataru Watari</a></li>
							<li><a href="#">Kugane Maruyama</a></li>
							<li><a href="#">Natsume Akatsuki</a></li>
							<li><a href="#">Yu Kamiya</a></li>
						</ul>
				</div>
				<div class="footer-bottom-cate cate-bottom">
				<h6>ALAMAT KAMI</h6>
						<ul>
							<li>Jl.Veteran</li>
							<li>Lowokwaru, Kota Malang</li>
							<li>No. 08.</li>
							<li class="phone">PH : 6985792466</li>
							<li class="temp">
								<p class="footer-class">Design by Matthew Kevin	</p>
							</li>
						</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
</body>

</html>