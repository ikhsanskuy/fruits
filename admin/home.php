<?php $ambil=$koneksi->query("SELECT * FROM admin"); ?>
<?php while($pecah=$ambil->fetch_assoc() ) { ?>

<p> 
	<h2 style="padding-bottom: 40px;"></h2>
	<h2 style="font-size: 80px; text-align: center;"> Selamat Datang <?php echo $pecah ['nama_lengkap']; ?></h2>
	<h2 style="text-align: center;">Mohon Cek Pemesanan Hari ini</h2>
</p>

<?php } ?>