<?php

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
header("Location: /CampusFeedback/views/admin/login.php");
exit;