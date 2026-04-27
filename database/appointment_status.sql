-- Add status column to appointment table
ALTER TABLE `appointment`
ADD COLUMN `status` ENUM('Pending', 'Accepted', 'Rejected') DEFAULT 'Pending';
