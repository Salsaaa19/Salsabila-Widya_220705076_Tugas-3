<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "pendaftaran_lomba");

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['nomor'];
$tanggal_pendaftaran = $_POST['tanggal_pendaftaran'];
$umur = $_POST['umur'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$kategori_lomba = $_POST['kategori_lomba'];
$status = $_POST['status'];
$pesan = $_POST['pesan'];

// Simpan data ke tabel
$sql = "INSERT INTO pendaftar (name, email, phone, tanggal_pendaftaran, umur, jenis_kelamin, kategori_lomba, status, pesan)
        VALUES ('$name', '$email', '$phone', '$tanggal_pendaftaran', $umur, '$jenis_kelamin', '$kategori_lomba', '$status', '$pesan')";

if ($conn->query($sql) === TRUE) {
    // Redirect ke halaman pendaftaran berhasil
    header("Location: pendaftaran_berhasil.html");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
