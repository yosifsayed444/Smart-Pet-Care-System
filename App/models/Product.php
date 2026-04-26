<?php

class Product
{
    use Model;
    protected $table = "product";

    protected $primaryKey = "ProductID";

    public function validate($data)
    {
        $errors = [];

        if (empty($data['Name'])) {
            $errors['Name'] = "Product name is required";
        }

        if (empty($data['Ingredients'])) {
            $errors['Ingredients'] = "Ingredients required";
        }

        if (empty($data['Price'])) {
            $errors['Price'] = "Price required";
        } elseif (! is_numeric($data['Price'])) {
            $errors['Price'] = "Price must be number";
        }

        if (empty($data['stock'])) {
            $errors['stock'] = "Stock required";
        } elseif (! is_numeric($data['stock'])) {
            $errors['stock'] = "Stock must be number";
        }

        return $errors;
    }public function getFeatured($limit = 4)
    {
        $query = "SELECT * FROM product
                  ORDER BY ProductID DESC
                  LIMIT $limit";

        return $this->query($query);
    }

}
