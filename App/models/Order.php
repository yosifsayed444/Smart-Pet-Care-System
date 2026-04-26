<?php

class Order {

    use Model;

    protected $table = "order";
      protected $allowedColumns = [
        'OrderID',
        'UserID',
        'OrderDate',
        'TotalPrice',
        'Status'
    ];

}