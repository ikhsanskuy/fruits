<?php 
session_start();

//id produk
$id_produk = $_GET['id'];

//produk +1
if(isset($_SESSION['keranjang'][$id_produk]))
{
	$_SESSION['keranjang'][$id_produk]+=1;
}

//jika kosong maka dibeli 1
else 
{
	$_SESSION['keranjang'][$id_produk] = 1;
}


echo "<script>alert('Produk ditambahkan di keranjang belanja anda!');</script>";
echo "<script>location='keranjang.php';</script>";

?>