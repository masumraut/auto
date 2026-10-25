<?php
require_once __DIR__ . '/init.php';

if (empty($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}