<?php

class Order
{
    use Model;

    protected $table = '`order`'; 
    protected $primaryKey = 'OrderID';

    protected $allowedColumns = [
        'UserID',
        'OrderDate',
        'TotalPrice',
        'Status'
    ];

    public function createOrder($data)
    {
        return $this->insert($data);
    }

    public function addDetails($orderId, $cart)
    {
        $con = $this->connect();
        
        foreach ($cart as $id => $item) {
            $query = "INSERT INTO orderdetails (OrderID, ProductID, Quantity) VALUES (:order_id, :product_id, :qty)";
            $con->prepare($query)->execute([
                'order_id' => $orderId,
                'product_id' => $id,
                'qty' => $item['qty']
            ]);
        }
    }

    public function getByUser($userId)
    {
        $query = "SELECT * FROM `order` WHERE UserID = :user_id ORDER BY OrderDate DESC";
        return $this->query($query, ['user_id' => $userId]);
    }

    public function getAllOrders()
    {
        $query = "SELECT o.*, u.username FROM `order` o JOIN users u ON o.UserID = u.id ORDER BY o.OrderDate DESC";
        return $this->query($query);
    }

    public function updateStatus($orderId, $status)
    {
        $query = "UPDATE `order` SET Status = :status WHERE OrderID = :order_id";
        return $this->query($query, ['status' => $status, 'order_id' => $orderId]);
    }

    public function getOrderItems($orderId)
    {
        $query = "SELECT * FROM orderdetails WHERE OrderID = :order_id";
        return $this->query($query, ['order_id' => $orderId]);
    }
}