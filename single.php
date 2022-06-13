<?php
session_start();
require_once 'config/koneksi.php';
require_once 'config/functions.php';

$id = $_GET['id'];
$gambarZoom = mysqli_query($conn, "SELECT * FROM tb_novel WHERE kd_novel = $id") or die(mysqli_error($conn));
$gbrZ = mysqli_fetch_assoc($gambarZoom);

// ketika tombol beli di klik
if (isset($_POST['beli'])) {
	$jumlah = $_POST['jumlah'];

	$_SESSION['keranjang'][$id] = $jumlah;

	echo "<script>alert('Produk berhasil masuk ke keranjang belanja anda.');window.location='keranjang.php';</script>";
}


?>
<!DOCTYPE html>
<html>

<head>
	<title><?= $gbrZ['nama']; ?> | Noverukun</title>
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<!--theme-style-->
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="stylesheet" href="css/etalage.css" type="text/css" media="all" />
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

	<script src="js/jquery.etalage.min.js"></script>
	<script>
		jQuery(document).ready(function($) {

			$('#etalage').etalage({
				thumb_image_width: 300,
				thumb_image_height: 400,
				source_image_width: 900,
				source_image_height: 1200,
				show_hint: true,
				click_callback: function(image_anchor, instance_id) {
					alert('Callback example:\nYou clicked on an image with the anchor: "' + image_anchor + '"\n(in Etalage instance: "' + instance_id + '")');
				}
			});

		});
	</script>

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
							<!--option value="German" class="in-of">German</option-->
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
					<div class="cart"><a href="<?= base_url('keranjang.php'); ?>"><span> </span></a></div>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!---->

	<div class="container">

		<div class=" single_top">
			<div class="single_grid">
				<div class="grid images_3_of_2">

					<ul id="etalage">
						<li>
							<a href="optionallink.html">
								<img class="etalage_thumb_image" src="paneladmin/modul/produk/img/<?= $gbrZ['foto']; ?>" class="img-responsive" />
								<img class="etalage_source_image" src="paneladmin/modul/produk/img/<?= $gbrZ['foto']; ?>" class="img-responsive" title="" />
							</a>
						</li>
					</ul>
					<div class="clearfix"> </div>
				</div>
				<div class="desc1 span_3_of_2">


					<h4><?= $gbrZ['nama']; ?></h4>
					<div class="cart-b">
						<div class="left-n ">Rp. <?= $gbrZ['hrg_jual']; ?></div>
						<a class="now-get get-cart-in" href="beli.php?id=<?= $gbrZ['kd_novel']; ?>">Masukan Di Keranjang</a>
						<div class="clearfix"></div>
					</div>

					</form>
					<h6>Stok <?= number_format($gbrZ['jumlah_brg']); ?></h6>
					<form action="" method="post">
						<div class="input-group col-md-4">
							<input type="number" name="jumlah" min="1" max="<?= $gbrZ['jumlah_brg']; ?>" class="form-control">
							<span class="input-group-btn">
								<button type="submit" name="beli" class="btn btn-primary" type="button">Beli</button>
							</span>
						</div><!-- /input-group -->
						<p><?= $gbrZ['deskripsi']; ?>.</p>
						<div class="share">
							<h5>Share Product :</h5>
							<ul class="share_nav">
								<li><a href="#"><img src="images/facebook.png" title="facebook"></a></li>
								<li><a href="#"><img src="images/twitter.png" title="Twiiter"></a></li>
								<li><a href="#"><img src="images/rss.png" title="Rss"></a></li>
								<li><a href="#"><img src="images/gpluse.png" title="Google+"></a></li>
							</ul>
						</div>


				</div>
				<div class="clearfix"> </div>
			</div>
			<ul id="flexiselDemo1">
				<?php
				// ambil url dari content.php
				$idk = $_GET['rl'];
				// $relate = mysqli_query($conn, "SELECT * FROM tb_novel INNER JOIN tb_genre ON tb_novel.kd_novel = tb_genre.id_genre") or die(mysqli_error($conn));
				$relate = mysqli_query($conn, "SELECT * FROM tb_novel WHERE id_genre = $idk") or die(mysqli_error($conn));
				while ($rRow = mysqli_fetch_assoc($relate)) { ?>
					<!-- <?php if ($rRow['id_genre'] == $rRow['id_genre']) : ?> -->
					<li><img src="paneladmin/modul/produk/img/<?= $rRow['foto']; ?>">
						<div class="grid-flex"><a href="single.php?id=<?= $rRow['kd_novel']; ?>&rl=<?= $rRow['id_genre']; ?>"><?= $rRow['nama']; ?></a>
							<p>Rp <?= number_format($rRow['hrg_jual']); ?></p>
						</div>
					</li>
					<!-- <?php endif; ?> -->
				<?php } ?>
				<!-- 
			<li><img src="images/pi1.jpg" /><div class="grid-flex"><a href="#">Capzio</a><p>Rs 850</p></div></li>
			<li><img src="images/pi2.jpg" /><div class="grid-flex"><a href="#">Zumba</a><p>Rs 850</p></div></li>
			<li><img src="images/pi3.jpg" /><div class="grid-flex"><a href="#">Bloch</a><p>Rs 850</p></div></li>
			<li><img src="images/pi4.jpg" /><div class="grid-flex"><a href="#">Capzio</a><p>Rs 850</p></div></li> -->
			</ul>
			<script type="text/javascript">
				$(window).load(function() {
					$("#flexiselDemo1").flexisel({
						visibleItems: 5,
						animationSpeed: 1000,
						autoPlay: true,
						autoPlaySpeed: 3000,
						pauseOnHover: true,
						enableResponsiveBreakpoints: true,
						responsiveBreakpoints: {
							portrait: {
								changePoint: 480,
								visibleItems: 1
							},
							landscape: {
								changePoint: 640,
								visibleItems: 2
							},
							tablet: {
								changePoint: 768,
								visibleItems: 3
							}
						}
					});

				});
			</script>
			<script type="text/javascript" src="js/jquery.flexisel.js"></script>

			<div class="toogle">
				<h3 class="m_3">Product Details</h3>
				<p class="m_text">More Info.</p>
			</div>
		</div>

		<!---->
		<div class="sub-cate">
			<?php require_once 'menu.php'; ?>
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
						<h6>BBEST SELLING AUTHORS</h6>
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