<?php
session_start();
//koneksi
include 'koneksi.php';


//if no login
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
{
	echo "<script>alert('Silahkan Login terlebih dahulu');</script>";
	echo "<script>location='login.php';</script>";
	exit();
}

//get id_pembelian 
$idpem = $_GET["id"];
$ambil = $koneksi->query ("SELECT * FROM pemesanan WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();

//get id_pelanggan yang pesan
$id_pelanggan_beli = $detpem["id_pelanggan"];

//get id_pelanggan yang login
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

if ($id_pelanggan_login !== $id_pelanggan_beli)
{
	echo "<script>alert('Maaf nota ini bukan milik anda');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}


?>


<!DOCTYPE html>
<html>
<head>
	<title>Pembayaran</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body style="font-family: monospace;">
<?php include 'menu.php'; ?>

	<div class="container">
		<h2>Konfirmasi Pembayaran</h2>
		<p>Kirim bukti pembayaran</p>
		<div class="alert alert-info">Total tagihan anda <strong>Rp. <?php echo number_format($detpem["total_pemesanan"]) ?></strong></div>

		<form method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Nama Pengirim</label>
				<input type="text" class="form-control" name="nama">
			</div>
			<div class="form-group">
				<label>Bank</label>
				<input type="text" class="form-control" name="bank">
			</div>
			<div class="form-group">
				<label>Jumlah</label>
				<input type="number" class="form-control" name="jumlah" min="1">
			</div>
			<div class="form-group">
				<label>Foto bukti pembayaran</label>
				<input type="file" class="form-control" name="bukti">
				<p class="text-danger">Format foto JPG max 2 mb</p>
			</div>
			<button class="btn btn-primary" name="kirim">Kirim</button>
		</form>
	</div> <br>

<?php
//insert ke database
if (isset($_POST["kirim"])) 
{
	$namabukti = $_FILES["bukti"]["name"];
	$lokasibukti = $_FILES["bukti"]["tmp_name"];
	$namafix = date("YmdHis").$namabukti;
	move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafix");

	$nama = $_POST["nama"];
	$bank = $_POST["bank"];
	$jumlah = $_POST["jumlah"];
	$tanggal = date("Y-m-d");

	//simpan pembayaran
	$koneksi->query("INSERT INTO pembayaran(id_pembelian, nama, bank, jumlah, tanggal, bukti)
		VALUES ('$idpem', '$nama', '$bank', '$jumlah', '$tanggal', '$namafix') ");

	//update database pemesanan
	$koneksi->query("UPDATE pemesanan SET status_pemesanan='Bukti pembayaran terkirim'
		WHERE id_pembelian='$idpem'");

	echo "<script>alert('Terimakasih atas bukti pembayarannya, pesanan kamu akan kami proses');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
?>

<!-- footer -->
<?php include 'footer.php'; ?>

</body>
</html>