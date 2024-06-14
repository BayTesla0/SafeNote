<?php

class Config {
    const gizli_key = 'aaaassssddddffffaaaassssddddffff';
    
}
define('DB_SERVER', 'hcn.h.filess.io');
define('DB_USERNAME', 'PASSNotes_placefresh');
define('DB_PASSWORD', '0823bdba379c80bfed893a1d4a9b02dc746ff838');
define('DB_NAME', 'PASSNotes_placefresh');

/* MySQL bağlantısı kurma */
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Bağlantıyı kontrol et
if($conn->connect_error){
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>
