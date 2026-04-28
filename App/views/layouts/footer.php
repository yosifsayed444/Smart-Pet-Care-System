<style>
.petcare-footer {
    background: #0f172a;
    color: rgba(255,255,255,0.75);
    font-family: 'Montserrat', sans-serif;
    padding: 64px 0 0;
    position: relative;
    overflow: hidden;
}

.petcare-footer::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #185FA5, #3b82f6, #185FA5);
    background-size: 200% 100%;
    animation: shimmer 3s linear infinite;
}

@keyframes shimmer {
    0%   { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

.pf-brand-logo {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 16px;
    text-decoration: none;
}

.pf-brand-logo img {
    width: 42px;
    height: 42px;
    object-fit: contain;
    border-radius: 10px;
    filter: brightness(1.1);
}

.pf-brand-name {
    font-size: 22px;
    font-weight: 800;
    background: linear-gradient(135deg, #ffffff 0%, #93c5fd 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    letter-spacing: -0.02em;
}

.pf-tagline {
    font-size: 13px;
    line-height: 1.7;
    color: rgba(255,255,255,0.5);
    margin-bottom: 24px;
    max-width: 240px;
}

.pf-socials {
    display: flex;
    gap: 10px;
    list-style: none;
    padding: 0;
    margin: 0;
}

.pf-socials li a {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgba(255,255,255,0.6);
    font-size: 15px;
    transition: all 0.25s ease;
    text-decoration: none;
}

.pf-socials li a:hover {
    background: #185FA5;
    border-color: #185FA5;
    color: #fff;
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(24,95,165,0.4);
}

.pf-heading {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: #185FA5;
    margin-bottom: 20px;
    position: relative;
    padding-bottom: 10px;
}

.pf-heading::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0;
    width: 28px;
    height: 2px;
    background: #185FA5;
    border-radius: 2px;
}

.pf-links {
    list-style: none;
    padding: 0; margin: 0;
}

.pf-links li {
    margin-bottom: 2px;
}

.pf-links li a {
    color: rgba(255,255,255,0.55);
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 6px 0;
    transition: all 0.2s ease;
}

.pf-links li a::before {
    content: '';
    width: 5px;
    height: 5px;
    border-radius: 50%;
    background: #185FA5;
    opacity: 0;
    transform: translateX(-6px);
    transition: all 0.2s ease;
    flex-shrink: 0;
}

.pf-links li a:hover {
    color: #fff;
    padding-left: 4px;
}

.pf-links li a:hover::before {
    opacity: 1;
    transform: translateX(0);
}

.pf-contact-list {
    list-style: none;
    padding: 0; margin: 0;
}

.pf-contact-list li {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 14px;
    color: rgba(255,255,255,0.55);
    font-size: 13.5px;
}

.pf-contact-list li a {
    color: rgba(255,255,255,0.55);
    text-decoration: none;
    transition: color 0.2s;
    display: flex;
    align-items: center;
    gap: 12px;
}

.pf-contact-list li a:hover {
    color: #fff;
    text-decoration: none;
}

.pf-contact-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: rgba(24,95,165,0.15);
    border: 1px solid rgba(24,95,165,0.25);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #3b82f6;
    font-size: 13px;
    flex-shrink: 0;
}
.pf-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.pf-badge {
    background: rgba(24,95,165,0.12);
    border: 1px solid rgba(24,95,165,0.25);
    color: #93c5fd;
    font-size: 11px;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    gap: 5px;
    transition: all 0.2s;
}

.pf-badge:hover {
    background: rgba(24,95,165,0.25);
    color: #fff;
}

.pf-divider {
    border: none;
    border-top: 1px solid rgba(255,255,255,0.07);
    margin: 48px 0 0;
}

.pf-bottom {
    background: rgba(0,0,0,0.25);
    padding: 18px 0;
}

.pf-copyright {
    font-size: 12.5px;
    color: rgba(255,255,255,0.35);
    margin: 0;
}

.pf-copyright span {
    color: #3b82f6;
    font-weight: 700;
}

.pf-bottom-links {
    display: flex;
    gap: 20px;
    justify-content: flex-end;
    list-style: none;
    padding: 0; margin: 0;
}

.pf-bottom-links a {
    font-size: 12px;
    color: rgba(255,255,255,0.35);
    text-decoration: none;
    transition: color 0.2s;
}

.pf-bottom-links a:hover {
    color: rgba(255,255,255,0.8);
}

@media (max-width: 768px) {
    .pf-bottom-links { justify-content: flex-start; margin-top: 8px; }
    .pf-tagline { max-width: 100%; }
}
</style>

<footer class="petcare-footer">
    <div class="container">
        <div class="row">

            <!-- Brand & Social -->
            <div class="col-md-6 col-lg-4 mb-5">
                <a href="<?= ROOT ?>/" class="pf-brand-logo">
                    <img src="<?= ROOT ?>/assets/images/logo.png" alt="PetCare Logo">
                    <span class="pf-brand-name">PetCare</span>
                </a>
                <p class="pf-tagline">Your all-in-one smart platform for pet health records, veterinary care, and trusted pet services.</p>
                <div class="pf-badges mb-4">
                    <span class="pf-badge"><span class="fa fa-paw"></span> Pet Health</span>
                    <span class="pf-badge"><span class="fa fa-stethoscope"></span> Vet Care</span>
                    <span class="pf-badge"><span class="fa fa-shopping-bag"></span> Marketplace</span>
                </div>
                <ul class="pf-socials">
                    <li><a href="#" title="Facebook"><span class="fa fa-facebook"></span></a></li>
                    <li><a href="#" title="Twitter"><span class="fa fa-twitter"></span></a></li>
                    <li><a href="#" title="Instagram"><span class="fa fa-instagram"></span></a></li>
                    <li><a href="#" title="YouTube"><span class="fa fa-youtube"></span></a></li>
                </ul>
            </div>

            <!-- Quick Links -->
            <div class="col-md-6 col-lg-2 mb-5">
                <h6 class="pf-heading">Quick Links</h6>
                <ul class="pf-links">
                    <li><a href="<?= ROOT ?>/">Home</a></li>
                    <li><a href="<?= ROOT ?>/about">About Us</a></li>
                    <li><a href="<?= ROOT ?>/serviceprovider">Services</a></li>
                    <li><a href="<?= ROOT ?>/shop">Marketplace</a></li>
                    <li><a href="<?= ROOT ?>/contact">Contact</a></li>
                </ul>
            </div>

            <!-- Account Links -->
            <div class="col-md-6 col-lg-2 mb-5">
                <h6 class="pf-heading">Account</h6>
                <ul class="pf-links">
                    <li><a href="<?= ROOT ?>/auth/login">Login</a></li>
                    <li><a href="<?= ROOT ?>/auth/register">Sign Up</a></li>
                    <li><a href="<?= ROOT ?>/profile">My Profile</a></li>
                    <li><a href="<?= ROOT ?>/petowner/dashboard">Dashboard</a></li>
                    <li><a href="<?= ROOT ?>/notifications">Notifications</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-md-6 col-lg-4 mb-5">
                <h6 class="pf-heading">Get In Touch</h6>
                <ul class="pf-contact-list">
                    <li>
                        <span class="pf-contact-icon"><span class="fa fa-map-marker"></span></span>
                        <span>203 Pet Street, Mountain View, CA 94043</span>
                    </li>
                    <li>
                        <a href="tel:+23923929210">
                            <span class="pf-contact-icon"><span class="fa fa-phone"></span></span>
                            +2 392 3929 210
                        </a>
                    </li>
                    <li>
                        <a href="mailto:info@petcare.com">
                            <span class="pf-contact-icon"><span class="fa fa-envelope-o"></span></span>
                            info@petcare.com
                        </a>
                    </li>
                    <li>
                        <span class="pf-contact-icon"><span class="fa fa-clock-o"></span></span>
                        <span>Mon – Sat: 8:00 AM – 8:00 PM</span>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <hr class="pf-divider">

    <!-- Bottom Bar -->
    <div class="pf-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="pf-copyright">
                        &copy; <script>document.write(new Date().getFullYear());</script>
                        <span>PetCare</span> &mdash; Smart Pet Care &amp; Veterinary Management System. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6">
                    <ul class="pf-bottom-links">
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="<?= ROOT ?>/contact">Support</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

  
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

  <script src="<?= ROOT ?>/assets/JS/jquery.min.js"></script>
  <script src="<?= ROOT ?>/assets/JS/jquery-migrate-3.0.1.min.js"></script>
  <script src="<?= ROOT ?>/assets/JS/popper.min.js"></script>
  <script src="<?= ROOT ?>/assets/JS/bootstrap.min.js"></script>
  <script src="<?= ROOT ?>/assets/JS/jquery.easing.1.3.js"></script>
  <script src="<?= ROOT ?>/assets/JS/jquery.waypoints.min.js"></script>
  <script src="<?= ROOT ?>/assets/JS/jquery.stellar.min.js"></script>
  <script src="<?= ROOT ?>/assets/JS/jquery.animateNumber.min.js"></script>
  <script src="<?= ROOT ?>/assets/JS/bootstrap-datepicker.js"></script>
  <script src="<?= ROOT ?>/assets/JS/jquery.timepicker.min.js"></script>
  <script src="<?= ROOT ?>/assets/JS/owl.carousel.min.js"></script>
  <script src="<?= ROOT ?>/assets/JS/jquery.magnific-popup.min.js"></script>
  <script src="<?= ROOT ?>/assets/JS/scrollax.min.js"></script>
  <script src="<?= ROOT ?>/assets/JS/main.js"></script>
  </body>
  <script>

    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    window.addEventListener("pageshow", function (event) {
        if (event.persisted) {
            window.location.reload();
        }
    });
</script>
</html>
