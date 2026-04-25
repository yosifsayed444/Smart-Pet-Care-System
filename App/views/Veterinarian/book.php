<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/navbar.php'; ?>

<section class="ftco-appointment ftco-section img" style="background-image: url(<?= ROOT ?>/assets/images/bg_3.jpg);">
    <div class="overlay"></div>
    <div class="container">
        <div class="row d-md-flex justify-content-end">
            <div class="col-md-12 col-lg-6 half p-3 py-5 pl-lg-5 ftco-animate">
                <h2 class="mb-4">Book an Appointment</h2>
                
                <?php if(!empty($success)): ?>
                    <div class="alert alert-success">Appointment requested successfully!</div>
                <?php endif; ?>

                <?php if(!isset($_SESSION['id'])): ?>
                    <div class="alert alert-warning">Please <a href="<?= ROOT ?>/auth/login">login</a> to book an appointment.</div>
                <?php else: ?>
                    <form method="POST" action="<?= ROOT ?>/vet/book" class="appointment">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-field">
                                        <div class="select-wrap">
                                            <div class="icon"><span class="fa fa-chevron-down"></span></div>
                                            <select name="service" id="service" class="form-control" required>
                                                <option value="">Select services</option>
                                                <option value="General Checkup">General Checkup</option>
                                                <option value="Vaccination">Vaccination</option>
                                                <option value="Surgery">Surgery</option>
                                                <option value="Dental Care">Dental Care</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-wrap">
                                        <div class="icon"><span class="fa fa-calendar"></span></div>
                                        <input type="text" name="date" class="form-control appointment_date" placeholder="Date" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-wrap">
                                        <div class="icon"><span class="fa fa-clock-o"></span></div>
                                        <input type="text" name="time" class="form-control appointment_time" placeholder="Time" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Notes or symptoms"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" value="Request Appointment" class="btn btn-primary py-3 px-4">
                                </div>
                            </div>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
