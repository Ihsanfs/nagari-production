-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 02 Sep 2024 pada 02.22
-- Versi server: 11.3.2-MariaDB-log
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal_nagari`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `album`
--

CREATE TABLE `album` (
  `id` bigint(20) NOT NULL,
  `nama_album` text NOT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `album_image` text NOT NULL,
  `user_id` int(20) NOT NULL,
  `is_active` int(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `album`
--

INSERT INTO `album` (`id`, `nama_album`, `slug`, `album_image`, `user_id`, `is_active`, `created_at`, `updated_at`) VALUES
(8, 'album pribadi', 'album-pribadi', 'images/album/497hospital2.png', 1, 1, '2024-05-29 02:49:21', '2024-05-29 03:19:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `app_nama`
--

CREATE TABLE `app_nama` (
  `id` bigint(20) NOT NULL,
  `nama_web` varchar(100) DEFAULT NULL,
  `lokasi` text DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `app_nama`
--

INSERT INTO `app_nama` (`id`, `nama_web`, `lokasi`, `logo`, `created_at`, `updated_at`) VALUES
(2, 'puskesmas', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15959.269532758832!2d99.77338329999999!3d0.0392705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302a7901d06f2ec1%3A0xbb10b33eddcd04ea!2sPasar%20Kapa!5e0!3m2!1sid!2sid!4v1724772847140!5m2!1sid!2sid\"  height=\"300px\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'logo/website/866_WhatsApp Image 2024-08-13 at 11.06.20.jpeg', '2024-08-23 08:51:35', '2024-08-27 15:40:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `artikels`
--

CREATE TABLE `artikels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` text NOT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kategori_id` varchar(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `gambar_artikel` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `views` tinyint(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `artikels`
--

INSERT INTO `artikels` (`id`, `judul`, `slug`, `body`, `kategori_id`, `tanggal`, `user_id`, `gambar_artikel`, `is_active`, `views`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'upcaarscfascacacas', 'upcaarscfascacacas', '<p>cascascascascascascacacacacac</p>', NULL, '2024-05-27', 1, 'images/artikel/26api.jpeg', 1, 14, '2024-05-28 07:49:46', '2024-08-27 15:46:10', '2024-05-29 02:51:45'),
(2, 'tes', 'tes', '<p>czczczczxczxcz</p>', NULL, '2024-05-30', 1, 'images/artikel/823kantor.png', 1, 8, '2024-05-29 03:03:04', '2024-08-28 02:10:03', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `artikels_tag`
--

CREATE TABLE `artikels_tag` (
  `id` bigint(20) NOT NULL,
  `artikel_id` int(20) NOT NULL,
  `tag_id` int(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `artikels_tag`
--

INSERT INTO `artikels_tag` (`id`, `artikel_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2024-05-28 07:49:46', '2024-05-28 07:49:46'),
(2, 2, 3, '2024-05-29 03:03:04', '2024-05-29 03:03:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `download`
--

CREATE TABLE `download` (
  `id` int(20) NOT NULL,
  `judul_download` varchar(255) DEFAULT NULL,
  `file_download` text DEFAULT NULL,
  `is_active` double NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `download`
--

INSERT INTO `download` (`id`, `judul_download`, `file_download`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'sadasdsa', 'file/download/28510.1.1.698.304.pdf', 1, '2024-03-27 07:21:22', '2024-03-27 07:21:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery`
--

CREATE TABLE `gallery` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `gambar_galery` varchar(100) DEFAULT NULL,
  `id_album` bigint(30) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `gallery`
--

INSERT INTO `gallery` (`id`, `nama`, `gambar_galery`, `id_album`, `is_active`, `created_at`, `updated_at`) VALUES
(4, 'sdada', 'images/album/998pasbar.jpg', 5, 0, '2024-05-27 08:14:35', '2024-05-27 08:16:43'),
(5, 'rumah', 'images/artikel/261hospital2.png', 8, 1, '2024-05-29 02:49:36', '2024-05-29 03:26:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `halaman`
--

CREATE TABLE `halaman` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `menu_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `view` varchar(100) DEFAULT NULL,
  `page_halaman` int(20) NOT NULL,
  `url` text DEFAULT NULL,
  `is_active` double NOT NULL,
  `gambar_h` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `halaman`
--

INSERT INTO `halaman` (`id`, `nama`, `slug`, `menu_id`, `user_id`, `deskripsi`, `view`, `page_halaman`, `url`, `is_active`, `gambar_h`, `created_at`, `updated_at`) VALUES
(3, 'Visi Misi', 'visi-misi', 2, 1, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '38', 1, NULL, 1, 'images/halaman/367_591Tentang Pasaman Barat bc (1).png', '2024-04-23 03:13:41', '2024-08-05 08:08:34'),
(4, '3243242', '3243242', 2, 1, NULL, '0', 2, 'https://subsiditepat.mypertamina.id', 1, NULL, '2024-05-02 04:51:35', '2024-05-02 04:58:54'),
(6, 'sakit kepala', 'sakit-kepala', 1, 1, '<p>&nbsp;</p>\r\n\r\n<p>sakit&nbsp;</p>', '15', 1, NULL, 1, NULL, '2024-05-05 02:41:43', '2024-08-28 02:09:47'),
(7, 'sdada', 'sdada', 1, 1, '<p>sadsadsa<img alt=\"\" src=\"http://127.0.0.1:8002/images/artikel/page/acfe30b08dc190951691c4b53e5d505e_1715494588.png\" style=\"float:left; height:113px; width:120px\" /></p>', '5', 3, NULL, 1, NULL, '2024-05-12 06:15:51', '2024-08-28 02:09:45'),
(8, 'layanan kb', 'layanan-kb', 5, 1, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '3', 1, NULL, 1, NULL, '2024-05-27 03:43:24', '2024-05-28 07:07:09'),
(9, 'layanan balita', 'layanan-balita', 5, 1, '<p><img alt=\"\" src=\"http://127.0.0.1:8008/images/artikel/page/api_1716781528.jpeg\" style=\"height:512px; width:512px\" /></p>', '3', 2, NULL, 1, NULL, '2024-05-27 03:45:39', '2024-05-29 03:19:17'),
(10, 'sadada', 'sadada', 5, 1, NULL, '0', 3, NULL, 1, 'images/halaman/17_api.jpeg', '2024-05-27 04:05:04', '2024-05-27 04:05:04'),
(11, 'sdsadas', 'sdsadas', 1, 1, '<p><img alt=\"\" src=\"http://127.0.0.1:8008/pdfs/5xnsR6h1NXZkc8HIoSr9CvOpEyDGQjPq_1724118871.pdf\" /><img alt=\"oke gas\" src=\"http://127.0.0.1:8008/pdfs/5xnsR6h1NXZkc8HIoSr9CvOpEyDGQjPq_1724118888.pdf\" /></p>', '1', 20, NULL, 1, NULL, '2024-08-20 01:55:13', '2024-08-20 01:55:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `halaman_feat`
--

CREATE TABLE `halaman_feat` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `menu_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `view` varchar(100) DEFAULT NULL,
  `page_halaman` int(20) NOT NULL,
  `url` text DEFAULT NULL,
  `is_active` double NOT NULL,
  `gambar_h` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `halaman_feat`
--

INSERT INTO `halaman_feat` (`id`, `nama`, `slug`, `menu_id`, `user_id`, `deskripsi`, `view`, `page_halaman`, `url`, `is_active`, `gambar_h`, `created_at`, `updated_at`) VALUES
(7, 'Profil Nagari', 'profil-nagari', 13, 1, '<h2 style=\"font-style:italic\">&nbsp;</h2>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; PROFIL NAGARI</p>\r\n\r\n<hr />\r\n<p>Nagari Salingka Muaro adalah salah satu nagari pemekaran dari Nagari Sungai Aua pada tahun 2017 dan menjadi Nagari Defenitif pada tahun 2023. Nagari Salingka Muara terletak di Kecamatan Sungai Aur Kabupaten Pasaman Barat Provinsi Sumatera Barat.&nbsp; Nagari ini memiliki luas 48.573 Km2, dan secara geografis berbatasan dengan wilayah sebagai berikut:</p>\r\n\r\n<ol>\r\n	<li>Sebelah utara berbtasan dengan Nagari Ranah Malintang</li>\r\n	<li>Sebelah selatan berbatasan dengan Sikilang Sungai Aur Selatan&nbsp;</li>\r\n	<li>Sebelah timur berbatasan dengan Nagari Sungai Aua dan Nagari Ranah Air Haji</li>\r\n	<li>Sebelah barat berbatasan dengan Nagari Salido Saroha dan Nagari Koto Gunung</li>\r\n</ol>\r\n\r\n<p>Secara administratif wilayah Nagari Salingka Muaro terdiri dari 5 kejorongan yaitu Jorong Situmang, Jorong Muara Tapus, Jorong Tombang Padang Hilir, Jorong Padang Timbalun dan Jorong Sungai Aur. Jumlah penduduk Nagari Salingka Muara&nbsp; berdasarkan data Sistem Administrasi Kependudukan (SIAK) tahun 2023 sebanyak 6.603 jiwa yang terdiri dari 3.295 penduduk laki-laki dan 3.308 penduduk perempuan.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', '70', 1, NULL, 1, NULL, '2024-03-20 06:13:37', '2024-04-22 02:19:21'),
(8, 'Visi Misi', 'visi-misi', 13, 1, '<p>Visi Misi</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', '51', 2, NULL, 1, NULL, '2024-03-20 06:16:03', '2024-04-22 02:33:47'),
(9, 'Potensi Desa', 'potensi-desa', 14, 1, '<p><strong>Potensi Desa</strong></p>\r\n\r\n<p>Berdasarkan data terpadu kesejahteraan sosial, Nagari Salingka Muaro memiliki penduduk miskin sebanyak 2598 keluarga atau 38,9% dari total penduduk Nagari Salingka Muaro. Berdasarkan hasil pendapatan penerima bantuan langsung tunai Nagari terdapat sebanyak 42 keluarga, selain itu penyandang masalah kesejahteraan sosial (PMKS) di Nagari Salingka Muaro adalah sebanyak 29. Selain itu jumlah pengangguran juga banyak terdapat di Nagari Salingka Muaro.&nbsp;</p>\r\n\r\n<p>Secara Umum tipologi Nagari Salingka Muaro terdiri dari persawahan, perkebunan, industri kecil serta jasa dan perdagangan. Secara Topologis Nagari Salingka Muaro secara umum termasuk daerah Dataran Tinggi dan berdasarkan ketinggian wilayah, Nagari Salingka Muaro diklasifikasikan kepada Dataran Tinggi. Potensi unggulan yang ada di Nagari Salingka Muaro secara terperinci yaitu potensi pertanian, perkebunan, peternakan dan perikanan. Sumber pengasilan utama penduduk Nagari Salingka Muaro adalah disektor perkebunan Sawit. Dan&nbsp; Sumber daya pembangunan yang dimiliki Nagari Salingka Muaro yang merupakan salah satu potensi untuk pembangunan Nagari diantaranya jalan, jembatan dan sarana prasarana olahraga.</p>\r\n\r\n<p>&nbsp;</p>', '21', 1, NULL, 1, NULL, '2024-03-20 06:30:02', '2024-04-22 02:19:23'),
(10, 'foto test', 'foto-test', 14, 1, '<p>puskesmas ini adalah akan melakukan penukaran exhange</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: -7px; top: -6px;\">\r\n<div class=\"gtx-trans-icon\">&nbsp;</div>\r\n</div>', '38', 2, NULL, 1, 'images/halaman/35_WhatsApp Image 2024-03-25 at 14.21.19 (1).jpeg', '2024-03-25 08:22:36', '2024-04-18 16:47:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `halaman_static`
--

CREATE TABLE `halaman_static` (
  `id` bigint(20) NOT NULL,
  `nama_h_static` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `menu_id` int(30) DEFAULT NULL,
  `page_halaman_static` int(20) DEFAULT NULL,
  `user_id` int(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `iklans`
--

CREATE TABLE `iklans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul_iklan` varchar(255) DEFAULT NULL,
  `link` text DEFAULT NULL,
  `gambar_iklan` varchar(255) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `iklans`
--

INSERT INTO `iklans` (`id`, `judul_iklan`, `link`, `gambar_iklan`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'rambo', 'www.google.com', 'iklan/13FdQDRTt60PyrRLz3ivvuJMc9yOWkfWNhMYJAnh.png', 1, '2024-01-15 12:54:42', '2024-01-15 12:54:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `instansi`
--

CREATE TABLE `instansi` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `sambutan` text DEFAULT NULL,
  `deskripsi_profil` text DEFAULT NULL,
  `nagari` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `kabupaten` varchar(100) DEFAULT NULL,
  `link` text DEFAULT NULL,
  `font_media` text DEFAULT NULL,
  `foto_instansi` varchar(100) DEFAULT NULL,
  `foto_kepala` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `instansi`
--

INSERT INTO `instansi` (`id`, `nama`, `sambutan`, `deskripsi_profil`, `nagari`, `kecamatan`, `kabupaten`, `link`, `font_media`, `foto_instansi`, `foto_kepala`, `created_at`, `updated_at`) VALUES
(6, 'MEKAR TANI', '<p>dasdsa</p>', '<p>sadsadasdas</p>', 'dsadasdsa', 'asdsadsa', 'sadas', NULL, NULL, NULL, NULL, '2024-05-28 06:23:00', '2024-05-28 06:23:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `slug`, `created_at`, `updated_at`) VALUES
(3, 'puskesmas', 'puskesmas', '2024-04-23 02:19:10', '2024-05-27 03:36:30'),
(4, 'pasaman', 'pasaman', '2024-05-27 03:38:15', '2024-05-27 03:38:15'),
(5, 'suntik', 'suntik', '2024-05-27 03:38:29', '2024-05-27 03:38:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_tag`
--

CREATE TABLE `kategori_tag` (
  `id` bigint(20) NOT NULL,
  `artikel_id` bigint(50) DEFAULT NULL,
  `kategori_id` bigint(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `kategori_tag`
--

INSERT INTO `kategori_tag` (`id`, `artikel_id`, `kategori_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2024-05-28 07:49:46', '2024-05-28 07:49:46'),
(2, 2, 3, '2024-05-29 03:03:04', '2024-05-29 03:03:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materis`
--

CREATE TABLE `materis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul_materi` varchar(255) NOT NULL,
  `slug` text NOT NULL,
  `link` text NOT NULL,
  `playlist_id` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar_materi` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `medsos_instansi`
--

CREATE TABLE `medsos_instansi` (
  `id` bigint(20) NOT NULL,
  `instansi_id` int(20) NOT NULL,
  `sosial_media_id` int(20) NOT NULL,
  `url` text DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `medsos_instansi`
--

INSERT INTO `medsos_instansi` (`id`, `instansi_id`, `sosial_media_id`, `url`, `created_at`, `updated_at`) VALUES
(26, 6, 1, 'http://127.0.0.1:8008/superadmin/mediasosial', '2024-05-29 03:34:33', '2024-05-29 03:34:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `user_id` int(20) NOT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `status` double DEFAULT NULL,
  `urutan_menu` int(20) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `view` int(100) NOT NULL DEFAULT 0,
  `gambar_page` text DEFAULT NULL,
  `deskripsi_page` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id`, `nama`, `slug`, `user_id`, `is_active`, `status`, `urutan_menu`, `url`, `view`, `gambar_page`, `deskripsi_page`, `created_at`, `updated_at`) VALUES
(1, 'Potensi Desa', NULL, 1, 1, 1, 7, NULL, 0, NULL, NULL, '2024-04-23 02:34:39', '2024-05-28 07:37:46'),
(2, 'Profil', NULL, 1, 1, 3, 1, NULL, 0, NULL, NULL, '2024-04-23 02:35:16', '2024-04-23 02:35:16'),
(3, 'dsadasd', NULL, 1, 1, 2, 3, NULL, 0, NULL, '<p>sada</p>', '2024-04-24 08:05:27', '2024-04-24 08:05:27'),
(4, 'pengumuman', NULL, 1, 1, 3, 4, NULL, 0, NULL, NULL, '2024-05-04 16:50:41', '2024-05-04 16:50:41'),
(5, 'layanan', NULL, 1, 1, 1, 5, NULL, 0, NULL, NULL, '2024-05-27 03:42:57', '2024-05-27 03:42:57'),
(6, 'sadadsa', 'sadadsa', 1, 1, 4, 8, NULL, 9, 'images/gambar_page/105api.jpeg', '<p>dsadasda</p>', '2024-05-28 07:26:25', '2024-08-27 15:44:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_feat`
--

CREATE TABLE `menu_feat` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `user_id` int(20) NOT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `status` double DEFAULT NULL,
  `url` text DEFAULT NULL,
  `view` int(100) NOT NULL DEFAULT 0,
  `gambar_page` text DEFAULT NULL,
  `deskripsi_page` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `menu_feat`
--

INSERT INTO `menu_feat` (`id`, `nama`, `slug`, `user_id`, `is_active`, `status`, `url`, `view`, `gambar_page`, `deskripsi_page`, `created_at`, `updated_at`) VALUES
(13, 'Profil Nagari', NULL, 1, 1, 1, NULL, 0, NULL, NULL, '2024-03-20 06:09:07', '2024-03-20 06:14:18'),
(14, 'Potensi Desa', NULL, 1, 1, 3, NULL, 0, NULL, NULL, '2024-03-20 06:28:26', '2024-03-20 06:28:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_02_24_171533_create_kategoris_table', 1),
(6, '2023_02_24_185037_create_artikels_table', 1),
(7, '2023_02_26_181510_create_playlists_table', 1),
(8, '2023_03_02_120108_create_materis_table', 1),
(9, '2023_03_02_125005_create_slides_table', 1),
(10, '2023_03_04_045250_create_iklans_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id` bigint(20) NOT NULL,
  `nama_pegawai` varchar(255) DEFAULT NULL,
  `jabatan` varchar(200) DEFAULT NULL,
  `gambar_pegawai` text DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `is_active` double NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id`, `nama_pegawai`, `jabatan`, `gambar_pegawai`, `tanggal`, `alamat`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'saroha', 'kepala dinas', 'images/pegawai/4848.jpg', '2024-08-14', 'malasiro', 1, '2024-08-14 16:41:47', '2024-08-15 07:03:51'),
(2, 'petra', 'pemain bola', 'images/pegawai/739514_ERYULIA SISKA, S.ST (KEPALA PUSK) (1).png', '2024-08-14', 'edd', 1, '2024-08-14 16:43:44', '2024-08-14 16:43:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelayanan`
--

CREATE TABLE `pelayanan` (
  `id` bigint(20) NOT NULL,
  `nama_pelayanan` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `is_active` double NOT NULL DEFAULT 0,
  `gambar_layanan` text DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `user_id` int(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pelayanan`
--

INSERT INTO `pelayanan` (`id`, `nama_pelayanan`, `slug`, `deskripsi`, `is_active`, `gambar_layanan`, `tanggal`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'sadasdas', 'sadasdas', '<p>sdadsadsadsa</p>', 1, 'images/layanan/137balok.png', '2024-04-25', 1, '2024-04-25 12:29:41', '2024-04-25 12:29:41'),
(2, 'sadasdas', 'sadasdas', '<p>sdadsadsadsa</p>', 1, 'images/layanan/137balok.png', '2024-04-25', 1, '2024-04-25 12:29:41', '2024-04-25 12:29:41'),
(3, 'sadasdas', 'sadasdas', '<p>sdadsadsadsa</p>', 1, 'images/layanan/137balok.png', '2024-04-25', 1, '2024-04-25 12:29:41', '2024-04-25 12:29:41'),
(4, 'sadasdas', 'sadasdas', '<p>sdadsadsadsa</p>', 1, 'images/layanan/137balok.png', '2024-04-25', 1, '2024-04-25 12:29:41', '2024-04-25 12:29:41'),
(5, 'sadasdas', 'sadasdas', '<p>sdadsadsadsa</p>', 1, 'images/layanan/137balok.png', '2024-04-25', 1, '2024-04-25 12:29:41', '2024-04-25 12:29:41'),
(6, 'sadasdas', 'sadasdas', '<p>sdadsadsadsa</p>', 1, 'images/layanan/137balok.png', '2024-04-25', 1, '2024-04-25 12:29:41', '2024-04-25 12:29:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL,
  `judul_pengumuman` text DEFAULT NULL,
  `file_pengumuman` text DEFAULT NULL,
  `is_active` double DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `judul_pengumuman`, `file_pengumuman`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'sdadadad', 'file/pengumuman/506WhatsApp Image 2024-04-09 at 10.22.21.jpeg', 1, '2024-04-18 03:19:46', '2024-04-18 03:19:46'),
(3, 'sdadasda', 'file/pengumuman/2702019-Mercedes-Benz-S-Class-S-560e-L-01.jpg', 1, '2024-04-18 13:53:21', '2024-04-18 13:53:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `playlists`
--

CREATE TABLE `playlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul_playlist` varchar(255) NOT NULL,
  `slug` text NOT NULL,
  `deskripsi` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `gambar_playlist` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', '2024-01-15 03:57:35', '2024-01-15 03:57:35'),
(2, 'admin', '2024-01-15 03:57:35', '2024-01-15 03:57:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `slider`
--

CREATE TABLE `slider` (
  `id` int(20) NOT NULL,
  `judul_slider` varchar(255) DEFAULT NULL,
  `gambar_slider` text DEFAULT NULL,
  `is_active` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `slider`
--

INSERT INTO `slider` (`id`, `judul_slider`, `gambar_slider`, `is_active`, `created_at`, `updated_at`) VALUES
(4, 'Nagari', 'images/slider/528karyawan.jpg', 1, '2024-03-24 06:29:17', '2024-04-23 02:29:36'),
(5, 'foto kantor', 'images/slider/1020240321_095215.jpg', 1, '2024-03-24 06:31:40', '2024-04-23 02:29:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `slides`
--

CREATE TABLE `slides` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul_slide` varchar(255) DEFAULT NULL,
  `link` text DEFAULT NULL,
  `video_slide` varchar(255) DEFAULT NULL,
  `type` int(20) DEFAULT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `slides`
--

INSERT INTO `slides` (`id`, `judul_slide`, `link`, `video_slide`, `type`, `is_active`, `created_at`, `updated_at`) VALUES
(4, 'sdadasda', 'd6lH75N4EiM', NULL, 1, 1, '2024-04-22 04:50:02', '2024-04-22 07:34:19'),
(5, 'wdadada', NULL, 'video/slide/1713772063My Video.mp4', 2, 1, '2024-04-22 04:50:38', '2024-04-22 07:47:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sosial_media`
--

CREATE TABLE `sosial_media` (
  `id` bigint(30) NOT NULL,
  `media_font` text DEFAULT NULL,
  `nama_sosmed` varchar(100) NOT NULL,
  `url` text DEFAULT NULL,
  `instansi_id` int(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `sosial_media`
--

INSERT INTO `sosial_media` (`id`, `media_font`, `nama_sosmed`, `url`, `instansi_id`, `created_at`, `updated_at`) VALUES
(1, '<i class=\"fa-brands fa-facebook\"></i>', 'fb', NULL, NULL, '2024-03-27 04:16:33', '2024-03-27 04:23:01'),
(3, '<i class=\"fa-brands fa-twitter\"></i>', 'twitter', NULL, NULL, '2024-03-27 04:28:19', '2024-03-27 04:28:19'),
(5, '<i class=\"fa-brands fa-instagram\"></i>', 'ig', NULL, NULL, '2024-03-27 06:12:21', '2024-03-27 06:12:21'),
(6, '<i class=\"fa fa-envelope\" aria-hidden=\"true\"></i>', 'gmail', NULL, NULL, '2024-03-27 06:12:33', '2024-05-29 03:35:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sumber_dana`
--

CREATE TABLE `sumber_dana` (
  `id` bigint(20) NOT NULL,
  `sumber_dana` varchar(100) NOT NULL,
  `file_dana` text DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `total` text DEFAULT NULL,
  `user_id` int(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `sumber_dana`
--

INSERT INTO `sumber_dana` (`id`, `sumber_dana`, `file_dana`, `deskripsi`, `tanggal`, `total`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'Kabupaten', 'file/sumberdana/613Dashboard.pdf', 'sumber dana kabupaten', '2024-04-23', '600000', 1, '2024-04-23 03:16:04', '2024-04-25 04:58:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tag`
--

CREATE TABLE `tag` (
  `id` bigint(20) NOT NULL,
  `nama_tag` text DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tag`
--

INSERT INTO `tag` (`id`, `nama_tag`, `slug`, `created_at`, `updated_at`) VALUES
(3, 'bencana alam', 'bencana-alam', '2024-04-23 02:20:22', '2024-04-23 02:20:22'),
(4, 'jarum', 'jarum', '2024-05-27 03:38:46', '2024-05-27 03:38:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint(20) NOT NULL,
  `id_dana` int(30) DEFAULT NULL,
  `jenis_transaksi` varchar(100) DEFAULT NULL,
  `total_transaksi` text DEFAULT NULL,
  `user_id` int(20) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `file_transaksi` text DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_dana`, `jenis_transaksi`, `total_transaksi`, `user_id`, `deskripsi`, `file_transaksi`, `status`, `created_at`, `updated_at`, `tanggal`) VALUES
(1, 1, 'pembelian buku', '30000', 1, 'sdadsada', 'file/pengeluaran/1712043280_462_Dashboard (3).pdf', 1, '2024-04-02 07:34:40', '2024-04-02 07:34:40', '2024-04-02'),
(2, 2, 'sdadas', '30000', 3, 'sadsada', 'file/pengeluaran/1714635912_859_bg u.png', 1, '2024-05-02 07:45:12', '2024-05-02 07:45:12', '2024-05-02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `is_active` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `gambar`, `remember_token`, `created_at`, `updated_at`, `role_id`, `is_active`) VALUES
(1, 'superadmin', 'admin@admin.com', NULL, '$2a$12$4WSTzLEUtNuXk52SV8aI/On/3siUXDeIBAgulKVxuYK7Q0e5xzsu2', 'images/profil/769_6.jpg', NULL, '2024-01-15 03:57:35', '2024-04-25 12:44:58', 1, 1),
(2, 'admin', 'student@student.com', NULL, '$2a$12$4WSTzLEUtNuXk52SV8aI/On/3siUXDeIBAgulKVxuYK7Q0e5xzsu2', 'images/profil/970_8.jpg', NULL, '2024-01-15 03:57:35', '2024-01-23 00:31:40', 2, 0),
(3, 'Pejabat babat', 'pejabat@pejabat.com', NULL, '$2y$10$dujLeJhQdKooEWdrQr3hgePE0VD0e7a1K0K10ysFIjg4qRPOtFdua', 'images/profil/Green Travel Blog Banner.png', 'iFol27Oolw838IhBlQOsKmpL49r4PVemlTKA1pgoJG4oafXv8pYNAFuwv5cO', '2024-01-15 03:57:35', '2024-02-22 03:11:29', 2, 1),
(4, 'superadmin', 'sasakpantai@gmail.com', NULL, '$2y$10$z8XMXdgJ5C9VGgOtgDLRMekplpLYGvguld63K6yZsyNxBuqWtYzmG', 'images/profil/329_a.jpg', NULL, '2024-01-21 21:55:39', '2024-01-21 21:55:39', 1, 1),
(6, 'anto', 'pandusugara@pu.go.id', NULL, '$2y$10$dujLeJhQdKooEWdrQr3hgePE0VD0e7a1K0K10ysFIjg4qRPOtFdua', 'images/profil/68_baju sipil.jpg', 'PWSTQLczUjg8EMq5tAtFcaCxtSs4zuCrpYKDQ1QWWCq7dzIODEcDWL8r03n4', '2024-01-21 22:08:17', '2024-01-22 21:18:44', 2, 1),
(7, 'dsadasd', 'icsshsan@gmail.com', NULL, '$2y$10$mn7DNbdO.fqI105YOllHX.2swI2oJJnHBEy3thDZs5cOfH69b3uTC', NULL, NULL, '2024-02-22 03:34:21', '2024-02-22 03:43:15', 2, 1),
(8, 'MEKAR TANI', 'asdadadmin@admin.com', NULL, '$2y$10$diSUucu2Iyx7gMGzjp3wQe5wpk9FbBfDFio9OWBxGeGAXpEOBVDGC', 'images/profil/856_baju sipil.jpg', NULL, '2024-04-23 04:32:46', '2024-04-23 04:41:53', 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `visit`
--

CREATE TABLE `visit` (
  `id` int(20) NOT NULL,
  `ip_address` text DEFAULT NULL,
  `activity` text DEFAULT NULL,
  `last_activity` text DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `browser` text DEFAULT NULL,
  `post_id` int(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `visit`
--

INSERT INTO `visit` (`id`, `ip_address`, `activity`, `last_activity`, `user_agent`, `browser`, `post_id`, `created_at`, `updated_at`) VALUES
(3, '127.0.0.2', '2024-03-31 10:37:00', '2024-03-31 10:37:00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-01 03:09:36', '2024-04-01 03:37:00'),
(4, '127.0.0.1', '2024-04-01 10:09:36', '2024-04-01 15:03:55', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-01 03:09:36', '2024-04-01 08:03:55'),
(5, '172.25.88.56', '2024-04-01 11:40:17', '2024-04-01 12:12:13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-01 04:40:17', '2024-04-01 05:12:13'),
(6, '127.0.0.1', '2024-04-02 12:54:06', '2024-04-02 15:24:34', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-02 05:54:06', '2024-04-02 08:24:34'),
(7, '192.168.129.164', '2024-04-02 14:52:23', '2024-04-02 15:18:34', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Mobile Safari/537.36', 'Chrome', NULL, '2024-04-02 07:52:23', '2024-04-02 08:18:34'),
(8, '192.168.129.223', '2024-04-02 14:56:14', '2024-04-02 14:58:51', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Mobile Safari/537.36', 'Chrome', NULL, '2024-04-02 07:56:14', '2024-04-02 07:58:51'),
(9, '192.168.129.225', '2024-04-02 15:04:16', '2024-04-02 15:05:31', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Mobile Safari/537.36', 'Chrome', NULL, '2024-04-02 08:04:16', '2024-04-02 08:05:31'),
(10, '192.168.129.21', '2024-04-02 15:10:24', '2024-04-02 15:10:24', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-02 08:10:24', '2024-04-02 08:10:24'),
(11, '127.0.0.1', '2024-04-03 09:33:46', '2024-04-03 10:35:11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-03 02:33:46', '2024-04-03 03:35:11'),
(12, '127.0.0.1', '2024-04-04 08:34:22', '2024-04-04 10:29:49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-04 01:34:22', '2024-04-04 03:29:49'),
(13, '103.145.163.105', '2024-04-04 10:49:21', '2024-04-04 15:06:20', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-04 03:49:21', '2024-04-04 08:06:20'),
(14, '182.4.68.219', '2024-04-04 11:38:39', '2024-04-04 13:34:52', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Mobile Safari/537.36', 'Chrome', NULL, '2024-04-04 04:38:39', '2024-04-04 06:34:52'),
(15, '51.81.46.212', '2024-04-04 13:22:52', '2024-04-04 13:24:49', NULL, '0', NULL, '2024-04-04 06:22:52', '2024-04-04 06:24:49'),
(16, '173.252.111.11', '2024-04-04 13:29:46', '2024-04-04 13:29:46', 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)', '0', NULL, '2024-04-04 06:29:46', '2024-04-04 06:29:46'),
(17, '173.252.79.4', '2024-04-04 13:29:46', '2024-04-04 13:29:46', 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)', '0', NULL, '2024-04-04 06:29:46', '2024-04-04 06:29:46'),
(18, '173.252.127.116', '2024-04-04 13:29:51', '2024-04-04 13:29:51', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Mobile Safari/537.36', 'Chrome', NULL, '2024-04-04 06:29:51', '2024-04-04 06:29:51'),
(19, '69.171.251.120', '2024-04-04 13:30:01', '2024-04-04 13:30:01', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Mobile Safari/537.36', 'Chrome', NULL, '2024-04-04 06:30:01', '2024-04-04 06:30:01'),
(20, '69.171.249.119', '2024-04-04 13:30:27', '2024-04-04 13:30:27', 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)', '0', NULL, '2024-04-04 06:30:27', '2024-04-04 06:30:27'),
(21, '69.63.189.2', '2024-04-04 13:30:36', '2024-04-04 13:30:36', 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)', '0', NULL, '2024-04-04 06:30:36', '2024-04-04 06:30:36'),
(22, '5.164.29.116', '2024-04-04 13:48:18', '2024-04-04 16:00:29', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 (scanner.ducks.party)', 'Chrome', NULL, '2024-04-04 06:48:18', '2024-04-04 09:00:29'),
(23, '182.4.69.47', '2024-04-04 14:45:04', '2024-04-04 14:52:14', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Mobile Safari/537.36', 'Chrome', NULL, '2024-04-04 07:45:04', '2024-04-04 07:52:14'),
(24, '104.166.80.220', '2024-04-04 14:58:45', '2024-04-04 14:58:45', 'Mozilla/5.0 (X11; Linux i686; rv:109.0) Gecko/20100101 Firefox/120.0', 'Firefox', NULL, '2024-04-04 07:58:45', '2024-04-04 07:58:45'),
(25, '104.166.80.8', '2024-04-04 14:59:56', '2024-04-04 14:59:56', 'Mozilla/5.0 (X11; Linux i686; rv:109.0) Gecko/20100101 Firefox/120.0', 'Firefox', NULL, '2024-04-04 07:59:56', '2024-04-04 07:59:56'),
(26, '104.166.80.15', '2024-04-04 15:40:02', '2024-04-04 15:40:03', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/120.0', 'Firefox', NULL, '2024-04-04 08:40:02', '2024-04-04 08:40:03'),
(27, '38.132.118.71', '2024-04-04 15:52:22', '2024-04-04 15:52:22', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-04 08:52:22', '2024-04-04 08:52:22'),
(28, '104.166.80.130', '2024-04-04 16:01:58', '2024-04-04 16:02:00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/120.0', 'Firefox', NULL, '2024-04-04 09:01:58', '2024-04-04 09:02:00'),
(29, '133.242.174.119', '2024-04-04 16:07:05', '2024-04-04 16:07:05', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Mobile Safari/537.36', 'Chrome', NULL, '2024-04-04 09:07:05', '2024-04-04 09:07:05'),
(30, '5.181.234.132', '2024-04-04 16:08:48', '2024-04-04 16:08:48', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-04 09:08:48', '2024-04-04 09:08:48'),
(31, '104.164.195.62', '2024-04-04 16:09:32', '2024-04-04 16:09:32', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-04 09:09:32', '2024-04-04 09:09:32'),
(32, '38.132.193.183', '2024-04-04 16:09:46', '2024-04-04 16:09:46', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-04 09:09:46', '2024-04-04 09:09:46'),
(33, '182.4.69.150', '2024-04-04 16:47:48', '2024-04-04 16:48:57', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Mobile Safari/537.36', 'Chrome', NULL, '2024-04-04 09:47:48', '2024-04-04 09:48:57'),
(34, '171.67.70.233', '2024-04-04 17:08:35', '2024-04-04 21:08:35', 'Mozilla/5.0 zgrab/0.x', 'Mozilla', NULL, '2024-04-04 10:08:35', '2024-04-04 14:08:35'),
(35, '188.212.135.56', '2024-04-04 18:22:30', '2024-04-04 18:22:30', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36', 'Chrome', NULL, '2024-04-04 11:22:30', '2024-04-04 11:22:30'),
(36, '34.71.255.110', '2024-04-04 20:54:27', '2024-04-04 20:54:27', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36', 'Chrome', NULL, '2024-04-04 13:54:27', '2024-04-04 13:54:27'),
(37, '34.134.31.226', '2024-04-04 20:58:12', '2024-04-04 20:58:12', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36', 'Chrome', NULL, '2024-04-04 13:58:12', '2024-04-04 13:58:12'),
(38, '103.190.46.115', '2024-04-05 00:34:11', '2024-04-05 01:15:55', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-04 17:34:11', '2024-04-04 18:15:55'),
(39, '171.67.70.238', '2024-04-05 01:08:35', '2024-04-05 17:46:34', 'Mozilla/5.0 zgrab/0.x', 'Mozilla', NULL, '2024-04-04 18:08:35', '2024-04-05 10:46:34'),
(40, '5.164.29.116', '2024-04-05 01:44:06', '2024-04-05 02:31:18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36 (scanner.ducks.party)', 'Chrome', NULL, '2024-04-04 18:44:06', '2024-04-04 19:31:18'),
(41, '3.92.82.180', '2024-04-05 01:45:41', '2024-04-05 01:45:41', 'axios/1.4.0', '0', NULL, '2024-04-04 18:45:41', '2024-04-04 18:45:41'),
(42, '199.45.155.22', '2024-04-05 01:53:29', '2024-04-05 01:53:29', 'Mozilla/5.0 (compatible; CensysInspect/1.1; +https://about.censys.io/)', 'Mozilla', NULL, '2024-04-04 18:53:29', '2024-04-04 18:53:29'),
(43, '199.45.155.55', '2024-04-05 02:28:20', '2024-04-05 02:28:20', 'Mozilla/5.0 (compatible; CensysInspect/1.1; +https://about.censys.io/)', 'Mozilla', NULL, '2024-04-04 19:28:20', '2024-04-04 19:28:20'),
(44, '65.154.226.167', '2024-04-05 03:03:38', '2024-04-05 03:03:38', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.5938.132 Safari/537.36', 'Chrome', NULL, '2024-04-04 20:03:38', '2024-04-04 20:03:38'),
(45, '199.45.155.38', '2024-04-05 03:16:23', '2024-04-05 03:16:23', 'Mozilla/5.0 (compatible; CensysInspect/1.1; +https://about.censys.io/)', 'Mozilla', NULL, '2024-04-04 20:16:23', '2024-04-04 20:16:23'),
(46, '171.67.70.233', '2024-04-05 05:36:00', '2024-04-05 09:46:34', 'Mozilla/5.0 zgrab/0.x', 'Mozilla', NULL, '2024-04-04 22:36:00', '2024-04-05 02:46:34'),
(47, '47.88.6.178', '2024-04-05 06:58:45', '2024-04-05 06:58:45', 'Mozilla/5.0 (Linux; Android 11; M2004J15SC) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.114 Mobile Safari/537.36', 'Chrome', NULL, '2024-04-04 23:58:45', '2024-04-04 23:58:45'),
(48, '47.89.195.210', '2024-04-05 06:58:45', '2024-04-05 06:58:45', 'Mozilla/5.0 (Linux; Android 11; M2004J15SC) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.114 Mobile Safari/537.36', 'Chrome', NULL, '2024-04-04 23:58:45', '2024-04-04 23:58:45'),
(49, '47.254.85.182', '2024-04-05 06:59:47', '2024-04-05 06:59:47', 'Mozilla/5.0 (Linux; Android 11; M2004J15SC) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.114 Mobile Safari/537.36', 'Chrome', NULL, '2024-04-04 23:59:47', '2024-04-04 23:59:47'),
(50, '47.88.101.3', '2024-04-05 06:59:47', '2024-04-05 06:59:47', 'Mozilla/5.0 (Linux; Android 11; M2004J15SC) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.114 Mobile Safari/537.36', 'Chrome', NULL, '2024-04-04 23:59:47', '2024-04-04 23:59:47'),
(51, '47.88.86.63', '2024-04-05 07:10:57', '2024-04-05 07:10:57', 'Mozilla/5.0 (Linux; Android 11; M2004J15SC) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.114 Mobile Safari/537.36', 'Chrome', NULL, '2024-04-05 00:10:57', '2024-04-05 00:10:57'),
(52, '47.254.25.10', '2024-04-05 07:10:57', '2024-04-05 07:10:57', 'Mozilla/5.0 (Linux; Android 11; M2004J15SC) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.114 Mobile Safari/537.36', 'Chrome', NULL, '2024-04-05 00:10:57', '2024-04-05 00:10:57'),
(53, '103.87.68.54', '2024-04-05 07:51:18', '2024-04-05 07:51:18', 'Mozilla/5.0 DelfiEEwww/613.0.0 EmbeddedBrowser (iPhone; CPU iPhone OS 17_3_1 like Mac OS X) AppleWebKit (KHTML, like Gecko) Mobile DeviceUID:  VendorUID:  AppPkgID: ee.delfi.delfi', 'Mozilla', NULL, '2024-04-05 00:51:18', '2024-04-05 00:51:18'),
(54, '52.33.177.82', '2024-04-05 07:51:18', '2024-04-05 07:51:18', 'BrightSign/9.0.97 (XD235) Mozilla/5.0 (X11; Linux aarch64) AppleWebKit/537.36 (KHTML, like Gecko) QtWebEngine/5.15.2 Chrome/87.0.4280.144 Safari/537.36', 'Chrome', NULL, '2024-04-05 00:51:18', '2024-04-05 00:51:18'),
(55, '149.202.79.129', '2024-04-05 07:51:18', '2024-04-05 07:51:18', 'BrightSign/9.0.97 (XD235) Mozilla/5.0 (X11; Linux aarch64) AppleWebKit/537.36 (KHTML, like Gecko) QtWebEngine/5.15.2 Chrome/87.0.4280.144 Safari/537.36', 'Chrome', NULL, '2024-04-05 00:51:18', '2024-04-05 00:51:18'),
(56, '23.82.137.82', '2024-04-05 07:51:20', '2024-04-05 07:51:20', 'Mozilla/5.0 Autopliuslt/8.3.0 EmbeddedBrowser (iPhone; CPU iPhone OS 17_3_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 DeviceUID:  VendorUID:  AppPkgID: lt.plius.auto', 'Mozilla', NULL, '2024-04-05 00:51:20', '2024-04-05 00:51:20'),
(57, '146.70.191.197', '2024-04-05 07:51:21', '2024-04-05 07:51:21', 'Mozilla/5.0 DelfiEEwww/613.0.0 EmbeddedBrowser (iPhone; CPU iPhone OS 17_3_1 like Mac OS X) AppleWebKit (KHTML, like Gecko) Mobile DeviceUID:  VendorUID:  AppPkgID: ee.delfi.delfi', 'Mozilla', NULL, '2024-04-05 00:51:21', '2024-04-05 00:51:21'),
(58, '65.154.226.169', '2024-04-05 08:08:45', '2024-04-05 08:08:45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.5938.132 Safari/537.36', 'Chrome', NULL, '2024-04-05 01:08:45', '2024-04-05 01:08:45'),
(59, '182.1.1.200', '2024-04-05 08:54:14', '2024-04-05 08:54:14', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Mobile Safari/537.36', 'Chrome', NULL, '2024-04-05 01:54:14', '2024-04-05 01:54:14'),
(60, '206.189.230.160', '2024-04-05 10:10:16', '2024-04-05 10:10:18', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-05 03:10:16', '2024-04-05 03:10:18'),
(61, '198.235.24.85', '2024-04-05 11:55:03', '2024-04-05 11:55:03', 'Expanse, a Palo Alto Networks company, searches across the global IPv4 space multiple times per day to identify customers&#39; presences on the Internet. If you would like to be excluded from our scans, please send IP addresses/domains to: scaninfo@paloaltonetworks.com', '0', NULL, '2024-04-05 04:55:03', '2024-04-05 04:55:03'),
(62, '104.166.80.102', '2024-04-05 14:44:29', '2024-04-05 14:44:29', 'Mozilla/5.0 (X11; Linux i686; rv:109.0) Gecko/20100101 Firefox/120.0', 'Firefox', NULL, '2024-04-05 07:44:29', '2024-04-05 07:44:29'),
(63, '104.166.80.162', '2024-04-05 14:45:14', '2024-04-05 14:45:14', 'Mozilla/5.0 (X11; Linux i686; rv:109.0) Gecko/20100101 Firefox/120.0', 'Firefox', NULL, '2024-04-05 07:45:14', '2024-04-05 07:45:14'),
(64, '103.145.163.98', '2024-04-05 14:51:55', '2024-04-05 15:17:44', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-05 07:51:55', '2024-04-05 08:17:44'),
(65, '87.236.176.74', '2024-04-05 15:06:35', '2024-04-05 15:06:35', 'Mozilla/5.0 (compatible; InternetMeasurement/1.0; +https://internet-measurement.com/)', 'Mozilla', NULL, '2024-04-05 08:06:35', '2024-04-05 08:06:35'),
(66, '205.169.39.244', '2024-04-05 15:07:26', '2024-04-05 15:07:37', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'Chrome', NULL, '2024-04-05 08:07:26', '2024-04-05 08:07:37'),
(67, '87.236.176.35', '2024-04-05 16:16:20', '2024-04-05 16:16:20', 'Mozilla/5.0 (compatible; InternetMeasurement/1.0; +https://internet-measurement.com/)', 'Mozilla', NULL, '2024-04-05 09:16:20', '2024-04-05 09:16:20'),
(68, '205.210.31.248', '2024-04-05 17:32:35', '2024-04-05 17:32:35', 'Expanse, a Palo Alto Networks company, searches across the global IPv4 space multiple times per day to identify customers&#39; presences on the Internet. If you would like to be excluded from our scans, please send IP addresses/domains to: scaninfo@paloaltonetworks.com', '0', NULL, '2024-04-05 10:32:35', '2024-04-05 10:32:35'),
(69, '193.122.155.11', '2024-04-05 18:26:11', '2024-04-05 18:26:11', 'Mozilla/5.0 (Windows NT 10.0; Trident/7.0; AS; rv:11.0) like Gecko', 'IE', NULL, '2024-04-05 11:26:11', '2024-04-05 11:26:11'),
(70, '87.236.176.115', '2024-04-05 18:50:12', '2024-04-05 18:50:12', 'Mozilla/5.0 (compatible; InternetMeasurement/1.0; +https://internet-measurement.com/)', 'Mozilla', NULL, '2024-04-05 11:50:12', '2024-04-05 11:50:12'),
(71, '205.210.31.219', '2024-04-05 20:00:32', '2024-04-05 20:00:32', 'Expanse, a Palo Alto Networks company, searches across the global IPv4 space multiple times per day to identify customers&#39; presences on the Internet. If you would like to be excluded from our scans, please send IP addresses/domains to: scaninfo@paloaltonetworks.com', '0', NULL, '2024-04-05 13:00:32', '2024-04-05 13:00:32'),
(72, '13.229.103.92', '2024-04-06 00:30:54', '2024-04-06 15:07:50', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-05 17:30:54', '2024-04-06 08:07:50'),
(73, '45.90.61.156', '2024-04-06 00:42:59', '2024-04-06 00:42:59', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.61 Safari/537.36', 'Chrome', NULL, '2024-04-05 17:42:59', '2024-04-05 17:42:59'),
(74, '176.53.218.253', '2024-04-06 03:12:25', '2024-04-06 03:12:25', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.61 Safari/537.36', 'Chrome', NULL, '2024-04-05 20:12:25', '2024-04-05 20:12:25'),
(75, '87.236.176.158', '2024-04-06 03:26:08', '2024-04-06 03:26:08', 'Mozilla/5.0 (compatible; InternetMeasurement/1.0; +https://internet-measurement.com/)', 'Mozilla', NULL, '2024-04-05 20:26:08', '2024-04-05 20:26:08'),
(76, '87.236.176.189', '2024-04-06 03:34:24', '2024-04-06 03:34:24', 'Mozilla/5.0 (compatible; InternetMeasurement/1.0; +https://internet-measurement.com/)', 'Mozilla', NULL, '2024-04-05 20:34:24', '2024-04-05 20:34:24'),
(77, '198.235.24.192', '2024-04-06 07:38:29', '2024-04-06 07:38:29', 'Expanse, a Palo Alto Networks company, searches across the global IPv4 space multiple times per day to identify customers&#39; presences on the Internet. If you would like to be excluded from our scans, please send IP addresses/domains to: scaninfo@paloaltonetworks.com', '0', NULL, '2024-04-06 00:38:29', '2024-04-06 00:38:29'),
(78, '188.165.87.102', '2024-04-06 10:06:28', '2024-04-06 10:10:25', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:109.0) Gecko/20100101 Firefox/115.0', 'Firefox', NULL, '2024-04-06 03:06:28', '2024-04-06 03:10:25'),
(79, '188.165.87.101', '2024-04-06 10:11:26', '2024-04-06 10:11:26', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:109.0) Gecko/20100101 Firefox/115.0', 'Firefox', NULL, '2024-04-06 03:11:26', '2024-04-06 03:11:26'),
(80, '188.165.87.106', '2024-04-06 10:12:24', '2024-04-06 10:12:24', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:109.0) Gecko/20100101 Firefox/115.0', 'Firefox', NULL, '2024-04-06 03:12:24', '2024-04-06 03:12:24'),
(81, '51.254.49.100', '2024-04-06 12:43:29', '2024-04-06 12:43:29', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:109.0) Gecko/20100101 Firefox/115.0', 'Firefox', NULL, '2024-04-06 05:43:29', '2024-04-06 05:43:29'),
(82, '51.254.49.97', '2024-04-06 13:06:33', '2024-04-06 13:06:33', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:109.0) Gecko/20100101 Firefox/115.0', 'Firefox', NULL, '2024-04-06 06:06:33', '2024-04-06 06:06:33'),
(83, '104.166.80.72', '2024-04-06 14:41:39', '2024-04-06 14:41:39', 'Mozilla/5.0 (X11; Linux i686; rv:109.0) Gecko/20100101 Firefox/120.0', 'Firefox', NULL, '2024-04-06 07:41:39', '2024-04-06 07:41:39'),
(84, '104.166.80.149', '2024-04-06 14:45:23', '2024-04-06 14:45:23', 'Mozilla/5.0 (X11; Linux i686; rv:109.0) Gecko/20100101 Firefox/120.0', 'Firefox', NULL, '2024-04-06 07:45:23', '2024-04-06 07:45:23'),
(85, '205.210.31.206', '2024-04-06 17:13:23', '2024-04-06 17:13:23', 'Expanse, a Palo Alto Networks company, searches across the global IPv4 space multiple times per day to identify customers&#39; presences on the Internet. If you would like to be excluded from our scans, please send IP addresses/domains to: scaninfo@paloaltonetworks.com', '0', NULL, '2024-04-06 10:13:23', '2024-04-06 10:13:23'),
(86, '138.68.158.207', '2024-04-06 20:59:37', '2024-04-06 20:59:39', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-06 13:59:37', '2024-04-06 13:59:39'),
(87, '198.235.24.51', '2024-04-06 21:02:01', '2024-04-06 21:02:01', NULL, '0', NULL, '2024-04-06 14:02:01', '2024-04-06 14:02:01'),
(88, '167.71.90.179', '2024-04-06 21:12:28', '2024-04-06 21:12:29', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-06 14:12:28', '2024-04-06 14:12:29'),
(89, '54.91.159.178', '2024-04-06 22:38:53', '2024-04-06 22:38:53', 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; en-US) AppleWebKit/534.1 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/534.1', 'Chrome', NULL, '2024-04-06 15:38:53', '2024-04-06 15:38:53'),
(90, '54.87.59.153', '2024-04-06 22:39:23', '2024-04-06 22:39:29', 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; en-US) AppleWebKit/534.1 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/534.1', 'Chrome', NULL, '2024-04-06 15:39:23', '2024-04-06 15:39:29'),
(91, '116.212.154.49', '2024-04-07 23:23:40', '2024-04-07 23:24:40', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:33.0) Gecko/20100101 Firefox/33.0', 'Firefox', NULL, '2024-04-07 16:23:40', '2024-04-07 16:24:40'),
(92, '182.4.68.180', '2024-04-08 11:27:46', '2024-04-08 11:27:46', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Mobile Safari/537.36', 'Chrome', NULL, '2024-04-08 04:27:46', '2024-04-08 04:27:46'),
(93, '205.210.31.141', '2024-04-08 13:53:09', '2024-04-08 13:53:09', NULL, '0', NULL, '2024-04-08 06:53:09', '2024-04-08 06:53:09'),
(94, '3.89.27.95', '2024-04-08 13:58:00', '2024-04-08 13:58:00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-08 06:58:00', '2024-04-08 06:58:00'),
(95, '104.166.80.128', '2024-04-08 14:41:48', '2024-04-08 14:41:48', 'Mozilla/5.0 (X11; Linux i686; rv:109.0) Gecko/20100101 Firefox/120.0', 'Firefox', NULL, '2024-04-08 07:41:48', '2024-04-08 07:41:48'),
(96, '104.166.80.102', '2024-04-08 14:44:10', '2024-04-08 14:44:10', 'Mozilla/5.0 (X11; Linux i686; rv:109.0) Gecko/20100101 Firefox/120.0', 'Firefox', NULL, '2024-04-08 07:44:10', '2024-04-08 07:44:10'),
(97, '205.210.31.12', '2024-04-08 14:46:04', '2024-04-08 14:46:04', NULL, '0', NULL, '2024-04-08 07:46:04', '2024-04-08 07:46:04'),
(98, '198.199.120.20', '2024-04-08 15:48:46', '2024-04-08 15:48:46', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-08 08:48:46', '2024-04-08 08:48:46'),
(99, '198.199.120.20', '2024-04-08 15:48:46', '2024-04-08 15:48:46', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-08 08:48:46', '2024-04-08 08:48:46'),
(100, '95.217.18.177', '2024-04-08 16:04:01', '2024-04-08 16:04:01', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Chrome', NULL, '2024-04-08 09:04:01', '2024-04-08 09:04:01'),
(101, '50.17.66.165', '2024-04-08 20:05:56', '2024-04-08 20:05:56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-08 13:05:56', '2024-04-08 13:05:56'),
(102, '167.99.150.227', '2024-04-08 20:29:53', '2024-04-08 20:29:53', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-08 13:29:53', '2024-04-08 13:29:53'),
(103, '167.99.150.227', '2024-04-08 20:29:53', '2024-04-08 20:29:53', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-08 13:29:53', '2024-04-08 13:29:53'),
(104, '178.128.235.240', '2024-04-08 21:37:48', '2024-04-08 21:37:48', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-08 14:37:48', '2024-04-08 14:37:48'),
(105, '178.128.235.240', '2024-04-08 21:37:48', '2024-04-08 21:37:48', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-08 14:37:48', '2024-04-08 14:37:48'),
(106, '182.4.68.235', '2024-04-08 23:24:34', '2024-04-08 23:24:34', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Mobile Safari/537.36', 'Chrome', NULL, '2024-04-08 16:24:34', '2024-04-08 16:24:34'),
(107, '209.126.85.229', '2024-04-09 02:09:47', '2024-04-09 02:10:00', 'Mozilla/5.0 (Unknown; Linux x86_64) AppleWebKit/538.1 (KHTML, like Gecko) PhantomJS/2.0.0 Safari/538.1', 'Safari', NULL, '2024-04-08 19:09:47', '2024-04-08 19:10:00'),
(108, '209.126.85.229', '2024-04-09 02:09:47', '2024-04-09 02:09:47', 'Mozilla/5.0 (Windows NT 6.1; rv:39.0) Gecko/20100101 Firefox/39.0', 'Firefox', NULL, '2024-04-08 19:09:47', '2024-04-08 19:09:47'),
(109, '209.126.85.229', '2024-04-09 02:09:47', '2024-04-09 02:09:47', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.134 Safari/537.36', 'Chrome', NULL, '2024-04-08 19:09:47', '2024-04-08 19:09:47'),
(110, '205.210.31.49', '2024-04-09 02:44:30', '2024-04-09 02:44:30', 'Expanse, a Palo Alto Networks company, searches across the global IPv4 space multiple times per day to identify customers&#39; presences on the Internet. If you would like to be excluded from our scans, please send IP addresses/domains to: scaninfo@paloaltonetworks.com', '0', NULL, '2024-04-08 19:44:30', '2024-04-08 19:44:30'),
(111, '205.210.31.221', '2024-04-09 08:35:17', '2024-04-09 08:35:17', 'Expanse, a Palo Alto Networks company, searches across the global IPv4 space multiple times per day to identify customers&#39; presences on the Internet. If you would like to be excluded from our scans, please send IP addresses/domains to: scaninfo@paloaltonetworks.com', '0', NULL, '2024-04-09 01:35:17', '2024-04-09 01:35:17'),
(112, '198.235.24.67', '2024-04-09 10:56:42', '2024-04-09 10:56:42', 'Expanse, a Palo Alto Networks company, searches across the global IPv4 space multiple times per day to identify customers&#39; presences on the Internet. If you would like to be excluded from our scans, please send IP addresses/domains to: scaninfo@paloaltonetworks.com', '0', NULL, '2024-04-09 03:56:42', '2024-04-09 03:56:42'),
(113, '161.35.179.119', '2024-04-09 11:52:57', '2024-04-09 11:52:57', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-09 04:52:57', '2024-04-09 04:52:57'),
(114, '161.35.179.119', '2024-04-09 11:52:57', '2024-04-09 11:52:57', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-09 04:52:57', '2024-04-09 04:52:57'),
(115, '182.4.68.13', '2024-04-09 12:15:23', '2024-04-09 12:15:23', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_3_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.3.1 Mobile/15E148 Safari/604.1', 'Safari', NULL, '2024-04-09 05:15:23', '2024-04-09 05:15:23'),
(116, '104.166.80.162', '2024-04-09 14:54:19', '2024-04-09 14:54:19', 'Mozilla/5.0 (X11; Linux i686; rv:109.0) Gecko/20100101 Firefox/120.0', 'Firefox', NULL, '2024-04-09 07:54:19', '2024-04-09 07:54:19'),
(117, '104.166.80.55', '2024-04-09 14:55:35', '2024-04-09 14:55:35', 'Mozilla/5.0 (X11; Linux i686; rv:109.0) Gecko/20100101 Firefox/120.0', 'Firefox', NULL, '2024-04-09 07:55:35', '2024-04-09 07:55:35'),
(118, '142.93.190.160', '2024-04-13 21:35:41', '2024-04-13 21:35:41', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-13 14:35:41', '2024-04-13 14:35:41'),
(119, '142.93.190.160', '2024-04-13 21:35:41', '2024-04-13 21:35:41', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-13 14:35:41', '2024-04-13 14:35:41'),
(120, '182.4.70.86', '2024-04-13 22:57:20', '2024-04-13 23:05:24', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Mobile Safari/537.36', 'Chrome', NULL, '2024-04-13 15:57:20', '2024-04-13 16:05:24'),
(121, '205.210.31.91', '2024-04-13 23:54:24', '2024-04-13 23:54:24', 'Expanse, a Palo Alto Networks company, searches across the global IPv4 space multiple times per day to identify customers&#39; presences on the Internet. If you would like to be excluded from our scans, please send IP addresses/domains to: scaninfo@paloaltonetworks.com', '0', NULL, '2024-04-13 16:54:24', '2024-04-13 16:54:24'),
(122, '182.4.70.66', '2024-04-14 09:29:49', '2024-04-14 09:43:15', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Mobile Safari/537.36', 'Chrome', NULL, '2024-04-14 02:29:49', '2024-04-14 02:43:15'),
(123, '182.4.70.90', '2024-04-14 11:29:19', '2024-04-14 11:30:27', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Mobile Safari/537.36', 'Chrome', NULL, '2024-04-14 04:29:19', '2024-04-14 04:30:27'),
(124, '182.4.70.86', '2024-04-14 12:15:51', '2024-04-14 12:15:51', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Mobile Safari/537.36', 'Chrome', NULL, '2024-04-14 05:15:51', '2024-04-14 05:15:51'),
(125, '54.226.107.238', '2024-04-14 16:28:53', '2024-04-14 16:28:53', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-14 09:28:53', '2024-04-14 09:28:53'),
(126, '159.65.43.214', '2024-04-14 21:34:21', '2024-04-14 21:34:21', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-14 14:34:21', '2024-04-14 14:34:21'),
(127, '159.65.43.214', '2024-04-14 21:34:21', '2024-04-14 21:34:21', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-14 14:34:21', '2024-04-14 14:34:21'),
(128, '209.126.85.229', '2024-04-15 02:18:40', '2024-04-15 02:24:05', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; Trident/7.0; Touch; MATBJS; rv:11.0) like Gecko', 'IE', NULL, '2024-04-14 19:18:40', '2024-04-14 19:24:05'),
(129, '209.126.85.229', '2024-04-15 02:18:40', '2024-04-15 02:18:40', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; WOW64; Trident/7.0; TNJB; 1ButtonTaskbar)', 'IE', NULL, '2024-04-14 19:18:40', '2024-04-14 19:18:40'),
(130, '209.126.85.229', '2024-04-15 02:18:40', '2024-04-15 02:18:40', 'Mozilla/5.0 (Linux; Android 5.0.1; VS985 4G Build/LRX21Y) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.84 Mobile Safari/537.36', 'Chrome', NULL, '2024-04-14 19:18:40', '2024-04-14 19:18:40'),
(131, '209.126.85.229', '2024-04-15 02:18:40', '2024-04-15 02:18:40', 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; WOW64; Trident/6.0; EIE10;ENUSWOL)', 'IE', NULL, '2024-04-14 19:18:40', '2024-04-14 19:18:40'),
(132, '205.210.31.151', '2024-04-15 07:50:50', '2024-04-15 07:50:50', NULL, '0', NULL, '2024-04-15 00:50:50', '2024-04-15 00:50:50'),
(133, '95.217.18.177', '2024-04-15 21:25:24', '2024-04-15 21:25:24', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Chrome', NULL, '2024-04-15 14:25:24', '2024-04-15 14:25:24'),
(134, '95.217.18.177', '2024-04-15 21:25:24', '2024-04-15 21:25:24', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Chrome', NULL, '2024-04-15 14:25:24', '2024-04-15 14:25:24'),
(135, '95.217.18.177', '2024-04-15 21:25:24', '2024-04-15 21:25:24', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Chrome', NULL, '2024-04-15 14:25:24', '2024-04-15 14:25:24'),
(136, '51.15.66.158', '2024-04-15 21:25:41', '2024-04-15 21:25:41', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Chrome', NULL, '2024-04-15 14:25:41', '2024-04-15 14:25:41'),
(137, '103.190.46.57', '2024-04-16 00:06:21', '2024-04-16 00:29:20', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-15 17:06:21', '2024-04-15 17:29:20'),
(138, '103.190.46.57', '2024-04-16 00:06:21', '2024-04-16 00:06:21', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-15 17:06:21', '2024-04-15 17:06:21'),
(139, '127.0.0.1', '2024-04-16 00:36:33', '2024-04-16 21:03:27', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-15 17:36:33', '2024-04-16 14:03:27'),
(140, '127.0.0.1', '2024-04-17 02:18:15', '2024-04-17 12:05:34', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-16 19:18:15', '2024-04-17 05:05:34'),
(141, '127.0.0.1', '2024-04-18 09:29:35', '2024-04-18 23:59:40', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-18 02:29:35', '2024-04-18 16:59:40'),
(142, '127.0.0.1', '2024-04-19 00:02:01', '2024-04-19 00:08:58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-18 17:02:01', '2024-04-18 17:08:58'),
(143, '127.0.0.1', '2024-04-22 09:16:25', '2024-04-22 15:43:11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-22 02:16:25', '2024-04-22 08:43:11'),
(144, '127.0.0.1', '2024-04-23 09:13:11', '2024-04-23 11:44:18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-23 02:13:11', '2024-04-23 04:44:18'),
(145, '127.0.0.1', '2024-04-24 10:50:38', '2024-04-24 23:32:44', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-24 03:50:38', '2024-04-24 16:32:44'),
(146, '127.0.0.1', '2024-04-25 08:47:11', '2024-04-25 19:57:08', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-04-25 01:47:11', '2024-04-25 12:57:08'),
(147, '127.0.0.1', '2024-05-02 10:21:30', '2024-05-02 21:29:57', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-05-02 03:21:30', '2024-05-02 14:29:57'),
(148, '127.0.0.1', '2024-05-03 00:46:29', '2024-05-03 16:07:25', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-05-02 17:46:29', '2024-05-03 09:07:25'),
(149, '127.0.0.1', '2024-05-04 22:56:36', '2024-05-04 23:58:40', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-05-04 15:56:36', '2024-05-04 16:58:40'),
(150, '127.0.0.1', '2024-05-05 00:00:05', '2024-05-05 14:44:41', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-05-04 17:00:05', '2024-05-05 07:44:41'),
(151, '127.0.0.1', '2024-05-06 00:02:08', '2024-05-06 12:38:26', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-05-05 17:02:08', '2024-05-06 05:38:26'),
(152, '127.0.0.1', '2024-05-12 10:25:36', '2024-05-12 13:17:06', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-05-12 03:25:36', '2024-05-12 06:17:06'),
(153, '127.0.0.1', '2024-05-27 10:17:48', '2024-05-27 23:33:24', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-05-27 03:17:48', '2024-05-27 16:33:24'),
(154, '127.0.0.1', '2024-05-28 08:57:37', '2024-05-28 15:42:40', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-05-28 01:57:37', '2024-05-28 08:42:40'),
(155, '127.0.0.1', '2024-05-29 07:56:12', '2024-05-29 10:40:00', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-05-29 00:56:12', '2024-05-29 03:40:00'),
(156, '127.0.0.1', '2024-06-06 14:53:00', '2024-06-06 15:05:53', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-06-06 07:53:00', '2024-06-06 08:05:53'),
(157, '127.0.0.1', '2024-08-04 21:21:36', '2024-08-04 21:22:30', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-08-04 14:21:36', '2024-08-04 14:22:30'),
(158, '127.0.0.1', '2024-08-05 10:30:45', '2024-08-05 15:36:28', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-08-05 03:30:45', '2024-08-05 08:36:28'),
(159, '127.0.0.1', '2024-08-06 13:42:12', '2024-08-06 14:45:42', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-08-06 06:42:12', '2024-08-06 07:45:42'),
(160, '127.0.0.1', '2024-08-14 23:32:33', '2024-08-14 23:54:13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-08-14 16:32:33', '2024-08-14 16:54:13'),
(161, '127.0.0.1', '2024-08-15 08:11:44', '2024-08-15 14:25:30', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-08-15 01:11:44', '2024-08-15 07:25:30'),
(162, '127.0.0.1', '2024-08-20 08:51:54', '2024-08-20 09:48:17', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-08-20 01:51:54', '2024-08-20 02:48:17'),
(163, '127.0.0.1', '2024-08-23 15:13:30', '2024-08-23 16:03:34', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-08-23 08:13:30', '2024-08-23 09:03:34'),
(164, '127.0.0.1', '2024-08-27 22:20:24', '2024-08-27 22:47:23', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-08-27 15:20:24', '2024-08-27 15:47:23'),
(165, '127.0.0.1', '2024-08-28 09:07:49', '2024-08-28 09:12:58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-08-28 02:07:49', '2024-08-28 02:12:58'),
(166, '127.0.0.1', '2024-09-02 08:56:08', '2024-09-02 08:58:37', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'Chrome', NULL, '2024-09-02 01:56:08', '2024-09-02 01:58:37');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `app_nama`
--
ALTER TABLE `app_nama`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `artikels`
--
ALTER TABLE `artikels`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `artikels_tag`
--
ALTER TABLE `artikels_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `download`
--
ALTER TABLE `download`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `halaman`
--
ALTER TABLE `halaman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `halaman_feat`
--
ALTER TABLE `halaman_feat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `halaman_static`
--
ALTER TABLE `halaman_static`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `iklans`
--
ALTER TABLE `iklans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `instansi`
--
ALTER TABLE `instansi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_tag`
--
ALTER TABLE `kategori_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `materis`
--
ALTER TABLE `materis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `medsos_instansi`
--
ALTER TABLE `medsos_instansi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu_feat`
--
ALTER TABLE `menu_feat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelayanan`
--
ALTER TABLE `pelayanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sosial_media`
--
ALTER TABLE `sosial_media`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sumber_dana`
--
ALTER TABLE `sumber_dana`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `visit`
--
ALTER TABLE `visit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `album`
--
ALTER TABLE `album`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `app_nama`
--
ALTER TABLE `app_nama`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `artikels`
--
ALTER TABLE `artikels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `artikels_tag`
--
ALTER TABLE `artikels_tag`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `download`
--
ALTER TABLE `download`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `halaman`
--
ALTER TABLE `halaman`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `halaman_feat`
--
ALTER TABLE `halaman_feat`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `halaman_static`
--
ALTER TABLE `halaman_static`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `iklans`
--
ALTER TABLE `iklans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `instansi`
--
ALTER TABLE `instansi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kategori_tag`
--
ALTER TABLE `kategori_tag`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `materis`
--
ALTER TABLE `materis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `medsos_instansi`
--
ALTER TABLE `medsos_instansi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `menu_feat`
--
ALTER TABLE `menu_feat`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pelayanan`
--
ALTER TABLE `pelayanan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `slides`
--
ALTER TABLE `slides`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `sosial_media`
--
ALTER TABLE `sosial_media`
  MODIFY `id` bigint(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `sumber_dana`
--
ALTER TABLE `sumber_dana`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tag`
--
ALTER TABLE `tag`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `visit`
--
ALTER TABLE `visit`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
