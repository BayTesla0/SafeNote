
    <?php
    // Veritabanı bağlantısı
    require_once 'private/config.php';
    // Form verilerini al
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    

    $sql = "SELECT * FROM kullanicilar WHERE kullanici_adi='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Bu kullanıcı adı zaten kullanılıyor.";
    } else {
        $sql = "SELECT * FROM kullanicilar WHERE e_posta='$email'";
        $result = $conn->query($sql);
    
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        if ($result->num_rows > 0) {
            echo "Bu e-posta zaten kullanılıyor.";
        } else {
            // Eğer kullanıcı adı ve e-posta benzersizse, kullanıcıyı veritabanına kaydet
            $sql = "INSERT INTO kullanicilar (kullanici_adi, e_posta, sifre) VALUES ('$username', '$email', '$hashedPassword')";
            if ($conn->query($sql) === TRUE) {
                echo "Başarılı";
             } else {
                echo "Hata: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $conn->close();
    ?>
    