<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gondia Auto | Fast & Safe Rides</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="logo">
            <a href="index.html" style="text-decoration: none; color: inherit;">
                <i class="fa-solid fa-taxi"></i> Gondia<span>Auto</span>
            </a>
        </div>
        
        <ul class="nav-links">
            <li><a href="index.php" class="active">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="contact.php">Contact</a></li>
            <!-- These show up only in the mobile dropdown -->
            <li class="mobile-auth"><a href="login.php">Login</a></li>
            <li class="mobile-auth"><a href="signup.php" style="color: var(--primary);">Sign Up</a></li>
        </ul>

        <!-- Desktop Auth Buttons -->
        <div class="nav-auth">
            <a href="login.php" class="btn-login-text">Login</a>
            <a href="signup.php" class="btn-call">Sign Up</a>
        </div>
        
        <div class="menu-toggle"><i class="fa-solid fa-bars"></i></div>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        <div class="hero-content">
            <h1>Reliable Auto Rides in Gondia</h1>
            <p>24/7 service, affordable fares, and verified local drivers. Get to your destination safely and on time.</p>
            <div class="hero-buttons">
                <a href="login.html" class="btn-primary"><i class="fa-solid fa-location-dot"></i> Book Online Now</a>
                <a href="tel:+919876543210" class="btn-secondary"><i class="fa-solid fa-phone"></i> Call Driver</a>
            </div>
        </div>
    </header>

    <!-- Why Choose Us -->
    <section class="features">
        <div class="container">
            <h2 class="section-title">Why Ride With Us?</h2>
            <div class="grid">
                <div class="feature-card">
                    <i class="fa-solid fa-clock"></i>
                    <h3>Always on Time</h3>
                    <p>We pride ourselves on punctuality, especially for railway station drops.</p>
                </div>
                <div class="feature-card">
                    <i class="fa-solid fa-shield-halved"></i>
                    <h3>Safe & Verified</h3>
                    <p>All our drivers are local, experienced, and background-checked.</p>
                </div>
                <div class="feature-card">
                    <i class="fa-solid fa-indian-rupee-sign"></i>
                    <h3>Fair Pricing</h3>
                    <p>No haggling. We offer transparent and competitive rates across the city.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2026 Gondia Auto. All Rights Reserved.</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>