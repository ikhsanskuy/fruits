<?php include '../koneksi.php'; ?>
<?php
$keyword = $_GET["keyword"];

$semuadata = array();
$ambil = $conn->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%'
	OR deskripsi_produk LIKE '%$keyword%'");
while ($pecah = $ambil->fetch_assoc()) {
	$semuadata[] = $pecah;
}

// echo "<pre>";
// print_r($semuadata);
// echo "</pre>";
?>

<!DOCTYPE html>
<html>

<head>
	<title>Pencarian</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
</head>

<body style="font-family: monospace;">
	<?php include 'menu.php'; ?>
	<div class="container">
		<h3>Hasil Pencarian : <?php echo $keyword ?></h3>

		<?php if (empty($semuadata)) : ?>
			<div class="alert alert-info"><?php echo $keyword ?> tidak ditemukan</div>
		<?php endif ?>

		<div class="row">

			<?php foreach ($semuadata as $key => $value) : ?>
				<div class="col-md-3">
					<div class="thumbnail">
						<img src="../assets/foto_produk/<?php echo $value["foto_produk"] ?>" alt="" class="img-responsive">
						<div class="caption">
							<h3><?php echo $value["nama_produk"] ?></h3>
							<h5>Rp. <?php echo number_format($value["harga_produk"]) ?></h5>
							<a href="beli.php?id=<?php echo $value["id_produk"]; ?>" class="btn btn-primary">
								Beli</a>
							<a href="detail.php?id=<?php echo $value["id_produk"]; ?>" class="btn btn-default">
								Detail</a>
						</div>
					</div>
				</div>
			<?php endforeach ?>

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