<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Yeni kullanıcıyı kaydet
    // (Bu kısımda veritabanı işlemleri veya başka bir kayıt mekanizması kullanılabilir)
    echo "Hesap oluşturuldu! Kullanıcı adı: $username";
}
?>
