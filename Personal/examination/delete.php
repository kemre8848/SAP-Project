<?php 

require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/dbhelper/examination.php";
$examination = new Examination();
$results = $examination->readAll();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_id'])) {
        $examination->delete($_POST['delete_id']);
    
        exit;
    }}
?>