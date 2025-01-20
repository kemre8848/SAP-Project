<?php
include '../db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    echo "Geçersiz eğitim Id.";
    exit;
}


$sql = "SELECT eg.Id, eg.WorkerId, eg.EducationId, eg.EducationDate, eg.UpdateDateTime, c.Name, c.Surname, et.EducationName 
        FROM egitimler eg 
        JOIN calisanlar c ON eg.WorkerId = c.Id 
        JOIN egitimturleri et ON eg.EducationId = et.Id 
        WHERE eg.Id = $id";

$result = $conn->query($sql);

if (!$result || $result->num_rows === 0) {
    echo "Eğitim kaydı bulunamadı veya geçerli değil.";
    exit;
}

$row = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eğitim Düzenle</title>
</head>
<body>
    <h1>Eğitim Düzenle</h1>
    <form method="post" action="update_egitim.php">
        <input type="hidden" name="Id" value="<?php echo $row['Id']; ?>">

        <label for="WorkerId">Çalışan:</label>
        <select id="WorkerId" name="WorkerId" required>
            <?php
            include '../db.php';

            $sql = "SELECT Id, Name, Surname FROM calisanlar WHERE DepartmentId = 5 AND IsActive = 1";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($worker = $result->fetch_assoc()) {
                    $selected = ($worker['Id'] == $row['WorkerId']) ? "selected" : "";
                    echo "<option value='" . $worker['Id'] . "' $selected>" . $worker['Name'] . " " . $worker['Surname'] . "</option>";
                }
            } else {
                echo "<option disabled selected>No workers available</option>";
            }

            $conn->close();
            ?>
        </select>

        <label for="EducationId">Eğitim Türü:</label>
        <select id="EducationId" name="EducationId" required>
            <?php
            include '../db.php';

            $sql = "SELECT Id, EducationName FROM egitimturleri";
            $edu_result = $conn->query($sql);

            if ($edu_result->num_rows > 0) {
                while ($edu = $edu_result->fetch_assoc()) {
                    $selected = ($edu['Id'] == $row['EducationId']) ? "selected" : "";
                    echo "<option value='" . $edu['Id'] . "' $selected>" . $edu['EducationName'] . "</option>";
                }
            } else {
                echo "<option value=''>Eğitim türü bulunamadı</option>";
            }

            $conn->close();
            ?>
        </select>

        <label for="EducationDate">Eğitim Tarihi:</label>
        <input type="date" id="EducationDate" name="EducationDate" value="<?php echo $row['EducationDate']; ?>" required>

        <input type="submit" value="Güncelle">
    </form>
</body>
</html>



