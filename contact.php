<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Gondia Auto</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <nav class="navbar">
        <div class="logo"><i class="fa-solid fa-taxi"></i> Gondia<span>Auto</span></div>
        <ul class="nav-links">
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="services.html">Services</a></li>
            <li><a href="contact.html" class="active">Contact</a></li>
        </ul>
        <a href="tel:+919876543210" class="btn-call"><i class="fa-solid fa-phone"></i> Book Now</a>
        <div class="menu-toggle"><i class="fa-solid fa-bars"></i></div>
    </nav>

    <header class="page-header">
        <h1>Contact Us</h1>
        <p>We are just a call or message away.</p>
    </header>

    <section class="content-section">
        <div class="container grid">
            <div class="contact-info">
                <h2>Get in Touch</h2>
                <p><i class="fa-solid fa-phone"></i> +91 98765 43210</p>
                <p><i class="fa-solid fa-envelope"></i> bookings@gondiaauto.in</p>
                <p><i class="fa-solid fa-location-dot"></i> Near Jaistambh Chowk, Gondia, MH</p>
            </div>
            
            <form id="contact-form" class="contact-form">
                <input type="text" placeholder="Your Name" required>
                <input type="tel" placeholder="Phone Number" required>
                <textarea rows="4" placeholder="How can we help?" required></textarea>
                <button type="submit" class="btn-primary" style="width: 100%; border:none; cursor:pointer;">Send Message</button>
            </form>
        </div>
    </section>

    <footer class="footer">
        <p>&copy; 2026 Gondia Auto. All Rights Reserved.</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>