<?php
require_once __DIR__ . '/includes/init.php';

// Already logged in? Go to dashboard
if (!empty($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();

    $login = trim($_POST['login'] ?? '');
    $pass  = $_POST['password'] ?? '';

    $stmt = $conn->prepare(
        "SELECT id, full_name, password_hash, status
         FROM users
         WHERE (username = ? OR email = ?) AND role = 'admin'
         LIMIT 1"
    );
    $stmt->bind_param('ss', $login, $login);
    $stmt->execute();
    $admin = $stmt->get_result()->fetch_assoc();

    if ($admin && password_verify($pass, $admin['password_hash'])) {
        if ($admin['status'] !== 'active') {
            $error = 'This account is blocked.';
        } else {
            session_regenerate_id(true);
            $_SESSION['admin_id']   = $admin['id'];
            $_SESSION['admin_name'] = $admin['full_name'];
            header('Location: index.php');
            exit;
        }
    } else {
        $error = 'Invalid username/email or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login - Gondia Auto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-warning-subtle d-flex align-items-center min-vh-100">

<div class="container" style="max-width: 420px;">
  <div class="card shadow-sm">
    <div class="card-body p-4">
      <h4 class="text-center mb-4">Gondia Auto Admin</h4>

      <?php if ($error): ?>
        <div class="alert alert-danger"><?= e($error) ?></div>
      <?php endif; ?>

      <form method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
          <label class="form-label">Username or Email</label>
          <input type="text" name="login" class="form-control" required autofocus>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
       <button class="btn btn-warning w-100">Login</button>
      </form>
    </div>
  </div>
</div>

</body>
</html>