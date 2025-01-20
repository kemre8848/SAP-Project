<?php
include 'database.php';
use \Firebase\JWT\JWT;


define('SECRET_KEY', 'TURKIYE');
define('ALGORITHM', 'HS256');


$authHeader = isset($_COOKIE['jwt']) ? $_COOKIE['jwt'] : null;

if ($authHeader) {
    try {
        $decoded = JWT::decode($authHeader, SECRET_KEY, array(ALGORITHM));

        $_SESSION['kullanici_id'] = $decoded->sub;
        $_SESSION['rol_id'] = $decoded->rol_id;
    } catch (Exception $e) {
        echo "Token geçersiz!";
        exit();
    }
} else {

    echo "Giriş yapmanız gerekiyor!";
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Anasayfa</title>

</head>
<body>

</body>
</html>
