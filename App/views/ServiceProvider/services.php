<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<div class="hero-wrap js-fullheight" style="background-image: url('<?php echo ROOT ?>/assets/images/bg_2.jpg');"
  data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center"
      data-scrollax-parent="true">
      <div class="col-md-11 ftco-animate text-center">
        <h1 class="mb-4">Our Professional Pet Services</h1>
        <p>Find the perfect care for your furry friends</p>
      </div>
    </div>
  </div>
</div>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if(isset($_SESSION['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $_SESSION['success']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $_SESSION['error']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center ftco-animate">
                <h2>Available Services</h2>
                <p>We offer a wide range of services from certified providers to keep your pets happy and healthy.</p>
                <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'Owner'): ?>
                    <a href="<?= ROOT ?>/petowner/pets" class="btn btn-outline-success mb-3">
                        🐾 Add or Manage My Pets
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <?php if (!empty($services)): ?>
                <?php foreach ($services as $service): ?>
                    <div class="col-md-4 col-sm-6 mb-4 ftco-animate">
                        <div class="card shadow-sm h-100 border-0">
                            <?php if (!empty($service['image'])): ?>
                                <img src="<?= ROOT ?>/uploads/services/<?= $service['image'] ?>" class="card-img-top" style="height:250px; object-fit:cover;">
                            <?php else: ?>
                                <div class="card-img-top d-flex align-items-center justify-content-center bg-primary text-white" style="height:250px; font-size: 4rem;">
                                    <span class="flaticon-dog"></span>
                                </div>
                            <?php endif; ?>

                            <div class="card-body text-center">
                                <h4 class="card-title"><?php echo htmlspecialchars($service['name']); ?></h4>
                                <p class="text-muted mb-1">
                                    <strong>Provider:</strong> <?php echo htmlspecialchars($service['provider_name']); ?>
                                </p>
                                <span class="badge badge-info px-3 py-2 mb-3"><?php echo htmlspecialchars($service['tier']); ?></span>
                                <h5 class="text-primary font-weight-bold">$<?php echo number_format($service['price'], 2); ?></h5>
                                
                                <div class="mt-4">
                                    <a href="<?= ROOT ?>/ServiceProvider/book/<?= $service['id'] ?>" class="btn btn-primary px-4 py-2">
                                        Book Service 📅
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <h3 class="text-muted">No services are available at the moment. 🐾</h3>
                    <p>Please check back later or browse our marketplace.</p>
                    <a href="<?= ROOT ?>/marketplace" class="btn btn-primary mt-3">Visit Marketplace</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
