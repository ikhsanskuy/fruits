<?php
session_start();
include '../koneksi.php';
?>

<?php
//id_produk dari database
$id_produk = $_GET["id"];

//query ambil data
$ambil = $conn->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();

// echo "<pre>";
// print_r($detail);
// echo "</pre>";

?>

<!DOCTYPE html>
<html>

<head>
	<title>Eatee.Cereal </title>
	<link rel="stylesheet" href="../css/bootstrap.css">
</head>

<body>

	<?php include 'menu.php'; ?>

	<section class="konten" style="font-family: monospace;">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<img src="../assets/foto_produk/<?php echo $detail["foto_produk"]; ?>" class="img-responsive">
				</div>
				<div class="col-md-6">
					<h2><?php echo $detail["nama_produk"] ?></h2>
					<h4><?php echo number_format($detail["harga_produk"]); ?></h4>
					<h5>Stok : <?php echo $detail['stok_produk'] ?></h5>

					<form method="post">
						<div class="form-group">
							<div class="input-group">
								<input type="number" min="1" class="form-control" name="jumlah" max="<?php echo $detail['stok_produk'] ?>">
								<div class="input-group-btn">
									<button class="btn btn-primary" name="beli">Beli</button>
								</div>
							</div>
						</div>
					</form>

					<?php
					//button beli
					if (isset($_POST["beli"])) {
						//jumlah yang diinput
						$jumlah = $_POST["jumlah"];

						//masuk ke keranjang.php
						$_SESSION["keranjang"][$id_produk] = $jumlah;

						echo "<script>alert('Produk telah masuk kedalam keranjang'); </script>";
						echo "<script>location='keranjang.php';</script>";
					}
					?>

					<p><?php echo $detail["deskripsi_produk"]; ?></p>
				</div>
			</div>
		</div>
	</section> <br>

	<!-- footer -->
	<?php include 'footer.php'; ?>
</body>

</html>