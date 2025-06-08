<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "Buku_tamu";

$db = mysqli_connect($hostname, $username, $password, $database_name);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Membuat koneksi
    $db = new mysqli($hostname, $username, $password, $database_name);

    // Set charset (opsional tapi disarankan)
    $db->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    // Tangani error koneksi
    echo "Koneksi database gagal: " . $e->getMessage();
    exit;
}

?>