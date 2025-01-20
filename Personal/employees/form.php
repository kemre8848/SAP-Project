<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/dbhelper/employee.php";

$employee = new Employee();
$departments = $employee->getDepartments();
$titles = $employee->getTitles();
?>
<form id="store" method="post" action="">
    <h1>Yeni Çalışan Ekle</h1>
    <label for="Name">İsim:</label>
    <input type="text" id="Name" name="Name" required>
    
    <label for="Surname">Soyisim:</label>
    <input type="text" id="Surname" name="Surname" required>
    
    <label for="Birthday">Doğum Tarihi:</label>
    <input type="date" id="Birthday" name="Birthday" required>
    
    <label for="TitleId">Ünvan:</label>
    <select id="TitleId" name="TitleId" required>
    <?php while ($row = $titles->fetch_assoc()): ?>
        <option value="<?php echo $row['Id']; ?>"><?php echo $row['TitleName']; ?></option>
    <?php endwhile; ?>
    </select>

    <label for="DepartmentId">Departman:</label>
    <select id="DepartmentId" name="DepartmentId" required>
    <?php while ($row = $departments->fetch_assoc()): ?>
        <option value="<?php echo $row['Id']; ?>"><?php echo $row['Name']; ?></option>
    <?php endwhile; ?>
    </select>
    
    <label for="PhoneNo">Telefon No:</label>
    <input type="text" id="PhoneNo" name="PhoneNo" required>
    
    <input type="hidden" name="Id" value="<?php echo isset($employeeData['Id']) ? $employeeData['Id'] : -1; ?>">
    <input type="button" value="Kaydet" class="btn btn-primary" onclick="SaveEmployeesModul()">
</form>


