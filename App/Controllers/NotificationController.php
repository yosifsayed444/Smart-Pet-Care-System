<?php


require_once 'App/Core/Database.php';
require_once 'App/models/Notification.php';

class NotificationController {

    private $notificationModel;

    public function __construct() {
        $this->notificationModel = new Notification();
    }

    // عرض صفحة الـ notifications
    public function viewNotifications() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /SE1_Project/Public/auth');
            exit;
        }

        $user_id       = $_SESSION['user_id'];
        $notifications = $this->notificationModel->viewNotifications($user_id);
        $unread_count  = $this->notificationModel->countUnread($user_id);

        require_once 'views/notifications/notifications.php';
    }


    public function markAsRead() {
        header('Content-Type: application/json');
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            exit;
        }
        $notification_id = $_POST['notification_id'] ?? null;
        if (!$notification_id) {
            echo json_encode(['success' => false, 'message' => 'Missing notification ID']);
            exit;
        }
        $result = $this->notificationModel->markAsRead($notification_id);
        echo json_encode(['success' => (bool)$result]);
        exit;
    }

    public function markAllAsRead() {
        header('Content-Type: application/json');
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            exit;
        }
        $result = $this->notificationModel->markAllAsRead($_SESSION['user_id']);
        echo json_encode(['success' => (bool)$result]);
        exit;
    }

    public function deleteNotification() {
        header('Content-Type: application/json');
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            exit;
        }
        $notification_id = $_POST['notification_id'] ?? null;
        if (!$notification_id) {
            echo json_encode(['success' => false, 'message' => 'Missing notification ID']);
            exit;
        }
        $result = $this->notificationModel->deleteNotification($notification_id);
        echo json_encode(['success' => (bool)$result]);
        exit;
    }

    public function getUnreadCount() {
        header('Content-Type: application/json');
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['count' => 0]);
            exit;
        }
        $count = $this->notificationModel->countUnread($_SESSION['user_id']);
        echo json_encode(['count' => $count]);
        exit;
    }

    public function sendRecallNotification($product_id, $product_name, $recall_reason) {
        return $this->notificationModel->sendRecallNotification(
            $product_id,
            $product_name,
            $recall_reason
        );
    }

    public function sendNotification($user_id, $title, $message, $type = 'general') {
        return $this->notificationModel->sendNotification($user_id, $title, $message, $type);
    }
}
