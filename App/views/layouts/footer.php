
<footer class="petcare-footer">
    <div class="container">
        <div class="row">

            
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

  
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#128ced"/></svg></div>

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
