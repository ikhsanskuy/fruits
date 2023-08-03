-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:8889
-- Waktu pembuatan: 21 Bulan Mei 2023 pada 05.49
-- Versi server: 5.7.34
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fruit`
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
(1, 'admin', 'admin', 'Admin');

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
(1, 'pelanggan@gmail.com', '123', 'Pelanggan 1', '0218565187', 'Jl. Pisangan Lama 1');

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
(5, 26, '', '', 0, '2022-06-21', '20220621093638'),
(6, 27, 'Pelanggan', 'bca', 20000, '2023-01-23', '20230123065049logo.png'),
(7, 27, 'pelanggan', 'bca', 20000, '2023-01-23', '20230123070947logo.png'),
(8, 28, 'pelanggan', 'mandiri', 50000, '2023-01-23', '20230123071255logo.png'),
(9, 6, 'ef', 'fe', 214, '2023-05-21', '20230521054223Screenshot 2023-05-07 at 21.28.00.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_pemesanan` date NOT NULL,
  `total_pemesanan` int(11) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `status_pemesanan` varchar(50) NOT NULL DEFAULT 'pending',
  `totalberat` int(11) NOT NULL,
  `distrik` varchar(255) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `kodepos` varchar(255) NOT NULL,
  `ekspedisi` varchar(255) NOT NULL,
  `paket` varchar(255) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `estimasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id_pembelian`, `id_pelanggan`, `tanggal_pemesanan`, `total_pemesanan`, `provinsi`, `alamat_pengiriman`, `status_pemesanan`, `totalberat`, `distrik`, `tipe`, `kodepos`, `ekspedisi`, `paket`, `ongkir`, `estimasi`) VALUES
(1, 1, '2023-01-23', 20000, '', '', 'Barang Terkirim', 0, '', '', '', '', '', 0, ''),
(2, 1, '2023-01-23', 50000, '', 'kalimantan', 'Barang Terkirim', 0, '', '', '', '', '', 0, ''),
(3, 1, '2023-02-07', 20000, '', '', 'pending', 0, '', '', '', '', '', 0, ''),
(4, 1, '2023-05-20', 7000, 'Bangka Belitung', '', 'pending', 0, '', '', '', '', '', 0, ''),
(5, 1, '2023-05-21', 38000, 'Bali', 'dsvds', 'pending', 100, 'Badung', 'Kabupaten', '80351', 'pos', 'Pos Reguler', 24000, '4 HARI'),
(6, 1, '2023-05-21', 44000, 'Bali', 'sv', 'Barang Terkirim', 100, 'Badung', 'Kabupaten', '80351', 'jne', 'Pos Reguler', 24000, '4 HARI'),
(7, 1, '2023-05-21', 54000, 'Bali', 'siefhjsie', 'pending', 100, 'Badung', 'Kabupaten', '80351', 'tiki', 'REG', 34000, '3'),
(8, 1, '2023-05-21', 51000, 'Bali', 'jalan bali utara', 'pending', 100, 'Buleleng', 'Kabupaten', '81111', 'tiki', 'REG', 37000, '3');

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
(26, 22, 4, 1, 'Apple', 10000, 10000),
(27, 22, 6, 1, 'Bowl', 5050, 5050),
(28, 23, 2, 1, 'Koko Crunch', 5000, 5000),
(29, 23, 4, 1, 'Apple', 10000, 10000),
(30, 24, 7, 1, 'Reeses Pufs', 5000, 5000),
(31, 24, 3, 2, 'Pabbles', 6000, 6000),
(32, 25, 2, 7, 'Koko Crunch', 7000, 7000),
(33, 26, 3, 1, 'Pabbles', 6000, 6000),
(34, 27, 3, 1, 'Apel', 10000, 10000),
(35, 28, 3, 1, 'Apel', 10000, 10000),
(36, 28, 4, 1, 'Nanas', 10000, 10000),
(37, 0, 3, 1, 'Apel', 10000, 10000),
(38, 29, 3, 1, 'Apel', 10000, 10000),
(39, 30, 2, 1, 'Pisang', 7000, 7000),
(40, 5, 2, 2, 'Pisang', 7000, 7000),
(41, 6, 3, 2, 'Apel', 10000, 10000),
(42, 7, 4, 2, 'Nanas', 10000, 10000),
(43, 8, 2, 2, 'Pisang', 7000, 7000);

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
  `stok_produk` int(10) NOT NULL,
  `berat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `foto_produk`, `deskripsi_produk`, `stok_produk`, `berat`) VALUES
(2, 'Pisang', 7000, 'pisang.png', ' Buah pisang', 16, 50),
(3, 'Apel', 10000, 'apel.png', ' Buah semangka', 14, 50),
(4, 'Nanas', 10000, 'nanas.png', 'Buah nanas', 17, 50),
(7, 'Straweberry', 5000, 'strawberry.png', 'Buah strawberry', 20, 50);

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
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pemesanan_produk`
--
ALTER TABLE `pemesanan_produk`
  MODIFY `id_pemesanan_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
