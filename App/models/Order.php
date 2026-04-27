<?php

class Order
{
    use Model;

    protected $table = 'order'; // Note: 'order' is a reserved word in SQL, we must wrap in backticks
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
        $db = new class { use Database; };
        $con = $db->connect();
        
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
}