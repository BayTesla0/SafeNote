<?php
session_start();
require_once 'private/config.php';

$key = 'aaaassssddddffffaaaassssddddffff';

function encrypt($data, $key) {
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
    return base64_encode($encrypted . '::' . $iv);
}

function decrypt($data, $key) {
    $parts = explode('::', base64_decode($data), 2);
    if (count($parts) !== 2) {
        return "Geçersiz veri";
    }
    list($encrypteddata, $iv) = $parts;
    return openssl_decrypt($encrypteddata, 'aes-256-cbc', $key, 0, $iv);
}

// Yanlış giriş
if (!isset($_SESSION['wrong_attempts'])) {
    $_SESSION['wrong_attempts'] = 0;
}

// Kullanıcı adı ve şifre 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $imha_onay = $_POST['imha_onay'];

    //  doğrulama
    $stmt = $conn->prepare("SELECT * FROM kullanicilar WHERE kullanici_adi = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_password = $row['sifre'];

        if (password_verify($password, $stored_password) && strtoupper($imha_onay) === 'İMHA ET') {
            // Notları silme
            $stmt = $conn->prepare("DELETE FROM notlar WHERE kullanici_id = ?");
            $stmt->bind_param("i", $_SESSION['kullanici_idsiii']);
            $stmt->execute();
            header("Location: anasayfa.php");

            echo "Notlar başarıyla silindi.";
        } else {
            $_SESSION['wrong_attempts']++;
            if ($_SESSION['wrong_attempts'] >= 5) {
                $_SESSION['kullanici_idsiii'] = null;
                session_destroy();
                echo '<script>alert("Çok fazla deneme yaptınız ,oturumunuz sonlandırıldı."); window.location="login.html";</script>';
                exit();
            }
            echo "Kullanıcı adı, şifresi veya onay metni yanlış.";
        }
    } else {
        $_SESSION['wrong_attempts']++;
        if ($_SESSION['wrong_attempts'] >= 5) {
            $_SESSION['kullanici_idsiii'] = null;
            session_destroy();        
            echo '<script>alert("Çok fazla deneme yaptınız ,oturumunuz sonlandırıldı."); window.location="login.html";</script>';
            exit();
        
        }
        echo "Kullanıcı adı veya şifre yanlış ya da İMHA ONAY metni yanlış.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İmha Sayfası</title>
    <h1 style="color: RED; font-size: 36px;">İMHA DOĞRULAMA</h1>

    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: black;
            color: white;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        input {
            margin-bottom: 10px;
            padding: 10px;
            width: 200px;
        }
        button {
            padding: 10px 20px;
            background-color: red;
            color: white;
            border: none;
            cursor: pointer;
        }
        img {
            width: 100px;
            height: 50px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <form method="post" action="imha.php">

    <input type="text" name="username" placeholder="Kullanıcı Adı" required>
        <input type="password" name="password" placeholder="Şifre" required>
        <img src="GGAGGUGU.jpeg" alt="Imha Resmi">

        <input type="text" name="imha_onay" placeholder="Resimdeki Metin" required, autocomplete="off">
       

        <button type="submit">Siliyorum</button>
    </form>



</body>
</html>
