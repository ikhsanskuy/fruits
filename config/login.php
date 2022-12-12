<?php
session_start();
//koneksi
include '../koneksi.php';
?>

<!DOCTYPE html>
<html>

<head>
	<title>Login Pelanggan</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
</head>

<body style="font-family: monospace;">

	<?php include 'menu.php'; ?>

	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Login Pelanggan</h3>
					</div>
					<div class="panel-body">
						<form method="post">
							<div class="form-group">
								<label>Email</label>
								<input type="email" class="form-control" name="email">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" class="form-control" name="password">
							</div>
							<button class="btn btn-primary" name="login">Login</button>
							<h4>belum punya akun?</h4>
							<!-- <button class="btn btn-primary" onclick="window.location.href = 'daftar.php">Daftar</button> -->
							<a class="btn btn-primary" href="daftar.php">daftar</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php

	if (isset($_POST["login"])) {
		$email = $_POST['email'];
		$password = $_POST['password'];

		$ambil = $conn->query("SELECT * FROM pelanggan
		WHERE email_pelanggan='$email' AND password_pelanggan='$password'");

		$akunyangcocok = $ambil->num_rows;

		if ($akunyangcocok == 1) {
			$akun = $ambil->fetch_assoc();
			$_SESSION["pelanggan"] = $akun;
			echo "<script>alert('Sukses login');</script>";

			//sudah ada riwayat pemesanan
			if (isset($_SESSION["keranjang"]) or !empty($_SESSION["keranjang"])) {
				echo "<script>location='checkout.php';</script>";
			} else {
				echo "<script>location='../index.php';</script>";
			}
		} else {
			//gagal login
			echo "<script>alert('Gagal login, periksa kembali email dan password anda');</script>";
			echo "<script>location='login.php';</script>";
		}
	}

	?>

</body>

</html>