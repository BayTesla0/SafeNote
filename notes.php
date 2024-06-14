<?php
session_start();
require_once 'private/config.php';

// notlarını almak için sorgu
$query = "SELECT not_tarihi, not_metni FROM notlar WHERE kullanici_id = ?";

if ($stmt = $conn->prepare($query)) {
    // ? işaretine session'dan gelen kullanıcı id'sini bağlama
    $stmt->bind_param("i", $_SESSION['kullanici_idsiii']);

    // Sorguyu çalıştırma
    $stmt->execute();

    // Sonuçları al
    $result = $stmt->get_result();

    // Sonuçları işleme
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['not_tarihi']."</td>";
        echo "<td>".$row['not_metni']."</td>";
        echo "</tr>";
    }

    // Bağlantıyı kapat
    $stmt->close();
} else {
    echo "Sorgu hazırlanamadı.";
}

$conn->close();
?>
