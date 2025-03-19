-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Mar 2025 pada 10.22
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `cabang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username`, `password`, `nama`, `jabatan`, `telepon`, `cabang`) VALUES
(12, 'suhendro_it', '21232f297a57a5a743894a0e4a801fc3', 'Suhendro Purnomo', 'IT', '085863440339', 'Jakarta'),
(19, 'budi_it', '21232f297a57a5a743894a0e4a801fc3', 'Budi Mulyono', 'IT', '082299990622', 'Jakarta'),
(27, 'widi_korcap', '21232f297a57a5a743894a0e4a801fc3', 'Widianto', 'Korcap', '081808081981', 'Tangerang'),
(32, 'edi_korcap', '21232f297a57a5a743894a0e4a801fc3', 'Edi', 'Korcap', 'xxx', 'Jakarta');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_batangan`
--

CREATE TABLE `tb_batangan` (
  `id_batangan` int(11) NOT NULL,
  `nama_operator` varchar(255) NOT NULL,
  `penempatan` varchar(255) NOT NULL,
  `jenis_unit` varchar(255) NOT NULL,
  `merek_unit` varchar(255) NOT NULL,
  `tonase` varchar(255) NOT NULL,
  `no_unit` varchar(255) NOT NULL,
  `nama_helper` varchar(255) NOT NULL,
  `foto_mou` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_batangan`
--

