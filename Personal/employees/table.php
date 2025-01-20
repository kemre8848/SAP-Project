<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/dbhelper/employee.php";

$employee = new Employee();
$employees = $employee->getEmployees();
?>

<div class="container">
    <h2>Çalışan Listesi</h2>
    <table id=calisan_table>
            <colgroup>
                <col span="3" style="background-color: #D6EEEE">
                <col span="4" style="background-color: pink">
            </colgroup>
            <thead>
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
            </thead>
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
                    <button name="edit_id" class="btn btn-primary" onclick="OpenEmployeesEdit(<?php echo $row['Id']; ?>)">Düzenle</button>
                    <button name="delete_id" class="btn btn-danger" onclick="RemoveEmployeesTable(<?php echo $row['Id']; ?>)">Sil</button>
                </td>
            </tr>
            <?php endwhile; ?>

    </table>
</div>