<?php
include '../koneksi.php';
?>
<h2>Tambah Produk</h2>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama">
	</div>
	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" class="form-control" name="harga">
	</div>
	<div class="form-group">
		<label>Foto</label>
		<input type="file" class="form-control" name="foto">
	</div>
	<div class="form-group">
		<label>Deskripsi</label>
		<textarea type="text" class="form-control" name="deskripsi" rows="10"></textarea>
	</div>
	<div class="form-group">
		<label>Stok</label>
		<input type="number" class="form-control" name="stok" rows="10"></input>
	</div>
	<button class="btn btn-primary" name="save">Simpan</button>
</form>
<?php
if (isset($_POST['save'])) {
	$nama = $_FILES['foto']['name'];
	$lokasi = $_FILES['foto']['tmp_name'];
	$nama_produk      = ($_POST['nama']);
	$harga_produk      = ($_POST['harga']);
	$deskripsi_produk      = ($_POST['deskripsi']);
	$stok_produk      = ($_POST['stok']);
	move_uploaded_file($lokasi, "../assets/foto_produk/" . $nama);
	// $conn->query("INSERT INTO produk
	// 		(nama_produk, harga_produk, foto_produk, deskripsi_produk)
	// 		VALUES('$_POST[nama]','$_POST[harga]','$nama','$_POST[deskripsi]')");
	$query = mysqli_query($conn, "INSERT INTO `produk` (`nama_produk`,`harga_produk`,`foto_produk`,`deskripsi_produk`,`stok_produk`) 
					VALUES ('$nama_produk','$harga_produk','$nama','$deskripsi_produk','$stok_produk')");


	if ($query) {
		echo "<div class='alert alert-info'>Data Tersimpan</div>";
		echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
	} else {
		header("location:./index.php");
	}
}
?>