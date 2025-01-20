<?php 


require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/dbhelper/employee.php";
$employee = new Employee();
$employees = $employee->getEmployees();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_id'])) {
        $employee->deleteEmployee($_POST['delete_id']);
        
        exit;
    }}
?>