<?php
// Session başlat
session_start();
ob_start();
/*
$responsa12=     $_SESSION['sql1']."-------"  .$_SESSION['sql2'];
<div>
        <?php echo $responsa12."<br>"; ?>
    </div>
    <div>
        <?php echo $responsa11."<br>"; ?>
    </div>

$responsa11=  $_SESSION['kullanici_id'];
*/
// $_SESSION['response'] içeriğini al
/*
$responsa1 =$_SESSION['resim_yolu'];
$responsa2 =$_SESSION['resim_yolu1'];
$responsa3 =$_SESSION['resim_yolu2'];

$responsa4 =$_SESSION['resim_yolu3'];
$responsa5 =$_SESSION['resim_yolu_bu'];
$responsa6=$_SESSION['response1'] ;
*/
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paylaşım Başarılı</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
            background-image: url('background.jpg'); /* Arkaplan resmi */
            background-size: cover;
            color: #fff; /* Beyaz metin renk */
        }
        .success-message {
            font-size: 36px;
            color: #fff; /* Beyaz metin renk */
            margin-bottom: 20px;
        }
        .image-container {
            margin-bottom: 20px;
        }
        .image-container img {
            width: 512px;
            height: 512px;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .index-button {
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #007bff; /* Mavi tonu */
            color: #fff; /* Beyaz metin renk */
            text-decoration: none;
            margin-top: 20px;
            display: inline-block;
        }
        .index-button:hover {
            background-color: #0056b3; /* Koyu mavi tonu */
        }
    </style>
</head>
<body>
    <div class="success-message">BAŞARIYLA PAYLAŞILDI</div>
    
    <div class="image-container">
        <img src="thumbsup.png" alt="512x512 Fotoğraf">
    </div>
    <a href="index.html" class="index-button">Anasayfaya Dön</a>
</body>
</html>
