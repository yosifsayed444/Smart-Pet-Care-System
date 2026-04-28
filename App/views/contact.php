<?php require __DIR__ . '/layouts/header.php'; ?>
<?php require __DIR__ . '/layouts/navbar.php'; ?>



<section class="hero-wrap hero-wrap-2"
style="background-image: url('<?= ROOT ?>/assets/images/bg_2.jpg');">

<div class="overlay"></div>

<div class="container">
<div class="row no-gutters slider-text align-items-end">

<div class="col-md-9 ftco-animate pb-5">

<p class="breadcrumbs mb-2">

<span class="mr-2">

<a href="<?= ROOT ?>/">

Home <i class="ion-ios-arrow-forward"></i>

</a>

</span>

<span>

Contact Us <i class="ion-ios-arrow-forward"></i>

</span>

</p>

<h1 class="mb-0 bread">

Contact Us

</h1>

</div>

</div>
</div>

</section>



<section class="ftco-section contact-section">

<div class="container">

<div class="row d-flex mb-5 contact-info">

<div class="col-md-12 mb-4">

<h2 class="h4">

Contact Information

</h2>

</div>



<div class="w-100"></div>

<div class="col-md-3 d-flex">

<div class="info bg-light p-4">

<p>

<span>Address:</span><br>

123 Pet Street,<br>
Cairo, Egypt

</p>

</div>

</div>



<div class="col-md-3 d-flex">

<div class="info bg-light p-4">

<p>

<span>Phone:</span><br>

<a href="tel://01000000000">

01000000000

</a>

</p>

</div>

</div>



<div class="col-md-3 d-flex">

<div class="info bg-light p-4">

<p>

<span>Email:</span><br>

<a href="mailto:info@petcare.com">

info@petcare.com

</a>

</p>

</div>

</div>



<div class="col-md-3 d-flex">

<div class="info bg-light p-4">

<p>

<span>Website:</span><br>

<a href="#">

www.petcare.com

</a>

</p>

</div>

</div>

</div>


<div class="row block-9">
    <div class="col-md-6 order-md-last d-flex">
        <form action="<?= ROOT ?>/contact/send" method="POST" class="bg-light p-5 contact-form" novalidate>
            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
            <?php endif; ?>
            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>

<div class="form-group">

<input type="text"
name="name"
class="form-control"
placeholder="Your Name"
required>

</div>

<div class="form-group">

<input type="email"
name="email"
class="form-control"
placeholder="Your Email"
required>

</div>

<div class="form-group">

<input type="text"
name="subject"
class="form-control"
placeholder="Subject"
required>

</div>

<div class="form-group">

<textarea name="message"
cols="30"
rows="7"
class="form-control"
placeholder="Message"
required></textarea>

</div>

<div class="form-group">

<input type="submit"
value="Send Message"
class="btn btn-primary py-3 px-5">

</div>

</form>

</div>



<div class="col-md-6 d-flex">

<div class="bg-white p-5 contact-form">

<img src="<?= ROOT ?>/assets/images/about.jpg"
style="width:100%; height:auto; border-radius:10px;">

</div>

</div>

</div>

</div>

</section>

<?php require __DIR__ . '/layouts/footer.php'; ?>
