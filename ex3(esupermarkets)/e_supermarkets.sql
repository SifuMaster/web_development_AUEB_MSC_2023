-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2023 at 11:41 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_supermarkets`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Αντισηπτικά'),
(2, 'Βρεφικά είδη'),
(3, 'Για κατοικίδια'),
(4, 'Καθαριότητα'),
(5, 'Ποτά-Αναψυκτικά');

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `subcategory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `name`, `description`, `subcategory`) VALUES
(1, 'ΒΕΡΓΙΝΑ | Μπύρα Lager Φιάλη 500ml\r\n', 'Η αυθεντική ελληνική μπύρα Lager από 100% Βύνη Θράκης και εκλεκτές πρώτες ύλες ζυμωμένη με γνώση & μεράκι στην Κομοτηνή.', 13),
(2, 'ΒΕΡΓΙΝΑ | Μπύρα Weiss Φιάλη 500ml', 'Η ελληνική πολυβραβευμένη μπύρα Weiss.\n\nΣταρένια, αφιλτράριστη μπίρα με θολή όψη, χάρη στην ειδική αφροζύμη που εμπεριέχεικαι της χαρίζει ιδιαίτερη γεύση και πλούσιο, φρουτώδες άρωμα.', 13),
(3, 'FISCHER | Μπύρα Pilsner Φιάλη 500ml', 'Με καταγωγή από την Αλσατία, η Fisher είναι μια μπύρα Pilsner υψηλής ποιότητας. Τη χαρακτηρίζει το ανοιχτό χρώμα, η διακριτική παρουσία του λυκίσκου στο άρωμα, η ελαφρώς πικρή γεύση και η χαρακτηριστική της επίγευση. \nΜπορείς να την απολαύσεις όταν βγεις', 13),
(4, 'PAULANER | Μπύρα Weiss Φιάλη 500ml', 'Φυσική συννεφιά και μεταξένια λάμψη χρυσού στο ποτήρι κάτω από ένα πολύ ισχυρό αφρό. Μια από τις αγαπημένες μπύρες του κόσμου. Η πρώτη γουλιά Weissbier έχει ένα ήπιο άρωμα μπανάνας. Ο ουρανίσκος εντοπίζει νότες από μάνγκο και ανανά και την ισορροπία γλυκο', 13);

-- --------------------------------------------------------

--
-- Table structure for table `product_physical`
--

CREATE TABLE `product_physical` (
  `id` int(11) NOT NULL,
  `product_details` int(11) NOT NULL,
  `supermarket` int(11) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_physical`
--

INSERT INTO `product_physical` (`id`, `product_details`, `supermarket`, `price`, `quantity`) VALUES
(1, 1, 1, 1.25, 20),
(2, 2, 1, 1.75, 25),
(3, 1, 2, 1.3, 10),
(4, 3, 1, 2, 35),
(5, 3, 2, 2.25, 20),
(6, 3, 5, 2.5, 10),
(7, 4, 2, 4.5, 30);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `category`, `name`) VALUES
(1, 1, 'Αντισηπτικά'),
(2, 2, 'Απορρυπαντικά'),
(3, 2, 'Βρεφικές τροφές'),
(4, 2, 'Γάλα'),
(5, 3, 'Pet shop/Τροφή γάτας'),
(6, 3, 'Pet shop/Τροφή σκύλου'),
(7, 4, 'Αποσμητικά χώρου'),
(8, 4, 'Είδη γενικού καθαρισμού'),
(9, 4, 'Είδη κουζίνας - Μπάνιου'),
(10, 4, 'Εντομοκτόνα - Εντομοαπωθητικά'),
(11, 4, 'Χαρτικά'),
(12, 5, 'Κρασιά'),
(13, 5, 'Μπύρες'),
(14, 5, 'Ποτά'),
(15, 5, 'Χυμοί');

-- --------------------------------------------------------

--
-- Table structure for table `supermarket`
--

CREATE TABLE `supermarket` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supermarket`
--

INSERT INTO `supermarket` (`id`, `name`, `address`, `email`, `phone`) VALUES
(1, 'Σκλαβενίτης', 'Δωδεκανήσου 61', 'sklavenitis@mail.gr', '2105720312'),
(2, 'ΑΒ Βασιλόπουλος', 'Φιλαδέλφειας 83, Αχαρνές 136 73', 'ab_vasilopoulos@mail.gr', '2102446661'),
(3, 'Γαλαξίας', 'Λένορμαν 129, Κολωνός, Αθήνα, 10442', 'galaxias@mail.gr', '2122225400'),
(4, 'Κρητικός', 'Αγίου Νεκτάριου 55, Ηράκλειο 141 22', 'kritikos@mail.gr', '2102853696'),
(5, 'Carrefour', ' Εθνικής Αντιστάσεως 104, Παλλήνη, ΤΚ 15351', 'carrefour@mail.gr', '2111165261');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `create_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `create_datetime`) VALUES
(1, 'Phivos', 'lala@yahoo.gr', '202cb962ac59075b964b07152d234b70', '2023-09-07 15:26:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product subcategory` (`subcategory`);

--
-- Indexes for table `product_physical`
--
ALTER TABLE `product_physical`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product supermarket` (`supermarket`),
  ADD KEY `product details` (`product_details`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `supermarket`
--
ALTER TABLE `supermarket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_physical`
--
ALTER TABLE `product_physical`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `supermarket`
--
ALTER TABLE `supermarket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `product subcategory` FOREIGN KEY (`subcategory`) REFERENCES `subcategory` (`id`);

--
-- Constraints for table `product_physical`
--
ALTER TABLE `product_physical`
  ADD CONSTRAINT `product details` FOREIGN KEY (`product_details`) REFERENCES `product_details` (`id`),
  ADD CONSTRAINT `product supermarket` FOREIGN KEY (`supermarket`) REFERENCES `supermarket` (`id`);

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `main category` FOREIGN KEY (`category`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
