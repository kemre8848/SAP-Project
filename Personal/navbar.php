<?php
session_start();
include 'database.php';

if (!isset($_SESSION['kullanici_id'])) {
    header('Location: login.php');
    exit;
}

$database = new Database(); 

$rol_id = $_SESSION['rol_id'];

$sql = "SELECT rol_adi FROM roller WHERE id = ?";
$stmt = $database->prepare($sql);
$stmt->bind_param('i', $rol_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $rol = $result->fetch_assoc()['rol_adi'];
} else {
    $rol = ''; 
}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.navbar {
    background-color: #333;
    overflow: hidden;
    display: flex;
    justify-content: center; 
    align-items: center;
    padding: 10px 20px;
}

.navbar .nav-links {
    display: flex;
    list-style-type: none;
    margin: 0;
    padding: 0;
}

.navbar .nav-links li {
    margin: 0 10px; 
}

.navbar .nav-link {
    color: #f2f2f2;
    text-align: center;
    padding: 14px 20px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.navbar .nav-link:hover {
    background-color: #ddd;
    color: black;
}

.navbar .nav-link.active {
    background-color: #4CAF50;
    color: white;
}

.navbar .logout {
    color: #f2f2f2;
    text-decoration: none;
    padding: 14px 20px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.navbar .logout:hover {
    background-color: #ddd;
    color: black;
}

@media screen and (max-width: 600px) {
    .navbar .nav-links {
        flex-direction: column;
        align-items: flex-start;
    }

    .navbar .nav-link {
        display: block;
        text-align: left;
        padding: 10px;
    }
}

    </style>
</head>
<body>
    <div class="navbar">
        <ul class="nav-links">
            <?php if ($rol == 'admin' || $rol == 'human_resources') { ?>
                <li><span class="nav-link" onclick="OpenEmployeesPage();">Çalışanlar</span></li>
            <?php } ?>
            <?php if ($rol == 'admin' || $rol == 'infirmary') { ?>
                <li><span class="nav-link" onclick="OpenExaminationPage();">Muayene Kayıt</span></li>
           
            <?php } ?>
            <?php if ($rol == 'admin' || $rol == 'quality_control') { ?>
                <li><span class="nav-link" onclick="OpenEducationPage();">Eğitim Kayıt</span></li>
            <?php } ?>
            <?php 
                if($rol == 'admin' || $rol == 'quality_control' || $rol == 'infirmary'){ ?>
                    <li><span class="nav-link" onclick="OpenCertificatePage();">Sertifika Kayıt</span></li>
                <?php } ?>
            <?php if ($rol == 'admin') { ?>
                <li><a class="nav-link" href="admin_index.php">Admin</a></li>
            <?php } ?>
        </ul>
        <a class="logout" href="logout.php">Çıkış</a>
    </div>
</body>
</html>
