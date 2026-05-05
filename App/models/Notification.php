<?php

class Notification
{
    use Model;
    protected $table = 'notifications';
    protected $primaryKey = 'notification_id';
    protected $allowedColumns = ['user_id', 'title', 'message', 'status', 'created_at'];

    public function viewNotifications($userId)
    {
        $query = "SELECT * FROM notifications WHERE user_id = :userId ORDER BY created_at DESC";
        return $this->query($query, ['userId' => $userId]);
    }

    public function countUnread($userId)
    {
        $query = "SELECT COUNT(*) as count FROM notifications WHERE user_id = :userId AND status = 'unread'";
        $res = $this->query($query, ['userId' => $userId]);
        return $res[0]['count'] ?? 0;
    }

    public function markAsRead($id)
    {
        $query = "UPDATE notifications SET status = 'read' WHERE notification_id = :id";
        return $this->query($query, ['id' => $id]);
    }

    public function markAllAsRead($userId)
    {
        $query = "UPDATE notifications SET status = 'read' WHERE user_id = :userId";
        return $this->query($query, ['userId' => $userId]);
    }

    public function deleteNotification($id)
    {
        $query = "DELETE FROM notifications WHERE notification_id = :id";
        return $this->query($query, ['id' => $id]);
    }

    public function sendNotification($userId, $message, $type = 'System')
    {
        return $this->insert([
            'user_id' => $userId,
            'title' => $type,
            'message' => $message,
            'status' => 'unread'
        ]);
    }
}
