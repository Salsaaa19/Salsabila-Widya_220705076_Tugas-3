<?php
include "../koneksi.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa username
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Periksa password
        if ($password == $user['password']) {
            $_SESSION['username'] = $username;
            header("Location:../dashboard/main_menu.php"); // Redirect ke dashboard
            echo "Login Berhasil";
            exit;
        } else {
            echo "Password Salah";
        }
    } else {
        echo "Username Tidak Ditemukan";
    }
    $stmt->close();
}

$conn->close();
?>
