-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2025 at 06:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medical_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `mission` text DEFAULT NULL,
  `vision` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `working_hours` text DEFAULT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `title`, `description`, `mission`, `vision`, `address`, `phone`, `email`, `working_hours`, `last_updated`) VALUES
(1, 'Medical Store', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae distinctio quia velit in deleniti amet est modi numquam nemo molestias illo, qui dolorem laudantium minus error doloribus quasi ea, neque enim voluptatum exercitationem. Iste doloribus dicta officia sed sapiente praesentium, obcaecati pariatur quas blanditiis tenetur, molestias aliquam quasi ipsam, ea illum architecto eaque itaque fugit! Commodi aspernatur minus repellendus necessitatibus debitis iste ab placeat corrupti similique culpa expedita sunt earum omnis, molestiae veritatis modi fugiat laborum dolorem eos! Esse quisquam exercitationem numquam dolores. Dicta, veniam fugiat. Impedit dicta deserunt atque! Dolor deserunt eligendi provident saepe incidunt facere impedit? Aut, officia.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae distinctio quia velit in deleniti amet est modi numquam nemo molestias illo, qui dolorem laudantium minus error doloribus quasi ea, neque enim voluptatum exercitationem. Iste doloribus dicta officia sed sapiente praesentium, obcaecati pariatur quas blanditiis tenetur, molestias aliquam quasi ipsam, ea illum architecto eaque itaque fugit! Commodi aspernatur minus repellendus necessitatibus debitis iste ab placeat corrupti similique culpa expedita sunt earum omnis, molestiae veritatis modi fugiat laborum dolorem eos! Esse quisquam exercitationem numquam dolores. Dicta, veniam fugiat. Impedit dicta deserunt atque! Dolor deserunt eligendi provident saepe incidunt facere impedit? Aut, officia.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae distinctio quia velit in deleniti amet est modi numquam nemo molestias illo, qui dolorem laudantium minus error doloribus quasi ea, neque enim voluptatum exercitationem. Iste doloribus dicta officia sed sapiente praesentium, obcaecati pariatur quas blanditiis tenetur, molestias aliquam quasi ipsam, ea illum architecto eaque itaque fugit! Commodi aspernatur minus repellendus necessitatibus debitis iste ab placeat corrupti similique culpa expedita sunt earum omnis, molestiae veritatis modi fugiat laborum dolorem eos! Esse quisquam exercitationem numquam dolores. Dicta, veniam fugiat. Impedit dicta deserunt atque! Dolor deserunt eligendi provident saepe incidunt facere impedit? Aut, officia.', 'Asuliea,Saver,Dhaka', '01794970124', 'sagor@gmail.com', '60 hours', '2025-03-10 17:37:16');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `userpassword` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Id`, `username`, `userpassword`) VALUES
(1, 'admin', 'admin123'),
(2, 'Juthy', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `time_slot` enum('morning','evening') NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `doctor_id`, `appointment_date`, `time_slot`, `status`, `created_at`) VALUES
(7, 11, 2, '2025-03-12', 'morning', 'approved', '2025-03-10 13:29:51'),
(8, 12, 2, '2025-03-10', 'morning', 'approved', '2025-03-10 17:32:18');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(4, 'Sagor Kumar Pal', 'sagor@gmail.com', 'Hello, I am sagor', '2025-03-10 13:11:16'),
(5, 'sagor Pal', 'sagor@gmail.com', 'hello', '2025-03-10 17:34:47');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `specialty` varchar(100) NOT NULL,
  `hospital` varchar(200) NOT NULL,
  `morning_schedule` varchar(50) NOT NULL,
  `evening_schedule` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `number`, `email`, `specialty`, `hospital`, `morning_schedule`, `evening_schedule`, `age`, `gender`, `description`, `fee`, `image`) VALUES
