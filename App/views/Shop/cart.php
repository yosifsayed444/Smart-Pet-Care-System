<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4">Your Shopping Cart</h2>
                
                <?php if(isset($_SESSION['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                <?php endif; ?>

                <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                <?php endif; ?>
                
                <?php if(!empty($cart)): ?>
                    <div class="card shadow-sm p-4">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($cart as $id => $item): ?>
                                    <tr>
                                        <?php 
                                            $name = $item['name'] ?? $item['Name'] ?? 'Product';
                                            $price = $item['price'] ?? $item['Price'] ?? 0;
                                        ?>
                                        <td><strong><?= htmlspecialchars($name) ?></strong></td>
                                        <td><?= number_format($price, 2) ?> EGP</td>
                                        <td class="text-center">
                                            <div class="input-group mb-3" style="max-width: 120px; margin: 0 auto;">
                                                <div class="input-group-prepend">
                                                    <a href="<?= ROOT ?>/shop/decreaseQty/<?= $id ?>" class="btn btn-outline-secondary btn-sm">-</a>
                                                </div>
                                                <input type="text" class="form-control form-control-sm text-center" value="<?= $item['qty'] ?>" readonly>
                                                <div class="input-group-append">
                                                    <a href="<?= ROOT ?>/shop/increaseQty/<?= $id ?>" class="btn btn-outline-secondary btn-sm">+</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= number_format($price * $item['qty'], 2) ?> EGP</td>
                                        <td>
                                            <a href="<?= ROOT ?>/shop/removeFromCart/<?= $id ?>" class="text-danger">
                                                <i class="fa fa-trash-o fa-lg"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr class="font-weight-bold" style="font-size: 1.2rem;">
                                    <td colspan="3" class="text-right">Total:</td>
                                    <td class="text-success"><?= number_format($total, 2) ?> EGP</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                        
                        <div class="d-flex justify-content-between mt-4">
                            <a href="<?= ROOT ?>/shop" class="btn btn-outline-secondary">Continue Shopping</a>
                            <a href="<?= ROOT ?>/shop/checkout" class="btn btn-primary px-5">Proceed to Checkout <i class="fa fa-arrow-right ml-1"></i></a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="card p-5 text-center shadow-sm">
                        <i class="fa fa-shopping-cart fa-4x text-muted mb-3"></i>
                        <h5>Your cart is empty.</h5>
                        <div class="mt-3">
                            <a href="<?= ROOT ?>/shop" class="btn btn-primary">Start Shopping</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
