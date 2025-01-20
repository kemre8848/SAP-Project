<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/dbhelper/education.php";
$db = new Database();
$education = new Education($db);
$educations = $education->getAllEducations();
?>


<div class="container">
        <h1>Eğitim Listesi</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Çalışan Adı</th>
                    <th>Eğitim Türü</th>
                    <th>Eğitim Tarihi</th>
                    <th>Eklenme Tarihi</th>
                    <th>Güncellenme Tarihi</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <?php while ($edu = $educations->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $edu['Id']; ?></td>
                <td><?php echo $edu['Name'] . ' ' . $edu['Surname']; ?></td>
                <td><?php echo $edu['EducationName']; ?></td>
                <td><?php echo $edu['EducationDate']; ?></td>
                <td><?php echo $edu['AddDate']; ?></td>
                <td><?php echo $edu['UpdateDateTime']; ?></td>
                <td>
                <button name="delete_id" class="btn btn-danger" onclick="OpenEducationEdit(<?php echo $edu['Id']; ?>)">Düzenle</button>
                    
                    <button name="delete_id" class="btn btn-danger" onclick="RemoveEducationTable(<?php echo $edu['Id']; ?>)">Sil</button>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>