<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Hasil Pencarian</title>
</head>
<body>
    <div class="container">
        <h2>Hasil Pencarian</h2>
        <form action="search.php" method="GET" class="search-form">
            <input type="text" name="query" placeholder="Cari berdasarkan nama" required>
            <button type="submit" class="btn-search">Cari</button>
        </form>
        <a href="index.php" class="btn">Kembali ke Daftar Pengguna</a>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Tanggal Pendaftaran</th>
                        <th>Umur</th>
                        <th>Jenis Kelamin</th>
                        <th>Kategori Lomba</th>
                        <th>Status</th>
                        <th>Pesan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_GET['query'])) {
                        $query = $_GET['query'];

                        // Koneksi ke database
                        $conn = new mysqli("localhost", "root", "", "pendaftaran_lomba");
                        if ($conn->connect_error) {
                            die("Koneksi gagal: " . $conn->connect_error);
                        }

                        // Mengambil data dari tabel berdasarkan pencarian
                        $sql = "SELECT * FROM pendaftar WHERE name LIKE '%$query%'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>" . $row["id"] . "</td>
                                        <td>" . $row["name"] . "</td>
                                        <td>" . $row["email"] . "</td>
                                        <td>" . $row["phone"] . "</td>
                                        <td>" . $row["tanggal_pendaftaran"] . "</td>
                                        <td>" . $row["umur"] . "</td>
                                        <td>" . $row["jenis_kelamin"] . "</td>
                                        <td>" . $row["kategori_lomba"] . "</td>
                                        <td>" . $row["status"] . "</td>
                                        <td>" . $row["pesan"] . "</td>
                                        <td>
                                            <a href='update.php?id=" . $row["id"] . "' class='btn-edit'>Edit</a>
                                            <a href='delete.php?id=" . $row["id"] . "' class='btn-delete'>Hapus</a>
                                        </td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='11'>Tidak ada data yang ditemukan</td></tr>";
                        }
                        $conn->close();
                    } else {
                        echo "<tr><td colspan='11'>Masukkan kata kunci pencarian</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>