INSERT INTO `tb_batangan` (`id_batangan`, `nama_operator`, `penempatan`, `jenis_unit`, `merek_unit`, `tonase`, `no_unit`, `nama_helper`, `foto_mou`) VALUES
(1, 'Lama Irwandi R', 'Palembang', 'TMC (Truck Mounted Crane)', 'Kobelco', '10 ton', '12/89940/09', 'Mandor', '07012025103133mou.jpg'),
(2, 'Budi Agustine', 'Tanggerang', 'Roughter Crane', 'Sany', '10 ton', '12/89940/10', 'Rendy Oktani', '07012025103144mou.jpg'),
(4, 'Andi Lobakus', 'Cikarang', 'Mobil Crane', 'Kato', '10 ton', '12/89940/10', 'Rendy Oktani', '07012025103159mou.jpg'),
(5, 'Andi Stepen', 'Cikarang', 'Mobil Crane', 'Hyundai', '50 Ton', '12/89940/09', 'Ronald', '07012025103214mou.jpg'),
(6, 'Deni Mulyadi ', 'Tangerang', 'Crawler Crane', 'Zoomlion', '50 Ton', '12/89940/10', 'Bimo Akbar', '13022025080349mou.jpg'),
(7, 'Tito Karnavian', 'Jakarta', 'Crawler Crane', 'Tadano', '110 Ton', '12/89940/19', 'Mandor', '13022025080409mou.jpg'),
(8, 'Joko Burhanudin', 'Tangerang', 'TMC (Truck Mounted Crane)', 'Kato', '150 Ton', '12/89940/15', 'Loki', '12022025155133mou.jpg'),
(9, 'Petrick', 'Jakarta', 'TMC (Truck Mounted Crane)', 'JLG', '150 Ton', '12/89940/15', 'Jimy', '13022025080443mou.jpg'),
(10, 'Petrus', 'Cikarang', 'Spider', 'IHI', '110 Ton', '12/89940/10', 'Bimo', '13022025080540mou.jpg'),
(12, 'Islam akbar Monarki', 'Tangerang', 'TMC (Truck Mounted Crane)', 'JLG', '150 Ton', '12/89940/10', 'Bimo Akbar', '12022025155205mou.jpg'),
(15, 'Juno', 'Semarang', 'Forklift', 'Doosan', '50 Ton', '12/89940/19', 'Jimy', '13022025080637mou.jpg'),
(16, 'Robi Komarudin', 'Tangerang', 'Crawler Crane', 'Zoomlion', '50 Ton', '12/89940/43', 'Bimo Subagia', '13022025080735mou.jpg'),
(17, 'Kopral', 'Tangerang', 'Menlift', 'Tadano', '110 Ton', '12/89940/90', 'Ronald', '13022025080750mou.jpg'),
(18, 'Herman Bambang', 'Semarang', 'Mobil Crane', 'Doosan', '100 Ton', '12/89940/15', 'Jimy', '13022025080816mou.jpg'),
(19, 'Pandi Kosware', 'Tangerang', 'Roughter Crane', 'Zoomlion', '25 Ton', '12/89940/15', 'Rendy Oktani', '12022025155045struk.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_cabang`
--

CREATE TABLE `tb_cabang` (
  `id_cabang` int(11) NOT NULL,
  `nama_cabang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_cabang`
--

INSERT INTO `tb_cabang` (`id_cabang`, `nama_cabang`) VALUES
(1, 'Jakarta'),
(2, 'Cikarang'),
(3, 'Tangerang'),
(4, 'Balikpapan'),
(5, 'Palembang'),
(6, 'Semarang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_lain_lain`
--

CREATE TABLE `tb_lain_lain` (
  `id_biaya` int(11) NOT NULL,
  `nama_operator` varchar(255) NOT NULL,
  `penempatan` varchar(255) NOT NULL,
  `jenis_unit` varchar(255) NOT NULL,
  `merek_unit` varchar(255) NOT NULL,
  `tonase` varchar(255) NOT NULL,
  `no_unit` varchar(255) NOT NULL,
  `keterangan_biaya` varchar(255) NOT NULL,
  `waktu` varchar(255) NOT NULL,
  `foto_keterangan` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_lain_lain`
--

INSERT INTO `tb_lain_lain` (`id_biaya`, `nama_operator`, `penempatan`, `jenis_unit`, `merek_unit`, `tonase`, `no_unit`, `keterangan_biaya`, `waktu`, `foto_keterangan`) VALUES
(1, 'Joko Burhanudin', 'Palembang', 'TMC (Truck Mounted Crane)', 'Zoomlion', '80 Ton', '12/89940/15', 'Mel', '2025-02-10', '13022025144543mou.jpg'),
(2, 'Budi Mansur', 'Palembang', 'TMC (Truck Mounted Crane)', 'Lain Lain', '150 Ton', '12/89940/10', 'Mel', '2025-02-10', '11022025030412struk.jpg'),
(4, 'Ferry Irwandi Ortega', 'Semarang', 'Forklift', 'Kobelco', '100', '12/89940/90', 'Mel', '2025-02-09', '11022025030206Kejadian.jpeg'),
(6, 'Bambang Prakoso', 'Tangerang', 'TMC (Truck Mounted Crane)', 'Doosan', '100 Ton', '12/89940/15', 'Mel Polisi', '2025-02-07', '12022025053721Kejadian.jpeg'),
(7, 'Agus Martono', 'Tangerang', 'Crawler Crane', 'Zoomlion', '100 Ton', '12/89940/11', 'Mel Polisi', '2025-02-12', 'mou.jpg'),
(8, 'Bagus Mulyadi', 'Tangerang', 'Mobil Crane', 'Doosan', '100 Ton', '12/89940/09', 'Mel Ormas', '2025-02-12', '12022025053449Kejadian.jpeg'),
(9, 'Budi Hokmen', 'Tangerang', 'Crawler Crane', 'JLG', '150 Ton', '12/89940/90', 'Mel Dishub', '2025-02-12', '13022025152056struk.jpg'),
(10, 'Sakur', 'Jakarta', 'Forklift', 'Zoomlion', '100 Ton', '12/89940/09', 'Mel', '2025-02-12', 'struk.jpg'),
(11, 'Bagas', 'Jakarta', 'Forklift', 'Doosan', '100 Ton', '12/89940/77', 'Mel Polisi', '2025-02-12', '13022025080957struk.jpg'),
(12, 'Joko Wanda', 'Jakarta', 'Forklift', 'Sany', '10 ton', '12/89940/10', 'Mel Polisi', '2025-02-12', 'struk.jpg'),
(13, 'Muhammad Iqbal', 'Balikpapan', 'Crawler Crane', 'Tadano', '50 Ton', '12/89940/10', 'Mel Polisi', '2025-02-03', 'struk.jpg'),
(19, 'x', 'Cikarang', 'TMC (Truck Mounted Crane)', 'Hyundai', 'x', 'x', 'Mel', '2025-02-25', 'Ramadhan 1.jpg'),
(20, 'y', 'Cikarang', 'TMC (Truck Mounted Crane)', 'Cutter Pillar', 'y', 'y', 'Mel Dishub', '2025-02-26', 'Ramadhan 1.jpg'),
(21, 'xx', 'Cikarang', 'Crawler Crane', 'Doosan', 'xx', 'xx', 'Mel', '2025-02-26', 'Ramadhan 1.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_laporan`
--

CREATE TABLE `tb_laporan` (
  `id_laporan` int(11) NOT NULL,
  `nama_operator_report` varchar(255) NOT NULL,
  `no_sio_opr` varchar(255) NOT NULL,
  `penempatan` varchar(255) NOT NULL,
  `tgl_kejadian` date NOT NULL,
  `kejadian` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `no_berita_acara` varchar(255) NOT NULL,
  `foto_kejadian` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_laporan`
--

INSERT INTO `tb_laporan` (`id_laporan`, `nama_operator_report`, `no_sio_opr`, `penempatan`, `tgl_kejadian`, `kejadian`, `note`, `no_berita_acara`, `foto_kejadian`) VALUES
(34, 'Agus Priyono Budianto', '9898977797', 'Tangerang', '2024-12-08', 'Kecelakaan Kerja', 'Jatuh ketiban tangga', '2024/12/18003', '11022025170505Kejadian.jpeg'),
(35, 'Loki Mangku Bumi', '838747287', 'Tangerang', '2024-12-19', 'Kecelakaan Kerja', 'Nabrak orang', '2024/12/18003', '03022025052922Kejadian.jpeg'),
(38, 'Roby Monarki', '8889432466', 'Jakarta', '2024-12-20', 'Kecelakaan Kerja', 'ketabrak mobil', '2024/12/18001', '09012025052525Kejadian.jpeg'),
(39, 'Bumi Pitulaka Putra', '8889432498', 'Jakarta', '2024-12-20', 'Bolos', 'Nabrak orang dan meninggal', '2024/12/18006', '20122024041027download (2).jpeg'),
(42, 'Jacky Murtado', '8889432498', 'Tangerang', '2024-12-24', 'Kecelakaan Kerja', 'Jatuh ketiban tangga 5 m', '2024/12/18004', '31122024045110sertif4.jpg'),
(44, 'Bokir al Khindi', '8889432498', 'Semarang', '2024-12-31', 'Bolos', 'Pulang cepat ', '2024/12/18007', '31122024053620sertif2.jpg'),
(46, 'Bogo Akbar', '8889432498', 'Jakarta', '2025-01-09', 'Kecelakaan Kerja', 'Nabrak orang dan meninggal', '2024/12/18006', '09012025052713Kejadian.jpeg'),
(47, 'Korfan Ali', '8889432498', 'Jakarta', '2025-01-08', 'Kecelakaan Kerja', 'Nabrak orang', '2024/12/18001', '09012025061249Kejadian.jpeg'),
(48, 'Regi Marsudurini', '8889432498', 'Jakarta', '2025-02-03', 'Kecelakaan Kerja', 'Tidak menggunakan alat P3K', '2024/12/18007', '03022025051907Kejadian.jpeg'),
(49, 'Roby Monarko', '88894324989', 'Tangerang', '2025-02-11', 'Kecelakaan Kerja', 'ketabrak mobil', '2024/12/18003', '11022025084233Kejadian.jpeg'),
(50, 'Junaidi Rohman', '8889432498', 'Tangerang', '2025-02-11', 'Kecelakaan Kerja', 'Pulang cepat', '2024/12/18002', '11022025164239Kejadian.jpeg'),
(52, 'Sukijan', '89849283948', 'Tangerang', '2025-02-11', 'Kecelakaan Kerja', 'Nabrak orang', '2024/12/18003', '11022025171509Kejadian.jpeg'),
(53, 'Juno joki', '989318981', 'Jakarta', '2025-02-09', 'Bolos', 'Jatuh ketiban tangga 5 m', '2024/12/18003', '12022025151605Kejadian.jpeg'),
(54, 'Bimo Kastoni', '98931893819', 'Balikpapan', '2025-02-11', 'Kecelakaan Kerja', 'Jatuh ketiban tangga 5 m', '2024/12/18003', '12022025152212Kejadian.jpeg'),
(55, 'Gaber Oktoni', '99849141917', 'Semarang', '2025-02-12', 'Kecelakaan Kerja', 'Jatuh ketiban tangga', '2024/12/18003', '12022025152552Kejadian.jpeg'),
(56, 'Marsito', '882743798', 'Semarang', '2025-02-09', 'Kecelakaan Kerja', 'Jatuh ketiban tangga', '2024/12/18007', '12022025153454Kejadian.jpeg'),
(64, 'xxx', 'xxs', 'Cikarang', '2025-02-25', 'xxx', 'xxx', 'xxx', '25022025022300Ramadhan 1.jpg'),
(65, 'yy', 'yy', 'Cikarang', '2025-02-26', 'yy', 'yy', 'yy', '26022025023350Ramadhan 1.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mutasi_operator`
--

CREATE TABLE `tb_mutasi_operator` (
  `id_mutasi` int(11) NOT NULL,
  `id_operator` int(11) NOT NULL,
  `nama_operator` varchar(255) NOT NULL,
  `penempatan_opr_baru` varchar(255) NOT NULL,
  `status_opr_baru` varchar(255) NOT NULL,
  `status_approval` varchar(255) NOT NULL,
  `tgl_pengajuan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_mutasi_operator`
--

INSERT INTO `tb_mutasi_operator` (`id_mutasi`, `id_operator`, `nama_operator`, `penempatan_opr_baru`, `status_opr_baru`, `status_approval`, `tgl_pengajuan`) VALUES
(31, 36, 'Mbokir', 'Tangerang', 'Aktif', 'Ajukan Mutasi', '2025-02-25'),
(32, 46, 'Modik', 'Jakarta', 'Aktif', 'Ajukan Mutasi', '2025-02-25'),
(33, 33, 'Bagus', 'Tangerang', 'Aktif', 'Ajukan Mutasi', '2025-02-26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_operator`
--

CREATE TABLE `tb_operator` (
  `id_operator` int(11) NOT NULL,
  `nama_operator` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `no_sio` varchar(255) NOT NULL,
  `jenis_sio` varchar(255) NOT NULL,
  `operator` varchar(255) NOT NULL,
  `kelas_operator` varchar(255) NOT NULL,
  `foto_ktp` varchar(255) NOT NULL,
  `foto_sio` varchar(255) NOT NULL,
  `foto_sim` varchar(255) NOT NULL,
  `foto_sertifikat_dpn` varchar(255) NOT NULL,
  `foto_sertifikat_blk` varchar(255) NOT NULL,
  `foto_operator` varchar(255) NOT NULL,
  `penempatan_opr` varchar(255) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_operator`
--

INSERT INTO `tb_operator` (`id_operator`, `nama_operator`, `nik`, `alamat`, `no_telp`, `no_sio`, `jenis_sio`, `operator`, `kelas_operator`, `foto_ktp`, `foto_sio`, `foto_sim`, `foto_sertifikat_dpn`, `foto_sertifikat_blk`, `foto_operator`, `penempatan_opr`, `tgl_masuk`, `status`) VALUES
(33, 'Bagus', '3172040378472', 'Jl Tipar Cakung Pesada Rt001/004 Kec.Cillincing, Kel. Semper Barat No.48', '084874784004', '8318921319', 'Disnaker', 'TMC (Truck Mounted Crane)', 'Kelas 2', '12022025144307ktp.jpeg', '12022025144211sio.jpg', '12022025144307sim.jpg', '19022025035930my profile.jpg', '19022025035930Untitled.jpg', '19022025035930Untitled.png', 'Tangerang', '2024-12-20', 'Non Aktif'),
(34, 'Ferry Irwandi', '31887319730189021', 'Jl Bogasari 5', '084874784004', '8318921314', 'Disnaker', 'TMC (Truck Mounted Crane)', 'Kelas 1', '12022025144839ktp.jpeg', '12022025144839sio.jpg', '11022025165023sim.jpg', '11022025161534Sertifikat.jpg', '11022025161534Sertifikat.jpg', '13022025085230pas foto.jpg', 'Tangerang', '2024-12-20', 'Aktif'),
(35, 'Bobi Karma', '317204030888002', 'Jl Bogasari ', '084874784004', '8318921319', 'Migas', 'Menlift', 'Kelas 1', '201220240357581.jpeg', '201220240357582.jpg', '20122024035758sertif2.jpg', '11022025154216Sertifikat.jpg', '11022025154235Sertifikat.jpg', '11022025154235pas foto.jpg', 'Balikpapan', '2024-12-09', 'SP'),
(36, 'Mbokir', '317204030888006', 'Jl Tipar cakung ', '085863440339', '8318921319', 'Disnaker', 'Forklift', 'Kelas 3', '20122024035941091220241049431 (1).jpeg', '03022025071524sio.jpg', '03022025071524sim.jpg', '09012025052203Sertifikat.jpg', '09012025051330Pas Foto.jpg', '20122024035941Pas Foto.jpg', 'Jakarta', '2024-12-20', 'Aktif'),
(37, 'Opik', '317204030888002', 'Jl Bogasari ', '084874784004', '873784721998', 'Disnaker', 'Spider', 'Kelas 1', '311220240442551.jpeg', '311220240442551.jpeg', '20122024040843download (4).jpeg', '09012025052222Sertifikat.jpg', '03022025051601Sertifikat 2.jpg', '20122024040843Pas Foto.jpg', 'Jakarta', '2024-12-20', 'Aktif'),
(38, 'Bumi Agustine', '317204030888002', 'Jl Bogasari ', '084874784004', '873784721998', 'BNSP', 'Crawler Crane', 'Kelas 1', '20122024041135download (1).jpeg', '20122024041135download (2).jpeg', '20122024041135download.jpeg', '20122024041135download (3).jpeg', '20122024041135download (2).jpeg', '20122024040843Pas Foto.jpg', 'Jakarta', '2024-12-17', 'Aktif'),
(41, 'Naro Bahlul', '317204030888002', 'Jl Harun', '084874784004', '8318921313', 'Migas', 'Forklift', 'Kelas 1', '2112202412292104122024142448sertif4.jpg', '21122024122921091220241049431.jpeg', '21122024122921091220241049431.jpeg', '21122024122921091220241049431.jpeg', '21122024122921091220241049431.jpeg', '21122024122921091220241049431.jpeg', 'Balikpapan', '2024-12-09', 'Aktif'),
(42, 'Lama Irwandi Pokbar', '317204030888004', 'Jl Tipar cakung', '084874784004', '8318921313', 'Migas', 'Spider', 'Kelas 3', '21122024123303download (1).jpeg', '21122024123303download (2).jpeg', '21122024123303download (1).jpeg', '21122024123303download (1).jpeg', '21122024123303download (1).jpeg', '21122024123303download (1).jpeg', 'Jakarta', '2024-12-21', 'Non Aktif'),
(44, 'Fredi Sambo', '317204030888009', 'Jl Bogasari', '0848747840088', '873784721998', 'Migas', 'Roughter Crane', 'Kelas 1', '27122024084016091220241049431.jpeg', '27122024084016jasa.jpg', '27122024084016sertif4.jpg', '27122024084016091220241049431 (1).jpeg', '27122024084016091220241049431 (1).jpeg', '27122024091934Pas Foto.jpg', 'Jakarta', '2024-12-27', 'Aktif'),
(46, 'Modik', '317204030888002', 'Jl Bogasari', '0848747840088', '873784721998', 'Disnaker', 'Mobil Crane', 'Kelas 2', '27122024091759091220241049431.jpeg', '27122024091759091220241049431.jpeg', '27122024091759091220241049431.jpeg', '27122024093759sertif2.jpg', '27122024093759sertif.jpg', '27122024091759Pas Foto.jpg', 'Cikarang', '2024-12-26', 'Aktif'),
(47, 'Jemi Prasetyo', '317204030888004', 'Jl Bogasari', '084874784004', '8318921319', 'BNSP', 'Forklift', 'Kelas 1', '27122024093500091220241049431.jpeg', '27122024093500091220241049431.jpeg', '27122024093500091220241049431.jpeg', '27122024093500sertif3.jpeg', '311220240443481.jpeg', '27122024093500Pas Foto.jpg', 'Tangerang', '2024-12-27', 'Blacklist'),
(49, 'Ali Imron', '317204030888009', 'Jl Bogasari', '084874784004', '873784721998', 'Disnaker', 'Forklift', 'Kelas 2', '03022025051005ktp.jpeg', '03022025051005sio.jpg', '03022025051005sim.jpg', '03022025051636Sertifikat 2.jpg', '03022025051005Sertifikat 2.jpg', '03022025051005pas foto.jpg', 'Tangerang', '2025-02-03', 'Blacklist'),
(50, 'Fredi Sitanggang', '317204030888004', 'Jl Bogasari', '084874784004', '873784721998', 'Migas', 'Crawler Crane', 'Kelas 2', '11022025080032ktp.jpeg', '11022025080032sio.jpg', '11022025080032sim.jpg', '11022025080032Sertifikat.jpg', '11022025080032Sertifikat 2.jpg', '11022025145742pas foto.jpg', 'Cikarang', '2025-02-13', 'Non Aktif'),
(51, 'Park Jing So', '317204030888002', 'Jl Bogasari', '0848747840088', '873784721990', 'BNSP', 'Roughter Crane', 'Kelas 2', '11022025084811ktp.jpeg', '11022025084811sio.jpg', '11022025084811sim.jpg', '11022025084811Sertifikat.jpg', '11022025084811Sertifikat 2.jpg', '11022025084811pas foto.jpg', 'Jakarta', '2025-02-10', 'Non Aktif'),
(52, 'Limnas joki', '317204030888004', 'Jl Bogasari', '084874784004', '8318921314', 'Disnaker', 'Roughter Crane', 'Kelas 1', '11022025085813ktp.jpeg', '11022025085813sio.jpg', '11022025085813sim.jpg', '11022025085813Sertifikat.jpg', '11022025085813Sertifikat 2.jpg', '11022025085813pas foto.jpg', 'Jakarta', '2025-02-11', 'SP'),
(53, 'Regi Norman', '317204030888002', 'Jl Tipar cakung', '084874784004', '8318921319', 'BNSP', 'Roughter Crane', 'Kelas 1', '11022025145650ktp.jpeg', '11022025145650sio.jpg', '11022025145650sim.jpg', '11022025145650Sertifikat.jpg', '11022025145650Sertifikat 2.jpg', '11022025145650pas foto.jpg', 'Tangerang', '2025-02-11', 'Skorsing'),
(54, 'Junaidi Rohman', '317204030888002', 'Jl Tipar cakung', '084874784004', '873784721990', 'Disnaker', 'TMC (Truck Mounted Crane)', 'Kelas 1', '11022025151757ktp.jpeg', '11022025151757sio.jpg', '11022025151757sim.jpg', '11022025151757Sertifikat.jpg', '11022025151757Sertifikat 2.jpg', '11022025151757pas foto.jpg', 'Jakarta', '2025-02-11', 'Aktif'),
(55, 'Sakur', '317204030888004', 'Jl Tipar cakung', '084874784004', '8318921319', 'Disnaker', 'Menlift', 'Kelas 1', '11022025152033ktp.jpeg', '11022025152033sio.jpg', '11022025152033sim.jpg', '11022025152033Sertifikat.jpg', '11022025152320Sertifikat.jpg', '11022025152033pas foto.jpg', 'Balikpapan', '2025-02-11', 'Aktif'),
(56, 'Akur', '317204030888009', 'Jl Tipar cakung', '084874784004', '873784721990', 'BNSP', 'Spider', 'Kelas 2', '12022025143358ktp.jpeg', '12022025143358sio.jpg', '12022025143358sim.jpg', '12022025143358Sertifikat.jpg', '', '12022025143358pas foto.jpg', 'Semarang', '2025-02-12', 'Aktif'),
(57, 'Bobi Indra', '317204030888002', 'Jl Bogasari', '084874784004', '8318921314', 'Disnaker', 'Menlift', 'Kelas 2', '12022025143602ktp.jpeg', '12022025143602sio.jpg', '12022025143602sim.jpg', '', '', '12022025143602pas foto.jpg', 'Jakarta', '2025-02-03', 'Non Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_petugas`
--

CREATE TABLE `tb_petugas` (
  `id_petugas` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `cabang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_petugas`
--

INSERT INTO `tb_petugas` (`id_petugas`, `username`, `password`, `nama`, `telepon`, `cabang`) VALUES
(11, 'admin_cikarang', 'afb91ef692fd08c445e8cb1bab2ccf9c', 'Admin Cikarang', 'xxx', 'Cikarang'),
(12, 'admin_tangerang', 'afb91ef692fd08c445e8cb1bab2ccf9c', 'Wati', '081196503196', 'Tangerang'),
(14, 'admin_jakarta', 'afb91ef692fd08c445e8cb1bab2ccf9c', 'Admin Jakarta', 'xxx', 'Jakarta'),
(16, 'admin_balikpapan', 'afb91ef692fd08c445e8cb1bab2ccf9c', 'Admin Balikpapan', 'xxx', 'Balikpapan'),
(36, 'admin_tangerang5', 'afb91ef692fd08c445e8cb1bab2ccf9c', 'Robi Oktoni', 'xxx', 'Tangerang');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_batangan`
--
ALTER TABLE `tb_batangan`
  ADD PRIMARY KEY (`id_batangan`);

--
-- Indeks untuk tabel `tb_cabang`
--
ALTER TABLE `tb_cabang`
  ADD PRIMARY KEY (`id_cabang`);

--
-- Indeks untuk tabel `tb_lain_lain`
--
ALTER TABLE `tb_lain_lain`
  ADD PRIMARY KEY (`id_biaya`);

--
-- Indeks untuk tabel `tb_laporan`
--
ALTER TABLE `tb_laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indeks untuk tabel `tb_mutasi_operator`
--
ALTER TABLE `tb_mutasi_operator`
  ADD PRIMARY KEY (`id_mutasi`);

--
-- Indeks untuk tabel `tb_operator`
--
ALTER TABLE `tb_operator`
  ADD PRIMARY KEY (`id_operator`);

--
-- Indeks untuk tabel `tb_petugas`
--
ALTER TABLE `tb_petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `tb_batangan`
--
ALTER TABLE `tb_batangan`
  MODIFY `id_batangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tb_cabang`
--
ALTER TABLE `tb_cabang`
  MODIFY `id_cabang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_lain_lain`
--
ALTER TABLE `tb_lain_lain`
  MODIFY `id_biaya` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tb_laporan`
--
ALTER TABLE `tb_laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT untuk tabel `tb_mutasi_operator`
--
ALTER TABLE `tb_mutasi_operator`
  MODIFY `id_mutasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `tb_operator`
--
ALTER TABLE `tb_operator`
  MODIFY `id_operator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT untuk tabel `tb_petugas`
--
ALTER TABLE `tb_petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
