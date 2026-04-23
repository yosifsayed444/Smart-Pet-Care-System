-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 25, 2026 at 03:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
  `AppointmentDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`AppointmentID`, `OwnerID`, `PetID`, `VetID`, `AppointmentDate`) VALUES
(1, 1, 1, 2, '2026-03-01'),
(2, 1, 2, 6, '2026-03-02'),
(3, 4, 3, 7, '2026-03-03'),
(4, 10, 4, 2, '2026-03-04'),
(6, 11, 7, 12, '2026-03-14');

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
  `Price` decimal(10,2) GENERATED ALWAYS AS (timestampdiff(HOUR,`StartTime`,`EndTime`) * 50) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`BookingID`, `PetID`, `OwnerID`, `ProviderID`, `BookingDate`, `StartTime`, `EndTime`) VALUES
(1, 1, 1, 3, '2026-03-01', '10:00:00', '12:00:00'),
(2, 2, 1, 8, '2026-03-02', '09:00:00', '11:00:00'),
(3, 3, 4, 9, '2026-03-03', '14:00:00', '16:00:00'),
(4, 4, 10, 3, '2026-03-04', '12:00:00', '13:00:00'),
(6, 7, 11, 9, '2026-03-01', '09:00:00', '11:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `medicalrecord`
--

CREATE TABLE `medicalrecord` (
  `RecordID` int(11) NOT NULL,
  `PetID` int(11) NOT NULL,
  `VetID` int(11) DEFAULT NULL,
  `Diagnosis` text DEFAULT NULL,
  `RecordDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicalrecord`
--

INSERT INTO `medicalrecord` (`RecordID`, `PetID`, `VetID`, `Diagnosis`, `RecordDate`) VALUES
(1, 1, 2, 'Skin Allergy', '2026-02-01'),
(2, 2, 6, 'Flu', '2026-02-10'),
(3, 3, 7, 'Injury', '2026-02-15'),
(4, 4, 2, 'Checkup', '2026-02-20'),
(6, 7, 12, 'Skin Allergy', '2026-02-15');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `OrderDate` date DEFAULT NULL,
  `TotalPrice` decimal(10,2) DEFAULT NULL CHECK (`TotalPrice` >= 0),
  `Status` enum('Pending','Cancelled','Completed') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`OrderID`, `UserID`, `OrderDate`, `TotalPrice`, `Status`) VALUES
(1, 1, '2026-03-01', 250.00, 'Completed'),
(2, 1, '2026-03-05', 120.00, 'Pending'),
(3, 4, '2026-03-10', 80.00, 'Cancelled'),
(4, 10, '2026-03-15', 150.00, 'Completed'),
(5, 1, '2026-03-20', 30.00, 'Pending'),
(6, 11, '2026-03-11', 260.00, 'Pending');

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
(1, 1, 1, 1),
(2, 2, 2, 2),
(3, 3, 3, 1),
(4, 4, 4, 1),
(5, 5, 5, 3),
(6, 6, 6, 2);

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
  `Allergies` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`PetID`, `OwnerID`, `PetName`, `Species`, `Age`, `Gender`, `Weight`, `Allergies`) VALUES
(1, 1, 'Max', 'Dog', 3, 'Male', 12.50, 'Chicken'),
(2, 1, 'Luna', 'Cat', 2, 'Female', 4.00, 'None'),
(3, 4, 'Rocky', 'Dog', 5, 'Male', 20.00, 'Beef'),
(4, 10, 'Milo', 'Cat', 1, 'Male', 3.50, 'None'),
(7, 11, 'Mimo', 'Cat', 3, 'Male', 13.50, 'Chicken');

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
(1, 1, 2, 'Antihistamine', '5mg', '2026-02-01'),
(2, 2, 6, 'Antibiotic', '10mg', '2026-02-10'),
(3, 3, 7, 'Painkiller', '2mg', '2026-02-15'),
(4, 4, 2, 'Vitamin', '1 tablet', '2026-02-20'),
(6, 7, 12, 'Antihistamine', '5mg', '2026-02-15');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Ingredients` text DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL CHECK (`Price` >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `Name`, `Ingredients`, `Price`) VALUES
(1, 'Dry Dog Food', 'Chicken, Rice', 250.00),
(2, 'Wet Cat Food', 'Fish, Vitamins', 120.00),
(3, 'Dog Shampoo', 'Herbal Extracts', 80.00),
(4, 'Rabies Vaccine', 'Vaccine Solution', 150.00),
(5, 'Cat Toy', 'Plastic', 30.00),
(6, 'OmegaDog Kibble', 'Salmon', 75.00);

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
(3, 'Sara Mohamed', 'Sitting'),
(8, 'Kareem Hassan', 'Walking'),
(9, 'Nour Sayed', 'Walking');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(150) NOT NULL,
  `Role` enum('Owner','Vet','Provider','Admin') NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `PhoneNumber` varchar(50) DEFAULT NULL
) ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Name`, `Role`, `Email`, `Password`, `PhoneNumber`) VALUES
(1, 'Mariam Ahmed', 'Owner', 'mariam@gmail.com', 'Hgc#464859', '01111111111'),
(2, 'Ali Hassan', 'Vet', 'ali@gmail.com', 'Ghfn#123', '+201222222222'),
(3, 'Sara Mohamed', 'Provider', 'sara@gmail.com', 'Bskdn#123', '+201133333333'),
(4, 'Omar Khaled', 'Owner', 'omar@gmail.com', 'Ksvbd#123', '+201544444444'),
(5, 'Laila Osama', 'Admin', 'admin@gmail.com', 'Laili#12345', '+201555555555'),
(6, 'Samy Ali', 'Vet', 'samy@gmail.com', 'Sdmfg#123', '+201066666666'),
(7, 'Mona Kareem', 'Vet', 'mona@gmail.com', 'Mdhfgh#123', '+201077777777'),
(8, 'Kareem Hassan', 'Provider', 'kareem@gmail.com', 'Kgfbfn#123', '01188888888'),
(9, 'Nour Sayed', 'Provider', 'nour@gmail.com', 'Nfhfb#123', '01599999999'),
(10, 'Hana Marwan', 'Owner', 'hana@gmail.com', 'Hdvdn#123', '+201101010101'),
(11, 'Mariam Saber', 'Owner', 'mariamSaber56@gmail.com', 'MgvfgKc#464859', '01245111111'),
(12, 'Hend Mostafa', 'Vet', 'hendmostafa89@gmail.com', 'H4674#123', '+201522222222');

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
(1, 1, 'Rabies', '2026-01-01', '2027-01-01'),
(2, 2, 'Triple Vaccine', '2026-01-05', '2027-01-05'),
(3, 3, 'Rabies', '2026-01-10', '2027-01-10'),
(4, 4, 'Feline Vaccine', '2026-01-15', '2027-01-15'),
(6, 7, 'Feline Vaccine', '2026-01-20', '2027-01-25');

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
(2, 'Ali Hassan', 'Surgery', 'LIC001'),
(6, 'Samy Ali', 'Dermatology', 'LIC002'),
(7, 'Mona Kareem', 'Dental', 'LIC003'),
(12, 'Hend Mostafa', 'Surgery', 'LIC004');

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
-- Indexes for table `medicalrecord`
--
ALTER TABLE `medicalrecord`
  ADD PRIMARY KEY (`RecordID`),
  ADD KEY `PetID` (`PetID`),
  ADD KEY `VetID` (`VetID`);

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
-- Indexes for table `serviceprovider`
--
ALTER TABLE `serviceprovider`
  ADD PRIMARY KEY (`ProviderID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `PhoneNumber` (`PhoneNumber`);

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
  MODIFY `AppointmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `medicalrecord`
--
ALTER TABLE `medicalrecord`
  MODIFY `RecordID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `OrderDetailsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pet`
