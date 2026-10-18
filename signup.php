<?php
// 1. Include the database connection
require_once 'includes/config.php';

$message = ""; // Variable to hold success/error messages

// 2. Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 3. Get the data from the form
    $full_name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Auto-generate a username using the first part of their email + a random number
    $username = explode('@', $email)[0] . rand(100, 999);

    // 4. Encrypt (hash) the password for security
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // 5. Check if the email is already registered
    $check_email = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $check_email->store_result();

    if ($check_email->num_rows > 0) {
        $message = "<div style='color: #c82333; background: #fdeaea; padding: 10px; border-radius: 5px; text-align: center; margin-bottom: 15px;'>Email is already registered!</div>";
    } else {
        // 6. Insert the new user into the database
        $stmt = $conn->prepare("INSERT INTO users (full_name, username, email, password_hash, phone_number) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $full_name, $username, $email, $password_hash, $phone);

        if ($stmt->execute()) {
            $message = "<div style='color: #1e7e34; background: #e6f4ea; padding: 10px; border-radius: 5px; text-align: center; margin-bottom: 15px;'>Registration successful! <a href='login.php' style='font-weight: bold; color: #1e7e34;'>Login here</a></div>";
        } else {
            $message = "<div style='color: #c82333; background: #fdeaea; padding: 10px; border-radius: 5px; text-align: center; margin-bottom: 15px;'>Error: " . $conn->error . "</div>";
        }
        $stmt->close();
    }
    $check_email->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Gondia Auto</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css"> 
    <link rel="stylesheet" href="css/auth.css">  
</head>
<body class="auth-body">

    <a href="index.php" class="back-link"><i class="fa-solid fa-arrow-left"></i> Back to Home</a>

    <div class="auth-container">
        <div class="auth-header">
            <h2>Create Account 🚀</h2>
            <p>Join Gondia Auto today.</p>
        </div>
        
        <!-- Show success or error message here -->
        <?php echo $message; ?>
        
        <!-- ADDED method="POST" and action="signup.php" -->
        <form action="signup.php" method="POST">
            <div class="input-group">
                <i class="fa-solid fa-user"></i>
                <!-- ADDED name="name" -->
                <input type="text" name="name" placeholder="Full Name" required>
            </div>
            <div class="input-group">
                <i class="fa-solid fa-phone"></i>
                <!-- ADDED name="phone" -->
                <input type="tel" name="phone" placeholder="Phone Number" required>
            </div>
            <div class="input-group">
                <i class="fa-solid fa-envelope"></i>
                <!-- ADDED name="email" -->
                <input type="email" name="email" placeholder="Email Address" required>
            </div>
            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <!-- ADDED name="password" -->
                <input type="password" name="password" placeholder="Create Password" required>
            </div>

            <button type="submit" class="btn-primary" style="width: 100%; border:none; cursor:pointer;">Create Account</button>
        </form>

        <p class="toggle-text">Already have an account? <a href="login.php" class="toggle-link">Login</a></p>
    </div>

</body>
</html>