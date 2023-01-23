-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Okt 2022 pada 11.12
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eatee`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'rafli', 'rafli', 'Rafli Sani');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(10) NOT NULL,
  `nama_kota` varchar(15) NOT NULL,
  `tarif` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'DKI Jakarta', 10000),
(2, 'Luar DKI Jakart', 20000),
(3, 'Luar Pulau Jawa', 30000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(50) NOT NULL,
  `password_pelanggan` varchar(15) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `telepon_pelanggan` varchar(15) NOT NULL,
  `alamat_pelanggan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `telepon_pelanggan`, `alamat_pelanggan`) VALUES
(1, 'raflisani07@gmail.com', 'rafli', 'Rafli', '089501607377', 'Jl. Abdul Ghani Raya'),
(2, 'pelanggan@gmail.com', 'pelanggan', 'Pelanggan 1', '0218565187', 'Jl. Pisangan Lama 1'),
(4, 'AzzamSani@gmail.com', 'azzam02', 'Azzam', '081286859979', 'Jl. Abdul Ghani Raya No. 14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `bank` varchar(15) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(2, 19, 'Rafli', 'BCA', 30000, '2022-05-25', '20220525110318TandaTangan.jpg'),
(3, 20, 'Rafli', 'BCA', 30000, '2022-05-25', '20220525133755gundar.png'),
(4, 21, 'Rafli', 'BCA', 40000, '2022-05-29', '20220529090542Screenshot 2022-04-05 103348.png'),
(5, 26, '', '', 0, '2022-06-21', '20220621093638');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tanggal_pemesanan` date NOT NULL,
  `total_pemesanan` int(11) NOT NULL,
  `nama_kota` varchar(15) NOT NULL,
  `tarif` int(11) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `status_pemesanan` varchar(15) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id_pembelian`, `id_pelanggan`, `id_ongkir`, `tanggal_pemesanan`, `total_pemesanan`, `nama_kota`, `tarif`, `alamat_pengiriman`, `status_pemesanan`) VALUES
(17, 2, 1, '2022-05-23', 21000, 'DKI Jakarta', 10000, '', 'pending'),
(18, 3, 2, '2022-05-23', 25000, 'Luar DKI Jakart', 20000, 'Jl. Kayumanis VI.\r\nNo. 40', 'pending'),
(19, 1, 1, '2022-05-24', 30000, 'DKI Jakarta', 10000, 'Jl. Kayumanis VI No. 40, 08/05, 0606', 'Pemesanan sedan'),
(20, 1, 1, '2022-05-24', 30000, 'DKI Jakarta', 10000, 'Jl. Kayumanis VI No. 40', 'Bukti pembayara'),
(21, 1, 2, '2022-05-25', 40000, 'Luar DKI Jakart', 20000, 'Jl. Kayumanis VI No. 40', 'Bukti pembayara'),
(22, 1, 2, '2022-05-29', 35050, 'Luar DKI Jakart', 20000, 'Jl. Kayumanis VI.\r\nNo. 40', 'pending'),
(23, 1, 2, '2022-06-07', 35000, 'Luar DKI Jakart', 20000, 'Jl. Kayumanis VI.\r\nNo. 40', 'pending'),
(24, 1, 1, '2022-06-07', 27000, 'DKI Jakarta', 10000, 'Jl. Kayumanis VI.\r\nNo. 40', 'pending'),
(25, 2, 1, '2022-06-21', 59000, 'DKI Jakarta', 10000, 'Jl. Kayumanis VI.\r\nNo. 40', 'pending'),
(26, 1, 0, '2022-06-21', 6000, '', 0, '', 'Bukti pembayara');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan_produk`
--

CREATE TABLE `pemesanan_produk` (
  `id_pemesanan_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `subharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemesanan_produk`
--

INSERT INTO `pemesanan_produk` (`id_pemesanan_produk`, `id_pembelian`, `id_produk`, `jumlah`, `nama`, `harga`, `subharga`) VALUES
(1, 1, 1, 1, '', 0, 0),
(2, 1, 1, 1, '', 0, 0),
(3, 12, 2, 1, '', 0, 0),
(4, 12, 3, 1, '', 0, 0),
(5, 12, 4, 1, '', 0, 0),
(6, 13, 2, 1, '', 0, 0),
(7, 13, 3, 1, '', 0, 0),
(8, 13, 4, 1, '', 0, 0),
(9, 14, 2, 1, '', 0, 0),
(10, 14, 3, 1, '', 0, 0),
(11, 15, 2, 1, '', 0, 0),
(12, 15, 5, 1, '', 0, 0),
(13, 16, 2, 1, 'Koko Crunch', 5000, 5000),
(14, 16, 3, 1, 'Pabbles', 6000, 6000),
(15, 17, 2, 1, 'Koko Crunch', 5000, 5000),
(16, 17, 3, 1, 'Pabbles', 6000, 6000),
(17, 0, 4, 1, 'Apple', 10000, 10000),
(18, 0, 5, 1, 'Susu', 5000, 5000),
(19, 18, 2, 1, 'Koko Crunch', 5000, 5000),
(20, 19, 2, 2, 'Koko Crunch', 5000, 5000),
(21, 19, 4, 1, 'Apple', 10000, 10000),
(22, 20, 2, 2, 'Koko Crunch', 5000, 5000),
(23, 20, 4, 1, 'Apple', 10000, 10000),
(24, 21, 7, 2, 'Reeses Pufs', 5000, 5000),
(25, 21, 2, 2, 'Koko Crunch', 5000, 5000),
(26, 22, 4, 1, 'Apple', 10000, 10000),
(27, 22, 6, 1, 'Bowl', 5050, 5050),
(28, 23, 2, 1, 'Koko Crunch', 5000, 5000),
(29, 23, 4, 1, 'Apple', 10000, 10000),
(30, 24, 7, 1, 'Reeses Pufs', 5000, 5000),
(31, 24, 3, 2, 'Pabbles', 6000, 6000),
(32, 25, 2, 7, 'Koko Crunch', 7000, 7000),
(33, 26, 3, 1, 'Pabbles', 6000, 6000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(25) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `foto_produk` varchar(50) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `stok_produk` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `foto_produk`, `deskripsi_produk`, `stok_produk`) VALUES
(2, 'KokoCrunch', 7000, '1603594163340.jpg', '    Cereal coklat dari KokoCrunch', 20),
(3, 'Pabbles', 6000, '1603594118163.jpg', 'Cereal Pabbles', 7),
(4, 'Apple', 10000, 'apple.jpg', 'Cereal apel', 8),
(7, 'Reeses Pufs', 5000, '1603594192030.jpg', 'Menu baru', 7);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indeks untuk tabel `pemesanan_produk`
--
ALTER TABLE `pemesanan_produk`
  ADD PRIMARY KEY (`id_pemesanan_produk`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `pemesanan_produk`
--
ALTER TABLE `pemesanan_produk`
  MODIFY `id_pemesanan_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
