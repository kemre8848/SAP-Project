<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/dbhelper/employee.php";

$employee = new Employee();
$departments = $employee->getDepartments();
$titles = $employee->getTitles();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
        
     if(isset($_POST['Name']) && isset($_POST['Surname']) && isset($_POST['Birthday']) && isset($_POST['TitleId']) && isset($_POST['DepartmentId']) && isset($_POST['PhoneNo'])) {
        $name = $_POST['Name'];
        $surname = $_POST['Surname'];
        $birthday = $_POST['Birthday'];
        $titleId = $_POST['TitleId'];
        $departmentId = $_POST['DepartmentId'];
        $phoneNo = $_POST['PhoneNo'];
        $employee->addEmployee($name, $surname, $birthday, $titleId, $departmentId, $phoneNo);
        header('Location: index.php');
        exit;
    }
}

?>