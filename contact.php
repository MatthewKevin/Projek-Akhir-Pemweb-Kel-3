<?php
session_start();
require_once 'config/koneksi.php';
require_once 'config/functions.php';

if (isset($_POST['kirim'])) {
	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$pesan = $_POST['pesan'];
	$admin = 'matthewkevinsiahaan@gmail.com';

	$pengirim = "Dari : " . $nama . '<' . $email . '>';

	if (mail($admin, $pesan, $pengirim)) {
		echo "<script>alert('Pesan anda berhasil di kirim.');window.location='contact.php';</script>";
	} else {
		echo "<script>alert('Pesan anda gagal di kirim.');window.location='contact.php';</script>";
	}
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>Kontak Kami | NOVERUKUN</title>
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
						<a href="index.php"><img src="images/n2.png" alt=" " /></a>
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
							<li><a href="register.php">DAFTAR</a></li>
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
	<div class="container">

		<div class="register">
			<div class="products">
				<h5 class="latest-product"><i class="fa fa-shopping-cart"></i> KONTAK KAMI</h5>
			</div>
			<div class="row">
				<div class="col-md-12">
					<form action="" method="post">
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="text" name="nama" id="nama" class="form-control">
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="text" name="email" id="email" class="form-control">
						</div>
						<div class="form-group">
							<label for="pesan">Pesan</label>
							<textarea name="pesan" id="pesan" class="form-control" cols="30" rows="10"></textarea>
						</div>
						<div class="form-group">
							<button type="submit" name="kirim" class="btn btn-primary">Kirim</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="sub-cate">
			<?php include 'menu.php'; ?>
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
								<li><a href="#"><?= $row['nama_genre']; ?></a></li>
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