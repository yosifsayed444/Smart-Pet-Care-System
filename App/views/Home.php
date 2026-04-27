<?php require __DIR__ . '/layouts/header.php'; ?>
<?php require __DIR__ . '/layouts/navbar.php'; ?>

<style>
  /* ============================================================
   PetCare — Custom Override CSS
   Minimal & Professional — Bootstrap override only
   Import AFTER bootstrap.css in header.php
   ============================================================ */

/* ── TOKENS ─────────────────────────────────────────────── */
:root {
  --pc-green:        #1D9E75;
  --pc-green-dark:   #0F6E56;
  --pc-green-light:  #E1F5EE;
  --pc-green-mid:    #9FE1CB;
  --pc-text:         #111111;
  --pc-muted:        #6B7280;
  --pc-border:       #E5E7EB;
  --pc-bg:           #FFFFFF;
  --pc-bg-alt:       #F9FAFB;
  --pc-radius:       10px;
  --pc-radius-lg:    14px;
  --pc-font:         'DM Sans', 'Segoe UI', sans-serif;
}

/* Google Font */
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&display=swap');

/* ── BASE ─────────────────────────────────────────────────── */
body {
  font-family: var(--pc-font);
  color: var(--pc-text);
  background: var(--pc-bg);
  -webkit-font-smoothing: antialiased;
}

a { text-decoration: none; }

/* ── HERO ─────────────────────────────────────────────────── */
.hero-wrap {
  /* background-color: var(--pc-green-dark) !important; */
  /* background-image: none !important; */
  min-height: 480px !important;
  display: flex;
  align-items: center;
  position: relative;
  overflow: hidden;
}

/* subtle geometric accent */
.hero-wrap::before {
  content: '';
  position: absolute;
  right: -120px;
  top: -120px;
  width: 520px;
  height: 520px;
  border-radius: 50%;
  background: rgba(255,255,255,0.04);
  pointer-events: none;
}
.hero-wrap::after {
  content: '';
  position: absolute;
  right: 60px;
  bottom: -80px;
  width: 280px;
  height: 280px;
  border-radius: 50%;
  background: rgba(255,255,255,0.03);
  pointer-events: none;
}

.hero-wrap .overlay { display: none; }

.hero-wrap .slider-text h1 {
  font-size: 46px;
  font-weight: 600;
  line-height: 1.18;
  letter-spacing: -1.2px;
  /* color: #fff; */
  margin-bottom: 20px;
}

.hero-wrap .slider-text p { margin-bottom: 0; }

.hero-wrap .btn-primary {
  background: #fff !important;
  color: var(--pc-green-dark) !important;
  border: none !important;
  font-weight: 600;
  font-size: 15px;
  padding: 14px 32px !important;
  border-radius: var(--pc-radius) !important;
  letter-spacing: -0.2px;
  transition: opacity .2s;
}
.hero-wrap .btn-primary:hover { opacity: .88; }

/* ── INTRO SERVICES BAR ───────────────────────────────────── */
.ftco-intro {
  background: var(--pc-bg) !important;
  padding-top: 0 !important;
  padding-bottom: 0 !important;
  border-bottom: 1px solid var(--pc-border);
}

.ftco-intro .services {
  border-right: 1px solid var(--pc-border);
  border-bottom: none !important;
  border-radius: 0 !important;
  background: var(--pc-bg) !important;
  padding: 36px 32px !important;
  margin: 0 !important;
  transition: background .2s;
}
.ftco-intro .services:last-child { border-right: none; }
.ftco-intro .services:hover { background: var(--pc-green-light) !important; }
.ftco-intro .services.active { background: var(--pc-bg) !important; }

.ftco-intro .services .icon {
  width: 48px;
  height: 48px;
  border-radius: 10px;
  background: var(--pc-green-light);
  margin: 0 auto 16px;
}
.ftco-intro .services .icon span {
  font-size: 22px;
  color: var(--pc-green-dark);
}

.ftco-intro .services h3.heading {
  font-size: 15px;
  font-weight: 600;
  color: var(--pc-text);
  margin-bottom: 6px;
}
.ftco-intro .services p {
  font-size: 13px;
  color: var(--pc-muted);
  line-height: 1.6;
  margin-bottom: 14px;
}

.ftco-intro .btn-custom {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: var(--pc-green-light);
  color: var(--pc-green-dark);
  margin: 0 auto;
  transition: background .2s, color .2s;
}
.ftco-intro .btn-custom:hover {
  background: var(--pc-green);
  color: #fff;
}

