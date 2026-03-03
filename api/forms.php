<?php

require_once '../vendor/autoload.php';
require_once '../core/Database.php';
require_once '../core/AuthMiddleware.php';

header("Content-Type: application/json");

// Protect this route
$user = AuthMiddleware::check();

echo json_encode([
    "status" => true,
    "message" => "Welcome " . $user->username
]);