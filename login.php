<?php
// Start the session so we can remember the user after they log in
session_start();

// Include the database connection
require_once 'includes/config.php';

$message = ""; // Variable to hold error messages

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get the submitted email and password
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Prepare a query to find the user by email
    $stmt = $conn->prepare("SELECT id, full_name, password_hash FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if a user with that email exists
    if ($stmt->num_rows > 0) {
        // Bind the results from the database to variables
        $stmt->bind_result($id, $full_name, $password_hash);
        $stmt->fetch();

        // Verify the password matches the hashed password in the database
        if (password_verify($password, $password_hash)) {
            
            // Password is correct! Set session variables
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $full_name;
            $_SESSION['logged_in'] = true;

            // Redirect the user to the dashboard
            header("Location: dashboard.php");
            exit(); // Stop executing the rest of the script

        } else {
            $message = "<div style='color: #c82333; background: #fdeaea; padding: 10px; border-radius: 5px; text-align: center; margin-bottom: 15px;'>Incorrect password. Please try again.</div>";
        }
    } else {
        $message = "<div style='color: #c82333; background: #fdeaea; padding: 10px; border-radius: 5px; text-align: center; margin-bottom: 15px;'>No account found with that email address.</div>";
    }
    
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Gondia Auto</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css"> <!-- Global styles -->
    <link rel="stylesheet" href="css/auth.css">  <!-- Auth styles -->
</head>
<body class="auth-body">

    <!-- Updated back link to point to index.php -->
    <a href="index.php" class="back-link"><i class="fa-solid fa-arrow-left"></i> Back to Home</a>

    <div class="auth-container">
        <div class="auth-header">
            <h2>Welcome Back! 🛺</h2>
            <p>Login to book your next ride.</p>
        </div>
        
        <!-- Print any login error messages here -->
        <?php echo $message; ?>
        
        <!-- Added action="login.php" and method="POST" -->
        <form action="login.php" method="POST">
            <div class="input-group">
                <i class="fa-solid fa-envelope"></i>
                <!-- Added name="email" -->
                <input type="email" name="email" placeholder="Email Address" required>
            </div>
            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <!-- Added name="password" -->
                <input type="password" name="password" placeholder="Password" required>
            </div>
            
            <div class="auth-options">
                <label><input type="checkbox"> Remember me</label>
                <a href="#" class="forgot-password">Forgot Password?</a>
            </div>

            <button type="submit" class="btn-primary" style="width: 100%; border:none; cursor:pointer;">Login</button>
        </form>

        <!-- Updated signup link to point to signup.php -->
        <p class="toggle-text">Don't have an account? <a href="signup.php" class="toggle-link">Sign Up</a></p>
    </div>

</body>
</html>