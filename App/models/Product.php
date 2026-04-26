<?php

class Product
{
    use Model;

    protected $table = "product";

    public function getFeatured($limit = 4)
    {
        $query = "SELECT * FROM product
                  ORDER BY ProductID DESC 
                  LIMIT $limit";

        return $this->query($query);
    }

}