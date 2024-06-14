<?php
session_start();
ob_start();

require_once 'config.php';

// Kullanıcı adı ve şifre 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kullanıcı adı ve şifre
    $username = $_POST['username'];
    $password = $_POST['password'];

    //şifre 
    $sql = "SELECT * FROM kullanicilar WHERE kullanici_adi = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_password = $row['sifre'];
        $_SESSION['kullanici_idsiii'] = $row['id'];

        // şifreyi kontrol edin
        if (password_verify($password, $stored_password)) {
            // Şifre doğruysa, başarılı giriş
            if ($username === 'admin') {
               // header("Location: basari.php"); // Admin paneline 

           header("Location: anasayfa.php"); // Admin paneli
                exit;
            } else {
               // header("Location: basari.php"); // Admin paneline 

             header("Location: anasayfa.php"); 
                exit;
            }
        } else {
            // Hatalı giriş
            echo '<script>alert("Kullanıcı adı veya .şifre yanlış."); window.location="login.html";</script>'; // Hatalı giriş
        }
    } else {
        // Kullanıcı adı bulunamadı
        echo '<script>alert(".Kullanıcı adı veya şifre yanlış."); window.location="login.html";</script>'; // Hatalı giriş 
        exit;
    }
}
ob_end_flush();

?>
