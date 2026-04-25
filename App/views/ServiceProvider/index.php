<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center pb-5 mb-3">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <h2>Our Pet Services</h2>
                <p>Find the best walkers and sitters in your area.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 d-flex align-self-stretch px-4 ftco-animate">
                <div class="d-block services active text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="flaticon-blind"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Dog Walking</h3>
                        <p>Our dynamic service area geofencing connects you with local walkers.</p>
                        <a href="<?= ROOT ?>/vet/book" class="btn-custom d-flex align-items-center justify-content-center"><span class="fa fa-chevron-right"></span><i class="sr-only">Book Now</i></a>
                    </div>
                </div>      
            </div>
            <div class="col-md-4 d-flex align-self-stretch px-4 ftco-animate">
                <div class="d-block services text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="flaticon-dog-eating"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Pet Daycare</h3>
                        <p>Find reliable sitters with check-in/check-out verification.</p>
                        <a href="<?= ROOT ?>/vet/book" class="btn-custom d-flex align-items-center justify-content-center"><span class="fa fa-chevron-right"></span><i class="sr-only">Book Now</i></a>
                    </div>
                </div>    
            </div>
            <div class="col-md-4 d-flex align-self-stretch px-4 ftco-animate">
                <div class="d-block services text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="flaticon-grooming"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Pet Grooming</h3>
                        <p>Certified groomers for your beloved pets.</p>
                        <a href="<?= ROOT ?>/vet/book" class="btn-custom d-flex align-items-center justify-content-center"><span class="fa fa-chevron-right"></span><i class="sr-only">Book Now</i></a>
                    </div>
                </div>      
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
