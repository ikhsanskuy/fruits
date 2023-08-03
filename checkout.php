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
				<?php $totalberat = 0; ?>
				<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
					<!-- menampilkan produk -->
					<?php
					$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
					$pecah = $ambil->fetch_assoc();
					$subharga = $pecah["harga_produk"]*$jumlah;
					$subberat = $pecah["berat"] * $jumlah;
					$totalberat+=$subberat;
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
				<div class="col-md-3">
					<label>Provinsi</label>
					<select class="form-control" name="nama_provinsi">
					</select>
				</div>
				<div class="col-md-3">
				<label>Distrik</label>
					<select class="form-control" name="nama_distrik">
					</select>
				</div>
				<div class="col-md-3">
				<label>Ekspedisi</label>
					<select class="form-control" name="nama_ekspedisi">
					</select>
				</div>
				<div class="col-md-3">
				<label>Paket</label>
					<select class="form-control" name="nama_paket">
					</select>
				</div>
				<div class="form-group">
					<label>Alamat lengkap</label>
					<textarea class="form-control" name="alamat_pengiriman" placeholder="Alamat lengkap pengiriman anda"></textarea>
				</div>
			</div>
			<button class="btn btn-primary" name="checkout">Checkout</button>
			<input type="hidden" name="total_berat" value="<?php echo $totalberat; ?>">
			<input type="hidden" name="provinsi">
			<input type="hidden" name="distrik">
			<input type="hidden" name="tipe">
			<input type="hidden" name="kodepos">
			<input type="hidden" name="ekspedisi">
			<input type="hidden" name="paket">
			<input type="hidden" name="ongkir">
			<input type="hidden" name="estimasi">
			<input type="hidden" name="ongkir">
			<!-- <input type="text" name="alamat_pengiriman"> -->
		</form> 

		<?php 
			if(isset($_POST["checkout"]))
			{
				$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
				$tanggal_pemesanan = date("Y-m-d");
				$alamat_pengiriman = $_POST['alamat_pengiriman'];
				$provinsi = $_POST['provinsi'];
				$totalberat = $_POST["total_berat"];
				$distrik = $_POST["distrik"];
				$tipe = $_POST["tipe"];
				$kodepos = $_POST["kodepos"];
				$ekspedisi = $_POST["ekspedisi"];
				$paket = $_POST["paket"];
				$ongkir = $_POST["ongkir"];
				$estimasi = $_POST["estimasi"];
				// $ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
				// $arrayongkir = $ambil->fetch_assoc();
				// $nama_kota = $arrayongkir['nama_kota'];
				// $tarif = $arrayongkir['tarif'];

				$total_pemesanan = $totalbelanja + $ongkir;

				// 1. Simpan data ke tabel pemesanan
				$koneksi->query("INSERT INTO pemesanan (provinsi,id_pelanggan, tanggal_pemesanan, total_pemesanan,alamat_pengiriman,totalberat,distrik,tipe,kodepos,ekspedisi,paket,ongkir,estimasi)
					VALUES ('$provinsi','$id_pelanggan', '$tanggal_pemesanan', '$total_pemesanan', '$alamat_pengiriman','$totalberat','$distrik','$tipe','$kodepos','$ekspedisi','$paket','$ongkir','$estimasi') ");

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
	$(document).ready(function(){
		$.ajax({
			type: "POST",
			url:'api/provinsi.php',
			success: function(hasil_provinsi)
			{
				$("select[name=nama_provinsi]").html(hasil_provinsi);
			}
		});
		$("select[name=nama_provinsi]").on("change", function(){
		var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
		$.ajax({
			type: "POST",
			url:'api/distrik.php',
			data: 'id_provinsi='+id_provinsi_terpilih,
			success: function(hasil_distrik){
				$("select[name=nama_distrik]").html(hasil_distrik);
			}
		});
		});
		$.ajax({
			type: "POST",
			url:'api/ekspedisi.php',
			success: function(hasil_ekspedisi){
				$("select[name=nama_ekspedisi").html(hasil_ekspedisi);
			}
		});
		$("select[name=nama_ekspedisi]").on("change", function(){
		var ekspedisi_terpilih = $("select[name=nama_ekspedisi]").val();
		var distrik_terpilih = $("option:selected","select[name=nama_distrik]").attr("id_distrik");

		var total_berat=  $("input[name=total_berat]").val();
		$.ajax({
			type: "POST",
			url:'api/paket.php',
			data:
			'ekspedisi='+ekspedisi_terpilih+
			'&distrik='+distrik_terpilih+
			'&berat='+total_berat,
			success: function(hasil_paket)
			{
				$("select[name=nama_paket").html(hasil_paket);
				$("input[name=ekspedisi").val(ekspedisi_terpilih);

			}
		})
	});
	$("select[name=nama_distrik]").on("change", function(){
		var prov = $("option:selected",this).attr("nama_provinsi");
		var dist = $("option:selected",this).attr("nama_distrik");
		var tipe = $("option:selected",this).attr("tipe");
		var kodepos = $("option:selected",this).attr("kodepos");

		$("input[name=provinsi]").val(prov);
		$("input[name=distrik]").val(dist);
		$("input[name=tipe]").val(tipe);
		$("input[name=kodepos]").val(kodepos);
		
		$("select[name=nama_paket]").on("change", function(){
			var paket = $("option:selected",this).attr("paket");
			var ongkir = $("option:selected",this).attr("ongkir");
			var etd = $("option:selected",this).attr("etd");
			$("input[name=paket]").val(paket);
			$("input[name=ongkir]").val(ongkir);
			$("input[name=estimasi]").val(etd);
		})
	})
	});
</script>
</body> <br>

<!-- footer -->
<?php include 'footer.php'; ?>
</html>

