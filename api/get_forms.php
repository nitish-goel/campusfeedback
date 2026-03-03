<?php
require_once '../vendor/autoload.php';
require_once '../config/Database.php';

$db = new Database();
$conn = $db->connect();



// Get form
$stmt = $conn->query("SELECT * FROM tbl_forms WHERE is_active = 1 LIMIT 1");
$form = $stmt->fetch(PDO::FETCH_ASSOC);
// print_r($form);
// die;
if(!$form){
    echo json_encode(["status"=>false,"message"=>"Form not found"]);
    exit;
}

// Get fields
$stmt2 = $conn->prepare("SELECT * FROM tbl_fields WHERE form_id = ?");
$stmt2->execute([$form['id']]);
$fields = $stmt2->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "status" => true,
    "form" => $form,
    "fields" => $fields
]);