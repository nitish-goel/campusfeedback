<?php
require_once '../vendor/autoload.php';
require_once '../config/Database.php';
require_once '../helper/AuthMiddleware.php';

AuthMiddleware::check();

$data = json_decode(file_get_contents("php://input"), true);

$form_id = $data['form_id'] ?? null;

if(!$form_id){
    echo json_encode(["status"=>false]);
    exit;
}

$db = new Database();
$conn = $db->connect();

$conn->beginTransaction();

try {

    // Deactivate all forms
    $conn->query("UPDATE tbl_forms SET is_active = 0");

    // Activate selected form
    $stmt = $conn->prepare("UPDATE tbl_forms SET is_active = 1 WHERE id = ?");
    $stmt->execute([$form_id]);

    $conn->commit();

    echo json_encode(["status"=>true]);

} catch(Exception $e){
    $conn->rollBack();
    echo json_encode(["status"=>false]);
}