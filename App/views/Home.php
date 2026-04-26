<?php require __DIR__ . '/layouts/header.php'; ?>
<?php require __DIR__ . '/layouts/navbar.php'; ?>

<div class="hero-wrap js-fullheight" style="background-image: url('<?php echo ROOT ?>/assets/images/bg_1.jpg');"
  data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center"
      data-scrollax-parent="true">
      <div class="col-md-11 ftco-animate text-center">
        <h1 class="mb-4">Highest Quality Care For Pets You'll Love </h1>
        <p><a href="<?php echo ROOT ?>/vet/book" class="btn btn-primary mr-md-4 py-3 px-4">Book a Vet <span
              class="ion-ios-arrow-forward"></span></a></p>
      </div>
    </div>
  </div>
</div>

<section class="ftco-section bg-light ftco-no-pt ftco-intro">
  <div class="container">
    <div class="row">
      <div class="col-md-4 d-flex align-self-stretch px-4 ftco-animate">
        <div class="d-block services active text-center">
          <div class="icon d-flex align-items-center justify-content-center">
            <span class="flaticon-blind"></span>
          </div>
          <div class="media-body">
            <h3 class="heading">Dog Walking</h3>
            <p>Find the best walkers in your area with dynamic service geofencing and GPS tracking features.</p>
            <a href="<?php echo ROOT ?>/serviceprovider/index"
              class="btn-custom d-flex align-items-center justify-content-center"><span
                class="fa fa-chevron-right"></span><i class="sr-only">Read more</i></a>
          </div>
        </div>
      </div>
      <div class="col-md-4 d-flex align-self-stretch px-4 ftco-animate">
        <div class="d-block services text-center">
          <div class="icon d-flex align-items-center justify-content-center">
            <span class="flaticon-dog-eating"></span>
          </div>
          <div class="media-body">
            <h3 class="heading">Specialized Diet</h3>
            <p>Filter marketplace food items based on your pet's recorded medical history and contraindications.</p>
            <a href="<?php echo ROOT ?>/marketplace/index"
              class="btn-custom d-flex align-items-center justify-content-center"><span
                class="fa fa-chevron-right"></span><i class="sr-only">Read more</i></a>
          </div>
        </div>
      </div>
      <div class="col-md-4 d-flex align-self-stretch px-4 ftco-animate">
        <div class="d-block services text-center">
          <div class="icon d-flex align-items-center justify-content-center">
            <span class="flaticon-grooming"></span>
          </div>
          <div class="media-body">
            <h3 class="heading">Veterinary Care</h3>
            <p>Keep digital vaccination records, receive automated reminders, and schedule appointments easily.</p>
            <a href="<?php echo ROOT ?>/vet/book"
              class="btn-custom d-flex align-items-center justify-content-center"><span
                class="fa fa-chevron-right"></span><i class="sr-only">Read more</i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="ftco-section">
<div class="container">

<div class="row justify-content-center mb-5">
<div class="col-md-7 text-center">

<h2>Featured Products</h2>
<p>Top products recommended for your pets</p>

</div>
</div>

<div class="row">

<?php if (! empty($products)): ?>

<?php foreach ($products as $product): ?>

<div class="col-md-3 col-sm-6 mb-4 ftco-animate">

<div class="card shadow-sm h-100">

<img
src="<?php echo ROOT ?>/uploads/products/<?php echo ! empty($product['image']) ? $product['image'] : 'pricing-1.jpg'; ?>"
class="card-img-top"
style="height:200px; object-fit:cover;">

<div class="card-body text-center">

<h5 class="card-title">

<?php echo htmlspecialchars($product['Name']); ?>

</h5>

<p class="text-muted small">

<?php echo htmlspecialchars($product['Ingredients']); ?>

</p>

<h6 class="text-primary">

$<?php echo htmlspecialchars($product['Price']); ?>

</h6>

<?php if ($product['stock'] > 0): ?>

