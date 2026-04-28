<?php

class Product
{
    use Model;

    protected $table = 'product';
    protected $primaryKey = 'ProductID';

    protected $allowedColumns = [
        'Name',
        'Ingredients',
        'Price',
        'stock',
        'image'
    ];

    public function getAll()
    {
        return $this->fetchAll();
    }

    public function getById($id)
    {
        $res = $this->where(['ProductID' => $id]);
        return !empty($res) ? $res[0] : false;
    }

    public function getFeatured($limit = 4)
    {
        $query = "SELECT * FROM $this->table ORDER BY ProductID DESC LIMIT $limit";
        return $this->query($query);
    }

    public function reduceStock($productId, $qty)
    {
        $query = "UPDATE $this->table SET stock = stock - :qty WHERE ProductID = :product_id AND stock >= :qty";
        return $this->query($query, ['qty' => $qty, 'product_id' => $productId]);
    }
}
