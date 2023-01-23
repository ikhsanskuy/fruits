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
?>

<!DOCTYPE html>
<html>
<head>
	<title>Eatee.Cereal </title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body style="font-family: monospace;">

<?php include 'menu.php'; ?>

<!-- <pre><?php //print_r($_SESSION) ?></pre> -->

<section class="riwayat">
	<div class="container">
		<h3>Riwayat belanja <?php echo $_SESSION["pelanggan"]["nama_pelanggan"]  ?></h3>

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Tanggal</th>
					<th>Status</th>
					<th>Total</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<body>
				<?php
				$nomor=1;
				//get id pelanggan
				$id_pelanggan = $_SESSION["pelanggan"]['id_pelanggan'];

				$ambil = $koneksi->query("SELECT * FROM pemesanan WHERE id_pelanggan='$id_pelanggan'");
				while($pecah = $ambil->fetch_assoc())
					{
				?>
				<tr>
					<td><?php echo $nomor; ?></td>
					<td><?php echo $pecah["tanggal_pemesanan"] ?></td>
					<td><?php echo $pecah["status_pemesanan"] ?></td>
					<td>Rp. <?php echo number_format($pecah["total_pemesanan"]) ?></td>
					<td>
						<a href="nota.php?id=<?php echo $pecah["id_pembelian"] ?>" class="btn btn-info">Nota</a>

						<?php if ($pecah['status_pemesanan']=="pending"): ?>
							<a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-warning">
								Kirim Bukti Pembayaran
							</a>

						<?php else: ?>
						<a href="lihat_pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-success">
							Lihat Bukti Pembayaran
						</a>
					<?php endif ?>

					</td>
				</tr>
				<?php $nomor++; ?>
				<?php } ?>
			</body>
		</table>

	</div>
</section>
</body>

</html>