<?php


require_once 'App/Core/Model.php';

class Notification {
    use Model;
    protected $table = 'notifications';


    public function sendNotification($user_id, $title, $message, $type = 'general') {
        $db   = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "INSERT INTO notifications (user_id, title, message, type, is_read, created_at)
             VALUES (?, ?, ?, ?, 0, NOW())"
        );
        return $stmt->execute([$user_id, $title, $message, $type]);
    }

    public function viewNotifications($user_id) {
        $db   = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT * FROM notifications
             WHERE user_id = ?
             ORDER BY created_at DESC"
        );
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function markAsRead($notification_id) {
        $db   = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "UPDATE notifications SET is_read = 1 WHERE id = ?"
        );
        return $stmt->execute([$notification_id]);
    }


    public function markAllAsRead($user_id) {
        $db   = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "UPDATE notifications SET is_read = 1 WHERE user_id = ?"
        );
        return $stmt->execute([$user_id]);
    }


    public function countUnread($user_id) {
        $db   = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT COUNT(*) as total FROM notifications
             WHERE user_id = ? AND is_read = 0"
        );
        $stmt->execute([$user_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) $row['total'];
    }

    public function deleteNotification($notification_id) {
        $db   = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "DELETE FROM notifications WHERE id = ?"
        );
        return $stmt->execute([$notification_id]);
    }

    public function sendRecallNotification($product_id, $product_name, $recall_reason) {
        $db   = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "SELECT DISTINCT o.user_id
             FROM orders o
             JOIN order_items oi ON o.id = oi.order_id
             WHERE oi.product_id = ?"
        );
        $stmt->execute([$product_id]);
        $affected_users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $title   = "⚠️ Product Recall Alert";
        $message = "A product you purchased (" . $product_name . ") has been recalled. "
                 . "Reason: " . $recall_reason . ". Please stop using it immediately.";

        $count = 0;
        foreach ($affected_users as $user) {
            if ($this->sendNotification($user['user_id'], $title, $message, 'recall')) {
                $count++;
            }
        }
        return $count;
    }

    public function broadcastToAll($title, $message, $type = 'broadcast') {
        $db   = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT id FROM users WHERE status = 'active'");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $count = 0;
        foreach ($users as $user) {
            if ($this->sendNotification($user['id'], $title, $message, $type)) {
                $count++;
            }
        }
        return $count;
    }
}
