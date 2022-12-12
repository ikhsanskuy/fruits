<?php
session_start();
include '../koneksi.php';

$id_pembelian = $_GET["id"];

$ambil = $conn->query("SELECT * FROM pembayaran
	LEFT JOIN pemesanan ON pembayaran.id_pembelian=pemesanan.id_pembelian
	WHERE pemesanan.id_pembelian='$id_pembelian'");
$detbay = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($detbay);
// echo "</pre>";

//if belum bayar
if (empty($detbay)) {
	echo "<script>alert('Belum ada data pembayaran');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}

//if data pelanggan tidak sesuai
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
if ($_SESSION["pelanggan"]['id_pelanggan'] !== $detbay["id_pelanggan"]) {
	echo "<script>alert('Maaf anda bukan pemilik data ini!');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Lihat Bukti Pembayaran</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
</head>

<body style="font-family: monospace;">
	<?php include 'menu.php'; ?>

	<div class="container">
		<h3>Bukti Pembayaran</h3>
		<div class="row">
			<div class="col-md-6">
				<table class="table">
					<tr>
						<th>Nama</th>
						<td><?php echo $detbay["nama"] ?></td>
					</tr>
					<tr>
						<th>Bank</th>
						<td><?php echo $detbay["bank"] ?></td>
					</tr>
					<tr>
						<th>Tanggal</th>
						<td><?php echo $detbay["tanggal_pemesanan"] ?></td>
					</tr>
					<tr>
						<th>Jumlah</th>
						<td>Rp. <?php echo number_format($detbay["jumlah"]) ?></td>
					</tr>
				</table>
			</div>
			<div class="col-md-6">
				<img src="../assets/bukti_pembayaran/<?php echo $detbay["bukti"] ?>" alt="" class="img-responsive">
			</div>
		</div>
	</div>

	<!-- footer -->
	<div class="footer" style="padding:25px 0">
		<div class="container">
			<small">Copyright &copy; 2022 - Eatee.Cereal</small>
		</div>
	</div>

</body>

</html>