/* ── SECTION SHARED ───────────────────────────────────────── */
.ftco-section {
  padding: 72px 0 !important;
  background: var(--pc-bg);
}
.ftco-section.bg-light {
  background: var(--pc-bg-alt) !important;
}

.ftco-section h2 {
  font-size: 26px;
  font-weight: 600;
  letter-spacing: -0.6px;
  color: var(--pc-text);
  margin-bottom: 6px;
}
.ftco-section > .container > .row.justify-content-center p {
  font-size: 14px;
  color: var(--pc-muted);
}

/* ── PRODUCT CARDS ────────────────────────────────────────── */
.ftco-section .card {
  border: 1px solid var(--pc-border) !important;
  border-radius: var(--pc-radius-lg) !important;
  box-shadow: none !important;
  transition: border-color .2s, transform .2s;
  background: var(--pc-bg);
}
.ftco-section .card:hover {
  border-color: var(--pc-green-mid) !important;
  transform: translateY(-2px);
}

.ftco-section .card-img-top {
  border-radius: var(--pc-radius-lg) var(--pc-radius-lg) 0 0 !important;
  object-fit: cover;
}

.ftco-section .card-body {
  padding: 16px 18px !important;
}

.ftco-section .card-title {
  font-size: 14px !important;
  font-weight: 600 !important;
  color: var(--pc-text);
  margin-bottom: 4px;
}

.ftco-section .card-body .text-muted.small {
  font-size: 12px !important;
  color: var(--pc-muted) !important;
  margin-bottom: 10px;
}

.ftco-section .card-body .text-primary {
  font-size: 16px !important;
  font-weight: 600 !important;
  color: var(--pc-green) !important;
}

/* product action buttons */
.ftco-section .card-body .btn-primary.btn-sm {
  background: var(--pc-green) !important;
  border: none !important;
  border-radius: 6px !important;
  font-size: 12px !important;
  font-weight: 500;
  padding: 7px 14px !important;
  color: #fff !important;
}
.ftco-section .card-body .btn-primary.btn-sm:hover {
  background: var(--pc-green-dark) !important;
}

.ftco-section .card-body .btn-secondary.btn-sm {
  background: #F3F4F6 !important;
  border: none !important;
  border-radius: 6px !important;
  font-size: 12px !important;
  color: var(--pc-muted) !important;
  padding: 7px 14px !important;
}

.ftco-section .card-body .text-success.small {
  font-size: 11px !important;
  color: var(--pc-green) !important;
  margin-top: 6px;
}
.ftco-section .card-body .text-danger.small {
  font-size: 11px !important;
  margin-top: 6px;
}

/* ── SERVICE CARDS ────────────────────────────────────────── */
.ftco-section .card.border-0 {
  border: 1px solid var(--pc-border) !important;
}

/* provider name */
.ftco-section .card-body .text-muted.small.mb-1 {
  font-size: 12px !important;
}

/* tier badge */
.ftco-section .card-body .badge.badge-info {
  background: var(--pc-green-light) !important;
  color: var(--pc-green-dark) !important;
  font-size: 11px !important;
  font-weight: 500;
  border-radius: 20px;
  padding: 3px 10px;
}

/* Book Now button */
.ftco-section .card-body .btn-outline-primary.btn-sm {
  border: 1px solid var(--pc-green) !important;
  color: var(--pc-green) !important;
  background: transparent !important;
  border-radius: 6px !important;
  font-size: 12px !important;
  font-weight: 500;
  padding: 7px 14px !important;
  transition: background .2s, color .2s;
}
.ftco-section .card-body .btn-outline-primary.btn-sm:hover {
  background: var(--pc-green) !important;
  color: #fff !important;
}

/* ── SHOP BY CATEGORY ─────────────────────────────────────── */
.ftco-section .p-4.border.rounded {
  border: 1px solid var(--pc-border) !important;
  border-radius: var(--pc-radius-lg) !important;
  padding: 28px 20px !important;
  background: var(--pc-bg);
  transition: border-color .2s, background .2s;
  cursor: pointer;
}
.ftco-section .p-4.border.rounded:hover {
  border-color: var(--pc-green) !important;
  background: var(--pc-green-light);
}
.ftco-section .p-4.border.rounded h5 {
  font-size: 15px;
  font-weight: 600;
  color: var(--pc-text);
  margin-bottom: 12px;
}
.ftco-section .p-4.border.rounded .btn-outline-primary.btn-sm {
  border: 1px solid var(--pc-green) !important;
  color: var(--pc-green) !important;
  background: transparent !important;
  border-radius: 6px !important;
  font-size: 12px !important;
  font-weight: 500;
  padding: 6px 18px !important;
  transition: background .2s, color .2s;
}
.ftco-section .p-4.border.rounded:hover .btn-outline-primary.btn-sm {
  background: var(--pc-green) !important;
  color: #fff !important;
}

