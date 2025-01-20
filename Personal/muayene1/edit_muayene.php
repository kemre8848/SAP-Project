<?php
include '../db.php';

$id = $_GET['id'];

$sql = "SELECT mk.Id, mk.WorkerId, mk.ExaminationDate, mk.ExaminationTypeId, mk.Results, mk.AddDate, mk.UpdateDateTime, c.Name, c.Surname 
        FROM muayenekayit mk 
        JOIN calisanlar c ON mk.WorkerId = c.Id 
        WHERE mk.Id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Muayene kaydı bulunamadı.";
    exit;
}

$calisanlar = $conn->query("SELECT Id, Name, Surname FROM calisanlar");
$muayene_turleri = $conn->query("SELECT Id, TypeName FROM muayene_turleri");

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Muayene Düzenle</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"],
        input[type="date"],
        textarea,
        select {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
            box-sizing: border-box;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form id="update" method="post" action="update_muayene.php">
        <h1>Muayene Düzenle</h1>
        
        <input type="hidden" name="id" value="<?php echo $row['Id']; ?>">

        <label for="WorkerId">Çalışan:</label>
        <select id="WorkerId" name="WorkerId" required>
            <?php while ($calisan = $calisanlar->fetch_assoc()) { ?>
                <option value="<?php echo $calisan['Id']; ?>" <?php if ($calisan['Id'] == $row['WorkerId']) echo 'selected'; ?>>
                    <?php echo $calisan['Name'] . ' ' . $calisan['Surname']; ?>
                </option>
            <?php } ?>
        </select>

        <label for="ExaminationDate">Muayene Tarihi:</label>
        <input type="date" id="ExaminationDate" name="ExaminationDate" value="<?php echo $row['ExaminationDate']; ?>" required>
        
        <label for="ExaminationTypeId">Muayene Türü:</label>
        <select id="ExaminationTypeId" name="ExaminationTypeId" required>
            <?php while ($tur = $muayene_turleri->fetch_assoc()) { ?>
                <option value="<?php echo $tur['Id']; ?>" <?php if ($tur['Id'] == $row['ExaminationTypeId']) echo 'selected'; ?>>
                    <?php echo $tur['TypeName']; ?>
                </option>
            <?php } ?>
        </select>
        
        <label for="Results">Sonuçlar:</label>
        <textarea id="Results" name="Results" rows="4" required><?php echo $row['Results']; ?></textarea>
        
        <input type="submit" value="Kaydet">
    </form>
</body>
</html>
