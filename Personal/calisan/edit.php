<?php
include 'Employee.php';

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

    
    $updated = $employee->updateEmployee($id, $name, $surname, $birthday, $titleId, $departmentId, $phoneNo);

    if ($updated) {
        header('Location: index.php');
        exit;
    } else {
        echo "Güncelleme işlemi başarısız.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Çalışan Düzenle</title>
    <style>
    
    </style>
</head>
<body>
    <form id="update" method="post" action="edit.php?id=<?php echo $id; ?>">
        <h1>Çalışan Düzenle</h1>
        <input type="hidden" id="Id" name="Id" value="<?php echo $employeeData['Id']; ?>">
        
        <label for="Name">İsim:</label>
        <input type="text" id="Name" name="Name" value="<?php echo $employeeData['Name']; ?>" required>
        
        <label for="Surname">Soyisim:</label>
        <input type="text" id="Surname" name="Surname" value="<?php echo $employeeData['Surname']; ?>" required>
        
        <label for="Birthday">Doğum Tarihi:</label>
        <input type="date" id="Birthday" name="Birthday" value="<?php echo $employeeData['Birthday']; ?>" required>
        
        <label for="TitleId">Ünvan:</label>
        <select id="TitleId" name="TitleId" required>
            <?php while ($row = $titles->fetch_assoc()): ?>
                <option value="<?php echo $row['Id']; ?>" <?php if($row['Id'] == $employeeData['TitleId']) echo 'selected'; ?>><?php echo $row['TitleName']; ?></option>
            <?php endwhile; ?>
        </select>

        <label for="DepartmentId">Departman:</label>
        <select id="DepartmentId" name="DepartmentId" required>
            <?php while ($row = $departments->fetch_assoc()): ?>
                <option value="<?php echo $row['Id']; ?>" <?php if($row['Id'] == $employeeData['DepartmentId']) echo 'selected'; ?>><?php echo $row['Name']; ?></option>
            <?php endwhile; ?>
        </select>
        
        <label for="PhoneNo">Telefon No:</label>
        <input type="text" id="PhoneNo" name="PhoneNo" value="<?php echo $employeeData['PhoneNo']; ?>" required>
        
        <input type="submit" value="Güncelle">
    </form>
</body>
</html>

