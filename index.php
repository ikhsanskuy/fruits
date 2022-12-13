<?php
session_start();
//koneksi
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Angkringan Ceria</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/stylefooter.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-default" style="font-family: monospace;">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><a href="index.php"> <img src="assets/logoremovebg.png" alt="logo" width="60" height="60"> </a></li>
                <li><a href="config/keranjang.php"> Keranjang </a></li>
                <!-- if sudah login -->

                <?php if (isset($_SESSION["pelanggan"])) : ?>
                    <li><a href="config/riwayat.php">Riwayat Pemesanan</a></li>
                    <li><a href="config/logout.php"> Logout </a></li>

                    <!-- else belum login -->
                <?php else :  ?>
                    <li><a href="config/login.php"> Login </a></li>
                    <li><a href="config/daftar.php">Daftar</a></li>
                <?php endif ?>

                <li><a href="config/checkout.php"> Checkout </a></li>
            </ul>

            <form action="config/pencarian.php" method="get" class="navbar-form navbar-right">
                <input type="text" class="form-control" name="keyword">
                <button class="btn btn-warning">Cari</button>
            </form>
        </div>
    </nav>


    <!-- Konten -->

    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <!-- <img src="assets/logo.png" alt="" width="50" height="50"> -->
                <h1 class="display-4 fw-bolder">Angkringan Ceria</h1>
                <p class="lead fw-normal text-white-50 mb-0">Selamat Berbelanja</p>
            </div>
        </div>
    </header>

    <section class="konten" style="font-family: monospace;">
        <div class="container">

            <div class="row">

                <?php $ambil = $conn->query("SELECT * FROM produk "); ?>
                <?php while ($perproduk = $ambil->fetch_assoc()) { ?>
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img src="assets/foto_produk/<?php echo $perproduk['foto_produk']; ?>" width="200" height="200" >
                            <div class="caption text-center">
                                <h3><?php echo $perproduk['nama_produk']; ?></h3>
                                <h5>Rp. <?php echo number_format($perproduk['harga_produk']); ?></h5>
                                <a href="config/beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary">
                                    Beli</a>
                                <a href="config/detail.php?id=<?php echo $perproduk["id_produk"]; ?>" class="btn btn-default">Detail</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </section>
    </div>
</body>

<!-- footer -->
<footer>
    <div class="footer-content">
        <h3>Angkringan Ceria</h3>
        <p>Hubungi Kami disini</p>
        <ul class="socials">
            <li><a href="https://wa.me/6289677978072"><i class="fa fa-whatsapp"></i></a></li>
            <li><a href="https://www.instagram.com/ceriaangkringan/"><i class="fa fa-instagram"></i></a></li>

        </ul>
    </div>
    <div class="footer-bottom">
        <p>Copyright &copy; 2022 codeOpacity. designed by <span>Angkringan Ceria</span></p>
    </div>
</footer>

</html>