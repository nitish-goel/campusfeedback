<?php
require_once '../vendor/autoload.php';
require_once '../config/Database.php';

$db = new Database();
$conn = $db->connect();

$form_id = $_GET['id'] ?? null;

if(!$form_id){
    echo json_encode(["status"=>false,"message"=>"Form ID missing"]);
    exit;
}

// Create submission
$stmt = $conn->prepare("INSERT INTO tbl_submissions (form_id) VALUES (?)");
$stmt->execute([$form_id]);
$submission_id = $conn->lastInsertId();

// Save answers
foreach($_POST as $key => $value){

    if(strpos($key, "field_") === 0){

        $field_id = str_replace("field_", "", $key);

        // If checkbox (array)
        if(is_array($value)){
            $value = implode(",", $value);
        }

        $stmt2 = $conn->prepare("
            INSERT INTO tbl_submission_answers 
            (submission_id, field_id, answer)
            VALUES (?, ?, ?)
        ");

        $stmt2->execute([$submission_id, $field_id, $value]);
    }
}

echo json_encode([
    "status"=>true,
    "message"=>"Thank you! Feedback submitted successfully."
]);