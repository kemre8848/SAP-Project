<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/dbhelper/employee.php";

$employee = new Employee();
$titles = $employee->getTitles();
$departments = $employee->getDepartments();

$employeeData = [];
if (isset($_POST['edit_id'])) {
    $employeeData = $employee->getEmployeeById($_POST['edit_id']);
}
?>

<div class="container">
    <form id="editForm" method="post" action="">
        <h1>Çalışanı Düzenle</h1>
        <label for="Name">İsim:</label>
        <input type="text" id="Name" name="Name" required value="<?php echo isset($employeeData['Name']) ? $employeeData['Name'] : ''; ?>">
        
        <label for="Surname">Soyisim:</label>
        <input type="text" id="Surname" name="Surname" required value="<?php echo isset($employeeData['Surname']) ? $employeeData['Surname'] : ''; ?>">
        
        <label for="Birthday">Doğum Tarihi:</label>
        <input type="date" id="Birthday" name="Birthday" required value="<?php echo isset($employeeData['Birthday']) ? $employeeData['Birthday'] : ''; ?>">
        
        <label for="TitleId">Ünvan:</label>
        <select id="TitleId" name="TitleId" required>
            <?php while ($row = $titles->fetch_assoc()): ?>
                <option value="<?php echo $row['Id']; ?>" <?php echo isset($employeeData['TitleId']) && $employeeData['TitleId'] == $row['Id'] ? 'selected' : ''; ?>><?php echo $row['TitleName']; ?></option>
            <?php endwhile; ?>
        </select>

        <label for="DepartmentId">Departman:</label>
        <select id="DepartmentId" name="DepartmentId" required>
            <?php while ($row = $departments->fetch_assoc()): ?>
                <option value="<?php echo $row['Id']; ?>" <?php echo isset($employeeData['DepartmentId']) && $employeeData['DepartmentId'] == $row['Id'] ? 'selected' : ''; ?>><?php echo $row['Name']; ?></option>
            <?php endwhile; ?>
        </select>
        
        <label for="PhoneNo">Telefon No:</label>
        <input type="text" id="PhoneNo" name="PhoneNo" required value="<?php echo isset($employeeData['PhoneNo']) ? $employeeData['PhoneNo'] : ''; ?>">
        
        <input type="hidden" name="Id" value="<?php echo isset($employeeData['Id']) ? $employeeData['Id'] : -1; ?>">
        <input type="button" value="Güncelle" class="btn btn-primary" onclick="UpdateEmployee();">
    </form>
</div>
