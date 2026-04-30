<?php require __DIR__ . '/layouts/header.php'; ?>

<style>
    :root {
        --primary-blue: #185FA5;
        --soft-blue: #E3F2FD;
        --accent-orange: #FF8A65;
        --glass-bg: rgba(255, 255, 255, 0.85);
    }

    body {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .error-container {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .error-card {
        background: var(--glass-bg);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 40px;
        padding: 60px 40px;
        max-width: 700px;
        width: 100%;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.05);
        animation: slideUp 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    @keyframes slideUp {
        from { transform: translateY(50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .error-illustration {
        position: relative;
        width: 250px;
        height: 250px;
        margin: 0 auto 30px;
    }

    .error-illustration .main-icon {
        font-size: 150px;
        color: var(--primary-blue);
        filter: drop-shadow(0 10px 20px rgba(24, 95, 165, 0.2));
        animation: float 4s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
    }

    .paw-print {
        position: absolute;
        font-size: 30px;
        color: var(--accent-orange);
        opacity: 0.3;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); opacity: 0.3; }
        50% { transform: scale(1.2); opacity: 0.6; }
        100% { transform: scale(1); opacity: 0.3; }
    }

    .error-code {
        font-family: 'Montserrat', sans-serif;
        font-weight: 900;
        font-size: 100px;
        background: linear-gradient(45deg, var(--primary-blue), #2196F3);        -webkit-text-fill-color: transparent;
        line-height: 1;
        margin-bottom: 10px;
        letter-spacing: -5px;
    }

    .error-title {
        font-weight: 700;
        font-size: 28px;
        color: #2D3748;
        margin-bottom: 15px;
    }

    .error-text {
        color: #718096;
        font-size: 18px;
        line-height: 1.6;
        margin-bottom: 40px;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    .btn-premium {
        background: var(--primary-blue);
        color: white;
        padding: 16px 40px;
        border-radius: 20px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        box-shadow: 0 10px 20px rgba(24, 95, 165, 0.2);
    }

    .btn-premium:hover {
        background: #124a82;
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(24, 95, 165, 0.3);
        color: white;
        text-decoration: none;
    }

    .btn-premium i {
        font-size: 18px;
    }

</style>

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


