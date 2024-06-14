<?php
    require_once 'private/config.php';


// Kullanıcılar tablosunu oluşturma
$sql = "ALTER TABLE notlar ADD imha_kodu VARCHAR(255);

";

if ($conn->query($sql) === TRUE) {
    echo "Kullanıcılar tablosu başarıyla oluşturuldu\n";
} else {
    echo "Tablo oluşturma hatası: " . $conn->error;
}

// Notlar tablosunu oluşturma
$sql = "CREATE TABLE IF NOT EXISTS notlar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    not_metni TEXT NOT NULL,
    not_tarihi DATE NOT NULL,
    kullanici_id INT,
    FOREIGN KEY (kullanici_id) REFERENCES kullanicilar(id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Notlar tablosu başarıyla oluşturuldu\n";
} else {
    echo "Tablo oluşturma hatası: " . $conn->error;
}

// MySQL bağlantısını kapatma
$conn->close();
?>
