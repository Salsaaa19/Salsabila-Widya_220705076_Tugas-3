<?php
// Koneksi ke database
    $conn = new mysqli("localhost", "root", "", "pendaftaran_lomba");
    if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>