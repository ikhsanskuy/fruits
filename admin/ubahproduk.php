<h2>Ubah Produk</h2>
<?php
include '../koneksi.php';
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();

?>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Produk</label>
		<input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Harga Produk Rp.</label>
		<input type="number" class="form-control" name="harga" value="<?php echo $pecah['harga_produk']; ?>">
	</div>
	<div class="form-group">
		<img src="../assets/foto_produk/<?php echo $pecah['foto_produk'] ?>" width="200">
	</div>
	<div class="form-group">
		<label>Ganti Foto</label>
		<input type="file" class="form-control" name="foto">
	</div>
	<div class="form-group">
		<label>Stok produk</label>
		<input type="number" class="form-control" name="stok" value="<?php echo $pecah['stok_produk']; ?>">
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<textarea class="form-control" name="deskripsi" rows="10"> <?php echo $pecah['deskripsi_produk']; ?></textarea>
	</div>
	<button class="btn btn-primary" name="ubah">Ubah</button>
</form>

<?php
if (isset($_POST['ubah'])) {
	$namafoto = $_FILES['foto']['name'];
	$lokasifoto = $_FILES['foto']['tmp_name'];
	$nama_produk      = ($_POST['nama']);
	$harga_produk      = ($_POST['harga']);
	$deskripsi_produk      = ($_POST['deskripsi']);
	$stok_produk      = ($_POST['stok']);
	// jika foto diubah
	if (!empty($lokasifoto)) {
		move_uploaded_file($lokasifoto, "../assets/foto_produk/$namafoto");

		$query = mysqli_query($conn, "UPDATE `produk` SET 
		`nama_produk` = '$nama_produk', 
		`harga_produk` = '$harga_produk', 
		`foto_produk` = '$namafoto', 
		`deskripsi_produk` = '$deskripsi_produk', 
		`stok_produk` = '$stok_produk' 
		WHERE `id_produk` = '$_GET[id]'");
	} else {

		$query = mysqli_query($conn, "UPDATE `produk` SET 
		`nama_produk` = '$nama_produk', 
		`harga_produk` = '$harga_produk', 
		`deskripsi_produk` = '$deskripsi_produk' 
		`stok_produk` = '$stok_produk' 
		WHERE `id_produk` = '$_GET[id]'");
	}



	if ($query) {
		echo "<script>alert('Produk Diubah'); </script>";
		echo "<script>location='index.php?halaman=produk'; </script>";
	} else {
		echo "<script>alert('Produk Gagal Diubah'); </script>";
		echo "<script>location='index.php?halaman=produk'; </script>";
	}
}

?>