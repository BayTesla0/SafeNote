<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kullanıcı adı ve şifreyi kontrol et
    // (Bu kısımda veritabanı işlemleri veya başka bir kontrol mekanizması kullanılabilir)
    if ($username === "admin" && $password === "password") {
        echo "Giriş başarılı!";
    } else {
        echo "Kullanıcı adı veya şifre yanlış!";
    }
}
?>
