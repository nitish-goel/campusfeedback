<?php
require_once '../config/bootstrap.php';
// Destroy JWT cookie
setcookie("token", "", [
    "expires" => time() - 3600,
    "path" => "/",
    "httponly" => true,
    "secure" => false,
    "samesite" => "Lax"
]);
// Optional: destroy session if using
session_start();
session_unset();
session_destroy();

// Redirect to login page
header("Location: ".$_ENV['APP_URL']."/views/admin/login.php");
exit;