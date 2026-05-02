<?php require __DIR__ . '/layouts/header.php'; ?>
<?php require __DIR__ . '/layouts/navbar.php'; ?>



<section class="hero-premium">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-7 hero-content">
        <h1 class="animate__animated animate__fadeInUp"> Modern Care For Your Pets</h1>
        <p class="animate__animated animate__fadeInUp animate__delay-1s">PetCare is the world's most advanced platform for pet management, connecting you with elite veterinarians and premium supplies.</p>
        <div class="hero-btns animate__animated animate__fadeInUp animate__delay-2s">
          <a href="<?php echo ROOT ?>/petowner/bookVet" class="btn-premium btn-white">
            <span class="fa fa-calendar"></span> Book A Visit
          </a>
          <a href="<?php echo ROOT ?>/shop" class="btn-premium btn-outline-white">
            <span class="fa fa-shopping-bag"></span> Shop Marketplace
          </a>
        </div>
      </div>
    </div>
  </div>
</section>


<div class="container">
  <div class="row feature-row">
    <div class="col-md-4 mb-4">
      <div class="feature-card">
        <div class="feature-icon"><span class="fa fa-stethoscope"></span></div>
        <h3>Elite Vet Network</h3>
        <p>Access the best-rated veterinary clinics in your city with real-time availability and digital booking.</p>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="feature-card">
        <div class="feature-icon"><span class="fa fa-shopping-cart"></span></div>
        <h3>Smart Shop</h3>
        <p>A curated marketplace tailored to your pet's dietary needs and health history.</p>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="feature-card">
        <div class="feature-icon"><span class="fa fa-heartbeat"></span></div>
        <h3>Health History</h3>
        <p>Keep a complete digital record of vaccinations, surgeries, and medical reports in one safe place.</p>
      </div>
    </div>
  </div>
</div>


<section class="section-premium">
  <div class="container">
    <div class="section-header">
      <h2>Our best sellers</h2>
      <p>Premium nutrition and accessories recommended by our top specialists.</p>
    </div>

    <div class="row">
      <?php if (! empty($products)): ?>
        <?php foreach (array_slice($products, 0, 4) as $product): ?>
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="premium-card">
              <div class="card-media">
                <span class="card-badge">Best Seller</span>
                <?php if (!empty($product['image'])): ?>
                    <?php if (strpos($product['image'], 'http') === 0): ?>
                        <img src="<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['Name']) ?>">
                    <?php else: ?>
                        <img src="<?= ROOT ?>/uploads/products/<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['Name']) ?>">
                    <?php endif; ?>
                <?php else: ?>
                    <i class="fa fa-shopping-basket fa-5x" style="color: #e2e8f0;"></i>
                <?php endif; ?>
              </div>
              <div class="premium-card-body">
                <h3 class="product-name"><?php echo htmlspecialchars($product['Name']); ?></h3>
                <p class="product-meta"><?php echo htmlspecialchars(substr($product['Ingredients'], 0, 60)) ?>...</p>
                <div class="product-footer">
                  <div class="product-price"><?php echo htmlspecialchars($product['Price']); ?> <span style="font-size: 12px;">EGP</span></div>
                  <?php if ($product['stock'] > 0): ?>
                    <a href="<?= ROOT ?>/shop/addToCart/<?= $product['ProductID'] ?>" class="btn-pill btn-blue">
                      <span class="fa fa-plus"></span>
                    </a>
                  <?php else: ?>
                    <span class="badge badge-danger">Sold Out</span>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12 text-center text-muted">No products found.</div>
      <?php endif; ?>
    </div>
  </div>
</section>


<div class="stats-banner">
  <div class="container">
    <div class="row">
      <div class="col-md-3 stat-item">
        <h3>5k+</h3>
        <p>Happy Pets</p>
      </div>
      <div class="col-md-3 stat-item">
        <h3>120+</h3>
        <p>Verified Vets</p>
      </div>
      <div class="col-md-3 stat-item">
        <h3>15k+</h3>
        <p>Orders Delivered</p>
      </div>
      <div class="col-md-3 stat-item">
        <h3>24/7</h3>
        <p>Support</p>
      </div>
    </div>
  </div>
</div>


