-- Migration: add LabNotes, LabFile, Behavior to medicalrecord
ALTER TABLE `medicalrecord`
    ADD COLUMN IF NOT EXISTS `Behavior` text DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `LabNotes` text DEFAULT NULL,
    ADD COLUMN IF NOT EXISTS `LabFile`  varchar(255) DEFAULT NULL;
