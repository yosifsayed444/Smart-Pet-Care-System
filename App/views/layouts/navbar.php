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
	    	<a class="navbar-brand" href="<?= ROOT ?>/"><span class="flaticon-pawprint-1 mr-2"></span>PetCare</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="fa fa-bars"></span> Menu
	      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	        	<li class="nav-item"><a href="<?= ROOT ?>/" class="nav-link">Home</a></li>
	        	<li class="nav-item"><a href="<?= ROOT ?>/vet" class="nav-link">Veterinarian</a></li>
	        	<li class="nav-item"><a href="<?= ROOT ?>/serviceprovider" class="nav-link">Services</a></li>
	          <li class="nav-item"><a href="<?= ROOT ?>/marketplace" class="nav-link">Marketplace</a></li>
              <?php if (isset($_SESSION['USER'])): ?>
                <?php if ($_SESSION['USER']->role === 'Admin'): ?>
	                <li class="nav-item"><a href="<?= ROOT ?>/admin" class="nav-link">Admin Panel</a></li>
                <?php endif; ?>
                <li class="nav-item"><a href="<?= ROOT ?>/auth/logout" class="nav-link">Logout</a></li>
              <?php else: ?>
	            <li class="nav-item"><a href="<?= ROOT ?>/auth/login" class="nav-link">Login</a></li>
              <?php endif; ?>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
