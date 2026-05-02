<?php require __DIR__ . '/layouts/header.php'; ?>


<div class="error-container">
    <div class="error-card">
        <div class="error-illustration">
            <i class="fa fa-paw main-icon"></i>
            <i class="fa fa-paw paw-print" style="top: 10%; right: 10%; animation-delay: 0.2s;"></i>
            <i class="fa fa-paw paw-print" style="bottom: 20%; left: 5%; animation-delay: 0.5s;"></i>
            <i class="fa fa-paw paw-print" style="top: 40%; left: 15%; animation-delay: 0.8s; font-size: 15px;"></i>
        </div>
        
        <div class="error-code">404</div>
        <h1 class="error-title">Oops! Our paw-some guide got lost.</h1>
        <p class="error-text">
            We searched every nook and cranny, but it looks like this page has wandered off. Don't worry, we'll help you find your way back home!
        </p>
        
        <a href="<?= ROOT ?>/" class="btn-premium">
            <i class="fa fa-home"></i> Back to Home
        </a>
    </div>
</div>


