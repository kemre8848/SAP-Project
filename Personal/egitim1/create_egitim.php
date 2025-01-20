<?php
include '../db.php';


$sql = "SELECT Id, EducationName FROM egitimturleri";
$edu_result = $conn->query($sql);

if (!$edu_result) {
    die("Sorgu hatası: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Yeni Eğitim Ekle</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 15px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        select, input[type="date"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    
    <form method="post" action="store_egitim.php">
    <h1>Yeni Eğitim Ekle</h1>
        <label for="WorkerId">Çalışan:</label>
        <select id="WorkerId" name="WorkerId" required>
            <?php
            include '../db.php';

            $sql = "SELECT Id, Name, Surname FROM calisanlar WHERE DepartmentId = 5 AND IsActive = 1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['Id'] . "'>" . $row['Name'] . " " . $row['Surname'] . "</option>";
                }
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
                    echo "<option value='" . $edu['Id'] . "'>" . $edu['EducationName'] . "</option>";
                }
            }
            $conn->close();
            ?>
        </select>

        <label for="EducationDate">Eğitim Tarihi:</label>
        <input type="date" id="EducationDate" name="EducationDate" required>

        <input type="submit" value="Kaydet">
    </form>
</body>
</html>



