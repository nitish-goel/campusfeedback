<?php
require_once '../vendor/autoload.php';
require_once '../config/Database.php';
require_once '../helper/AuthMiddleware.php';

AuthMiddleware::check();

$data = json_decode(file_get_contents("php://input"), true);

$db = new Database();
$conn = $db->connect();

// delete fields first
$stmt1 = $conn->prepare("DELETE FROM tbl_fields WHERE form_id = ?");
$stmt1->execute([$data['form_id']]);

// delete form
$stmt2 = $conn->prepare("DELETE FROM tbl_forms WHERE id = ?");
$stmt2->execute([$data['form_id']]);

echo json_encode(["status"=>true]);