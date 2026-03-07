<?php

require_once '../vendor/autoload.php';
require_once '../config/Database.php';
require_once '../helper/AuthMiddleware.php';

AuthMiddleware::check();

$db = new Database();
$conn = $db->connect();

$stmt = $conn->query("
SELECT 
tbl_submissions.roll_number,
tbl_forms.title,
MAX(tbl_submissions.submitted_at) as submitted_at
FROM tbl_submissions
JOIN tbl_forms ON tbl_forms.id = tbl_submissions.form_id
GROUP BY tbl_submissions.roll_number
ORDER BY submitted_at DESC
LIMIT 5
");

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
"status"=>true,
"data"=>$data
]);