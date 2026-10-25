<?php $page = basename($_SERVER['PHP_SELF']); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gondia Auto Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <style>
    body { background: #fffbea; }
    .offcanvas-lg.sidebar { --bs-offcanvas-width: 250px; }
    .content { min-width: 0; }
    @media (min-width: 992px) { .sidebar-wrap { width: 250px; flex-shrink: 0; } }
  </style>
</head>
<body>
<div class="d-flex">

  <!-- Sidebar -->
  <div class="sidebar-wrap bg-dark text-white min-vh-100">
    <div class="offcanvas-lg offcanvas-start sidebar bg-dark text-white" tabindex="-1" id="sidebar">

      <div class="offcanvas-header justify-content-end">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" data-bs-target="#sidebar"></button>
      </div>

      <div class="offcanvas-body d-flex flex-column p-3">
        <a href="index.php" class="fs-5 fw-bold text-warning text-decoration-none">
          <i class="bi bi-taxi-front"></i> Gondia Auto
        </a>
        <hr class="border-secondary">

        <ul class="nav nav-pills flex-column gap-1 mb-auto">
          <li class="nav-item">
            <a class="nav-link <?= $page == 'index.php' ? 'active bg-warning text-dark' : 'text-white' ?>" href="index.php">
              <i class="bi bi-speedometer2 me-2"></i>Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= in_array($page, ['users.php', 'user-form.php']) ? 'active bg-warning text-dark' : 'text-white' ?>" href="users.php">
              <i class="bi bi-people me-2"></i>Users
            </a>
          </li>
        </ul>

        <hr class="border-secondary">
        <a class="nav-link text-white px-0 mb-2" href="../index.php" target="_blank">
          <i class="bi bi-box-arrow-up-right me-2"></i>View Website
        </a>
        <a class="btn btn-warning btn-sm" href="logout.php">
          <i class="bi bi-box-arrow-right"></i> Logout
        </a>
      </div>
    </div>
  </div>

  <!-- Right side: top bar + page content -->
  <div class="flex-grow-1 content">
    <nav class="navbar bg-warning px-3">
      <button class="btn btn-dark d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
        <i class="bi bi-list"></i>
      </button>
      <span class="ms-auto fw-semibold">
        <i class="bi bi-person-circle"></i> <?= e($_SESSION['admin_name']) ?>
      </span>
    </nav>

    <main class="p-4">