(2, 'Farzana Akter Juthy', '01739355272', 'juthy@gmail.com', 'Medicine', 'Islamic Hospital', '9:00-12:00', '5:00-12:00', 22, 'Female', 'I am doctor', 600.00, '1741546316_Doctor Image.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblcart`
--

CREATE TABLE `tblcart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcart`
--

INSERT INTO `tblcart` (`id`, `user_id`, `product_name`, `product_price`, `product_quantity`) VALUES
(26, 8, 'Napa Extend', 2.00, 1),
(27, 8, 'Toothpaste', 150.00, 1),
(28, 8, 'sagor', 2000.00, 1),
(62, 11, 'Napa One', 2.00, 1),
(63, 11, 'Toothpaste', 150.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct`
--

CREATE TABLE `tblproduct` (
  `Id` int(11) NOT NULL,
  `Pname` varchar(255) NOT NULL,
  `Pprice` decimal(10,2) NOT NULL,
  `Pimage` varchar(255) NOT NULL,
  `Pcategory` varchar(100) NOT NULL,
  `Pdescription` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblproduct`
--

INSERT INTO `tblproduct` (`Id`, `Pname`, `Pprice`, `Pimage`, `Pcategory`, `Pdescription`, `created_at`) VALUES
(34, 'Napa One', 2.00, 'Upload_image/napa_1 (Custom).jpeg', 'Medecine', 'Napa 1', '2025-03-09 22:32:56'),
(35, 'Napa One', 2.00, 'Upload_image/napa_1 (Custom).jpeg', 'Home', 'Napa 1', '2025-03-09 22:32:56'),
(36, 'Toothpaste', 150.00, 'Upload_image/SENSODYNE FRESH MINT (Custom).png', 'Medecine', 'Sensodyne toothpastes work in different ways depending on the product\'s active ingredient—potassium nitrate, strontium acetate/chloride. Potassium nitrate: The potassium ion hyperpolarizes the nerve and stops it from firing. The nerve impulses are thus desensitized and there is no pain.', '2025-03-10 13:16:37'),
(37, 'Toothpaste', 150.00, 'Upload_image/SENSODYNE FRESH MINT (Custom).png', 'Home', 'Sensodyne toothpastes work in different ways depending on the product\'s active ingredient—potassium nitrate, strontium acetate/chloride. Potassium nitrate: The potassium ion hyperpolarizes the nerve and stops it from firing. The nerve impulses are thus desensitized and there is no pain.', '2025-03-10 13:16:37'),
(38, 'ActivePlus', 320.00, 'Upload_image/ActivePlus Blood Glucometer.png', 'Equipment', 'hhjajlklall', '2025-03-10 17:35:42'),
(39, 'ActivePlus', 320.00, 'Upload_image/ActivePlus Blood Glucometer.png', 'Home', 'hhjajlklall', '2025-03-10 17:35:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `Id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Number` varchar(200) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `reward_points` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`Id`, `username`, `Email`, `Number`, `Password`, `reward_points`) VALUES
(6, 'Sagor Kumar Pal', 'sagor45@gmail.com', '01739355272', 'sagor@gmail.com', 139.60),
(7, 'Naib', 'naib@gmail.com', '01749591592', 'naib@gmail.com', 0.00),
(8, 'Farzana Akter Juthy', 'juthyfarzanaakter@gmail.com', '01794970124', 'juthyfarzanaakter@gmail.com', 0.00),
(9, 'utsha', 'utsha@gmail.com', '01794970122', 'utsha@gmail.com', 0.00),
(10, 'Md. Sadman', 'sadman@gmail.com', '01745167922', 'sadman@gmail.com', 0.00),
(11, 'Masum Sir', 'masumsir@gmail.com', '01794970122', '$2y$10$q352LJoCMrlKHMT2wuUJRucO7.2PmWn2UdCdCQYYrZZz1MfEOcjEq', 105.00),
(12, 'mahi mahidul', 'mahi@gmail.com', '01794970124', 'mahi@gmail.com', 70.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tblcart`
--
ALTER TABLE `tblcart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblcart`
--
ALTER TABLE `tblcart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tblproduct`
--
ALTER TABLE `tblproduct`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbluser` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tblcart`
--
ALTER TABLE `tblcart`
  ADD CONSTRAINT `tblcart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbluser` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
