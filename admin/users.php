<?php
require_once __DIR__ . '/includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();
    $id = (int)($_POST['id'] ?? 0);
    if ($_POST['action'] === 'toggle') {
        $conn->query("UPDATE users SET status = IF(status='active','blocked','active') WHERE id = $id");
    } elseif ($_POST['action'] === 'delete') {
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param('i', $id); $stmt->execute();
    }
    header('Location: users.php?msg=done'); exit;
}

$q = trim($_GET['q'] ?? '');
$like = "%$q%";
$stmt = $conn->prepare("SELECT id, name, email, status, created_at FROM users
                        WHERE name LIKE ? OR email LIKE ? ORDER BY id DESC");
$stmt->bind_param('ss', $like, $like);
$stmt->execute();
$users = $stmt->get_result();

include 'includes/header.php';
?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3 class="mb-0">Users</h3>
  <a href="user-form.php" class="btn btn-dark"><i class="bi bi-plus-lg"></i> Add User</a>
</div>

<?php if (isset($_GET['msg'])): ?><div class="alert alert-success py-2">Action completed.</div><?php endif; ?>

<form class="mb-3">
  <div class="input-group">
    <input name="q" value="<?= e($q) ?>" class="form-control" placeholder="Search name or email">
    <button class="btn btn-outline-secondary">Search</button>
  </div>
</form>

<div class="card">
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead><tr><th>#</th><th>Name</th><th>Email</th><th>Status</th><th>Joined</th><th class="text-end">Actions</th></tr></thead>
      <tbody>
      <?php while ($u = $users->fetch_assoc()): ?>
        <tr>
          <td><?= $u['id'] ?></td>
          <td><?= e($u['name']) ?></td>
          <td><?= e($u['email']) ?></td>
          <td><span class="badge text-bg-<?= $u['status']=='active'?'success':'danger' ?>"><?= e($u['status']) ?></span></td>
          <td><?= e($u['created_at']) ?></td>
          <td class="text-end">
            <a href="user-form.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
            <form method="post" class="d-inline">
              <?= csrf_field() ?><input type="hidden" name="id" value="<?= $u['id'] ?>">
              <button name="action" value="toggle" class="btn btn-sm btn-outline-warning">
                <?= $u['status']=='active' ? 'Block' : 'Unblock' ?>
              </button>
            </form>
            <form method="post" class="d-inline" onsubmit="return confirm('Delete this user?')">
              <?= csrf_field() ?><input type="hidden" name="id" value="<?= $u['id'] ?>">
              <button name="action" value="delete" class="btn btn-sm btn-outline-danger">Delete</button>
            </form>
          </td>
        </tr>
      <?php endwhile; ?>
      <?php if ($users->num_rows === 0): ?>
        <tr><td colspan="6" class="text-center text-muted py-4">No users found.</td></tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php include 'includes/footer.php'; ?>