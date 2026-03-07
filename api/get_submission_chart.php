<?php

require_once '../vendor/autoload.php';
require_once '../config/Database.php';
require_once '../helper/AuthMiddleware.php';

AuthMiddleware::check();

$db = new Database();
$conn = $db->connect();

$stmt = $conn->query("
SELECT 
DATE(submitted_at) as date,
COUNT(*) as total
FROM tbl_submissions
GROUP BY DATE(submitted_at)
ORDER BY date ASC
");

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
"status"=>true,
"data"=>$data
]);