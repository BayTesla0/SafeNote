<?php
session_start();
require_once 'private/config.php';

if (!isset($_SESSION['kullanici_idsiii']) || $_SESSION['kullanici_idsiii'] === null || $_SESSION['kullanici_idsiii'] === 0) {
    header("Location: login.html");
    exit();
}
$key = Config::gizli_key;;

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


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['not_metni'])) {
    $not_metni = htmlspecialchars($_POST['not_metni'], ENT_QUOTES, 'UTF-8');
    $not_tarihi = date("Y-m-d H:i:s");
    $kullanici_id = $_SESSION['kullanici_idsiii'];
    $encrypted_not_metni = encrypt($not_metni, $key);

    $stmt = $conn->prepare("INSERT INTO notlar (kullanici_id, not_metni, not_tarihi) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $kullanici_id, $encrypted_not_metni, $not_tarihi);

    if ($stmt->execute()) {
        header("Location: anasayfa.php");
        exit();
    } else {
        echo "Not eklenirken bir hata oluştu.";
    }

    $stmt->close();
}

if (isset($_GET['logout'])) {
    $_SESSION['kullanici_idsiii'] = null;
    session_destroy();
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notlar Sayfası</title>    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/png" href="favicon.png">

    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            background-color: black;
            color: white;
            overflow-y: auto;
            position: relative;
        }
        .menu {
            width: 100%;
            background-color: #333;
            overflow: hidden;
            padding: 10px 0;
        }
        .menu a {
            float: right;
            color: white;
            text-align: center;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 17px;
        }
        .menu a.logout {
            background-color: gray;
        }
        .menu a.imha {
            background-color: red;
        }
        h2 {
            margin-top: 20px;
        }
        form {
            margin: 20px 0;
            text-align: center;
        }
        textarea {
            width: 500px;
            height: 222px;
            margin-bottom: 10px;
            background-color: black;
            color: green;
        }
        button {
            padding: 13px 20px;
            background-color: gray;
            color: greenyellow;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            word-break: break-word;
            white-space: normal;
        }
        th {
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="menu">
        <a href="anasayfa.php?logout=true" class="logout">Çıkış Yap</a>
        <a href="imha.php" class="imha">İmha</a>
    </div>
    <h2>Notlar</h2>
    <form method="post" action="anasayfa.php">
        <label for="not_metni">Yeni Not:</label><br>
        <textarea id="not_metni" name="not_metni" rows="4" cols="50" required></textarea><br>
        <button type="submit">Not Ekle</button>
    </form>
    <table>
        <tr>
            <th>Tarih ve Saat</th>
            <th>Not Metni</th>
        </tr>
        <?php
        $query = "SELECT not_tarihi, not_metni FROM notlar WHERE kullanici_id = ? ORDER BY not_tarihi DESC";
        
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("i", $_SESSION['kullanici_idsiii']);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $decrypted_not_metni = decrypt($row['not_metni'], $key);
                echo "<tr>";
                echo "<td style='white-space: nowrap;'>".$row['not_tarihi']."</td>";
                echo "<td>".htmlspecialchars($decrypted_not_metni, ENT_QUOTES, 'UTF-8')."</td>";
                echo "</tr>";
            }

            $stmt->close();
        } else {
            echo "Sorgu hazırlanamadı.";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>
