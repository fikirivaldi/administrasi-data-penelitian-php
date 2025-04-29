-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2024 at 09:01 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_administrasi_data_penelitian`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokumen`
--

CREATE TABLE `dokumen` (
  `id` int(11) NOT NULL,
  `file` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `tahun` int(4) NOT NULL,
  `deskripsi` text NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `judul`, `author`, `tahun`, `deskripsi`, `file`, `created_at`) VALUES
(6, 'Verifiability Metric Notion in e-Voting System', 'Teguh Nurhadi Suharsono, Kuspriyanto Kuspriyanto, ', 2019, 'Voting has become an important part of the democratic system. The voters are more and more widespread,', 'Verifiability notion in e-Voting based on modified ThreeBallot system.pdf', '2024-07-11 12:02:39'),
(7, 'PENGEMBANGAN DAN PEMEKARAN USAHA PERTANIAN,  INDUS', 'Suhanda Suhanda, Erwan Komara, R Didin Kusdian, Bi', 2020, 'Desa Sunten Jaya, Kecamatan Lembang, Kabupaten Bandung Barat, merupakan desa yang memiliki banyak potensi. Namun potensi tersebut belum didukung dengan adanya bimbingan dan pengarahan untuk memaksimalkan potensi tersebut. ', 'masrahman,+1_Artikel+PKMB+USB-UK_Lembang.pdf', '2024-07-11 12:04:00'),
(8, 'DT-MSOF Strategy and its Application to Reduce the', 'Fazmah Arif Yulianto, Teguh Nurhadi Suharsono', 2018, 'A computing strategy called Double Track–Most Significant Operation First (DT-MSOF) is proposed. The goal of this strategy is to reduce computation time by reducing the number of operations that need to be executed, while maintaining a correct final result. Executions are conducted on a sequence of computing operations that have previously been sorted based on significance.', 'DT-MSOF Strategy and its Application to Reduce the Number of Operations in AHP.pdf', '2024-07-11 12:05:00'),
(9, 'Sistem Pakar Diagnosis Penyakit Infeksi Saluran Pe', 'Muhamad Taufiq Hidayatuloh, Teguh Nurhadi Suharson', 2023, 'Kesehatan merupakan aspek krusial dalam kehidupan manusia dan memengaruhi kelangsungan hidup dan kualitasnya. Terdapat berbagai masalah kesehatan yang sering dianggap sepele disebabkan oleh kurangnya pengetahuan tentang penyakit, biaya perawatan yang tinggi, dan kesulitan akses ke layanan kesehatan.', '2894-Article Text-12224-1-10-20231002.pdf', '2024-07-11 12:06:16'),
(10, 'Implementation of Simple Verifiability Metric to M', 'Teguh Nurhadi Suharsono, Dini Anggraini, Budi Raha', 2020, 'Verifiability is one of the parameters in e-voting that can increase confidence in voting technology with several parties ensuring that voters do not change their votes. Voting has become an important part of the democratization system, both to make choices regarding policies, to elect representatives to sit in the representative assembly, and to elect leaders.', 'Implementation of Simple Verifiability Metric to Measure the Degree.pdf', '2024-07-11 12:08:04'),
(11, 'Individual Verifiability Metric in e-Voting System', 'Teguh Nurhadi Suharsono, Budi Rahardjo', 2019, 'The voting process is an essential part of the democratic system. As the size and breadth of voter distribution grow, the social aspects become more complex and the need to manage the voting process more efficiently and more quickly increases. This makes electronic voting (e-voting) a more interesting alternative voting technology. ', 'Individual Verifiability Metric in e-Voting System.pdf', '2024-07-11 12:08:44'),
(12, 'Implementasi Metode Algoritma C4. 5 Untuk Prediksi', 'Alam Nurzaman, Teguh Nurhadi Suharsono', 2023, 'Anak merupakan anugerah dari Tuhan Yang Maha Esa, tetapi tidak sedikit di antara mereka yang menghadapi keterbelakangan mental, salah satunya adalah autisme, sebuah gangguan otak yang menyebabkan beberapa area otak tidak berfungsi secara normal. Dampaknya adalah kesulitan dalam berkomunikasi dan berinteraksi sosial.', '848-863.pdf', '2024-07-11 12:09:47'),
(13, 'Penentuan Optimalisasi TSP (Travelling Salesman Pr', 'Teguh Nurhadi Suharsono, Muhamad Reza Saddat', 2018, 'Pengiriman barang merupakan salah satu hal yang penting dalam suatu bidang usaha. Segala upaya diusahakan agar barang cepat kepada konsumen dan bisa di terima dalam kondisi yang baik. Namun seringkali proses distribusi tersebut mengalami kendala dengan masalah transportasi yang ada, misalnya bagaimana cara meminimalkan jarak dan biaya transportasi pada proses distribusi. ', 'mufid,+Manajer+Jurnal,+senter2017_326-335.pdf', '2024-07-11 12:10:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(70) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `username`, `password`, `image`) VALUES
(1, 'tioprayudha7@gmail.com', 'Tio', 'tioprayuda', '$2y$10$fIvI.RhfMByWE7rflnq7cuED7UsGTqJ4UAOPPr6tAf35s6lTM5JVG', 'uploads/aarn-giri-B1cJcYPoFxY-unsplash.jpg'),
(8, 'fikirivaldi12@gmail.com', 'Fiki', 'fikirivaldi', '$2y$10$o9JU2Yh3nDreMIlxeHz6z.dzb5aATgmOsT8GgR6noSJIRs1ljI3Mi', 'uploads/Foto Fiki (1).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `universitas` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `jenis_kelamin` enum('P','L') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `jurusan`, `universitas`, `alamat`, `jenis_kelamin`) VALUES
(1, 1, 'Teknik Informatika', 'Universitas Sangga Buana', 'Jl Buahbatu', 'L'),
(2, 1, 'Teknik Informatika', 'Universitas Sangga Buana', 'Jl Buahbatu', 'L'),
(3, 8, 'Informatika', 'YPKP', 'Kopo Elok', 'L'),
(4, 8, 'Informatika', 'YPKP', 'Kopo Elok', 'L');

-- --------------------------------------------------------

--
-- Table structure for table `_prisma_migrations`
--

CREATE TABLE `_prisma_migrations` (
  `id` varchar(36) NOT NULL,
  `checksum` varchar(64) NOT NULL,
  `finished_at` datetime(3) DEFAULT NULL,
  `migration_name` varchar(255) NOT NULL,
  `logs` text DEFAULT NULL,
  `rolled_back_at` datetime(3) DEFAULT NULL,
  `started_at` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `applied_steps_count` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `_prisma_migrations`
--

INSERT INTO `_prisma_migrations` (`id`, `checksum`, `finished_at`, `migration_name`, `logs`, `rolled_back_at`, `started_at`, `applied_steps_count`) VALUES
('02e1fa17-b5f9-445f-a361-e5bdae6abb10', 'f733a2ea70724df81b2846ec76097f08d967bb3a893ae29ef2eb41e17c536b59', '2024-07-06 03:03:43.324', '20240706030343_db_administrasi_data_penelitian', NULL, NULL, '2024-07-06 03:03:43.286', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `_prisma_migrations`
--
ALTER TABLE `_prisma_migrations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
