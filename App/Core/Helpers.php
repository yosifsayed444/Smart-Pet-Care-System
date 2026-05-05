<?php

class Helpers
{
    public static function clean($value)
    {
        return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
    }
    public static function ensureDir($folder)
    {
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }
    }
    public static function uploadFile($fileKey, $folder, $allowedExts = [], $maxSize = 2097152, $prefix = '')
    {
        if (empty($_FILES[$fileKey]['name'])) {
            return null;
        }

        $file = $_FILES[$fileKey];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!empty($allowedExts) && !in_array($ext, $allowedExts)) {
            $_SESSION['error'] = "Invalid file type. Allowed: " . implode(', ', $allowedExts);
            return null;
        }

        if ($file['size'] > $maxSize) {
            $maxMB = round($maxSize / (1024 * 1024), 1);
            $_SESSION['error'] = "File size must not exceed {$maxMB}MB.";
            return null;
        }

        self::ensureDir($folder);

        $filename = $prefix . time() . "_" . uniqid() . "." . $ext;
        if (move_uploaded_file($file['tmp_name'], $folder . $filename)) {
            return $filename;
        }

        $_SESSION['error'] = "Failed to upload file.";
        return null;
    }

    public static function deleteOldFile($folder, $filename)
    {
        if (!empty($filename) && strpos($filename, 'http') !== 0) {
            $filePath = $folder . $filename;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }

    public static function calculateCartTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }
        return $total;
    }
    public static function deleteRelatedData($userModel, $id, $user)
    {
        $userModel->query("DELETE FROM orderdetails WHERE OrderID IN (SELECT OrderID FROM `order` WHERE UserID = :id)", ['id' => $id]);
        $userModel->query("DELETE FROM `order` WHERE UserID = :id", ['id' => $id]);
        $userModel->query("DELETE FROM booking WHERE OwnerID = :id OR ProviderID = :id", ['id' => $id]);
        $userModel->query("DELETE FROM appointment WHERE OwnerID = :id OR VetID = :id", ['id' => $id]);
        $userModel->query("DELETE FROM notifications WHERE user_id = :id", ['id' => $id]);
        $userModel->query("DELETE FROM provider_reviews WHERE user_id = :id OR provider_id = :id", ['id' => $id]);

        if ($user['role'] === 'ServiceProvider') {
            $userModel->query("DELETE FROM provider_services WHERE provider_id = :id", ['id' => $id]);
            $userModel->query("DELETE FROM provider_availability WHERE provider_id = :id", ['id' => $id]);
            $userModel->query("DELETE FROM provider_certifications WHERE ProviderID = :id", ['id' => $id]);
            $userModel->query("DELETE FROM serviceprovider WHERE ProviderID = :id", ['id' => $id]);
        }

        if ($user['role'] === 'Vet') {
            $userModel->query("DELETE FROM prescription WHERE VetID = :id", ['id' => $id]);
            $userModel->query("DELETE FROM MedicalRecord WHERE VetID = :id", ['id' => $id]);
            $userModel->query("DELETE FROM veterinarian WHERE VetID = :id", ['id' => $id]);
        }
        $userModel->query("DELETE FROM ChronicCondition WHERE PetID IN (SELECT PetID FROM pet WHERE OwnerID = :id)", ['id' => $id]);
        $userModel->query("DELETE FROM MedicalRecord WHERE PetID IN (SELECT PetID FROM pet WHERE OwnerID = :id)", ['id' => $id]);
        $userModel->query("DELETE FROM vaccination WHERE PetID IN (SELECT PetID FROM pet WHERE OwnerID = :id)", ['id' => $id]);
        $userModel->query("DELETE FROM prescription WHERE PetID IN (SELECT PetID FROM pet WHERE OwnerID = :id)", ['id' => $id]);
        $userModel->query("DELETE FROM incidents WHERE OwnerID = :id OR SitterID = :id", ['id' => $id]);
        $userModel->query("DELETE FROM lost_pets WHERE OwnerID = :id", ['id' => $id]);
        $userModel->query("DELETE FROM pet WHERE OwnerID = :id", ['id' => $id]);
        
        if ($userModel->delete($id)) {
            $_SESSION['success'] = "User and all related data deleted successfully 🗑️";
        } else {
            $_SESSION['error'] = "Failed to delete user record. This might be due to existing database dependencies.";
        }
    }
    public static function generatePDFReport($type, $db, $pdf)
    {
        $filename = "";
        $title = "";

        if ($type == 'sales') {
            $title = "Sales Report";
            $filename = "sales_report_" . date('Y-m-d') . ".pdf";
            $data = $db->query("SELECT DATE(OrderDate) as date, SUM(TotalPrice) as total FROM `order` GROUP BY DATE(OrderDate)");
            
            $pdf->Cell(0, 10, $title, 0, 1, 'C');
            $pdf->Ln(10);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(95, 10, 'Date', 1);
            $pdf->Cell(95, 10, 'Total Revenue (EGP)', 1);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);
            if (!empty($data)) {
                foreach ($data as $row) {
                    $pdf->Cell(95, 10, $row['date'], 1);
                    $pdf->Cell(95, 10, number_format($row['total'], 2), 1);
                    $pdf->Ln();
                }
            }
        } elseif ($type == 'users') {
            $title = "User Analytics Report";
            $filename = "user_report_" . date('Y-m-d') . ".pdf";
            $data = $db->query("SELECT role, COUNT(*) as count FROM users GROUP BY role");
            
            $pdf->Cell(0, 10, $title, 0, 1, 'C');
            $pdf->Ln(10);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(95, 10, 'Role', 1);
            $pdf->Cell(95, 10, 'User Count', 1);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);
            if (!empty($data)) {
                foreach ($data as $row) {
                    $pdf->Cell(95, 10, $row['role'], 1);
                    $pdf->Cell(95, 10, $row['count'], 1);
                    $pdf->Ln();
                }
            }
        } elseif ($type == 'appointments') {
            $title = "Appointment Report";
            $filename = "appointment_report_" . date('Y-m-d') . ".pdf";
            $data = $db->query("SELECT DATE(AppointmentDate) as date, COUNT(*) as count FROM appointment GROUP BY DATE(AppointmentDate)");
            
            $pdf->Cell(0, 10, $title, 0, 1, 'C');
            $pdf->Ln(10);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(95, 10, 'Date', 1);
            $pdf->Cell(95, 10, 'Appointment Count', 1);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 12);
            if (!empty($data)) {
                foreach ($data as $row) {
                    $pdf->Cell(95, 10, $row['date'], 1);
                    $pdf->Cell(95, 10, $row['count'], 1);
                    $pdf->Ln();
                }
            }
        }

        
        $reportsDir = "uploads/reports/";
        Helpers::ensureDir($reportsDir);
        $savePath = $reportsDir . $filename;
        $pdf->Output('F', $savePath);

        
        $pdf->Output('D', $filename);
        exit;
    }
}
