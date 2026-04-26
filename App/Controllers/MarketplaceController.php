<?php

class MarketplaceController extends Controller
{

    public function index()
    {
        $productModel = new Product();

        $products = $productModel->fetchAll();

        $this->view("marketplace/index", [
            "products" => $products,
        ]);
    }

    public function cart()
    {
        $cart = $_SESSION['cart'] ?? [];

        $this->view('marketplace/cart', [
            'cart' => $cart,
        ]);
    }

    public function addToCart($id = null)
    {
        if (! isset($_SESSION['id'])) {
        header("Location: " . ROOT . "/auth/login");
        exit;
        }

        if (! $id) {
            return;
        }

        $productModel = new Product();

        $product = $productModel->first([
            "ProductID" => $id,
        ]);

        if ($product) {

            if (! isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            $currentQty = $_SESSION['cart'][$id]['qty'] ?? 0;

            if ($currentQty >= $product['stock']) {

                echo "Out of Stock ❌";
                return;
            }

            if (isset($_SESSION['cart'][$id])) {

                $_SESSION['cart'][$id]['qty']++;

            } else {

                $_SESSION['cart'][$id] = [

                    "ProductID" => $product['ProductID'],
                    "Name"      => $product['Name'],
                    "Price"     => (float) $product['Price'],
                    "image"     => $product['image'] ?? "pricing-1.jpg",
                    "qty"       => 1,

                ];
            }
        }

        header("Location: " . ROOT . "/marketplace/cart");
        exit;}
    public function increaseQty($id = null)
    {
        if (! isset($_SESSION['cart'][$id])) {
            return;
        }

        $productModel = new Product();

        $product = $productModel->first([
            "ProductID" => $id,
        ]);

        if (! $product) {
            return;
        }

        $currentQty = $_SESSION['cart'][$id]['qty'];

        if ($currentQty >= $product['stock']) {

            echo "No more stock available ❌";
            return;
        }

        $_SESSION['cart'][$id]['qty']++;

        header("Location: " . ROOT . "/marketplace/cart");
        exit;
    }
    public function decreaseQty($id = null)
    {
        if (isset($_SESSION['cart'][$id])) {

            $_SESSION['cart'][$id]['qty']--;

            if ($_SESSION['cart'][$id]['qty'] <= 0) {

                unset($_SESSION['cart'][$id]);

            }
        }

        header("Location: " . ROOT . "/marketplace/cart");
        exit;
    }

    public function removeFromCart($id)
    {
        if (isset($_SESSION['cart'][$id])) {

            unset($_SESSION['cart'][$id]);

        }

        header("Location: " . ROOT . "/marketplace/cart");
        exit;
    }

    public function clearCart()
    {
        unset($_SESSION['cart']);

        header("Location: " . ROOT . "/marketplace/cart");
        exit;
    }

    public function checkout()
    {
        if (empty($_SESSION['cart'])) {

            header("Location: " . ROOT . "/marketplace");
            exit;
        }

        require __DIR__ . '/../views/Marketplace/checkout.php';
    }

}
