<?php
require_once '../vendor/autoload.php';
require_once '../config/Database.php';
require_once '../helper/AuthMiddleware.php';

AuthMiddleware::check();

$data = json_decode(file_get_contents("php://input"), true);

$db = new Database();
$conn = $db->connect();

$options = null;

// If radio or checkbox → require options
if ($data['type'] === 'radio' || $data['type'] === 'checkbox') {
    
    if (empty($data['options'])) {
        echo json_encode([
            "status" => false,
            "message" => "Options required for radio/checkbox"
        ]);
        exit;
    }

    $options = $data['options'];
}

$stmt = $conn->prepare("
    INSERT INTO tbl_fields (form_id, label, type, options)
    VALUES (?, ?, ?, ?)
");

$stmt->execute([
    $data['form_id'],
    $data['label'],
    $data['type'],
    $options
]);

echo json_encode([
    "status" => true,
    "message" => "Field added successfully"
]);