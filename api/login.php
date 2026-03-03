<?php

require_once '../vendor/autoload.php';
require_once '../config/Database.php';
require_once '../helper/JWTService.php';

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["status" => false, "message" => "Method Not Allowed"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['username']) || !isset($data['password'])) {
    http_response_code(400);
    echo json_encode(["status" => false, "message" => "Username and Password required"]);
    exit;
}

$username = trim($data['username']);
$password = trim($data['password']);

$db = Database::connect();

$stmt = $db->prepare("SELECT * FROM tbl_admin WHERE username = ?");
$stmt->execute([$username]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {

    $token = JWTService::generate($user);

    // Store JWT in cookie
    setcookie("token", $token, [
        "expires" => time() + 3600,
        "path" => "/",
        "httponly" => true,
        "secure" => false, // true if using https
        "samesite" => "Lax"
    ]);

    echo json_encode([
        "status" => true,
        "message" => "Login successful"
    ]);


} else {

    http_response_code(401);
    echo json_encode([
        "status" => false,
        "message" => "Invalid credentials"
    ]);
}