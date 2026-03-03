<?php
require_once '../vendor/autoload.php';
require_once '../config/Database.php';
require_once '../helper/AuthMiddleware.php';

AuthMiddleware::check();

$data = json_decode(file_get_contents("php://input"), true);

$db = new Database();
$conn = $db->connect();

$stmt = $conn->prepare("
    UPDATE tbl_forms 
    SET title = ?, description = ?
    WHERE id = ?
");

$stmt->execute([
    $data['title'],
    $data['description'],
    $data['form_id']
]);

echo json_encode(["status"=>true]);