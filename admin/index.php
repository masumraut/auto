<?php
require_once __DIR__ . '/includes/auth.php';

// Summary numbers (one query)
$stats = $conn->query("
    SELECT COUNT(*)                          AS total,
           SUM(role = 'customer')            AS customers,
           SUM(role = 'driver')              AS drivers,
           SUM(status = 'blocked')           AS blocked
    FROM users
")->fetch_assoc();

// 5 newest users
$recent = $conn->query("
    SELECT id, full_name, username, email, role, status, created_at
    FROM users
    ORDER BY id DESC
    LIMIT 5
");

$cards = [
    ['Total Users', (int)$stats['total'],     'warning',   'bi-people'],
    ['Customers',   (int)$stats['customers'], 'dark',      'bi-person'],
    ['Drivers',     (int)$stats['drivers'],   'secondary', 'bi-taxi-front'],
    ['Blocked',     (int)$stats['blocked'],   'danger',    'bi-person-x'],
];

include __DIR__ . '/includes/header.php';
?>

<h3 class="mb-4">Dashboard</h3>

<div class="row g-3 mb-4">
  <?php foreach ($cards as [$label, $value, $color, $icon]): ?>
    <div class="col-6 col-lg-3">
      <div class="card text-bg-<?= $color ?>">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <div class="small"><?= $label ?></div>
            <div class="fs-3 fw-bold"><?= $value ?></div>
          </div>
          <i class="bi <?= $icon ?> fs-1 opacity-50"></i>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<div class="card">
  <div class="card-header d-flex justify-content-between">
    <span>Recent Users</span>
    <a href="users.php" class="small">View all</a>
  </div>
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead>
        <tr>
          <th>#</th><th>Name</th><th>Username</th><th>Email</th><th>Role</th><th>Status</th><th>Joined</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($u = $recent->fetch_assoc()): ?>
          <tr>
            <td><?= $u['id'] ?></td>
            <td><?= e($u['full_name']) ?></td>
            <td><?= e($u['username']) ?></td>
            <td><?= e($u['email']) ?></td>
            <td>
              <span class="badge text-bg-<?= ['customer' => 'primary', 'driver' => 'warning', 'admin' => 'dark'][$u['role']] ?? 'secondary' ?>">
                <?= e($u['role']) ?>
              </span>
            </td>
            <td>
              <span class="badge text-bg-<?= $u['status'] === 'active' ? 'success' : 'danger' ?>">
                <?= e($u['status']) ?>
              </span>
            </td>
            <td><?= e($u['created_at']) ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>