
<?php
$password = "ChangeMe123";

$hashedPassword = password_hash(
    $password,
    PASSWORD_DEFAULT
);

echo "<h2>Password Hash Generator</h2>";
echo "<p><strong>Original Password:</strong> "
    . htmlspecialchars($password)
    . "</p>";

echo "<p><strong>Hashed Password:</strong></p>";

echo "<textarea rows='4' cols='70' readonly>"
    . htmlspecialchars($hashedPassword)
    . "</textarea>";
?>
