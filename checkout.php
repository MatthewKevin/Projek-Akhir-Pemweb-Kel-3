<?php
session_start();
require_once 'config/koneksi.php';
require_once 'config/functions.php';

$keranjang = @$_SESSION['keranjang'];

if (!isset($_SESSION['username'])) {
	header("Location: " . "paneladmin/index.php");
	exit;
}

if (empty($keranjang)) {
	echo "<script>alert('Keranjang belanja kosong, silahkan beli beberapa produk.');window.location='index.php';</script>";
}

$queryi = mysqli_query($conn, "SELECT * FROM tb_user") or die(mysqli_error($conn));
$rowS = mysqli_fetch_assoc($queryi);
$_SESSION['id_user'] = $rowS['id_user'];
$_SESSION['no_telp'] = $rowS['no_telp'];
$_SESSION['emaill'] = $rowS['email'];
// var_dump($_SESSION['id_user']);

?>
<!DOCTYPE html>
<html>

<head>
	<title>Checkout | NOVERUKUN</title>
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
				<h5 class="latest-product"><i class="fa fa-shopping-cart"></i> CHECKOUT BELANJA</h5>
				<!-- <a class="view-all" href="product.html">VIEW ALL<span> </span></a> 		      -->
			</div>
			<table class="table">
				<thead>
					<tr>
						<th>No</th>
						<th>Barang</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Subtotal</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					$totalbelanja = 0;
					foreach ($keranjang as $id_produk => $jumlah) : ?>
						<?php
						$query_keranjang = mysqli_query($conn, "SELECT * FROM tb_novel WHERE kd_novel = $id_produk") or die(mysqli_error($conn));
						$rowK = mysqli_fetch_assoc($query_keranjang);
						$subtotal = $rowK['hrg_jual'] * $jumlah;
						?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $rowK['nama']; ?></td>
							<td><?= number_format($rowK['hrg_jual']); ?></td>
							<td><?= $jumlah; ?></td>
							<td><?= number_format($subtotal); ?></td>
						</tr>
						<?php $totalbelanja += $subtotal; ?>
					<?php endforeach; ?>
					<div class="col-md-12" style="margin-bottom: 8px;">

					</div>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4">Total Belanja</td>
						<td>Rp. <?= number_format($totalbelanja); ?></td>
					</tr>
				</tfoot>
			</table>
			<div class="row">
				<div class="col-md-3">
					<form action="" method="post">
						<input type="text" readonly="" value="<?= $_SESSION['nama_lengkap']; ?>">
				</div>
				<div class="col-md-3">
					<input type="text" readonly="" value="<?= $_SESSION['emaill']; ?>">
				</div>
				<div class="col-md-3">
					<input type="text" readonly="" value="<?= $_SESSION['no_telp']; ?>">
				</div>
				<div class="col-md-3">
					<select name="id_ongkir" class="form-control">
						<option value="">Pilih Ongkir</option>
						<?php
						$ongkir = mysqli_query($conn, "SELECT * FROM tb_ongkir");
						while ($rowO = mysqli_fetch_assoc($ongkir)) {
						?>
							<option value="<?= $rowO['id_ongkir'] ?>"><?= $rowO['nama_kota'] . " ~ Rp. " . number_format($rowO['tarif']); ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label>Alamat Pengiriman</label>
						<textarea name="alamat_pengiriman" class="form-control" cols="10" rows="3" placeholder="Masukan alamat lengkap anda..."></textarea>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="provinsi">Provinsi</label>
							<select name="provinsi" id="provinsi" class="form-control">
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="distrik">Distrik</label>
							<select name="distrik" id="distrik" class="form-control">
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="ekspedisi">Ekspedisi</label>
							<select name="ekspedisi" id="ekspedisi" class="form-control">
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="paket">Paket</label>
							<select name="paket" id="paket" class="form-control">
							</select>
						</div>
					</div>
					<div class="form-group">
						<input type="text" name="total_berat" value="1200" class="form-control">
						<input type="text" name="input_provinsi" class="form-control">
						<input type="text" name="input_distrik" class="form-control">
						<input type="text" name="input_tipe" class="form-control">
						<input type="text" name="input_kodepos" class="form-control">
						<input type="text" name="input_ekspedisi" class="form-control">
						<input type="text" name="input_paket" class="form-control">
						<input type="text" name="input_ongkir" class="form-control">
						<input type="text" name="input_estimasi" class="form-control">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12" style="margin-top: 10px;">
						<button type="submit" name="checkout" class="btn btn-danger" style="float: right;">Checkout</button>
					</div>
				</div>
			</div>
			</form>

			<!-- Aksi Checkout -->
			<?php
			if (isset($_POST['checkout'])) {
				// mendapatkan id_user
				$id_user = $_SESSION['id_user'];
				// dapatkan id_ongkir
				$id_ongkir = $_POST['id_ongkir'];
				$tgl_pembelian = date('Y-m-d');
				$alamat_pengiriman = $_POST['alamat_pengiriman'];

				// jika inputan ongkir kosong
				if (empty($id_ongkir)) {
					echo "<script>alert('Pilih tujuan pengiriman')</script>";
					return false;
				}

				// jika inputan alamat kosong
				if (empty($alamat_pengiriman)) {
					echo "<script>alert('Isi alamat lengkap anda terlebih dahulu.')</script>";
					return false;
				}

				$queryOngkir = $conn->query("SELECT * FROM tb_ongkir WHERE id_ongkir = $id_ongkir") or die(mysqli_error($conn));
				$pecahOngkir = $queryOngkir->fetch_assoc();
				$nama_kota = $pecahOngkir['nama_kota'];
				$tarifOngkir = $pecahOngkir['tarif'];

				$total_pembelian = $totalbelanja + $tarifOngkir;

				// menyimpan data ke table pembelian
				$queryPembelian = $conn->query("INSERT INTO tb_pembelian (id_user, id_ongkir, tgl_pembelian, total_pembelian, nama_kota, tarif, alamat_pengiriman) VALUES ('$id_user', '$id_ongkir', '$tgl_pembelian', '$total_pembelian', '$nama_kota', '$tarifOngkir', '$alamat_pengiriman')") or die(mysqli_error($conn));

				// mendapatkan id_pembelian barusan
				$id_pembelian_barusan = $conn->insert_id;

				foreach ($_SESSION['keranjang'] as $id_produk => $jumlah_brg) {
					// menampilkan novel berdasarkan kd_novel
					$ambil = $conn->query("SELECT * FROM tb_novel WHERE kd_novel = $id_produk") or die(mysqli_error($conn));
					$pernovel = $ambil->fetch_assoc();

					$nama = $pernovel['nama'];
					$harga = $pernovel['hrg_jual'];
					$subharga = $pernovel['hrg_jual'] * $jumlah_brg;

					$conn->query("INSERT INTO tb_pembelian_novel (id_pembelian_novel, kd_novel, jumlah, nama, harga, subharga) VALUES('$id_pembelian_barusan', '$id_produk', '$jumlah_brg', '$nama', '$harga', '$subharga')") or die(mysqli_error($conn));

					// mengurangi stok novel, saat pengguna membeli novel di single.php
					mysqli_query($conn, "UPDATE tb_novel SET jumlah_brg = jumlah_brg - $jumlah_brg WHERE kd_novel = '$id_produk'") or die(mysqli_error($conn));
				}

				// mengkosongkan keranjang belanja, stelah memasukan ke DB
				unset($_SESSION['keranjang']);

				// menampilkan pesan & mengalihkan ke halaman nota.php
				echo "<script>alert('Pembelian Berhasil');window.location='nota.php?id=$id_pembelian_barusan';</script>";
			}

			?>

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

		<script src="js/jquery-3.5.1.js"></script>
		<script>
			$(document).ready(function() {
				$.ajax({
					type: 'post',
					url: 'assets/apirajaongkir/data_provinsi.php',
					success: function(hasil_provinsi) {
						$('select[name=provinsi]').html(hasil_provinsi);
					}
				});

				// data distrik
				$('select[name=provinsi]').on('change', function() {
					// ambil id_provinsi dari select provinsi yang di pilih (dari atribut pribadi)
					const id_provinsi_terpilih = $('option:selected', this).attr('id_provinsi');
					// alert(id_provinsi_terpilih);
					$.ajax({
						type: 'post',
						url: 'assets/apirajaongkir/data_distrik.php',
						data: 'id_provinsi=' + id_provinsi_terpilih,
						success: function(hasil_distrik) {
							// console.log(hasil_distrik);
							$('select[name=distrik]').html(hasil_distrik);
						}
					});
				});

				// ekspedisi
				$.ajax({
					type: 'post',
					url: 'assets/apirajaongkir/data_ekspedisi.php',
					success: function(hasil_ekspedisi) {
						// console.log(hasil_ekspedisi);
						$('select[name=ekspedisi]').html(hasil_ekspedisi);
					}
				});

				// ongkir
				$('select[name=ekspedisi]').on('change', function() {
					// mendapatkan ongkos kirim

					// mendapatkan ekspedisi yang dipilih
					const ekspedisi_terpilih = $('select[name=ekspedisi]').val();
					// alert(ekspedisi_terpilih);

					// mendapatkan id_distrik yang dipilih pengguna
					const disktrik_terpilih = $('option:selected', 'select[name=distrik]').attr('id_distrik');
					// alert(disktrik_terpilih);

					// mendapatkan total_berat dari inputan
					const total_berat = $('input[name=total_berat]').val();
					$.ajax({
						type: 'post',
						url: 'assets/apirajaongkir/data_paket.php',
						data: 'ekspedisi=' + ekspedisi_terpilih + '&distrik=' + disktrik_terpilih + '&berat=' + total_berat,
						success: function(hasil_paket) {
							// console.log(hasil_paket);
							$('select[name=paket]').html(hasil_paket);

							// letakkan nama ekpedisi terpilih di input ekspedisi
							$('input[name=input_ekspedisi]').val(ekspedisi_terpilih);
						}
					});
				});

				// ketika inputan distrik klik pilih, atau nama kab/kota
				$('select[name=distrik]').on('change', function() {
					const prov = $('option:selected', this).attr('nama_provinsi');
					const dist = $('option:selected', this).attr('nama_distrik');
					const typ = $('option:selected', this).attr('tipe_distrik');
					const kodep = $('option:selected', this).attr('kodepos');
					// alert(prov);

					$('input[name=input_provinsi]').val(prov);
					$('input[name=input_distrik]').val(dist);
					$('input[name=input_tipe]').val(typ);
					$('input[name=input_kodepos]').val(kodep);
				});

				// ketika inputan paket/ongkir di klik & memilih pos, jne, tiki
				$('select[name=paket]').on('change', function() {
					const paket = $('option:selected', this).attr('paket');
					const ongkir = $('option:selected', this).attr('ongkir');
					const etd = $('option:selected', this).attr('etd');

					$('input[name=input_paket').val(paket);
					$('input[name=input_ongkir').val(ongkir);
					$('input[name=input_estimasi').val(etd);
				});
			});
		</script>
</body>

</html>