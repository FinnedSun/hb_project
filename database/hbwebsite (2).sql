-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 06 Bulan Mei 2024 pada 13.36
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hbwebsite`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_cred`
--

CREATE TABLE `admin_cred` (
  `sr_no` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin_cred`
--

INSERT INTO `admin_cred` (`sr_no`, `admin_name`, `admin_pass`) VALUES
(1, 'rayhan', '12345');

-- --------------------------------------------------------

--
-- Struktur dari tabel `carousel`
--

CREATE TABLE `carousel` (
  `sr_no` int(11) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `carousel`
--

INSERT INTO `carousel` (`sr_no`, `image`) VALUES
(1, 'IMG_15372.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gmap` varchar(100) NOT NULL,
  `pn1` varchar(30) NOT NULL,
  `pn2` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `ig` varchar(100) NOT NULL,
  `tw` varchar(100) NOT NULL,
  `iframe` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `pn1`, `pn2`, `email`, `fb`, `ig`, `tw`, `iframe`) VALUES
(1, 'Jl. Khatib Sulaiman No.48 sadfasdfa', 'https://maps.app.goo.gl/mDmSmryjAa2wvNp6A', '628956025887', '62895602588739', 'rayhanagungmaulana@gmail.com', 'https://facebook.com/asdfasdf', 'https://www.instagram.com/asdf', '', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127657.86730794268!2d100.21562644335938!3d-0.9160870000000046!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b8cf0d5762af:0xe8fd35b37bbbdab9!2sWhiz Prime Hotel Khatib Sulaiman Padang!5e0!3m2!1sid!2sid!4v1703358985859!5m2!1sid!2sid');

-- --------------------------------------------------------

--
-- Struktur dari tabel `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `facilities`
--

INSERT INTO `facilities` (`id`, `icon`, `name`, `description`) VALUES
(11, 'IMG_54868.svg', 'Bath', 'bak tempat mandi dilengakapi dengan aroma terapi yang menenangkan, dengan panjang 3 meter busa muat 2 orang sekaligus.'),
(12, 'IMG_21669.svg', 'Air Conditioner', 'Pendingin Ruangan disetai dengan Pemanas bisa membuat raungan lebih nyaman.'),
(13, 'IMG_34617.svg', 'GYM', 'Dengan ruang khusus yang dilengkapi dengan alat-alat yang bisa membuat tubuh lebih sehat dan bugar.'),
(14, 'IMG_18993.svg', 'Swimming Pool', 'Dilengkapi dengan ruangan kolam renang diatas gedung kita bisa melihat penadangan luar ruangan'),
(15, 'IMG_84810.svg', 'Televisi', 'Ruangan yang diliengkapi televisi dengan dimana tamu bisa menonton film-film netflex secara gratis.'),
(16, 'IMG_47461.svg', 'wifi', 'Wifi dengan kecepatan 50MB/s bisa membuat anda berselancar di internet dengan lancar.'),
(19, 'IMG_97005.svg', 'Double bed', 'as df asdf asdfasdf sad fsd fsad fas dfas df asdf sad fsd fsda sad fsad fsad fsda fsd fs daf'),
(20, 'IMG_69165.svg', 'louch', 'sad fsadfas d');

-- --------------------------------------------------------

--
-- Struktur dari tabel `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(16, 'Kamar tidur'),
(18, 'balkon');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment`
--

CREATE TABLE `payment` (
  `id` int(50) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(150) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `nama_product` varchar(200) NOT NULL,
  `harga_product` int(100) NOT NULL,
  `catatan_product` varchar(100) NOT NULL,
  `image` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `status_p` int(11) NOT NULL DEFAULT 1,
  `status_k` int(11) NOT NULL DEFAULT 1,
  `status_s` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `registered_users`
--

CREATE TABLE `registered_users` (
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `alamat` varchar(400) NOT NULL,
  `pincode` int(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `registered_users`
--

INSERT INTO `registered_users` (`username`, `email`, `phonenum`, `profile`, `alamat`, `pincode`, `password`, `status`, `datentime`) VALUES
('rayhan', 'sfinned@gmail.com', '0895602588739', 'inv_img', 'Komp Pesona Filano Block EE12 No08', 123, '$2y$10$tDip/vEcXkisADsuyNzC3uwUjfZYKxehZjNz993jtPLH31DNfskkm', 1, '2024-05-06 18:29:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `description` varchar(350) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `removed` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `area`, `price`, `quantity`, `adult`, `children`, `description`, `status`, `removed`) VALUES
(17, 'Faith Industries &quot;Paw-Paw&quot; Reversible Puffer Jacket', 3, 400, 200, 1, 2, 'Sizing Measurement Puffer Jacket:\r\n\r\nMedium: 70cm x 58cm x 62cm\r\nLarge: 72cm x 60cm x 64cm\r\nExtra Large: 74cm x 62cm x 66cm\r\nDouble Extra Large: 76cm x 64cm x 68cm', 1, 0),
(18, 'Faith Industries &quot;Mini-Feng&quot; Tie Dye Tshirt', 3, 225, 200, 1, 1, 'Medium : 58cm X 72cm\r\nLarge : 60cm X 74cm\r\nExtra Large : 62cm X 76cm\r\nDouble Extra Large : 64cm X 78cm\r\nTriple Extra Large : 66cm X 80cm', 1, 0),
(19, 'Faith Industries &quot;Makoto Yuki&quot; White Tshirt', 3, 200, 200, 1, 1, 'Medium : 58cm X 72cm\r\nLarge : 60cmX 74cm\r\nExtra Large : 62cmX 76cm\r\nDouble Extra Large : 64cm X 78cm', 1, 0),
(20, 'Faith Industries Feng The Harbinger Utility Cargo Pants', 3, 450, 200, 1, 1, 'Medium: 102cm x 35-53cm\r\nLarge: 104cm x 38-55cm\r\nExtra Large: 106cm x 41-57cm', 1, 0),
(21, 'Faith Industries &quot;Come Forth&quot; Black Tshirt', 12, 200, 200, 1, 1, 'Medium : 58cm X 72cm\r\nLarge : 60cmX 74cm\r\nExtra Large : 62cmX 76cm\r\nDouble Extra Large : 64cm X 78cm', 1, 0),
(22, 'FTH x EVOS x My Hero Academia &quot;Plus Ultra&quot; Baseball Cap', 12, 250, 200, 1, 1, 'Kalau ada produk atau orderan terjadi kendala seperti halnya:\r\n\r\nProduk cacat\r\nProduk kurang lengkap\r\nProduk tidak sesuai deskripsi\r\nSalah kirim produk (termasuk salah size)', 1, 0),
(23, 'rayhna', 1, 100, 100, 1, 1, 'asdsasa', 1, 1),
(24, 'asdf', 134, 123, 12, 1, 1, 'asdf', 1, 1),
(25, 'asdf', 111, 123, 123, 1, 1, 'askjdfkjsafkjasndkjfnsakdfnksdnfkasdkfsdajkfn', 1, 1),
(26, 'asdf', 23, 234, 234, 234, 234, 'asdfas', 1, 1),
(27, 'asdfsa', 100, 400, 200, 1, 1, 'asdfsadfdsaf', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `room_facilities`
--

CREATE TABLE `room_facilities` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `room_features`
--

CREATE TABLE `room_features` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `room_images`
--

CREATE TABLE `room_images` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `room_images`
--

INSERT INTO `room_images` (`sr_no`, `room_id`, `image`, `thumb`) VALUES
(28, 18, 'IMG_35660.jpg', 1),
(29, 18, 'IMG_35912.jpg', 0),
(30, 18, 'IMG_32797.jpg', 0),
(31, 18, 'IMG_16345.jpeg', 0),
(32, 17, 'IMG_15397.jpeg', 1),
(33, 17, 'IMG_97269.jpeg', 0),
(34, 17, 'IMG_27748.jpeg', 0),
(35, 17, 'IMG_58472.jpeg', 0),
(36, 19, 'IMG_15272.jpg', 0),
(37, 19, 'IMG_89256.jpg', 1),
(38, 19, 'IMG_50406.jpg', 0),
(39, 19, 'IMG_45733.jpg', 0),
(40, 19, 'IMG_45876.jpg', 0),
(41, 19, 'IMG_77595.jpg', 0),
(42, 20, 'IMG_70111.jpg', 0),
(43, 20, 'IMG_47472.jpg', 0),
(44, 20, 'IMG_84064.jpg', 0),
(45, 20, 'IMG_29968.jpg', 0),
(46, 20, 'IMG_74750.jpg', 1),
(47, 21, 'IMG_39070.jpg', 1),
(48, 21, 'IMG_34797.jpg', 0),
(49, 21, 'IMG_37246.jpg', 0),
(50, 21, 'IMG_64149.jpg', 0),
(51, 21, 'IMG_49567.jpg', 0),
(52, 21, 'IMG_25636.jpg', 0),
(53, 22, 'IMG_66647.jpg', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `sr_no` int(11) NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `site_about` varchar(300) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`sr_no`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'Faith Industries', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores corrupti quaerat dolorum laudantium eius iusto iure. Amet numquam fugiat, exercitationem, eos animi voluptatum fuga ad qui excepturi illum, sequi vel?', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `team_details`
--

CREATE TABLE `team_details` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `picture` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `team_details`
--

INSERT INTO `team_details` (`sr_no`, `name`, `picture`) VALUES
(3, 'Siti Nomina', 'IMG_85513.png'),
(6, 'Alex G.Morgan', 'IMG_41749.png'),
(7, 'Mery Jane', 'IMG_68880.png'),
(9, 'xia ming', 'IMG_87693.png'),
(10, 'isabela dexa', 'IMG_94118.png'),
(11, 'Natalie Martinez', 'IMG_46273.png'),
(12, 'Grace Kim', 'IMG_37288.png'),
(13, 'Olivia Blake', 'IMG_33943.png'),
(14, 'Maya Thompson', 'IMG_94287.png'),
(15, 'Aisha Patel', 'IMG_74825.png'),
(16, 'Ethan Turner', 'IMG_19890.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_cred`
--

CREATE TABLE `user_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(120) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `pincode` int(11) NOT NULL,
  `dob` date NOT NULL,
  `profile` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `token` varchar(200) DEFAULT NULL,
  `t_expire` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_queries`
--

CREATE TABLE `user_queries` (
  `sr_no` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_queries`
--

INSERT INTO `user_queries` (`sr_no`, `nama`, `email`, `subject`, `message`, `date`, `seen`) VALUES
(6, 'Rayhan agung', 'rayhan@gmail.com', 'safd sd fsd', 'sad fsd sd sdf sdf sd sdf .', '2023-12-24', 1),
(9, 'asdfsadf', 'rayhanagungmaulana.7@gmail.com', 'sadfsdf', 'kbkyuuygubiubub', '2024-01-01', 1),
(10, 'Rayhan', 'rayhanagungmaulana.04@gmail.com', 'as fdasd fsad f', 'asdf asdf asdf asf asd fsad asd fas dfas dfa sdf', '2024-01-01', 1),
(11, 'Rayhan', 'rayhanagungmaulana.04@gmail.com', 'as fdasd fsad f', 'asdf asdf asdf asf asd fsad asd fas dfas dfa sdf', '2024-01-01', 1),
(12, 'rayhan', 'rayhanagungmaulana.04@gmail.com', 'sadfsad fsad fasd', 'sa dfsad fsd fsda fsda fsad fsad fsda fsad fsad fasdf sad fasd fsa df asdf asdf a sdf sda fas d', '2024-01-03', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indeks untuk tabel `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indeks untuk tabel `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indeks untuk tabel `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `registered_users`
--
ALTER TABLE `registered_users`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room id` (`room_id`),
  ADD KEY `facilities id` (`facilities_id`);

--
-- Indeks untuk tabel `room_features`
--
ALTER TABLE `room_features`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `rm id` (`room_id`),
  ADD KEY `features id` (`features_id`);

--
-- Indeks untuk tabel `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room_id` (`room_id`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indeks untuk tabel `team_details`
--
ALTER TABLE `team_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indeks untuk tabel `user_cred`
--
ALTER TABLE `user_cred`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`sr_no`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin_cred`
--
ALTER TABLE `admin_cred`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `carousel`
--
ALTER TABLE `carousel`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `room_facilities`
--
ALTER TABLE `room_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `room_features`
--
ALTER TABLE `room_features`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `room_images`
--
ALTER TABLE `room_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `team_details`
--
ALTER TABLE `team_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD CONSTRAINT `facilities id` FOREIGN KEY (`facilities_id`) REFERENCES `facilities` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `room id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `room_features`
--
ALTER TABLE `room_features`
  ADD CONSTRAINT `features id` FOREIGN KEY (`features_id`) REFERENCES `features` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `rm id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