/* ── WHY CHOOSE ───────────────────────────────────────────── */
.ftco-section .col-md-4 h4 {
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 8px;
  color: var(--pc-text);
}
.ftco-section .col-md-4 p {
  font-size: 14px;
  color: var(--pc-muted);
  line-height: 1.7;
}

/* ── TESTIMONIALS ─────────────────────────────────────────── */
.ftco-section .col-md-4.text-center p {
  font-size: 14px;
  color: var(--pc-muted);
  line-height: 1.7;
  font-style: italic;
  border-left: 3px solid var(--pc-green-mid);
  text-align: left;
  padding-left: 16px;
  margin-bottom: 10px;
}
.ftco-section .col-md-4.text-center strong {
  font-size: 13px;
  font-weight: 600;
  color: var(--pc-text);
}

/* ── NEWSLETTER SECTION ───────────────────────────────────── */
section.ftco-section.bg-primary {
  background: var(--pc-green-dark) !important;
  padding: 64px 0 !important;
}
section.ftco-section.bg-primary h3 {
  font-size: 26px;
  font-weight: 600;
  letter-spacing: -0.5px;
  color: #fff;
  margin-bottom: 8px;
}
section.ftco-section.bg-primary p {
  color: var(--pc-green-mid);
  font-size: 15px;
  margin-bottom: 28px;
}
section.ftco-section.bg-primary .form-control {
  border-radius: 8px !important;
  border: none !important;
  padding: 13px 18px !important;
  font-size: 14px;
  background: rgba(255,255,255,0.12);
  color: #fff;
}
section.ftco-section.bg-primary .form-control::placeholder { color: rgba(255,255,255,0.5); }
section.ftco-section.bg-primary .btn-light {
  background: #fff !important;
  color: var(--pc-green-dark) !important;
  border: none !important;
  border-radius: 8px !important;
  font-weight: 600;
  font-size: 14px;
  padding: 13px 28px !important;
  transition: opacity .2s;
}
section.ftco-section.bg-primary .btn-light:hover { opacity: .88; }

/* ── FTCO ANIMATE — remove heavy transitions ──────────────── */
.ftco-animate {
  opacity: 1 !important;
  transform: none !important;
}
</style>
<div class="hero-wrap js-fullheight" style="background-image: url('<?php echo ROOT ?>/assets/images/bg_1.jpg');"
  data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center"
      data-scrollax-parent="true">
      <div class="col-md-11 ftco-animate text-center">
        <h1 class="mb-4">Highest Quality Care For Pets You'll Love </h1>
        <p><a href="<?php echo ROOT ?>/petowner/appointments" class="btn btn-primary mr-md-4 py-3 px-4">Book a Vet <span
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
</section>

<section class="ftco-section bg-light">
<div class="container">

<div class="row justify-content-center mb-5">
<div class="col-md-7 text-center">

<h2>Professional Services</h2>
<p>Book the best care for your pets from verified providers</p>

</div>
</div>

<div class="row">

<?php if (! empty($services)): ?>

<?php foreach ($services as $service): ?>

<div class="col-md-3 col-sm-6 mb-4 ftco-animate">

<div class="card shadow-sm h-100 border-0">

<?php if (! empty($service['image'])): ?>
    <img src="<?= ROOT ?>/uploads/services/<?= $service['image'] ?>" class="card-img-top" style="height:200px; object-fit:cover;">
<?php else: ?>
    <div class="card-img-top d-flex align-items-center justify-content-center bg-primary text-white" style="height:200px; font-size: 3rem;">
        <span class="flaticon-dog"></span>
    </div>
<?php endif; ?>

<div class="card-body text-center">

<h5 class="card-title">
<?php echo htmlspecialchars($service['name']); ?>
</h5>

<p class="text-muted small mb-1">
    <strong>Provider:</strong> <?php echo htmlspecialchars($service['provider_name']); ?>
</p>

<p class="badge badge-info">
    <?php echo htmlspecialchars($service['tier']); ?>
</p>

<h6 class="text-primary mt-2">
$<?php echo htmlspecialchars($service['price']); ?>
</h6>

<a href="<?= ROOT ?>/ServiceProvider/book/<?= $service['id'] ?>" class="btn btn-outline-primary btn-sm mt-2">
    Book Now 📅
</a>
</div>

</div>

</div>

<?php endforeach; ?>

<?php else: ?>

<div class="col-12 text-center">
<h5>No services listed yet 🐾</h5>
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