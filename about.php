<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Gondia Auto</title>
    <meta name="description" content="Gondia Auto has connected riders with trusted local auto-rickshaw drivers in Gondia since 2020.">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/about.css">
</head>
<body>

    <nav class="navbar">
        <div class="logo"><i class="fa-solid fa-taxi"></i> Gondia<span>Auto</span></div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php" class="active">About</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <a href="tel:+919876543210" class="btn-call"><i class="fa-solid fa-phone"></i> Book Now</a>
        <div class="menu-toggle"><i class="fa-solid fa-bars"></i></div>
    </nav>

    <header class="page-header">
        <h1>About Gondia Auto</h1>
        <p>Serving our city with pride since 2020.</p>
    </header>

    <main>

        <!-- Our story -->
        <section class="ab-section">
            <div class="ab-story">
                <div class="ab-story-text">
                    <span class="ab-eyebrow">Our story</span>
                    <h2>Making daily travel in Gondia hassle-free</h2>
                    <p>Gondia Auto started with a simple mission: to make daily commuting in Gondia hassle-free. We noticed that finding a reliable auto at odd hours, especially for Gondia Junction railway station, was a major challenge for residents.</p>
                    <p>We organized a network of trusted local drivers to change that. Today, a ride is one call or one booking away.</p>
                </div>
                <aside class="ab-badge" aria-label="Serving Gondia since 2020">
                    <i class="fa-solid fa-taxi"></i>
                    <strong>Since 2020</strong>
                    <span>Trusted local drivers, right here in Gondia</span>
                </aside>
            </div>
        </section>

        <!-- Our promise -->
        <section class="ab-section ab-alt">
            <div class="ab-wrap">
                <div class="ab-head">
                    <span class="ab-eyebrow">Our promise</span>
                    <h2>Whoever you are, you ride the same way</h2>
                    <p>Whether you are a daily commuter, a student, or visiting our city for the first time, we promise:</p>
                </div>
                <div class="ab-cards">
                    <article class="ab-card">
                        <span class="ab-icon"><i class="fa-solid fa-face-smile"></i></span>
                        <h3>A polite driver</h3>
                        <p>Local drivers who know the city and treat every rider with respect.</p>
                    </article>
                    <article class="ab-card">
                        <span class="ab-icon"><i class="fa-solid fa-broom"></i></span>
                        <h3>A clean auto</h3>
                        <p>A tidy, comfortable ride whether it is a short hop or a longer trip.</p>
                    </article>
                    <article class="ab-card">
                        <span class="ab-icon"><i class="fa-solid fa-shield-halved"></i></span>
                        <h3>A safe journey</h3>
                        <p>From pickup to drop-off, your safe arrival is what we care about most.</p>
                    </article>
                </div>
            </div>
        </section>

        <!-- How it works -->
        <section class="ab-section">
            <div class="ab-wrap">
                <div class="ab-head">
                    <span class="ab-eyebrow">How it works</span>
                    <h2>Your ride in three steps</h2>
                </div>
                <ol class="ab-steps">
                    <li>
                        <span class="ab-num">1</span>
                        <h3>Book</h3>
                        <p>Call us, or book online with your pickup and drop-off.</p>
                    </li>
                    <li>
                        <span class="ab-num">2</span>
                        <h3>Get your driver</h3>
                        <p>A nearby driver is assigned and their details are sent to your phone.</p>
                    </li>
                    <li>
                        <span class="ab-num">3</span>
                        <h3>Ride with ease</h3>
                        <p>Hop in, reach your destination, and pay your fare.</p>
                    </li>
                </ol>
            </div>
        </section>

        <!-- Call to action -->
        <section class="ab-cta">
            <div class="ab-cta-inner">
                <div>
                    <h2>Need an auto in Gondia?</h2>
                    <p>We are just a call away.</p>
                </div>
                <div class="ab-cta-btns">
                    <a href="tel:+919876543210" class="ab-btn ab-btn-dark"><i class="fa-solid fa-phone"></i> Call +91 98765 43210</a>
                    <a href="contact.php" class="ab-btn ab-btn-light">Send a message</a>
                </div>
            </div>
        </section>

    </main>

    <footer class="footer">
        <p>&copy; <span id="ab-year">2026</span> Gondia Auto. All Rights Reserved.</p>
    </footer>

    <script src="js/script.js"></script>
    <script>document.getElementById('ab-year').textContent = new Date().getFullYear();</script>
</body>
</html>