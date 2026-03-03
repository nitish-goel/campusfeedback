<?php
require_once '../vendor/autoload.php';
require_once '../config/Database.php';
require_once '../helper/AuthMiddleware.php';

AuthMiddleware::check();

$data = json_decode(file_get_contents("php://input"), true);

$db = new Database();
$conn = $db->connect();

$stmt = $conn->prepare("
    UPDATE tbl_fields 
    SET label = ?, type = ?, options = ?
    WHERE id = ?
");

$stmt->execute([
    $data['label'],
    $data['type'],
    $data['options'],
    $data['field_id']
]);

echo json_encode(["status"=>true]);