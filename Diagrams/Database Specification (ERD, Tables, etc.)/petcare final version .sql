-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2026 at 02:44 PM
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
-- Database: `petcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `AppointmentID` int(11) NOT NULL,
  `OwnerID` int(11) DEFAULT NULL,
  `PetID` int(11) DEFAULT NULL,
  `VetID` int(11) DEFAULT NULL,
  `AppointmentDate` date DEFAULT NULL,
  `status` enum('Pending','Accepted','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`AppointmentID`, `OwnerID`, `PetID`, `VetID`, `AppointmentDate`, `status`) VALUES
(17, 58, 9, 71, '2026-05-06', 'Accepted'),
(18, 58, 9, 76, '2026-05-30', 'Pending'),
(19, 58, 12, 71, '2026-05-29', 'Accepted'),
(20, 58, 9, 76, '2026-05-22', 'Pending'),
(21, 58, 12, 71, '2026-05-27', 'Accepted'),
(22, 58, 9, 71, '2026-05-13', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `BookingID` int(11) NOT NULL,
  `PetID` int(11) NOT NULL,
  `OwnerID` int(11) DEFAULT NULL,
  `ProviderID` int(11) DEFAULT NULL,
  `BookingDate` date DEFAULT NULL,
  `StartTime` time DEFAULT NULL,
  `EndTime` time DEFAULT NULL,
  `Price` decimal(10,2) GENERATED ALWAYS AS (timestampdiff(HOUR,`StartTime`,`EndTime`) * 50) STORED,
  `service_id` int(11) DEFAULT NULL,
  `status` enum('Accepted','Rejected','Under Review') DEFAULT 'Under Review',
  `EscrowStatus` enum('Held','Released','Refunded') DEFAULT 'Held',
  `EscrowAmount` decimal(10,2) DEFAULT 0.00,
  `CheckInTime` datetime DEFAULT NULL,
  `CheckOutTime` datetime DEFAULT NULL,
  `QRToken` varchar(50) DEFAULT NULL,
  `TotalPrice` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`BookingID`, `PetID`, `OwnerID`, `ProviderID`, `BookingDate`, `StartTime`, `EndTime`, `service_id`, `status`, `EscrowStatus`, `EscrowAmount`, `CheckInTime`, `CheckOutTime`, `QRToken`, `TotalPrice`) VALUES
(31, 9, 58, 69, '2026-05-07', '19:30:00', '20:30:00', 22, '', 'Refunded', 100.00, '2026-05-01 17:29:28', '2026-05-01 17:29:32', '6EE12B', 100.00),
(32, 9, 58, 69, '2026-05-07', '19:30:00', '20:30:00', 23, '', 'Released', 200.00, '2026-05-01 17:35:05', '2026-05-01 17:35:09', 'CE0826', 200.00),
(34, 9, 58, 69, '2026-05-19', '18:41:00', '19:41:00', 23, '', 'Released', 200.00, NULL, '2026-05-01 17:46:41', NULL, 200.00),
(35, 12, 58, 69, '2026-05-28', '05:35:00', '20:35:00', 23, '', 'Released', 200.00, '2026-05-02 16:38:40', '2026-05-02 16:38:44', '7C698A', 200.00),
(38, 9, 58, 69, '2026-05-28', '05:35:00', '20:35:00', 22, '', 'Released', 100.00, '2026-05-07 15:33:57', '2026-05-07 15:34:19', '33C0A4', 100.00),
(39, 9, 58, 69, '2026-05-21', '04:43:00', '16:43:00', 23, '', 'Released', 200.00, NULL, '2026-05-07 22:53:52', '1E68AD', 200.00),
(40, 9, 58, 69, '2026-05-28', '05:35:00', '20:35:00', 26, '', 'Released', 0.00, '2026-05-07 22:50:26', '2026-05-07 22:50:32', '7FFFCA', 0.00),
(41, 8, 58, 69, '2026-05-28', '05:35:00', '20:35:00', 27, '', 'Released', 0.00, '2026-05-08 19:07:49', '2026-05-08 19:07:54', '1BB477', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `chroniccondition`
--

CREATE TABLE `chroniccondition` (
  `ConditionID` int(11) NOT NULL,
  `PetID` int(11) NOT NULL,
  `ConditionName` varchar(100) NOT NULL,
  `Status` enum('Active','Controlled','Critical','Resolved') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chroniccondition`
--

