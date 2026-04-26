<?php
class Notification
{
    use Model;

    protected $table = 'notifications';

    protected $allowedColumns = [
        'user_id',
        'message',
        'is_read',
        'created_at'
    ];
}
