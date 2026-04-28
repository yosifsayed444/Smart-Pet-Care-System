<?php require __DIR__ . '/layouts/header.php'; ?>
<?php require __DIR__ . '/layouts/navbar.php'; ?>

<style>
  

  :root {
    --brand-primary: #185FA5;
    --brand-secondary: #0C447C;
    --brand-accent: #1D9E75;
    --brand-bg: #f8fafc;
    --brand-white: #ffffff;
    --brand-text: #0f172a;
    --brand-muted: #64748b;
    --brand-border: rgba(0, 0, 0, 0.06);
    --brand-radius: 20px;
    --brand-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    --brand-font: 'Montserrat', 'Inter', sans-serif;
  }

  body {
    font-family: var(--brand-font);
    background-color: var(--brand-white);
    color: var(--brand-text);
    -webkit-font-smoothing: antialiased;
  }

  
  .hero-premium {
    position: relative;
    padding: 120px 0;
    background: linear-gradient(135deg, #185FA5 0%, #0C447C 100%);
    color: white;
    overflow: hidden;
    border-bottom-left-radius: 80px;
  }

  .hero-premium::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 65%;
    height: 100%;
    background: url('https://images.unsplash.com/photo-1516734212186-a967f81ad0d7?auto=format&fit=crop&q=80&w=1200') no-repeat center center;
    background-size: cover;
    opacity: 0.35;
    mask-image: linear-gradient(to left, black 60%, transparent);
    -webkit-mask-image: linear-gradient(to left, black 60%, transparent);
  }

  .hero-content h1 {
    font-size: 56px;
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 24px;
    letter-spacing: -0.03em;
  }

  .hero-content p {
    font-size: 18px;
    opacity: 0.9;
    margin-bottom: 40px;
    max-width: 600px;
  }

  .hero-btns {
    display: flex;
    gap: 16px;
  }

  .btn-premium {
    padding: 16px 32px;
    border-radius: 14px;
    font-weight: 700;
    font-size: 15px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 10px;
  }

  .btn-white {
    background: white;
    color: var(--brand-primary);
  }

  .btn-white:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 20px -5px rgba(0, 0, 0, 0.2);
    color: var(--brand-secondary);
  }

  .btn-outline-white {
    border: 2px solid rgba(255, 255, 255, 0.3);
    color: white;
  }

  .btn-outline-white:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: white;
    color: white;
  }

  
  .feature-row {
    margin-top: -60px;
    position: relative;
    z-index: 10;
  }

  .feature-card {
    background: white;
    padding: 32px;
    border-radius: var(--brand-radius);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    border: 1px solid var(--brand-border);
    transition: all 0.3s ease;
    text-align: center;
    height: 100%;
  }

  .feature-card:hover {
    transform: translateY(-10px);
    border-color: var(--brand-primary);
  }

  .feature-icon {
    width: 64px;
    height: 64px;
    border-radius: 16px;
    background: #E6F1FB;
    color: var(--brand-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    margin: 0 auto 20px;
  }

  .feature-card h3 {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 12px;
  }

  .feature-card p {
    font-size: 14px;
    color: var(--brand-muted);
    line-height: 1.6;
  }

  
  .section-premium {
    padding: 100px 0;
  }

  .section-bg {
    background-color: var(--brand-bg);
  }

  .section-header {
    margin-bottom: 60px;
    text-align: center;
  }

  .section-header h2 {
    font-size: 36px;
    font-weight: 800;
    letter-spacing: -0.02em;
    margin-bottom: 16px;
  }

  .section-header p {
    color: var(--brand-muted);
    font-size: 16px;
    max-width: 600px;
    margin: 0 auto;
  }

  
  .premium-card {
    background: white;
    border-radius: 24px;
    border: 1px solid var(--brand-border);
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    height: 100%;
    display: flex;
    flex-direction: column;
  }

  .premium-card:hover {
    transform: scale(1.03);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
    border-color: var(--brand-primary);
  }

  .card-media {
    height: 240px;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
  }

  .card-media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .card-badge {
    position: absolute;
    top: 16px;
    left: 16px;
    padding: 6px 12px;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(4px);
    border-radius: 10px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    color: var(--brand-primary);
  }

  .premium-card-body {
    padding: 24px;
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  .product-name {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 8px;
    color: var(--brand-text);
  }

  .product-meta {
    font-size: 13px;
    color: var(--brand-muted);
    margin-bottom: 16px;
    line-height: 1.4;
  }

  .product-footer {
    margin-top: auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .product-price {
    font-size: 20px;
    font-weight: 800;
    color: var(--brand-primary);
  }

  
  .stats-banner {
    background: var(--brand-primary);
    padding: 60px 0;
    color: white;
    text-align: center;
  }

  .stat-item h3 {
    font-size: 40px;
    font-weight: 800;
    margin-bottom: 4px;
  }

  .stat-item p {
    font-size: 14px;
    opacity: 0.8;
    text-transform: uppercase;
    letter-spacing: 0.1em;
  }

  
  .testimonial-card {
    background: white;
    padding: 40px;
    border-radius: var(--brand-radius);
    border: 1px solid var(--brand-border);
    position: relative;
  }

  .testimonial-card::before {
    content: '"';
    position: absolute;
    top: 20px;
    left: 20px;
    font-size: 80px;
    color: #e2e8f0;
    font-family: serif;
    line-height: 1;
  }

  .testimonial-text {
    font-size: 16px;
    color: var(--brand-text);
    font-style: italic;
    margin-bottom: 24px;
    position: relative;
    z-index: 1;
  }

  .testimonial-user {
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .user-avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: var(--brand-bg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    color: var(--brand-primary);
  }

  .user-info strong {
    display: block;
    font-size: 15px;
  }

  .user-info span {
    font-size: 12px;
    color: var(--brand-muted);
  }

  
  .newsletter-premium {
    padding: 80px 0;
    background: linear-gradient(rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.9)), 
                url('https://images.unsplash.com/photo-1450778869180-41d0601e046e?auto=format&fit=crop&q=80&w=1200');
    background-size: cover;
    background-position: center;
    border-radius: 40px;
    margin: 40px;
    color: white;
    text-align: center;
  }

</style>


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
                <p class="product-meta">Provider: <strong><?php echo htmlspecialchars($service['provider_name']); ?></strong></p>
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
