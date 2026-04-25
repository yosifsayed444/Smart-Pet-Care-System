    <div class="wrap">
			<div class="container">
				<div class="row">
					<div class="col-md-6 d-flex align-items-center">
						<p class="mb-0 phone pl-md-2">
							<a href="#" class="mr-2"><span class="fa fa-phone mr-1"></span> +00 1234 567</a>
							<a href="#"><span class="fa fa-paper-plane mr-1"></span> info@petcare.com</a>
						</p>
					</div>
					<div class="col-md-6 d-flex justify-content-md-end">
						<div class="social-media">
			    		<p class="mb-0 d-flex">
			    			<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
			    			<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
			    			<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
			    		</p>
		        </div>
					</div>
				</div>
			</div>
		</div>
		<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	    	<a class="navbar-brand" href="<?php echo ROOT ?>/"><span class="flaticon-pawprint-1 mr-2"></span>PetCare</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="fa fa-bars"></span> Menu
	      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	        	<li class="nav-item"><a href="<?php echo ROOT ?>/" class="nav-link">Home</a></li>
	        	<li class="nav-item"><a href="<?php echo ROOT ?>/serviceprovider" class="nav-link">Services</a></li>
	          <li class="nav-item"><a href="<?php echo ROOT ?>/marketplace" class="nav-link">Marketplace</a></li>


<?php if (isset($_SESSION['id'])): ?>

    <!-- Admin OR Service Provider -->

    <?php if ($_SESSION['role'] === 'Admin' || $_SESSION['role'] === 'ServiceProvider' || $_SESSION['role'] === 'Veterinarian'): ?>

        <li class="nav-item">
            <a href="<?php echo ROOT ?>/<?php echo strtolower($_SESSION['role']); ?>/dashboard" class="nav-link">
                Dashboard
            </a>
        </li>

    <?php endif; ?>

    <li class="nav-item">
        <a href="<?php echo ROOT ?>/profile" class="nav-link">
           👤 <?php echo $_SESSION['username'] ?>
        </a>
    </li>

    <li class="nav-item">
        <a href="<?php echo ROOT ?>/auth/logout" class="nav-link">
            Logout
        </a>
    </li>

<?php else: ?>

    <!-- Guest -->

    <li class="nav-item">
        <a href="<?php echo ROOT ?>/auth/login" class="nav-link">
            Login
        </a>
    </li>

    <!-- <li class="nav-item">
        <a href="<?php echo ROOT ?>/auth/register" class="nav-link">
            Register
        </a>
    </li> -->

<?php endif; ?>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
