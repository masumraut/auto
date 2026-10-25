<?php
require_once __DIR__ . '/includes/auth.php';

$id = (int)($_GET['id'] ?? 0);
$user = ['name' => '', 'email' => '', 'status' => 'active'];
$error = '';

if ($id) {
    $stmt = $conn->prepare("SELECT id, name, email, status FROM users WHERE id = ?");
    $stmt->bind_param('i', $id); $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    if (!$user) { header('Location: users.php'); exit; }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $name   = trim($_POST['name'] ?? '');
    $email  = trim($_POST['email'] ?? '');
    $status = $_POST['status'] === 'blocked' ? 'blocked' : 'active';
    $pass   = $_POST['password'] ?? '';

    if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Enter a valid name and email.';
    } elseif (!$id && strlen($pass) < 6) {
        $error = 'Password must be at least 6 characters.';
    } else {
        // email must be unique
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? AND id <> ?");
        $stmt->bind_param('si', $email, $id); $stmt->execute();
        if ($stmt->get_result()->num_rows) {
            $error = 'That email is already in use.';
        } elseif ($id) {
            if ($pass !== '') {
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE users SET name=?, email=?, status=?, password=? WHERE id=?");
                $stmt->bind_param('ssssi', $name, $email, $status, $hash, $id);
            } else {
                $stmt = $conn->prepare("UPDATE users SET name=?, email=?, status=? WHERE id=?");
                $stmt->bind_param('sssi', $name, $email, $status, $id);
            }
            $stmt->execute();
            header('Location: users.php?msg=done'); exit;
        } else {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, status) VALUES (?,?,?,?)");
            $stmt->bind_param('ssss', $name, $email, $hash, $status);
            $stmt->execute();
            header('Location: users.php?msg=done'); exit;
        }
    }
    $user = ['name' => $name, 'email' => $email, 'status' => $status];
}

include 'includes/header.php';
?>
<h3 class="mb-3"><?= $id ? 'Edit User' : 'Add User' ?></h3>
<div class="card" style="max-width:560px">
  <div class="card-body">
    <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
    <form method="post">
      <?= csrf_field() ?>
      <div class="mb-3"><label class="form-label">Name</label>
        <input name="name" class="form-control" value="<?= e($user['name']) ?>" required></div>
      <div class="mb-3"><label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="<?= e($user['email']) ?>" required></div>
      <div class="mb-3"><label class="form-label">Password <?= $id ? '<small class="text-muted">(leave blank to keep current)</small>' : '' ?></label>
        <input type="password" name="password" class="form-control" <?= $id ? '' : 'required' ?>></div>
      <div class="mb-3"><label class="form-label">Status</label>
        <select name="status" class="form-select">
          <option value="active"  <?= $user['status']=='active'  ? 'selected' : '' ?>>Active</option>
          <option value="blocked" <?= $user['status']=='blocked' ? 'selected' : '' ?>>Blocked</option>
        </select></div>
      <button class="btn btn-dark">Save</button>
      <a href="users.php" class="btn btn-link">Cancel</a>
    </form>
  </div>
</div>
<?php include 'includes/footer.php'; ?>