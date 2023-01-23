<!-- Navbar -->
<nav class="navbar navbar-default" style="font-family: monospace;" >
	<div class="container">
		<ul class="nav navbar-nav">
			<li><a href="index.php"> Home </a></li>
			<li><a href="keranjang.php"> Keranjang </a></li>
			<!-- if sudah login -->

			<?php if (isset($_SESSION["pelanggan"])): ?>
			<li><a href="riwayat.php">Riwayat Pemesanan</a></li>	
			<li><a href="logout.php"> Logout </a></li>
			
			<!-- else belum login -->
			<?php else:  ?>
				<li><a href="login.php"> Login </a></li>
				<li><a href="daftar.php">Daftar</a></li>
			<?php endif ?>

			<li><a href="checkout.php"> Checkout </a></li>
		</ul>

		<form action="pencarian.php" method="get" class="navbar-form navbar-right">
			<input type="text" class="form-control" name="keyword">
			<button class="btn btn-warning">Cari</button>
		</form>
	</div>
</nav>