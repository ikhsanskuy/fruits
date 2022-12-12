<?php
session_start();
include '../koneksi.php';

?>

<!DOCTYPE html>
<html>

<head>
	<title>Checkout</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
</head>

<body style="font-family: monospace;">

	<?php include 'menu.php'; ?>

	<section class="konten">
		<div class="container">

			<!-- Nota dari admin/detail.php -->
			<h2>Detail Pembelian</h2>

			<?php
			$ambil = $conn->query("SELECT * FROM pemesanan JOIN pelanggan ON pemesanan.id_pelanggan=pelanggan.id_pelanggan WHERE pemesanan.id_pembelian='$_GET[id]'");
			$detail = $ambil->fetch_assoc();
			?>
			<!-- <pre><?php //print_r($detail); 
						?></pre> -->

			<!-- logika agar tidak bisa masuk nota orang lain -->
			<?php
			$idpelangganbeli = $detail["id_pelanggan"];
			$pembayaran = $detail["nama_kota"];

			$idpelangganlogin = $_SESSION["pelanggan"]["id_pelanggan"];

			if ($idpelangganbeli !== $idpelangganlogin) {
				echo "<script>alert('Maaf nota bukan milik anda')</script>";
				echo "<script>location='riwayat.php';</script>";
				exit();
			}
			?>

			<div class="row">
				<div class="col-md-5">
					<h3>Pembelian</h3>
					<strong>Nomor Pembelian : <?php echo $detail['id_pembelian'] ?></strong> <br>
					Tanggal : <?php echo $detail['tanggal_pemesanan']; ?> <br>
				</div>
				<div class="col-md-4">
					<h3>Pelanggan</h3>
					<strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
					<p>
						<?php echo $detail['email_pelanggan']; ?> <br>
						<?php echo $detail['telepon_pelanggan']; ?>
					</p>
				</div>
			</div>

			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Produk</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Subtotal</th>
					</tr>
				</thead>
				<tbody>
					<?php $nomor = 1; ?>
					<?php $ambil = $conn->query("SELECT * FROM pemesanan_produk WHERE id_pembelian='$_GET[id]' "); ?>
					<?php while (
						$pecah = $ambil->fetch_assoc()
					) { ?>
						<?php
						$totalbelanja = 0;
						$jumlah = $pecah['jumlah'];
						$subharga = $pecah["harga"] * $jumlah;
						?>
						<tr>
							<td><?php echo $nomor; ?></td>
							<td><?php echo $pecah['nama']; ?></td>
							<td>Rp. <?php echo number_format($pecah['harga']); ?></td>
							<td><?php echo ($jumlah); ?></td>
							<td>Rp. <?php echo number_format($subharga); ?></td>
						</tr>
						<?php $nomor++; ?>
						<?php $totalbelanja += $subharga; ?>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="4">Total Pembelian </th>
						<th>Rp. <?php echo number_format($totalbelanja) ?> </th>
					</tr>
				</tfoot>
			</table>
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-info">
						<?php if ($pembayaran == 'Transfer') {
							echo "<strong>Silahkan melakukan pembayaran, dan upload bukti transfer ke <a href=riwayat.php>Riwayat Pemesanan</a> </strong> <br> <br>
							<strong> BANK BCA 123456 AN. Angkringan Ceria</strong>";
						} else {
							echo "silahkan bayar dikasir";
						}
						?>
					</div>
				</div>
			</div>

		</div>
	</section>

	<!-- footer -->
	<?php include 'footer.php'; ?>

</body>

</html>