<a href="<?= ROOT ?>/marketplace/addToCart/<?= $product['ProductID'] ?>"
class="btn btn-primary btn-sm">

Add To Cart 🛒

</a>

<p class="text-success small">
Stock: <?= $product['stock'] ?>
</p>

<?php else: ?>

<button class="btn btn-secondary btn-sm" disabled>

Out of Stock ❌

</button>

<p class="text-danger small">
Out of Stock
</p>

<?php endif; ?>
</div>

</div>

</div>

<?php endforeach; ?>

<?php else: ?>

<div class="col-12 text-center">

<h5>No products available right now 🐾</h5>

</div>

<?php endif; ?>

</div>

</div>
</section>
<section class="ftco-section bg-light">
  <div class="container">

    <div class="row justify-content-center mb-5">
      <div class="col-md-7 text-center">
        <h2>Shop by Category</h2>
      </div>
    </div>

    <div class="row text-center">

      <div class="col-md-3">
        <div class="p-4 border rounded">

          <h5>🐶 Dog Food</h5>

          <a href="<?php echo ROOT ?>/marketplace" class="btn btn-outline-primary btn-sm">
            View
          </a>

        </div>
      </div>

      <div class="col-md-3">
        <div class="p-4 border rounded">

          <h5>🐱 Cat Supplies</h5>

          <a href="<?php echo ROOT ?>/marketplace" class="btn btn-outline-primary btn-sm">
            View
          </a>

        </div>
      </div>

      <div class="col-md-3">
        <div class="p-4 border rounded">

          <h5>🧴 Grooming</h5>

          <a href="<?php echo ROOT ?>/marketplace" class="btn btn-outline-primary btn-sm">
            View
          </a>

        </div>
      </div>

      <div class="col-md-3">
        <div class="p-4 border rounded">

          <h5>💊 Medicines</h5>

          <a href="<?php echo ROOT ?>/marketplace" class="btn btn-outline-primary btn-sm">
            View
          </a>

        </div>
      </div>

    </div>

  </div>
</section>
<section class="ftco-section">
  <div class="container">

    <div class="row justify-content-center mb-5">
      <div class="col-md-7 text-center">
        <h2>Why Choose PetCare?</h2>
      </div>
    </div>

    <div class="row text-center">

      <div class="col-md-4">

        <h4>🩺 Trusted Veterinarians</h4>

        <p>
          Professional vets ready to help your pets anytime.
        </p>

      </div>

      <div class="col-md-4">

        <h4>🛒 Smart Marketplace</h4>

        <p>
          Buy pet supplies based on medical needs.
        </p>

      </div>

      <div class="col-md-4">

        <h4>📋 Digital Records</h4>

        <p>
          Store vaccination and medical history securely.
        </p>

      </div>

    </div>

  </div>
</section>
<section class="ftco-section bg-light">
  <div class="container">

    <div class="row justify-content-center mb-5">
      <div class="col-md-7 text-center">
        <h2>Happy Customers</h2>
      </div>
    </div>

    <div class="row">

      <div class="col-md-4 text-center">

        <p>
          "PetCare helped me manage my dog's vaccines easily!"
        </p>

        <strong>Ahmed Ali</strong>

      </div>

      <div class="col-md-4 text-center">

        <p>
          "The marketplace saved me time finding special diet food."
        </p>

        <strong>Sara Mohamed</strong>

      </div>

      <div class="col-md-4 text-center">

        <p>
          "Booking vets is now very fast and simple."
        </p>

        <strong>Omar Hassan</strong>

      </div>

    </div>

  </div>
</section>
<section class="ftco-section bg-primary text-center text-white">
  <div class="container">

    <h3>Subscribe to Our Newsletter</h3>

    <p>
      Get updates about new products and services
    </p>

    <form class="form-inline justify-content-center">

      <input type="email" class="form-control mr-2" placeholder="Enter your email">

      <button class="btn btn-light">
        Subscribe
      </button>

    </form>

  </div>
</section>

<?php require __DIR__ . '/layouts/footer.php'; ?>