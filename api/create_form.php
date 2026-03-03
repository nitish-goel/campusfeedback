<?php
require_once '../vendor/autoload.php';
require_once '../config/Database.php';
require_once '../helper/AuthMiddleware.php';


AuthMiddleware::check();

$data = json_decode(file_get_contents("php://input"), true);

if(empty($data['title'])){
    echo json_encode(["status"=>false,"message"=>"Title required"]);
    exit;
}

$db = new Database();
$conn = $db->connect();

$stmt = $conn->prepare("INSERT INTO tbl_forms (title, description) VALUES (?, ?)");
$stmt->execute([$data['title'], $data['description']]);

$form_id = $conn->lastInsertId();

echo json_encode([
    "status" => true,
    "form_id" => $form_id
]);