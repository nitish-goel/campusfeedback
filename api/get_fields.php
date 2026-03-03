<?php
require_once '../vendor/autoload.php';
require_once '../config/Database.php';
require_once '../helper/AuthMiddleware.php';

AuthMiddleware::check();

$form_id = $_GET['form_id'] ?? null;

if(!$form_id){
    echo json_encode(["status"=>false]);
    exit;
}

$db = new Database();
$conn = $db->connect();

$stmt = $conn->prepare("SELECT * FROM tbl_fields WHERE form_id = ?");
$stmt->execute([$form_id]);

$fields = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "status" => true,
    "fields" => $fields
]);