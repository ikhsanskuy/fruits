<?php
session_start();
//koneksi
include 'koneksi.php';


//if no login
if (!isset($_SESSION["pelanggan"]))
{
	echo "<script>alert('Silahkan Login terlebih dahulu');</script>";
	echo "<script>location='login.php';</script>";
}

if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
	echo "<script>alert('Tidak ada produk yang dapat di checkout, silahkan masukkan keranjang terlebih dahulu!');</script>";
	echo "<script>location='index.php';</script>";
}
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
		<h1>Keranjang Belanja</h1>
		<hr>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Produk</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Sub Harga</th>
				</tr>
			</thead>
			<tbody>
				<?php $nomor=1; ?>
				<?php $totalbelanja = 0; ?>
				<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
					<!-- menampilkan produk -->
					<?php
					$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
					$pecah = $ambil->fetch_assoc();
					$subharga = $pecah["harga_produk"]*$jumlah;

					?>
					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $pecah["nama_produk"]; ?></td>
						<td>Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
						<td><?php echo $jumlah ?></td>
						<td>Rp. <?php echo number_format ($subharga); ?></td>
					</tr>
				<?php $nomor++; ?>
				<?php $totalbelanja += $subharga; ?>
				<?php endforeach ?>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="4">Total Pembelian </th>
					<th>Rp. <?php echo number_format($totalbelanja) ?> </th>
				</tr>
			</tfoot>
		</table>

		<form method="post">
			
			<div class="row">
				<div class="col-md-4"> 
					<div class="form-group">
						<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan'] ?>" class="	form-control">
					</div> 
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['telepon_pelanggan'] ?>" class="	form-control">
					</div> 
				</div>
				<div class="col-md-4">
					<select class="form-control" name="id_ongkir">
						<option value="">Pilih ongkos kirim</option>
						<?php 
							$ambil = $koneksi->query("SELECT * FROM ongkir");
							while ($perongkir = $ambil->fetch_assoc()) 
							{
						?>
						<option value="<?php echo $perongkir["id_ongkir"] ?>">
							<?php echo $perongkir['nama_kota'] ?> -
							Rp. <?php echo number_format($perongkir['tarif']) ?> 
						</option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label>Alamat lengkap pengiriman</label>
				<textarea class="form-control" name="alamat_pengiriman" placeholder="Alamat lengkap pengiriman anda, termasuk kode pos"></textarea>
			</div>
			<button class="btn btn-primary" name="checkout">Checkout</button>
		</form>

		<?php 
			if(isset($_POST["checkout"]))
			{
				$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
				$id_ongkir = $_POST["id_ongkir"];
				$tanggal_pemesanan = date("Y-m-d");
				$alamat_pengiriman = $_POST['alamat_pengiriman'];

				$ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
				$arrayongkir = $ambil->fetch_assoc();
				$nama_kota = $arrayongkir['nama_kota'];
				$tarif = $arrayongkir['tarif'];

				$total_pemesanan = $totalbelanja + $tarif;

				// 1. Simpan data ke tabel pemesanan
				$koneksi->query("INSERT INTO pemesanan (id_pelanggan, id_ongkir, tanggal_pemesanan, total_pemesanan, nama_kota, tarif, alamat_pengiriman)
					VALUES ('$id_pelanggan', '$id_ongkir', '$tanggal_pemesanan', '$total_pemesanan', '$nama_kota', '$tarif', '$alamat_pengiriman') ");

				//2. Simpan data ke tabel pemesanan_produk
				$id_pembelian_baru = $koneksi->insert_id;

				foreach ($_SESSION["keranjang"] as $id_produk => $jumlah)
				{
					//mendapatkan data berdasar id_produk
					$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
					$perproduk = $ambil->fetch_assoc();

					$nama = $perproduk['nama_produk'];
					$harga = $perproduk['harga_produk'];

					$subharga = $perproduk['harga_produk'];

					$koneksi->query("INSERT INTO pemesanan_produk (id_pembelian, id_produk, nama, harga, subharga, jumlah) 
						VALUES ('$id_pembelian_baru', '$id_produk', '$nama', '$harga', '$subharga', '$jumlah') ");

					//update stok
					$koneksi->query("UPDATE produk SET stok_produk=stok_produk -$jumlah
						WHERE id_produk='$id_produk'");
				} 

				// kosongkan keranjang setelah checkout
				unset($_SESSION["keranjang"]);

				//3. Tampil ke halaman nota
				echo "<script>alert('Pembelian sukses');</script>";
				echo "<script>location='nota.php?id=$id_pembelian_baru';</script>";
			}
		?>

	</div>
</section>

<!-- <pre><?php print_r($_SESSION['pelanggan']) ?></pre> -->
<!-- <pre><?php print_r($_SESSION["keranjang"]) ?></pre> -->

</body> <br>

<!-- footer -->
<?php include 'footer.php'; ?>
</html>