<section class="section-premium section-bg">
  <div class="container">
    <div class="section-header">
      <h2>Professional Care</h2>
      <p>World-class services from certified providers across the country.</p>
    </div>

    <div class="row">
      <?php if (! empty($services)): ?>
        <?php foreach (array_slice($services, 0, 4) as $service): ?>
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="premium-card">
              <div class="card-media">
                <?php if (! empty($service['image'])): ?>
                    <img src="<?= ROOT ?>/uploads/services/<?= $service['image'] ?>">
                <?php else: ?>
                    <div style="font-size: 3rem; color: #cbd5e1;"><span class="fa fa-paw"></span></div>
                <?php endif; ?>
              </div>
              <div class="premium-card-body">
                <span style="font-size: 11px; font-weight: 700; color: #10b981; text-transform: uppercase;"><?= $service['tier'] ?> Service</span>
                <h3 class="product-name" style="margin-top: 4px;"><?php echo htmlspecialchars($service['name']); ?></h3>
                <p class="product-meta">
                    Provider: <strong><?php echo htmlspecialchars($service['provider_name']); ?></strong>
                    <?php if (!empty($service['is_verified'])): ?>
                        <i class="fa fa-check-circle text-primary" title="Verified Professional"></i>
                    <?php endif; ?>
                </p>
                <div class="product-footer">
                  <div class="product-price">$<?php echo htmlspecialchars($service['price']); ?></div>
                  <a href="<?= ROOT ?>/ServiceProvider/book/<?= $service['id'] ?>" class="btn-pill btn-blue">
                    Book Visit
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>


<section class="section-premium">
  <div class="container">
    <div class="section-header">
      <h2>What Owners Say</h2>
      <p>Join thousands of happy pet owners who trust PetCare every day.</p>
    </div>

    <div class="row">
      <div class="col-md-4 mb-4">
        <div class="testimonial-card">
          <p class="testimonial-text">PetCare has completely transformed how I manage my cat's vaccinations. The reminders are a lifesaver!</p>
          <div class="testimonial-user">
            <div class="user-avatar">A</div>
            <div class="user-info">
              <strong>Ahmed Mansour</strong>
              <span>Dog Owner</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="testimonial-card">
          <p class="testimonial-text">The marketplace recommendations are spot on. My kitten loves the food suggested based on her age!</p>
          <div class="testimonial-user">
            <div class="user-avatar">S</div>
            <div class="user-info">
              <strong>Sara Khalid</strong>
              <span>Cat Owner</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="testimonial-card">
          <p class="testimonial-text">Booking a vet is now a 10-second task. No more phone calls or waiting. Highly recommend!</p>
          <div class="testimonial-user">
            <div class="user-avatar">M</div>
            <div class="user-info">
              <strong>Mona Ali</strong>
              <span>Bird Owner</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="section-premium section-bg">
  <div class="container">
    <div class="section-header">
      <h2>Happy Patients</h2>
      <p>A glimpse into the lives of the wonderful pets we care for every day.</p>
    </div>

    <div class="row g-4">
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="premium-card" style="height: 300px;">
          <img src="https://images.unsplash.com/photo-1517849845537-4d257902454a?auto=format&fit=crop&q=80&w=800" style="width:100%; height:100%; object-fit:cover; border-radius: 24px;">
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="premium-card" style="height: 300px;">
          <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?auto=format&fit=crop&q=80&w=800" style="width:100%; height:100%; object-fit:cover; border-radius: 24px;">
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="premium-card" style="height: 300px;">
          <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1?auto=format&fit=crop&q=80&w=800" style="width:100%; height:100%; object-fit:cover; border-radius: 24px;">
        </div>
      </div>
      <div class="col-lg-6 col-md-6 mb-4">
        <div class="premium-card" style="height: 350px;">
          <img src="https://images.unsplash.com/photo-1450778869180-41d0601e046e?auto=format&fit=crop&q=80&w=1200" style="width:100%; height:100%; object-fit:cover; border-radius: 24px;">
        </div>
      </div>
      <div class="col-lg-6 col-md-6 mb-4">
        <div class="premium-card" style="height: 350px;">
          <img src="https://images.unsplash.com/photo-1537151608828-ea2b11777ee8?auto=format&fit=crop&q=80&w=1200" style="width:100%; height:100%; object-fit:cover; border-radius: 24px;">
        </div>
      </div>
    </div>
  </div>
</section>


<div class="container">
  <div class="newsletter-premium">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <h2 style="color: white; font-weight: 800; margin-bottom: 16px;">Join the Pack</h2>
          <p style="opacity: 0.8; margin-bottom: 32px;">Subscribe to get exclusive discounts, health tips, and early access to new features.</p>
          <form class="d-flex gap-2" novalidate>
            <input type="email" class="form-control" placeholder="your@email.com" style="border-radius: 12px; padding: 14px 20px;">
            <button class="btn-premium btn-white" type="button">Subscribe</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require __DIR__ . '/layouts/footer.php'; ?>