INSERT INTO `chroniccondition` (`ConditionID`, `PetID`, `ConditionName`, `Status`) VALUES
(14, 9, 'diabets', 'Active'),
(15, 8, 'diabets', 'Active'),
(16, 8, 'diabets', 'Active'),
(17, 8, 'diabets', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `incidents`
--

CREATE TABLE `incidents` (
  `IncidentID` int(11) NOT NULL,
  `BookingID` int(11) NOT NULL,
  `SitterID` int(11) NOT NULL,
  `OwnerID` int(11) NOT NULL,
  `PetID` int(11) NOT NULL,
  `Description` text NOT NULL,
  `Severity` enum('Low','Medium','High','Critical') DEFAULT 'Low',
  `Status` enum('Open','Resolved') DEFAULT 'Open',
  `ReportedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `incidents`
--

INSERT INTO `incidents` (`IncidentID`, `BookingID`, `SitterID`, `OwnerID`, `PetID`, `Description`, `Severity`, `Status`, `ReportedAt`) VALUES
(4, 34, 69, 58, 9, 'its dengrious', 'Critical', 'Open', '2026-05-01 15:46:41'),
(5, 39, 69, 58, 9, 'medium', 'Medium', 'Open', '2026-05-07 20:50:47'),
(6, 39, 69, 58, 9, 'High', 'High', 'Open', '2026-05-07 20:53:52');

-- --------------------------------------------------------

--
-- Table structure for table `lost_pets`
--

CREATE TABLE `lost_pets` (
  `id` int(11) NOT NULL,
  `PetID` int(11) NOT NULL,
  `OwnerID` int(11) NOT NULL,
  `Description` text NOT NULL,
  `Location` varchar(255) NOT NULL,
  `Status` varchar(50) DEFAULT 'Lost',
  `DateReported` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lost_pets`
--

INSERT INTO `lost_pets` (`id`, `PetID`, `OwnerID`, `Description`, `Location`, `Status`, `DateReported`) VALUES
(1, 12, 58, 'afdaf', 'helwan', 'Lost', '2026-04-28 21:08:44'),
(2, 9, 58, 'red collar', 'helwan', 'Lost', '2026-05-05 16:21:30'),
(3, 8, 58, 'red ', 'helwan', 'Lost', '2026-05-07 13:36:35'),
(4, 9, 58, 'red', 'helwan', 'Lost', '2026-05-08 17:09:43');

-- --------------------------------------------------------

--
-- Table structure for table `medicalrecord`
--

CREATE TABLE `medicalrecord` (
  `RecordID` int(11) NOT NULL,
  `PetID` int(11) NOT NULL,
  `VetID` int(11) DEFAULT NULL,
  `Diagnosis` text DEFAULT NULL,
  `RecordDate` date DEFAULT NULL,
  `Behavior` varchar(255) DEFAULT NULL,
  `LabNotes` text DEFAULT NULL,
  `LabFile` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicalrecord`
--

INSERT INTO `medicalrecord` (`RecordID`, `PetID`, `VetID`, `Diagnosis`, `RecordDate`, `Behavior`, `LabNotes`, `LabFile`) VALUES
(7, 12, 71, 'good', '2026-05-01', NULL, 'no', 'lab_69f4aa36573d6.jpg'),
(8, 9, 71, 'sick', '2026-05-01', NULL, 'note', 'lab_69f4be232c5d1.jpg'),
(9, 8, 71, 'no', '2026-05-07', NULL, 'no', 'lab_1778159468_69fc8f6c780ef.pdf'),
(10, 8, NULL, 'diabiets', '2026-05-07', NULL, NULL, NULL),
(11, 15, 71, 'no', '2026-05-08', NULL, 'no', 'lab_1778259876_69fe17a4a2e78.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` enum('unread','read') DEFAULT 'unread',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `title`, `message`, `status`, `created_at`) VALUES
(2, 46, 'LostPet', 'LOST PET ALERT: A pet has been reported lost in helwan. Description: afdaf', 'unread', '2026-04-28 21:08:44'),
(5, 71, 'LostPet', 'LOST PET ALERT: A pet has been reported lost in helwan. Description: afdaf', 'read', '2026-04-28 21:08:44'),
(8, 46, 'System', 'i am the admin here', 'unread', '2026-04-28 21:09:03'),
(11, 71, 'System', 'i am the admin here', 'read', '2026-04-28 21:09:04'),
(17, 46, 'Verification', 'Your account has been verified! You can now use all features of PetCare.', 'unread', '2026-05-01 01:20:55'),
(22, 76, 'Verification', 'Your account has been verified! You can now use all features of PetCare.', 'unread', '2026-05-01 01:21:00'),
(27, 69, 'System', 'Your certification \'my pet\' has been Verified.', 'read', '2026-05-01 14:36:32'),
(30, 69, 'System', 'Your certification \'my pet\' has been Verified.', 'read', '2026-05-01 14:59:54'),
(32, 69, 'System', 'Your certification \'my pet\' has been Verified.', 'read', '2026-05-01 15:08:26'),
(36, 46, 'System Broadcast', 'i am the admin here', 'unread', '2026-05-02 13:29:33'),
(38, 69, 'System Broadcast', 'i am the admin here', 'read', '2026-05-02 13:29:33'),
(39, 71, 'System Broadcast', 'i am the admin here', 'read', '2026-05-02 13:29:33'),
(41, 76, 'System Broadcast', 'i am the admin here', 'unread', '2026-05-02 13:29:33'),
(43, 46, 'System Broadcast', 'I am the admin here', 'unread', '2026-05-02 13:55:16'),
(45, 69, 'System Broadcast', 'I am the admin here', 'read', '2026-05-02 13:55:16'),
(46, 71, 'System Broadcast', 'I am the admin here', 'read', '2026-05-02 13:55:16'),
(48, 76, 'System Broadcast', 'I am the admin here', 'unread', '2026-05-02 13:55:16'),
(50, 46, 'System Broadcast', 'i am the admin', 'unread', '2026-05-05 03:36:40'),
(51, 58, 'System Broadcast', 'i am the admin', 'read', '2026-05-05 03:36:40'),
(52, 69, 'System Broadcast', 'i am the admin', 'unread', '2026-05-05 03:36:40'),
(53, 71, 'System Broadcast', 'i am the admin', 'unread', '2026-05-05 03:36:40'),
(54, 76, 'System Broadcast', 'i am the admin', 'unread', '2026-05-05 03:36:40'),
(55, 46, 'LostPet', 'LOST PET ALERT: A pet has been reported lost in helwan. Description: red collar', 'unread', '2026-05-05 16:21:30'),
(56, 58, 'LostPet', 'LOST PET ALERT: A pet has been reported lost in helwan. Description: red collar', 'read', '2026-05-05 16:21:30'),
(57, 69, 'LostPet', 'LOST PET ALERT: A pet has been reported lost in helwan. Description: red collar', 'unread', '2026-05-05 16:21:30'),
(58, 71, 'LostPet', 'LOST PET ALERT: A pet has been reported lost in helwan. Description: red collar', 'unread', '2026-05-05 16:21:30'),
(59, 76, 'LostPet', 'LOST PET ALERT: A pet has been reported lost in helwan. Description: red collar', 'unread', '2026-05-05 16:21:30'),
(60, 79, 'LostPet', 'LOST PET ALERT: A pet has been reported lost in helwan. Description: red collar', 'unread', '2026-05-05 16:21:30'),
(61, 69, 'System', 'Your certification \'CPR\' has been Verified.', 'unread', '2026-05-07 13:24:50'),
(62, 46, 'LostPet', 'LOST PET ALERT: A pet has been reported lost in helwan. Description: red ', 'unread', '2026-05-07 13:36:35'),
(63, 58, 'LostPet', 'LOST PET ALERT: A pet has been reported lost in helwan. Description: red ', 'read', '2026-05-07 13:36:35'),
(64, 69, 'LostPet', 'LOST PET ALERT: A pet has been reported lost in helwan. Description: red ', 'unread', '2026-05-07 13:36:35'),
(65, 71, 'LostPet', 'LOST PET ALERT: A pet has been reported lost in helwan. Description: red ', 'unread', '2026-05-07 13:36:35'),
(66, 76, 'LostPet', 'LOST PET ALERT: A pet has been reported lost in helwan. Description: red ', 'unread', '2026-05-07 13:36:35'),
(67, 79, 'LostPet', 'LOST PET ALERT: A pet has been reported lost in helwan. Description: red ', 'unread', '2026-05-07 13:36:35'),
(68, 87, 'LostPet', 'LOST PET ALERT: A pet has been reported lost in helwan. Description: red ', 'unread', '2026-05-07 13:36:35'),
(69, 89, 'LostPet', 'LOST PET ALERT: A pet has been reported lost in helwan. Description: red ', 'unread', '2026-05-07 13:36:35'),
(70, 79, 'Verification', 'Your account has been verified!', 'unread', '2026-05-07 13:47:59'),
(71, 87, 'Verification', 'Your account has been verified!', 'unread', '2026-05-07 13:48:00'),
(72, 89, 'Verification', 'Your account has been verified!', 'unread', '2026-05-07 13:48:01'),
(73, 46, 'System Broadcast', 'I am the admin here', 'unread', '2026-05-07 13:54:40'),
(74, 58, 'System Broadcast', 'I am the admin here', 'unread', '2026-05-07 13:54:40'),
(75, 69, 'System Broadcast', 'I am the admin here', 'unread', '2026-05-07 13:54:40'),
(76, 71, 'System Broadcast', 'I am the admin here', 'unread', '2026-05-07 13:54:40'),
(77, 76, 'System Broadcast', 'I am the admin here', 'unread', '2026-05-07 13:54:40'),
(78, 79, 'System Broadcast', 'I am the admin here', 'unread', '2026-05-07 13:54:40'),
(79, 87, 'System Broadcast', 'I am the admin here', 'unread', '2026-05-07 13:54:40'),
(80, 89, 'System Broadcast', 'I am the admin here', 'unread', '2026-05-07 13:54:40'),
(81, 58, 'Prescription', 'A new prescription (sick) for rabbit has been added by your Veterinarian.', 'unread', '2026-05-07 13:59:47'),
(82, 87, 'System', 'Your account has been suspended by an administrator.', 'unread', '2026-05-07 14:01:08'),
(83, 58, 'Order', 'Your order #15 status has been updated to: Confirmed', 'unread', '2026-05-07 14:27:38'),
(84, 58, 'Order', 'Your order #17 status has been updated to: Confirmed', 'unread', '2026-05-07 20:13:50'),
(85, 58, 'Order', 'Your order #16 status has been updated to: Confirmed', 'unread', '2026-05-07 20:13:52'),
(86, 58, 'System', 'URGENT: An incident has been reported for your pet during booking #39.', 'unread', '2026-05-07 20:50:47'),
(87, 58, 'System', 'URGENT: A serious incident has been reported for your pet. Booking #39 has been automatically terminated for safety. Please check your dashboard immediately.', 'unread', '2026-05-07 20:53:52'),
(88, 58, 'Order', 'Your order #18 status has been updated to: Confirmed', 'unread', '2026-05-07 21:47:41'),
(89, 58, 'Order', 'Your order #19 status has been updated to: Confirmed', 'unread', '2026-05-08 17:02:23'),
(90, 58, 'Prescription', 'A new prescription (sick) for rabbit has been added by your Veterinarian.', 'read', '2026-05-08 17:04:18'),
(91, 46, 'LostPet', 'LOST PET ALERT: A pet has been reported lost in helwan. Description: red', 'unread', '2026-05-08 17:09:43'),
(92, 58, 'LostPet', 'LOST PET ALERT: A pet has been reported lost in helwan. Description: red', 'read', '2026-05-08 17:09:43'),
(93, 69, 'LostPet', 'LOST PET ALERT: A pet has been reported lost in helwan. Description: red', 'unread', '2026-05-08 17:09:43'),
(94, 71, 'LostPet', 'LOST PET ALERT: A pet has been reported lost in helwan. Description: red', 'unread', '2026-05-08 17:09:43'),
(95, 76, 'LostPet', 'LOST PET ALERT: A pet has been reported lost in helwan. Description: red', 'unread', '2026-05-08 17:09:43'),
(96, 79, 'LostPet', 'LOST PET ALERT: A pet has been reported lost in helwan. Description: red', 'unread', '2026-05-08 17:09:43'),
(97, 87, 'LostPet', 'LOST PET ALERT: A pet has been reported lost in helwan. Description: red', 'unread', '2026-05-08 17:09:43'),
(98, 89, 'LostPet', 'LOST PET ALERT: A pet has been reported lost in helwan. Description: red', 'unread', '2026-05-08 17:09:43');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `OrderDate` date DEFAULT NULL,
  `TotalPrice` decimal(10,2) DEFAULT NULL CHECK (`TotalPrice` >= 0),
  `Status` enum('Pending','Cancelled','Completed','Confirmed') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`OrderID`, `UserID`, `OrderDate`, `TotalPrice`, `Status`) VALUES
(7, 58, '2026-04-28', 1100.00, 'Confirmed'),
(8, 58, '2026-04-28', 1100.00, 'Cancelled'),
(9, 58, '2026-04-28', 2000.00, 'Confirmed'),
(10, 58, '2026-04-28', 120.00, 'Confirmed'),
(11, 58, '2026-04-28', 240.00, 'Confirmed'),
(12, 58, '2026-04-29', 70.00, 'Confirmed'),
(13, 58, '2026-05-01', 240.00, 'Confirmed'),
(14, 58, '2026-05-02', 125.00, 'Confirmed'),
(15, 58, '2026-05-07', 60.00, 'Confirmed'),
(16, 58, '2026-05-07', 60.00, 'Confirmed'),
(17, 58, '2026-05-07', 60.00, 'Confirmed'),
(18, 58, '2026-05-07', 180.00, 'Confirmed'),
(19, 58, '2026-05-08', 475.00, 'Confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `OrderDetailsID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL CHECK (`Quantity` > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`OrderDetailsID`, `OrderID`, `ProductID`, `Quantity`) VALUES
(12, 10, 13, 2),
(13, 11, 26, 3),
(14, 12, 23, 2),
(15, 13, 13, 4),
(16, 14, 27, 1),
(17, 14, 26, 1),
(18, 15, 13, 1),
(19, 16, 13, 1),
(20, 17, 13, 1),
(21, 18, 13, 3),
(22, 19, 14, 5);

-- --------------------------------------------------------

--
-- Table structure for table `payouts`
--

CREATE TABLE `payouts` (
  `PayoutID` int(11) NOT NULL,
  `OrderID` int(11) DEFAULT NULL,
  `VendorID` int(11) DEFAULT NULL,
  `GrossAmount` decimal(10,2) DEFAULT NULL,
  `PlatformFee` decimal(10,2) DEFAULT NULL,
  `NetAmount` decimal(10,2) DEFAULT NULL,
  `Status` enum('Pending','Paid') DEFAULT 'Pending',
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payouts`
--

INSERT INTO `payouts` (`PayoutID`, `OrderID`, `VendorID`, `GrossAmount`, `PlatformFee`, `NetAmount`, `Status`, `CreatedAt`) VALUES
(1, 17, 69, 60.00, 9.00, 51.00, 'Pending', '2026-05-07 20:13:06'),
(2, 18, 69, 180.00, 27.00, 153.00, 'Pending', '2026-05-07 20:17:56'),
(3, 19, 1, 475.00, 71.25, 403.75, 'Pending', '2026-05-08 17:01:55');

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

CREATE TABLE `pet` (
  `PetID` int(11) NOT NULL,
  `OwnerID` int(11) NOT NULL,
  `PetName` varchar(150) DEFAULT NULL,
  `Species` varchar(100) NOT NULL,
  `Age` int(11) DEFAULT NULL,
  `Gender` enum('Male','Female') DEFAULT NULL,
  `Weight` decimal(5,2) DEFAULT NULL,
  `Allergies` text DEFAULT NULL,
  `HandlingInstructions` text DEFAULT NULL,
  `BehaviorNotes` text DEFAULT NULL,
  `passport_ready` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`PetID`, `OwnerID`, `PetName`, `Species`, `Age`, `Gender`, `Weight`, `Allergies`, `HandlingInstructions`, `BehaviorNotes`, `passport_ready`) VALUES
(8, 58, 'max', 'Dog', 5, 'Male', 22.00, 'nndems', NULL, NULL, 1),
(9, 58, 'meshmesh', 'Bird', 11, 'Male', 999.99, 'no', 'Separation Anxiety - keep toys nearby', 'Shy at first, needs gentle approach', 1),
(12, 58, 'rabbit', 'Rabbit', 20, 'Male', 30.00, 'debites', 'Leash Aggressive - use harness', 'Very energetic, loves fetching balls', 0),
(15, 89, 'max', 'Dog', 1, 'Male', 2.00, 'no', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `PrescriptionID` int(11) NOT NULL,
  `PetID` int(11) DEFAULT NULL,
  `VetID` int(11) DEFAULT NULL,
  `MedicationName` varchar(100) DEFAULT NULL,
  `Dosage` varchar(50) DEFAULT NULL,
  `Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`PrescriptionID`, `PetID`, `VetID`, `MedicationName`, `Dosage`, `Date`) VALUES
(8, 8, 71, 'klajflk', 'aljflka', '2026-04-27'),
(12, 12, 71, 'sick', 'medicine', '2026-05-01'),
(13, 12, 71, 'sick', 'medicine', '2026-05-07'),
(14, 12, 71, 'sick', 'medicine', '2026-05-29');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Ingredients` text DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL CHECK (`Price` >= 0),
  `stock` int(11) NOT NULL DEFAULT 10,
  `image` varchar(500) DEFAULT NULL,
  `VendorID` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `Name`, `Ingredients`, `Price`, `stock`, `image`, `VendorID`) VALUES
(12, 'Orthopedic Dog Bed', 'Memory Foam, Washable Cover', 1000.00, 20, 'https://images.unsplash.com/photo-1589924691995-400dc9ecc119?auto=format&fit=crop&q=80&w=800', 1),
(13, 'Interactive Laser Toy', 'LED, Plastic, Battery-powered', 60.00, 90, '1777388069_gallery-3.jpg', 1),
(14, 'Anti-Flea Shampoo', 'Aloe Vera, Neem Oil, Natural Extracts', 95.00, 25, 'https://images.unsplash.com/photo-1516734212186-a967f81ad0d7?auto=format&fit=crop&q=80&w=800', 1),
(22, 'Waterproof Dog Raincoat', 'Nylon, Reflective Strips, Yellow', 150.00, 15, 'https://images.unsplash.com/photo-1583511655826-05700d52f4d9?auto=format&fit=crop&q=80&w=800', 1),
(23, 'Organic Catnip Toy', 'Dried Catnip, Cotton Canvas', 35.00, 48, 'https://images.unsplash.com/photo-1548247416-ec66f4900b2e?auto=format&fit=crop&q=80&w=800', 1),
(26, 'Lavender Calming Spray', 'Lavender Oil, Water, Chamomile', 80.00, 21, 'https://images.unsplash.com/photo-1626074353765-517a681e40be?auto=format&fit=crop&q=80&w=800', 1),
(27, 'Squeaky Squirrel Plush', 'Soft Plush, Internal Squeaker', 45.00, 39, 'https://images.unsplash.com/photo-1583512603805-3cc6b41f3edb?auto=format&fit=crop&q=80&w=800', 1);

-- --------------------------------------------------------

--
-- Table structure for table `provider_availability`
--

CREATE TABLE `provider_availability` (
  `id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `available_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `provider_availability`
--

INSERT INTO `provider_availability` (`id`, `provider_id`, `available_date`, `start_time`, `end_time`) VALUES
(13, 69, '2026-05-07', '19:30:00', '20:30:00'),
(15, 69, '2026-05-19', '18:41:00', '19:41:00'),
(16, 69, '2026-05-20', '05:35:00', '17:35:00'),
(17, 69, '2026-05-28', '05:35:00', '20:35:00'),
(18, 69, '2026-05-21', '04:43:00', '16:43:00');

-- --------------------------------------------------------

--
-- Table structure for table `provider_certifications`
--

CREATE TABLE `provider_certifications` (
  `CertID` int(11) NOT NULL,
  `ProviderID` int(11) NOT NULL,
  `CertName` varchar(150) NOT NULL,
  `FilePath` varchar(255) NOT NULL,
  `Status` enum('Pending','Verified','Rejected') DEFAULT 'Pending',
  `SubmittedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `provider_certifications`
--

INSERT INTO `provider_certifications` (`CertID`, `ProviderID`, `CertName`, `FilePath`, `Status`, `SubmittedAt`) VALUES
(1, 69, 'my pet', '1777646160_69f4ba50e0acb.jpg', 'Verified', '2026-05-01 14:36:00'),
(2, 69, 'my pet', '1777647562_69f4bfca7d030.jpg', 'Verified', '2026-05-01 14:59:22'),
(3, 69, 'my pet', '1777648085_69f4c1d5947c7.jpg', 'Verified', '2026-05-01 15:08:05'),
(4, 69, 'CPR', '1778160184_69fc923838070.png', 'Verified', '2026-05-07 13:23:04');

-- --------------------------------------------------------

--
-- Table structure for table `provider_services`
--

CREATE TABLE `provider_services` (
  `id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tier` enum('Basic','Standard','Premium') DEFAULT 'Standard',
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `duration_multiplier` decimal(3,2) DEFAULT 1.00,
  `species_multiplier` decimal(3,2) DEFAULT 1.00,
  `holiday_surcharge` decimal(10,2) DEFAULT 0.00,
  `multi_pet_discount` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `provider_services`
--

INSERT INTO `provider_services` (`id`, `provider_id`, `name`, `tier`, `price`, `image`, `duration_multiplier`, `species_multiplier`, `holiday_surcharge`, `multi_pet_discount`) VALUES
(26, 69, 'pet sitting', 'Basic', 100.00, '1778186895_69fcfa8f365bb.jpg', 1.00, 1.00, 0.00, 0.00),
(27, 69, 'pet washing', 'Premium', 1000.00, '1778259815_69fe17676e362.jpg', 1.00, 1.00, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `ReviewID` int(11) NOT NULL,
  `BookingID` int(11) DEFAULT NULL,
  `ReviewerID` int(11) DEFAULT NULL,
  `RevieweeID` int(11) DEFAULT NULL,
  `ReviewerRole` varchar(50) DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  `Comment` text DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`ReviewID`, `BookingID`, `ReviewerID`, `RevieweeID`, `ReviewerRole`, `Rating`, `Comment`, `CreatedAt`) VALUES
(3, 35, 58, 69, 'Owner', 5, '10/10', '2026-05-07 21:05:44'),
(4, 38, 58, 69, 'Owner', 2, 'this is poor sit', '2026-05-07 22:11:07'),
(5, 41, 58, 69, 'Owner', 5, 'this was a good sitting', '2026-05-08 17:09:01');

-- --------------------------------------------------------

--
-- Table structure for table `serviceprovider`
--

CREATE TABLE `serviceprovider` (
  `ProviderID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `ServiceType` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `serviceprovider`
--

INSERT INTO `serviceprovider` (`ProviderID`, `Name`, `ServiceType`) VALUES
(69, 'mariam saber', 'General');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `role` varchar(50) DEFAULT 'Owner',
  `email` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `status` enum('Active','Suspended') DEFAULT 'Active',
  `is_verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `role`, `email`, `password`, `phone`, `status`, `is_verified`) VALUES
(46, 'Yossef Sayed', 'Admin', 'yousifsayed311@gmail.com', '$2y$10$DdILDAhGyVlG8nyzxhSim.mjfMfP4F8nxnBwbuF8WzuRi2aLNNuNy', '01101212122', 'Active', 1),
(58, 'mariam abdelbaki', 'Owner', 'mariam@gmail.com', '$2y$10$dx8XW4hY0acwJqaLuci17enxIWtxb9pVWRFEJrzamQXIi/bMqgs.K', '58782975291', 'Active', 1),
(69, 'mariam saber', 'ServiceProvider', 'mariamsaber@gmail.com', '$2y$10$L2qGT8f2qI1d4Np1Skg2E.ADH0XTFM6xfuwZA.6G0U1z7sG/qJDD2', '16537276350', 'Active', 1),
(71, 'Hend Mostafa', 'Vet', 'hend@gmail.com', '$2y$10$zHDukVlFxJxEQGWjB.Fv3.Z7HTzb0BQnNuTOYogeS8lL52cWdTvK6', '17240704911', 'Active', 1),
(76, 'Mariam Mohsen', 'Vet', 'mariammosen@gmail.com', '$2y$10$LOSssehmhu9Sd9tJC7uGU.oQ/ydqEzslCGEn67rN9A1W0SS1rXFUi', '16537276352', 'Active', 1),
(79, 'Omar Galal', 'Owner', 'omar@gmail.com', '$2y$10$C.miPo/4Alljf0zq2FF89.vhsp.wIaGxDf2H/KQsB/WFWtc4qXUta', '01226648846', 'Active', 1),
(87, 'Shehab Mohsen', 'Vet', 'shehab@gmail.com', '$2y$10$SpArAcFZAJXsMDoARA06VON97cbVZ.vdqKMGnmVzadCH6UyWn1H6q', '01552432790', 'Suspended', 1),
(89, 'ahmed', 'Owner', 'ahmed@gmail.com', '$2y$10$oJt4nAXsjTrvx4MaZe6VJORh30ClH4l4cTLVUMnr4q55RjEVbATVu', '16537276351', 'Active', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vaccination`
--

CREATE TABLE `vaccination` (
  `VaccinationID` int(11) NOT NULL,
  `PetID` int(11) NOT NULL,
  `VaccineName` varchar(100) DEFAULT NULL,
  `VaccinationDate` date DEFAULT NULL,
  `NextDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccination`
--

INSERT INTO `vaccination` (`VaccinationID`, `PetID`, `VaccineName`, `VaccinationDate`, `NextDate`) VALUES
(8, 8, 'ljlajfa', '2026-04-27', '2026-04-30'),
(9, 12, 'vaccine', '2026-05-07', '2026-05-29');

-- --------------------------------------------------------

--
-- Table structure for table `veterinarian`
--

CREATE TABLE `veterinarian` (
  `VetID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Specialization` varchar(100) DEFAULT NULL,
  `LicenseNumber` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `veterinarian`
--

INSERT INTO `veterinarian` (`VetID`, `Name`, `Specialization`, `LicenseNumber`) VALUES
(71, 'Hend Mostafa', 'Surgery', 'VET-71'),
(76, 'Mariam Mohsen', 'general', '1111111'),
(87, 'Shehab Mohsen', 'dermatology', 'VET-131');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`AppointmentID`),
  ADD KEY `PetID` (`PetID`),
  ADD KEY `VetID` (`VetID`),
  ADD KEY `OwnerID` (`OwnerID`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`BookingID`),
  ADD KEY `PetID` (`PetID`),
  ADD KEY `ProviderID` (`ProviderID`),
  ADD KEY `OwnerID` (`OwnerID`);

--
-- Indexes for table `chroniccondition`
--
ALTER TABLE `chroniccondition`
  ADD PRIMARY KEY (`ConditionID`),
  ADD KEY `PetID` (`PetID`);

--
-- Indexes for table `incidents`
--
ALTER TABLE `incidents`
  ADD PRIMARY KEY (`IncidentID`),
  ADD KEY `BookingID` (`BookingID`);

--
-- Indexes for table `lost_pets`
--
ALTER TABLE `lost_pets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `PetID` (`PetID`),
  ADD KEY `OwnerID` (`OwnerID`);

--
-- Indexes for table `medicalrecord`
--
ALTER TABLE `medicalrecord`
  ADD PRIMARY KEY (`RecordID`),
  ADD KEY `PetID` (`PetID`),
  ADD KEY `VetID` (`VetID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`OrderDetailsID`),
  ADD KEY `OrderID` (`OrderID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `payouts`
--
ALTER TABLE `payouts`
  ADD PRIMARY KEY (`PayoutID`);

--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`PetID`),
  ADD KEY `OwnerID` (`OwnerID`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`PrescriptionID`),
  ADD KEY `PetID` (`PetID`),
  ADD KEY `VetID` (`VetID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `provider_availability`
--
ALTER TABLE `provider_availability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provider_id` (`provider_id`);

--
-- Indexes for table `provider_certifications`
--
ALTER TABLE `provider_certifications`
  ADD PRIMARY KEY (`CertID`),
  ADD KEY `ProviderID` (`ProviderID`);

--
-- Indexes for table `provider_services`
--
ALTER TABLE `provider_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provider_id` (`provider_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ReviewID`);

--
-- Indexes for table `serviceprovider`
--
ALTER TABLE `serviceprovider`
  ADD PRIMARY KEY (`ProviderID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`email`),
  ADD UNIQUE KEY `PhoneNumber` (`phone`);

--
-- Indexes for table `vaccination`
--
ALTER TABLE `vaccination`
  ADD PRIMARY KEY (`VaccinationID`),
  ADD KEY `PetID` (`PetID`);

--
-- Indexes for table `veterinarian`
--
ALTER TABLE `veterinarian`
  ADD PRIMARY KEY (`VetID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `AppointmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `chroniccondition`
--
ALTER TABLE `chroniccondition`
  MODIFY `ConditionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `incidents`
--
ALTER TABLE `incidents`
  MODIFY `IncidentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lost_pets`
--
ALTER TABLE `lost_pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `medicalrecord`
--
ALTER TABLE `medicalrecord`
  MODIFY `RecordID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `OrderDetailsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `payouts`
--
ALTER TABLE `payouts`
  MODIFY `PayoutID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pet`
--
ALTER TABLE `pet`
  MODIFY `PetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `PrescriptionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `provider_availability`
--
ALTER TABLE `provider_availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `provider_certifications`
--
ALTER TABLE `provider_certifications`
  MODIFY `CertID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `provider_services`
--
ALTER TABLE `provider_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `ReviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `vaccination`
--
ALTER TABLE `vaccination`
  MODIFY `VaccinationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`PetID`) REFERENCES `pet` (`PetID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`VetID`) REFERENCES `veterinarian` (`VetID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`OwnerID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`PetID`) REFERENCES `pet` (`PetID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`ProviderID`) REFERENCES `serviceprovider` (`ProviderID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`OwnerID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chroniccondition`
--
ALTER TABLE `chroniccondition`
  ADD CONSTRAINT `chroniccondition_ibfk_1` FOREIGN KEY (`PetID`) REFERENCES `pet` (`PetID`) ON DELETE CASCADE;

--
-- Constraints for table `incidents`
--
ALTER TABLE `incidents`
  ADD CONSTRAINT `incidents_ibfk_1` FOREIGN KEY (`BookingID`) REFERENCES `booking` (`BookingID`) ON DELETE CASCADE;

--
-- Constraints for table `lost_pets`
--
ALTER TABLE `lost_pets`
  ADD CONSTRAINT `lost_pets_ibfk_1` FOREIGN KEY (`PetID`) REFERENCES `pet` (`PetID`) ON DELETE CASCADE,
  ADD CONSTRAINT `lost_pets_ibfk_2` FOREIGN KEY (`OwnerID`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `medicalrecord`
--
ALTER TABLE `medicalrecord`
  ADD CONSTRAINT `medicalrecord_ibfk_1` FOREIGN KEY (`PetID`) REFERENCES `pet` (`PetID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medicalrecord_ibfk_2` FOREIGN KEY (`VetID`) REFERENCES `veterinarian` (`VetID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `order` (`OrderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `pet_ibfk_1` FOREIGN KEY (`OwnerID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `prescription_ibfk_1` FOREIGN KEY (`PetID`) REFERENCES `pet` (`PetID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prescription_ibfk_2` FOREIGN KEY (`VetID`) REFERENCES `veterinarian` (`VetID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `provider_availability`
--
ALTER TABLE `provider_availability`
  ADD CONSTRAINT `provider_availability_ibfk_1` FOREIGN KEY (`provider_id`) REFERENCES `serviceprovider` (`ProviderID`) ON DELETE CASCADE;

--
-- Constraints for table `provider_certifications`
--
ALTER TABLE `provider_certifications`
  ADD CONSTRAINT `provider_certifications_ibfk_1` FOREIGN KEY (`ProviderID`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `provider_services`
--
ALTER TABLE `provider_services`
  ADD CONSTRAINT `provider_services_ibfk_1` FOREIGN KEY (`provider_id`) REFERENCES `serviceprovider` (`ProviderID`) ON DELETE CASCADE;

--
-- Constraints for table `serviceprovider`
--
ALTER TABLE `serviceprovider`
  ADD CONSTRAINT `serviceprovider_ibfk_1` FOREIGN KEY (`ProviderID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vaccination`
--
ALTER TABLE `vaccination`
  ADD CONSTRAINT `vaccination_ibfk_1` FOREIGN KEY (`PetID`) REFERENCES `pet` (`PetID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `veterinarian`
--
ALTER TABLE `veterinarian`
  ADD CONSTRAINT `veterinarian_ibfk_1` FOREIGN KEY (`VetID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
