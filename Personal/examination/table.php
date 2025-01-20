<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/dbhelper/examination.php";

$examination = new Examination();
$results = $examination->readAll();

?>
<div class="container">
    <table id=muayene_table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Çalışan</th>
                <th>Muayene Tarihi</th>
                <th>Muayene Türü</th>
                <th>Sonuçlar</th>
                <th>Ekleme Tarihi</th>
                <th>Güncelleme Tarihi</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $results->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['Id']); ?></td>
                    <td><?php echo htmlspecialchars($row['Name'] . ' ' . $row['Surname']); ?></td>
                    <td><?php echo htmlspecialchars($row['ExaminationDate']); ?></td>
                    <td><?php echo htmlspecialchars($row['ExaminationTypeId']); ?></td>
                    <td><?php echo htmlspecialchars($row['Results']); ?></td>
                    <td><?php echo htmlspecialchars($row['AddDate']); ?></td>
                    <td><?php echo htmlspecialchars($row['UpdateDateTime']); ?></td>
                    <td>
                        <button name="edit_id" class="btn btn-primary" onclick="OpenExaminationEdit(<?php echo $row['Id']; ?>)">Düzenle</button>
                        <button name="delete_id" class="btn btn-danger" onclick="RemoveExaminationTable(<?php echo $row['Id']; ?>)">Sil</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>    