--
ALTER TABLE `pet`
  MODIFY `PetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `PrescriptionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vaccination`
--
ALTER TABLE `vaccination`
  MODIFY `VaccinationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`PetID`) REFERENCES `pet` (`PetID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`VetID`) REFERENCES `veterinarian` (`VetID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`OwnerID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`PetID`) REFERENCES `pet` (`PetID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`ProviderID`) REFERENCES `serviceprovider` (`ProviderID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`OwnerID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medicalrecord`
--
ALTER TABLE `medicalrecord`
  ADD CONSTRAINT `medicalrecord_ibfk_1` FOREIGN KEY (`PetID`) REFERENCES `pet` (`PetID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medicalrecord_ibfk_2` FOREIGN KEY (`VetID`) REFERENCES `veterinarian` (`VetID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `order` (`OrderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `pet_ibfk_1` FOREIGN KEY (`OwnerID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `prescription_ibfk_1` FOREIGN KEY (`PetID`) REFERENCES `pet` (`PetID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prescription_ibfk_2` FOREIGN KEY (`VetID`) REFERENCES `veterinarian` (`VetID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `serviceprovider`
--
ALTER TABLE `serviceprovider`
  ADD CONSTRAINT `serviceprovider_ibfk_1` FOREIGN KEY (`ProviderID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vaccination`
--
ALTER TABLE `vaccination`
  ADD CONSTRAINT `vaccination_ibfk_1` FOREIGN KEY (`PetID`) REFERENCES `pet` (`PetID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `veterinarian`
--
ALTER TABLE `veterinarian`
  ADD CONSTRAINT `veterinarian_ibfk_1` FOREIGN KEY (`VetID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
