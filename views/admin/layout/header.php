<?php
date_default_timezone_set('Asia/Kolkata');
require_once __DIR__ .'/../../../config/bootstrap.php';
require_once __DIR__ .'/../../../vendor/autoload.php';
require_once __DIR__ .'/../../../helper/AuthMiddleware.php';

$response = AuthMiddleware::check();
if(!$response['status']){
    header("Location: ".$_ENV['APP_URL']."/views/admin/login.php");
    exit;
}

    $user = $response['user'];
    $userdata = $user->data;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= $_ENV['APP_URL']?>/assets/favicon.ico" type="image/x-icon">
    <title>Admin | CampusCall</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href= "<?= $_ENV['APP_URL']; ?>/assets/css/style.css">
</head>

<body class="bg-light">

<!-- Top Navbar -->
<nav class="navbar navbar-expand navbar-light bg-white shadow-sm px-4">
    <a class="navbar-brand fw-bold text-primary"
       href="<?= $_ENV['APP_URL']; ?>/views/admin/dashboard.php">
        🎓 CampusCall
    </a>

    <div class="ms-auto d-flex align-items-center">
        <span class="me-3 text-muted small">
            Welcome, <strong><?= htmlspecialchars(ucfirst($userdata->username)); ?></strong>
        </span>

        <a href="<?= $_ENV['APP_URL']; ?>/api/logout.php"
           class="btn btn-sm btn-outline-danger">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
</nav>
  <!-- ========== Toast helper ========== -->
  <div id="nt-toast-container"></div>
<div class="container-fluid">
    <div class="row">