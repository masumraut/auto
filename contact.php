<?php
session_start();

// CSRF token: proves the form was loaded from your own site
if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}
$csrf = $_SESSION['csrf'];

// Prefill the name for logged-in riders
$prefill_name = '';
if (!empty($_SESSION['logged_in']) && !empty($_SESSION['user_name'])) {
    $prefill_name = htmlspecialchars($_SESSION['user_name'], ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Gondia Auto</title>
    <meta name="description" content="Call or message Gondia Auto to book an auto-rickshaw ride in Gondia, Maharashtra.">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/contact.css">
</head>
<body>

    <nav class="navbar">
        <div class="logo"><i class="fa-solid fa-taxi"></i> Gondia<span>Auto</span></div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="contact.php" class="active">Contact</a></li>
        </ul>
        <a href="tel:+919876543210" class="btn-call"><i class="fa-solid fa-phone"></i> Book Now</a>
        <div class="menu-toggle"><i class="fa-solid fa-bars"></i></div>
    </nav>

    <header class="page-header">
        <h1>Contact Us</h1>
        <p>We are just a call or message away.</p>
    </header>

    <main class="ct-section">
        <div class="ct-grid">

            <section class="ct-info" aria-labelledby="ct-info-title">
                <h2 id="ct-info-title">Get in touch</h2>
                <p class="ct-lead">Need a ride right now? Call us. For anything else, send a message and we will reply soon.</p>
                <ul class="ct-list">
                    <li>
                        <span class="ct-icon"><i class="fa-solid fa-phone"></i></span>
                        <div><strong>Call or WhatsApp</strong><a href="tel:+919876543210">+91 98765 43210</a></div>
                    </li>
                    <li>
                        <span class="ct-icon"><i class="fa-solid fa-envelope"></i></span>
                        <div><strong>Email</strong><a href="mailto:bookings@gondiaauto.in">bookings@gondiaauto.in</a></div>
                    </li>
                    <li>
                        <span class="ct-icon"><i class="fa-solid fa-location-dot"></i></span>
                        <div><strong>Find us</strong>
                            <a href="https://www.google.com/maps/search/?api=1&amp;query=Jaistambh+Chowk+Gondia+Maharashtra" target="_blank" rel="noopener">Near Jaistambh Chowk, Gondia, MH</a>
                        </div>
                    </li>
                </ul>
                <a class="ct-wa" href="https://wa.me/919876543210" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> Chat on WhatsApp</a>
            </section>

            <section class="ct-card" aria-labelledby="ct-form-title">
                <h2 id="ct-form-title">Send a message</h2>

                <form id="contact-form" class="ct-form" action="contact_submit.php" method="post" novalidate>
                    <input type="hidden" name="csrf" value="<?php echo $csrf; ?>">

                    <div class="ct-field">
                        <label for="name">Your name</label>
                        <input type="text" id="name" name="name" autocomplete="name" minlength="2" maxlength="80" value="<?php echo $prefill_name; ?>" placeholder="e.g. Ramesh Patle" required>
                        <small class="ct-err" data-for="name"></small>
                    </div>

                    <div class="ct-field">
                        <label for="phone">Phone number</label>
                        <input type="tel" id="phone" name="phone" autocomplete="tel" inputmode="tel" placeholder="e.g. 98765 43210" required>
                        <small class="ct-err" data-for="phone"></small>
                    </div>

                    <div class="ct-field">
                        <label for="message">How can we help?</label>
                        <textarea id="message" name="message" rows="5" minlength="5" maxlength="1000" placeholder="Tell us your pickup place, time or question" required></textarea>
                        <small class="ct-err" data-for="message"></small>
                    </div>

                    <div class="ct-hp" aria-hidden="true">
                        <label>Leave this empty <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
                    </div>

                    <button type="submit" class="ct-btn" id="ct-submit">
                        <span class="ct-btn-text">Send Message</span>
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                    <p id="ct-status" class="ct-status" role="status" aria-live="polite"></p>
                </form>
            </section>

        </div>
    </main>

    <footer class="footer">
        <p>&copy; <?php echo date('Y'); ?> Gondia Auto. All Rights Reserved.</p>
    </footer>

    <script src="js/script.js"></script>
    <script src="js/contact.js"></script>
</body>
</php>