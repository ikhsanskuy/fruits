<?php 
session_start();
include 'koneksi.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Checkout</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body style="font-family: monospace;">

<?php include 'menu.php'; ?>

<section class="konten">
	<div class="container">
		
		<!-- Nota dari admin/detail.php -->
		<h2>Detail Pembelian</h2>

<?php 
$ambil = $koneksi->query("SELECT * FROM pemesanan JOIN pelanggan ON pemesanan.id_pelanggan=pelanggan.id_pelanggan WHERE pemesanan.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>
<!-- <pre><?php //print_r($detail); ?></pre> -->

<!-- logika agar tidak bisa masuk nota orang lain -->
<?php 
$idpelangganbeli = $detail["id_pelanggan"];

$idpelangganlogin = $_SESSION["pelanggan"]["id_pelanggan"];

if ($idpelangganbeli!==$idpelangganlogin)
{
	echo "<script>alert('Maaf nota bukan milik anda')</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
?>

<div class="row">
	<div class="col-md-4">
		<h3>Pembelian</h3>
		<strong>Nomor Pembelian : <?php echo $detail['id_pembelian'] ?></strong> <br>
		Tanggal : <?php echo $detail['tanggal_pemesanan']; ?> <br>
		Total : Rp. <?php echo number_format($detail['total_pemesanan']) ?>
	</div>
	<div class="col-md-4">
		<h3>Pelanggan</h3>
		<strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
		<p>
			<?php echo $detail['email_pelanggan']; ?> <br>
			<?php echo $detail['telepon_pelanggan']; ?>
		</p>
	</div>
	<div class="col-md-4">
		<h3>Pengiriman</h3>
		<strong>Tujuan : <?= $detail['tipe'] ?> <?= $detail['distrik'] ?>,<?= $detail['provinsi'] ?></strong> <br>
		Ongkos kirim : Rp. <?php echo number_format($detail['ongkir']); ?> <br>
		Alamat : <?php echo $detail['alamat_pengiriman'] ?>
	</div>
</div>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Produk</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<!-- <th>Ongkir</th> -->
			<th>Subtotal</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pemesanan_produk WHERE id_pembelian='$_GET[id]' "); ?>
		<?php while($pecah=$ambil->fetch_assoc()) { ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama']; ?></td>
			<td>Rp. <?php echo number_format ($pecah['harga']); ?></td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<!-- <td><?php echo $pecah['ongkir']; ?></td> -->
			<!-- <td>Rp. <?php echo number_format($pecah['subharga']); ?></td> -->
			<td>Rp. <?php echo number_format ($pecah['subharga']*$pecah['jumlah']); ?></td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>

<div class="row">
	<div class="col-md-12">
		<div class="alert alert-info">
			<p>
				<strong>Silahkan melakukan pembayaran Rp. <?php echo number_format($detail['total_pemesanan']); ?></strong> <br> <br>
				<strong>Bca 1671313891 Alvin Rivandha</strong> <br>
				<strong>Gopay 081381546017</strong> <br>
				<strong>Dana 081381546017</strong> <br><br>
			</p>
			<p class="text-danger"> <strong>Mohon Kirim bukti pembayaran max 1 x 24 jam</strong></p>
			<p class="text-danger"> <strong>Bukti pembayaran dapat dikirim pada <a href="riwayat.php">riwayat pemesanan</a> </strong> </p>
		</div>
	</div>
</div>

	</div>
</section>

<!-- footer -->
<?php include 'footer.php'; ?>

</body>
</html>