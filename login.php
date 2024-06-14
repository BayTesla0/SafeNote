<?php
session_start();
ob_start();

// Veritabanı bağlantısını dahil etme
// Veritabanı bilgileri
require_once 'private/config.php';

// Kullanıcı adı ve şifre kontrolü
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kullanıcı adı ve şifre
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kullanıcı adı ve şifre kontrolü
    $sql = "SELECT * FROM kullanicilar WHERE kullanici_adi = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_password = $row['sifre'];
        $_SESSION['kullanici_idsiii'] = $row['id'];

        // Kullanıcının girdiği şifreyi kontrol edin
        if (password_verify($password, $stored_password)) {
            // Şifre doğruysa, başarılı giriş
            if ($username === 'admin') {
               // header("Location: basari.php"); // Admin paneline yönlendir

           header("Location: anasayfa.php"); // Admin paneline yönlendir
                exit;
            } else {
               // header("Location: basari.php"); // Admin paneline yönlendir

             header("Location: anasayfa.php"); //   için hoş geldiniz sayfasına yönlendir
                exit;
            }
        } else {
            // Hatalı giriş
            echo '<script>alert("Kullanıcı adı veya .şifre yanlış."); window.location="login.html";</script>'; // Hatalı giriş durumunda uyarı mesajı ve tekrar giriş sayfasına yönlendirme
            exit;
        }
    } else {
        // Kullanıcı adı bulunamadı
        echo '<script>alert(".Kullanıcı adı veya şifre yanlış."); window.location="login.html";</script>'; // Hatalı giriş durumunda uyarı mesajı ve tekrar giriş sayfasına yönlendirme
        exit;
    }
}
ob_end_flush();

?>
