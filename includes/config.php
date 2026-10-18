<?php
// Database configuration for XAMPP
$servername = "localhost";
$username   = "root";      // Default XAMPP username
$password   = "";          // Default XAMPP password (leave empty)
$dbname     = "gondia_auto"; // The database name we created earlier

// Create connection using MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Stops the page from loading if there is an error
    die("Database Connection Failed: " . $conn->connect_error); 
}

// Optional: You can uncomment the line below to test if it works, 
// but remember to hide it again once you start building pages!
//echo "Connected successfully to Gondia Auto Database!";
?>