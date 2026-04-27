<?php

class ShopController extends Controller
{
    public function index()
    {
        $productModel = new Product();
        $data['products'] = $productModel->getAll();
        $this->view('Shop/index', $data);
    }

    public function addToCart($id)
    {
        $productModel = new Product();
        $product = $productModel->getById($id);

        if (!$product) {
            $_SESSION['error'] = "Product not found.";
            redirect('shop');
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['qty']++;
        } else {
            $_SESSION['cart'][$id] = [
                'name' => $product['Name'],
                'price' => $product['Price'],
                'qty' => 1
            ];
        }

        $_SESSION['success'] = "Added " . $product['Name'] . " to cart!";
        redirect('shop');
    }

    public function cart()
    {
        $data['cart'] = $_SESSION['cart'] ?? [];
        $data['total'] = 0;
        foreach ($data['cart'] as $item) {
            $data['total'] += $item['price'] * $item['qty'];
        }
        $this->view('Shop/cart', $data);
    }

    public function removeFromCart($id)
    {
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
            $_SESSION['success'] = "Item removed from cart.";
        }
        redirect('shop/cart');
    }

    public function checkout()
    {
        if (empty($_SESSION['cart'])) {
            $_SESSION['error'] = "Your cart is empty.";
            redirect('shop');
        }

        if (!isset($_SESSION['id'])) {
            $_SESSION['error'] = "Please login to place an order.";
            redirect('auth/login');
        }

        $data['cart'] = $_SESSION['cart'];
        $data['total'] = 0;
        foreach ($data['cart'] as $item) {
            $data['total'] += $item['price'] * $item['qty'];
        }

        $this->view('Shop/checkout', $data);
    }

    public function placeOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_SESSION['cart'])) {
                redirect('shop');
            }

            $orderModel = new Order();
            $total = 0;
            foreach ($_SESSION['cart'] as $item) {
                $total += $item['price'] * $item['qty'];
            }

            $orderData = [
                'UserID' => $_SESSION['id'],
                'OrderDate' => date('Y-m-d'),
                'TotalPrice' => $total,
                'Status' => 'Pending'
            ];

            // Note: Since 'order' is a reserved word, let's use raw query for insert to be safe
            $db = new class { use Database; };
            $con = $db->connect();
            $query = "INSERT INTO `order` (UserID, OrderDate, TotalPrice, Status) VALUES (:UserID, :OrderDate, :TotalPrice, :Status)";
            $stmt = $con->prepare($query);
            $stmt->execute($orderData);
            
            $orderId = $con->lastInsertId();

            if ($orderId) {
                $orderModel->addDetails($orderId, $_SESSION['cart']);
                unset($_SESSION['cart']);
                $_SESSION['success'] = "Order placed successfully! Order ID: #$orderId";
                redirect('petowner/index');
            } else {
                $_SESSION['error'] = "Failed to place order. Please try again.";
                redirect('shop/checkout');
            }
        }
    }
}
