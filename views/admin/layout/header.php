<?php
require_once '../../config/bootstrap.php';
require_once '../../vendor/autoload.php';
require_once '../../helper/AuthMiddleware.php';

$response = AuthMiddleware::check();
if(!$response['status']){
    header("Location: /CampusFeedback/views/admin/login.php");
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
    <title>Admin | CampusFeedback</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="/CampusFeedback/assets/css/style.css">
</head>

<body class="bg-light">

<!-- Top Navbar -->
<nav class="navbar navbar-expand navbar-light bg-white shadow-sm px-4">
    <a class="navbar-brand fw-bold text-primary"
       href="/CampusFeedback/views/admin/dashboard.php">
        🎓 CampusFeedback
    </a>

    <div class="ms-auto d-flex align-items-center">
        <span class="me-3 text-muted small">
            Welcome, <strong><?= htmlspecialchars(ucfirst((isset($userdata->name)?$userdata->name:'Administrater'))); ?></strong>
        </span>

        <a href="/CampusFeedback/api/logout.php"
           class="btn btn-sm btn-outline-danger">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
</nav>
  <!-- ========== Toast helper ========== -->
  <div id="nt-toast-container"></div>
<div class="container-fluid">
    <div class="row">