<?php

class NotificationsController extends Controller
{
    public function index()
    {
        Middleware::requireLogin();
        $notifModel = new Notification();
        
        $data['notifications'] = $notifModel->viewNotifications($_SESSION['id']);
        $data['username'] = $_SESSION['username'] ?? 'User';
        
        $this->view('notifications', $data);
    }

    public function markAsRead($id)
    {
        Middleware::requireLogin();
        $notifModel = new Notification();
        $notifModel->markAsRead($id);
        redirect('notifications');
    }

    public function markAllAsRead()
    {
        Middleware::requireLogin();
        $notifModel = new Notification();
        $notifModel->markAllAsRead($_SESSION['id']);
        redirect('notifications');
    }

    public function delete($id)
    {
        Middleware::requireLogin();
        $notifModel = new Notification();
        $notifModel->deleteNotification($id);
        redirect('notifications');
    }
}
