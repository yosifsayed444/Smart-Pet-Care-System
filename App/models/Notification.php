<?php

class Notification
{
    use Model;
    protected $table = 'notifications';
    protected $allowedColumns = ['UserID', 'Message', 'IsRead', 'Type', 'CreatedAt'];

    public function viewNotifications($userId)
    {
        $query = "SELECT * FROM notifications WHERE UserID = :userId ORDER BY CreatedAt DESC";
        return $this->query($query, ['userId' => $userId]);
    }

    public function countUnread($userId)
    {
        $query = "SELECT COUNT(*) as count FROM notifications WHERE UserID = :userId AND IsRead = 0";
        $res = $this->query($query, ['userId' => $userId]);
        return $res[0]['count'] ?? 0;
    }

    public function markAsRead($id)
    {
        $query = "UPDATE notifications SET IsRead = 1 WHERE id = :id";
        return $this->query($query, ['id' => $id]);
    }

    public function markAllAsRead($userId)
    {
        $query = "UPDATE notifications SET IsRead = 1 WHERE UserID = :userId";
        return $this->query($query, ['userId' => $userId]);
    }

    public function deleteNotification($id)
    {
        $query = "DELETE FROM notifications WHERE id = :id";
        return $this->query($query, ['id' => $id]);
    }

    public function sendNotification($userId, $message, $type = 'System')
    {
        return $this->insert([
            'UserID' => $userId,
            'Message' => $message,
            'Type' => $type,
            'IsRead' => 0
        ]);
    }
}
