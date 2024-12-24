<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn = new mysqli("localhost", "root", "", "pendaftaran_lomba");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Hapus data berdasarkan ID
    $sql = "DELETE FROM pendaftar WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // Perbarui ID agar berurutan kembali
        $sql_update_id = "SET @num := 0; UPDATE pendaftar SET id = @num := (@num+1); ALTER TABLE pendaftar AUTO_INCREMENT = 1;";
        if ($conn->multi_query($sql_update_id)) {
            do {
                // Skip hasil sementara dari multi_query
                if ($result = $conn->store_result()) {
                    $result->free();
                }
            } while ($conn->next_result());
        }

        header("Location: index.php");
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
