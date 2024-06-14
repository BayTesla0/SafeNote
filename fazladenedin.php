<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Yönlendir</title>
    <link rel="icon" type="image/png" href="favicon.png">

</head>
<body>

<script>
    // JavaScript ile alert kutusu oluşturuyoruz
    function showAlert() {
        alert("Tamam'a basarak login sayfasına yönlendirileceksiniz.");
        redirectToLogin();
    }

    // Yönlendirme işlemini gerçekleştiren fonksiyon
    function redirectToLogin() {
        window.location.href = "login.html";
    }
</script>

<!-- Sayfa yüklendiğinde showAlert fonksiyonunu çağırıyoruz -->
<script>
    showAlert();
</script>

</body>
</html>
