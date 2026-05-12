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
        if (!isset($_SESSION['id'])) {
            $_SESSION['error'] = "Please login to add items to cart.";
            redirect('auth/login');
        }

        $productModel = new Product();
        $product = $productModel->getById($id);

        if (!$product) {
            $_SESSION['error'] = "Product not found.";
            redirect('shop');
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $currentQty = $_SESSION['cart'][$id]['qty'] ?? 0;

        if ($currentQty >= $product['stock']) {
            $_SESSION['error'] = "Out of Stock ❌";
            redirect('shop');
        }

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['qty']++;
        } else {
            $_SESSION['cart'][$id] = [
                'ProductID' => $product['ProductID'],
                'name' => $product['Name'],
                'price' => (float)$product['Price'],
                'image' => $product['image'] ?? "pricing-1.jpg",
                'qty' => 1
            ];
        }

        $_SESSION['success'] = "Added " . $product['Name'] . " to cart!";
        redirect('shop/cart');
    }

    public function cart()
    {
        $data['cart'] = $_SESSION['cart'] ?? [];
        $data['total'] = Helpers::calculateCartTotal($data['cart']);
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

    public function increaseQty($id)
    {
        if (isset($_SESSION['cart'][$id])) {
            $productModel = new Product();
            $product = $productModel->getById($id);
            
            if ($product && $_SESSION['cart'][$id]['qty'] < $product['stock']) {
                $_SESSION['cart'][$id]['qty']++;
            } else {
                $_SESSION['error'] = "No more stock available.";
            }
        }
        redirect('shop/cart');
    }

    public function decreaseQty($id)
    {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['qty']--;
            if ($_SESSION['cart'][$id]['qty'] <= 0) {
                unset($_SESSION['cart'][$id]);
            }
        }
        redirect('shop/cart');
    }

    public function clearCart()
    {
        unset($_SESSION['cart']);
        $_SESSION['success'] = "Cart cleared.";
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
        $data['total'] = Helpers::calculateCartTotal($data['cart']);

        $this->view('Shop/checkout', $data);
    }

    public function placeOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_SESSION['cart'])) {
                redirect('shop');
                return;
            }

            $errors = Validator::validateCheckout($_POST);
            if (!empty($errors)) {
                $data['cart'] = $_SESSION['cart'];
                $data['total'] = Helpers::calculateCartTotal($data['cart']);
                $data['errors'] = $errors;
                $data['old'] = $_POST;
                $this->view('Shop/checkout', $data);
                return;
            }

            $paymentMethod = $_POST['payment'] ?? 'cod';
            $status = ($paymentMethod === 'card') ? 'Confirmed' : 'Pending';

            $orderModel = new Order();
            $total = Helpers::calculateCartTotal($_SESSION['cart']);

            $orderData = [
                'UserID' => $_SESSION['id'],
                'OrderDate' => date('Y-m-d'),
                'TotalPrice' => $total,
                'Status' => $status
            ];

            
            $con = $orderModel->connect();
            $query = "INSERT INTO `order` (UserID, OrderDate, TotalPrice, Status) VALUES (:UserID, :OrderDate, :TotalPrice, :Status)";
            $stmt = $con->prepare($query);
            $stmt->execute($orderData);
            
            $orderId = $con->lastInsertId();

            if ($orderId) {
                $orderModel->payouts($orderId, $_SESSION['cart']);
                unset($_SESSION['cart']);
                $_SESSION['success'] = "Order placed successfully! Order ID: #$orderId";
                
                
                if ($paymentMethod === 'card') {
                    $_SESSION['success'] .= " (Payment Confirmed via Card)";
                }

                redirect('petowner/index');
            } else {
                $_SESSION['error'] = "Failed to place order. Please try again.";
                redirect('shop/checkout');
            }
        }
    }
}
