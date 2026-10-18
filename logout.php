<?php
session_start();

// Destroy all session variables
session_unset();
session_destroy();

// Send the user back to the login page
header("Location: login.php");
exit();
?>