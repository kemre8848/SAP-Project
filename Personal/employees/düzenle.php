<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/dbhelper/employee.php";


$id = $_GET['id'];
$employee = new Employee();
$employeeData = $employee->getEmployeeById($id);
$departments = $employee->getDepartments();
$titles = $employee->getTitles();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_POST['Id'];
    $name = $_POST['Name'];
    $surname = $_POST['Surname'];
    $birthday = $_POST['Birthday'];
    $titleId = $_POST['TitleId'];
    $departmentId = $_POST['DepartmentId'];
    $phoneNo = $_POST['PhoneNo'];

    
    $updated = $employee->updateEmployee($id, $name, $surname, $birthday, $titleId, $departmentId, $phoneNo);}
?>
