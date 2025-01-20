<?php
include 'Employee.php';
include 'database.php';
session_start();
if (!isset($_SESSION['kullanici_id']) || ($_SESSION['rol_id'] != 1 && $_SESSION['rol_id'] != 2)) {
    header('Location: yetki.php');
    exit;
}

$employee = new Employee();
$employees = $employee->getEmployees();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_id'])) {
        $employee->deleteEmployee($_POST['delete_id']);
        header('Location: index.php');
        exit;
    } elseif (isset($_POST['Name']) && isset($_POST['Surname']) && isset($_POST['Birthday']) && isset($_POST['TitleId']) && isset($_POST['DepartmentId']) && isset($_POST['PhoneNo'])) {
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
<!DOCTYPE html>
<html>
<head>
    <title>Çalışan Listesi</title>
    <style>
        
    </style>
</head>
<body>
    <div class="container">
        <h1>Çalışan Listesi</h1>
        <a class="button" href="create.php">Yeni Çalışan Ekle</a>
        <table>
            <colgroup>
                <col span="3" style="background-color: #D6EEEE">
                <col span="4" style="background-color: pink">
            </colgroup>
            <tr>
                <th>ID</th>
                <th>İsim</th>
                <th>Soyisim</th>
                <th>Doğum Tarihi</th>
                <th>Departman</th>
                <th>Ünvan</th>
                <th>İletişim Bilgileri</th>
                <th>Eklenme Tarihi</th>
                <th>Güncellenme Tarihi</th>
                <th>İşlemler</th>
            </tr>
            <?php while($row = $employees->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['Id']; ?></td>
                <td><?php echo $row['Name']; ?></td>
                <td><?php echo $row['Surname']; ?></td>
                <td><?php echo $row['Birthday']; ?></td>
                <td><?php echo $row['DepartmentName']; ?></td>
                <td><?php echo $row['TitleName']; ?></td>
                <td><?php echo $row['PhoneNo']; ?></td>
                <td><?php echo $row['AddDate']; ?></td>
                <td><?php echo $row['UpdateDateTime']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['Id']; ?>">Düzenle</a>
                    <form method="post" action="index.php" style="display:inline;">
                    <input type="hidden" name="delete_id" value="<?php echo $row['Id']; ?>">
                    <button type="submit">Sil</button>
                    </form>

                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
