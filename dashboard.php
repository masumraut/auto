<?php
// 1. Start the session to access logged-in user data
session_start();

// 2. Protect the page: only logged-in users can see it
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// 3. Stop the browser from showing this page again after logout (Back button)
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

// 4. Safe values for output (htmlspecialchars prevents XSS)
$user_name  = htmlspecialchars($_SESSION['user_name'] ?? 'Rider', ENT_QUOTES, 'UTF-8');
$first_name = explode(' ', trim($user_name))[0];
$initial    = strtoupper(mb_substr($first_name, 0, 1, 'UTF-8'));

// 5. Dashboard numbers. Replace with real values from your database.
//    Example: SELECT COUNT(*), COALESCE(SUM(fare),0) FROM rides WHERE user_id = ?
$stats = [
    'total_rides' => 0,
    'total_spent' => 0,
    'upcoming'    => 0,
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Gondia Auto</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body class="dashboard-body">

    <!-- Top header -->
    <header class="dash-header">
        <div class="dash-logo"><i class="fa-solid fa-taxi"></i>Gondia<span>Auto</span></div>

        <div class="dash-profile">
            <div class="profile-text">
                <span class="welcome-text">Welcome back</span>
                <span class="user-name"><?php echo $user_name; ?></span>
            </div>
            <div class="avatar-initials" aria-hidden="true"><?php echo $initial; ?></div>
            <a href="logout.php" class="logout-mobile" aria-label="Logout"><i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
    </header>

    <div class="dash-layout">

        <!-- Sidebar -->
        <aside class="dash-sidebar">
            <nav class="sidebar-nav" aria-label="Dashboard menu">
                <a href="dashboard.php" class="nav-item active"><i class="fa-solid fa-bolt"></i> Book Auto</a>
                <a href="#" class="nav-item"><i class="fa-solid fa-clock-rotate-left"></i> Ride History</a>
                <a href="#" class="nav-item"><i class="fa-solid fa-gear"></i> Settings</a>
            </nav>
            <div class="sidebar-footer">
                <a href="logout.php" class="nav-item logout-btn"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            </div>
        </aside>

        <!-- Main content -->
        <main class="dash-main">

            <!-- Quick stats -->
            <section class="stat-grid" aria-label="Your summary">
                <div class="stat-card">
                    <div class="stat-icon yellow-bg"><i class="fa-solid fa-taxi"></i></div>
                    <div class="stat-info">
                        <h3><?php echo (int)$stats['total_rides']; ?></h3>
                        <p>Total rides</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green-bg"><i class="fa-solid fa-indian-rupee-sign"></i></div>
                    <div class="stat-info">
                        <h3>₹<?php echo number_format((float)$stats['total_spent']); ?></h3>
                        <p>Total spent</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon dark-bg"><i class="fa-regular fa-calendar-check"></i></div>
                    <div class="stat-info">
                        <h3><?php echo (int)$stats['upcoming']; ?></h3>
                        <p>Upcoming rides</p>
                    </div>
                </div>
            </section>

            <!-- Booking form -->
            <section class="booking-card">
                <div class="card-header">
                    <h2>Book a Ride Now</h2>
                    <p>Enter your trip details and get your fare instantly.</p>
                </div>

                <form id="book-auto-form" class="modern-form">
                    <div class="input-group">
                        <label for="pickup">Pickup location</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-location-dot text-green"></i>
                            <input type="text" id="pickup" name="pickup" placeholder="e.g. Railway Station" autocomplete="off" required>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="dropoff">Drop-off location</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-location-dot text-red"></i>
                            <input type="text" id="dropoff" name="dropoff" placeholder="e.g. Civil Lines" autocomplete="off" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="input-group">
                            <label for="date">Date</label>
                            <div class="input-wrapper">
                                <i class="fa-regular fa-calendar"></i>
                                <input type="date" id="date" name="date" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="time">Time</label>
                            <div class="input-wrapper">
                                <i class="fa-regular fa-clock"></i>
                                <input type="time" id="time" name="time" required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-book-now">Calculate Fare &amp; Book</button>
                </form>

                <!-- Result (hidden until your JS shows it; IDs are unchanged) -->
                <div id="booking-result" class="result-card success hidden" role="status" aria-live="polite">
                    <div class="result-icon"><i class="fa-solid fa-circle-check"></i></div>
                    <div class="result-details">
                        <h3>Ride Confirmed!</h3>
                        <div class="route-details">
                            <span id="res-pickup"></span>
                            <i class="fa-solid fa-arrow-right"></i>
                            <span id="res-dropoff"></span>
                        </div>
                        <div class="fare-estimate">Estimated fare: <strong id="res-fare"></strong></div>
                        <p class="result-note">Driver details will be sent to your phone by SMS shortly.</p>
                    </div>
                </div>
            </section>

        </main>
    </div>

    <script src="js/dashboard.js"></script>
</body>
</html>