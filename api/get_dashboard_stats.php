<?php

require_once '../vendor/autoload.php';
require_once '../config/Database.php';
require_once '../helper/AuthMiddleware.php';

AuthMiddleware::check();

$db = new Database();
$conn = $db->connect();

/* Total Forms */
$totalForms = $conn->query("
SELECT COUNT(*) as total 
FROM tbl_forms
")->fetch(PDO::FETCH_ASSOC)['total'];

/* Active Form */
$activeForm = $conn->query("
SELECT title 
FROM tbl_forms 
WHERE is_active = 1 
LIMIT 1
")->fetch(PDO::FETCH_ASSOC);

$activeFormTitle = $activeForm ? $activeForm['title'] : "None";

/* Total Submissions */
$totalSubmissions = $conn->query("
SELECT COUNT(*) as total 
FROM tbl_submissions
")->fetch(PDO::FETCH_ASSOC)['total'];

/* Unique Students */
$totalStudents = $conn->query("
SELECT COUNT(DISTINCT roll_number) as total 
FROM tbl_submissions
")->fetch(PDO::FETCH_ASSOC)['total'];

echo json_encode([
"status"=>true,
"data"=>[
"forms"=>$totalForms,
"active_form"=>$activeFormTitle,
"submissions"=>$totalSubmissions,
"students"=>$totalStudents
]
]);