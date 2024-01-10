-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2024 at 05:31 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minang_recipe`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(25) NOT NULL,
  `admin_email` varchar(30) NOT NULL,
  `admin_pass` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_pass`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `alat_bahan`
--

CREATE TABLE `alat_bahan` (
  `id_alat` int(11) NOT NULL,
  `resep_id` int(11) NOT NULL,
  `item` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alat_bahan`
--

INSERT INTO `alat_bahan` (`id_alat`, `resep_id`, `item`) VALUES
(59, 37, 'Telur Puyuh 3 butir'),
(60, 37, 'Teri'),
(61, 37, 'Santan 1 liter'),
(379, 36, 'Ayam 12'),
(381, 45, 'Bahan 1'),
(458, 44, '3 ikat daun pepaya muda'),
(459, 44, '2 ikat daun singkong'),
(460, 44, '½ butir kelapa agak muda, parut'),
(461, 44, '1 sdm air jeruk nipis'),
(462, 44, '1 sdt garam'),
(463, 44, 'mentimun'),
(512, 60, '1/2 kg Daging Sapi '),
(513, 60, '2 lbr Daun salam'),
(514, 60, '5 siung bawang putih'),
(515, 60, '4 bhn'),
(527, 64, 'sd'),
(532, 61, '1 kg daging sapi'),
(533, 61, '2500 ml santan'),
(534, 61, '3 sdt garam'),
(546, 71, 'santan'),
(561, 46, 'udang'),
(562, 46, 'cabe'),
(563, 35, 'Ikan');

-- --------------------------------------------------------

--
-- Table structure for table `langkah`
--

CREATE TABLE `langkah` (
  `id_langkah` int(11) NOT NULL,
  `resep_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `langkah`
--

INSERT INTO `langkah` (`id_langkah`, `resep_id`, `nama`, `gambar`) VALUES
(53, 35, 'blu abstract', '../preview/upload/Screenshot 2023-03-24 151951.png'),
(55, 37, 'Masak di kompor', '../preview/upload/Halaman Tampil Resep.png'),
(158, 36, 'sd', '../preview/upload/Picture1.png'),
(164, 36, 'sd', '../preview/upload/download.jpg'),
(165, 36, 'sd', '../preview/upload/Screenshot (3122).png'),
(167, 36, 'sd', '../preview/upload/blurred-abstract-background-interior-view-looking-out-toward-empty-office-lobby-entrance-doors-glass-curtain-wall-with-frame_1339-6368.jpg'),
(168, 36, 'sd', '../preview/upload/QR Code Hasil Kelulusan.png'),
(170, 45, 'baru2', '../preview/upload/ruang-kerja-di-rumah-header.jpg'),
(172, 45, 'asa', '../preview/upload/depositphotos_263539898-stock-photo-blur-image-of-modern-kitchen.jpg'),
(176, 45, 'baru2', '../preview/upload/blurred-abstract-background-interior-view-looking-out-toward-empty-office-lobby-entrance-doors-glass-curtain-wall-with-frame_1339-6368.jpg'),
(179, 36, 'asdas', '../preview/upload/White Green Modern Company Invoice.png'),
(184, 45, 'baru2', '../preview/upload/_ae07a710-a755-458d-b70e-d9c769eedf31.jpg'),
(189, 45, 'baru2', '../preview/upload/WhatsApp Image 2023-06-10 at 19.06.41.jpeg'),
(190, 35, 'blu abstract', '../preview/upload/White Green Modern Company Invoice.png'),
(192, 45, 'baru2', '../preview/upload/mbkm.png'),
(205, 36, '193', '../preview/upload/portal.png'),
(206, 36, 'adsfsd', '../preview/upload/redhat.png'),
(222, 36, '9', '../preview/upload/tekomm.jpeg'),
(223, 45, 'tujuh', '../preview/upload/unandbanner.jpg'),
(225, 44, 'Siangi dan potong-potong sayuran lalu cuci bersih', '../preview/upload/download.jpg'),
(226, 44, 'Rebus daun pepaya dan daun singkong hingga empuk, angkat. Masukkan ke dalam air es, rendam hingga akan digunakan. Tiriskan, potong-potong, sisihkan.', '../preview/upload/download (1).jpg'),
(227, 44, 'Tumis bawang merah yang dirajang hingga layu dan harum. Lalu tambahkan bumbu halus. Masukkan daun salam dan jeruk. Aduk rata.', '../preview/upload/anyang-urap-a-la-padang-langkah-memasak-4-foto.webp'),
(228, 44, 'Tambahkan kelapa parut. Tambahkan garam dan (gula bila suka).', '../preview/upload/kelapa.jpg'),
(229, 44, 'Aduk hingga rata dan matang. Menjelang diangkat tambahkan air jeruk nipis. Kembali aduk rata. Koreksi rasa', '../preview/upload/Screenshot 2023-12-30 205010.png'),
(230, 44, 'Cara menyajikannya, campur sayuran yang sudah direbus tadi dengan sambal kelapanya. Aduk rata. Sajikan... bisa ditambahkan mentimun...', '../preview/upload/Screenshot 2023-12-30 205253.png'),
(232, 46, 'Langkah 1', '../preview/upload/_616dbde8-1511-4181-adaa-53e93259af1d.jpg'),
(242, 46, '2', '../preview/upload/sisfo.jpg'),
(248, 35, 'ya', '../preview/upload/portal.png'),
(266, 60, 'Daging cuci bersih dengan air mengalir Rebus air hingga mendidih lalu masukkan daging beserta daun salam dan jahe untuk mengurangi aroma/khas dirinya (sapi). Rebus kurang lebih 45 menit/hingga daging empuk Atau sebelumnya lumuri dengan parutan nanas terle', '../preview/upload/cuci.jpg'),
(267, 60, 'Ambil minyak bekas goreng dendeng sedikit. Lalu tumis bumbu tumis di atas, dalam hal ini step awal yaitu goreng bawang merah yg sudah diiris tipis dulu sampai harum atau setengah matang lalu baru masukan dan tumis Cabai yg di Chopper kasar atau ulek kasar', '../preview/upload/Screenshot 2024-01-07 170226.png'),
(270, 61, 'Cuci daging sapi', '../preview/upload/cuci.jpg'),
(273, 64, 'asd', '../preview/upload/WhatsApp Image 2023-06-26 at 21.39.55.jpeg'),
(281, 71, 'edit terbaru langkah', '../preview/upload/kelapa.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orderan`
--

CREATE TABLE `orderan` (
  `order_id` int(11) NOT NULL,
  `form_order_id` varchar(50) DEFAULT NULL,
  `us_id` int(11) DEFAULT NULL,
  `resep_id` int(11) DEFAULT NULL,
  `tgl_order` date NOT NULL DEFAULT current_timestamp(),
  `harga` int(11) DEFAULT NULL,
  `status_pembayaran` enum('Sukses','Cancelled') DEFAULT 'Sukses'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `orderan`
--

INSERT INTO `orderan` (`order_id`, `form_order_id`, `us_id`, `resep_id`, `tgl_order`, `harga`, `status_pembayaran`) VALUES
(24, 'ORD76228621', 47, 36, '2024-01-08', 20000, 'Sukses'),
(25, 'ORD67409649', 47, 35, '2024-01-08', 20000, 'Sukses'),
(30, 'ORD87311285', 1, 45, '2024-01-08', 32000, 'Sukses'),
(40, 'ORD6756697', 1, 44, '2024-01-08', 100000, 'Sukses'),
(41, 'ORD82564941', 74, 35, '2024-01-09', 20000, 'Sukses'),
(44, 'ORD27006620', 74, 46, '2024-01-09', 50000, 'Sukses'),
(45, 'ORD93143690', 47, 44, '2024-01-09', 100000, 'Sukses'),
(47, 'ORD28154058', 74, 45, '2024-01-09', 32000, 'Sukses'),
(48, 'ORD73372989', 74, 36, '2024-01-09', 20000, 'Sukses'),
(49, 'ORD3248498', 74, 44, '2024-01-09', 100000, 'Sukses'),
(51, 'ORD32459404', 1, 35, '2024-01-09', 20000, 'Sukses'),
(52, 'ORD75601104', 1, 36, '2024-01-09', 20000, 'Sukses'),
(53, 'ORD55264710', 75, 35, '2024-01-09', 20000, 'Sukses'),
(54, 'ORD79969619', 75, 44, '2024-01-09', 100000, 'Sukses'),
(56, 'ORD86639824', 76, 44, '2024-01-09', 100000, 'Sukses');

-- --------------------------------------------------------

--
-- Table structure for table `resep`
--

CREATE TABLE `resep` (
  `resep_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `deskripsi` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `durasi` varchar(10) NOT NULL,
  `daerah_asal` varchar(25) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `tipe` enum('ori','umum') NOT NULL,
  `url_vidio` varchar(255) DEFAULT NULL,
  `us_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resep`
--

INSERT INTO `resep` (`resep_id`, `title`, `author`, `deskripsi`, `thumbnail`, `durasi`, `daerah_asal`, `harga`, `tipe`, `url_vidio`, `us_id`) VALUES
(35, 'Asam Padeh', 'partner', 'red hat akademi', '../preview/upload/Asam Padeh.jpg', '12', 'bukittinggi', 20000, 'ori', 'tes baru', NULL),
(36, 'Ampiang Dadiah', 'Farid ', 'Ampiang Dadiah khas Bukittinggi.', '../preview/upload/Ampiang Dadiah.jpg', '6', 'Bukittinggi', 20000, 'ori', '-', NULL),
(37, 'Sambalado Tanak', '', 'Bagi yang kangen masakan sambalado tanak khas minang silahkan dicoba :)', '../preview/upload/sambalado-tanak-khas-minang-foto-resep-utama.jpg', '20', 'Padang', 20000, 'umum', '', 47),
(44, 'Anyang', 'Lulung Thyo Thoharie', 'Kalau mertua sedang berkunjung ke rumah, selalu minta dibikinin anyang ini. Biasanya sih sayurannya pakai daun pepaya saja, tapi saya suka bikinnya sayurannya dicampur-campur...jadi lebih bervariasi.  Sumber gambar & langkah dari kompas serta cookpad.', '../preview/upload/Anyang.jpg', '45', 'Padang', 100000, 'ori', 'https://drive.google.com/file/d/1S6X_fGXMkln1PcOwQv0LO7LE00cdkLuf/preview', NULL),
(45, 'Singgang Ikan Nila', 'Welly Herlina', 'Tes deskripsi saja', '../preview/upload/singgang-ikan-nila-khas-situjuah-minang-foto-resep-utama.webp', '12', 'Padang', 32000, 'ori', 'url baru', NULL),
(46, 'Udang Saos Padang', 'Admin', 'Selalu ga tahan liat udang segar yang dijual di pasar. Jadilah menu special Udang Saus Padang. Karena dimasak dari udang yang fresh, rasanya udah pasti nikmat. Nyumm.', '../preview/upload/udang.jpg', '30', 'Contoh', 50000, 'ori', 'Link', NULL),
(60, 'Dendeng Batokok', NULL, 'Dendeng batokok adalah masakan khas Sumatera Barat dibuat dari irisan tipis dan lebar. Setelah daging sapi diiris tipis melebar, lalu dipukul-pukul dengan batu cobek supaya daging nya menjadi lembut. Kemudian makanan ini diberi cabai hijau yang diiris kasar.', '../preview/upload/Dendeng Batokok.jpg', '60', 'Bukittinggi', 0, 'umum', '', 1),
(61, 'Rendang', NULL, 'Minang atau Sumatera Barat terkenal dengan makanan atau kuliner yang sangat enak dan sudah mendunia, salah satunya adalah rendang.', '../preview/upload/hero.png', '360', 'Bukittinggi', 0, 'umum', '', 1),
(64, 'adsaa', NULL, 'sd', '../preview/upload/WhatsApp Image 2023-06-20 at 20.08.26.jpeg', '3', 'fd', NULL, 'umum', NULL, 47),
(71, 'randang', NULL, 'asda', '../preview/upload/anyang-urap-a-la-padang-langkah-memasak-4-foto.webp', '60', 'sdfsd', NULL, 'umum', NULL, 75);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `us_id` int(11) NOT NULL,
  `us_name` varchar(255) NOT NULL,
  `us_email` varchar(255) NOT NULL,
  `us_pass` varchar(255) NOT NULL,
  `us_occ` varchar(255) DEFAULT NULL,
  `us_img` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`us_id`, `us_name`, `us_email`, `us_pass`, `us_occ`, `us_img`) VALUES
(1, 'shadeq', 'shadeq@gmail.com', 'shadeq123', 'Mahasiswa', '../preview/upload/_616dbde8-1511-4181-adaa-53e93259af1d.jpg'),
(3, 'dika', 'dika@gmail.com', 'dika123', 'Mahasiswa', ''),
(22, 'asas', 'adw@gmail.com', 'asa3214', '', ''),
(25, 'ver', 'ver@gmail.com', 'aawaaaa098', '', ''),
(30, 'ini tes', 'vdsd@gmail.com', '12131231d', '', ''),
(45, 'sah', 'qwerty@gmail.com', '$2y$10$Ba7m7aQiyht083pzLsqGN.hvgHBNJBEOCMf7KS5sBI2xJzKLw.D8m', '', ''),
(47, 'Koki Minang', 'tes@mail.com', 'tes123', 'Kerja', '../preview/upload/koki.png'),
(48, 'Shadeq', 'Yusuf@gmail.com', '1123', 'Mahasiswa', '../preview/upload/if.png'),
(67, 'sherly', 'sherly@terserah.com', '1234', 'Mahasiswa', ''),
(73, 'sda', 'sda@da.g', 'dasa', '', ''),
(74, 'haahahaha', 'sdada@gmail.com', 'sdasdas', 'dfsd', '../preview/upload/Halaman Tampil Resep.png'),
(75, 'tesakun', 'tesakun@mail.com', '1234', 'Mahasiswa', '../preview/upload/MENU UTAMA FTI.png'),
(76, 'Diganti', 'demo@gmail.com', '123', 'Mahasiswa', '../preview/upload/Anyang.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `alat_bahan`
--
ALTER TABLE `alat_bahan`
  ADD PRIMARY KEY (`id_alat`),
  ADD KEY `alat_bahan_ibfk_1` (`resep_id`);

--
-- Indexes for table `langkah`
--
ALTER TABLE `langkah`
  ADD PRIMARY KEY (`id_langkah`),
  ADD KEY `langkah_ibfk_1` (`resep_id`);

--
-- Indexes for table `orderan`
--
ALTER TABLE `orderan`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_ibfk_2` (`resep_id`),
  ADD KEY `order_ibfk_1` (`us_id`),
  ADD KEY `resep_id` (`resep_id`);

--
-- Indexes for table `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`resep_id`),
  ADD KEY `us_id` (`us_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`us_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alat_bahan`
--
ALTER TABLE `alat_bahan`
  MODIFY `id_alat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=564;

--
-- AUTO_INCREMENT for table `langkah`
--
ALTER TABLE `langkah`
  MODIFY `id_langkah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;

--
-- AUTO_INCREMENT for table `orderan`
--
ALTER TABLE `orderan`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `resep`
--
ALTER TABLE `resep`
  MODIFY `resep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `us_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alat_bahan`
--
ALTER TABLE `alat_bahan`
  ADD CONSTRAINT `alat_bahan_ibfk_1` FOREIGN KEY (`resep_id`) REFERENCES `resep` (`resep_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `langkah`
--
ALTER TABLE `langkah`
  ADD CONSTRAINT `langkah_ibfk_1` FOREIGN KEY (`resep_id`) REFERENCES `resep` (`resep_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderan`
--
ALTER TABLE `orderan`
  ADD CONSTRAINT `orderan_ibfk_1` FOREIGN KEY (`resep_id`) REFERENCES `resep` (`resep_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orderan_ibfk_2` FOREIGN KEY (`us_id`) REFERENCES `user` (`us_id`);

--
-- Constraints for table `resep`
--
ALTER TABLE `resep`
  ADD CONSTRAINT `resep_ibfk_1` FOREIGN KEY (`us_id`) REFERENCES `user` (`us_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
