<?php
session_start();

// Hapus semua data sesi
session_unset();
session_destroy();

// Redirect ke halaman utama
header('Location: index.php');
?>
