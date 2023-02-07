<?php

$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$update = mysqli_query($koneksi, "UPDATE `pemesanan` SET `status_pemesanan` = 'Barang Terkirim' WHERE `id_pembelian` = '$id' ");

if (mysqli_affected_rows($koneksi)) {
    echo "<script>alert('Barang sudah dikirim'); 
    location.href='index.php?halaman=pemesanan';</script>";
} else {
    echo "<script>alert('Barang gagal dikirim'); 
    location.href='index.php?halaman=pemesanan';</script>";
}
