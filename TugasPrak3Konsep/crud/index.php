<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>CRUD System</title>
</head>
<body>
    <div class="container">
        <h2>Daftar Peserta</h2>
        
        <!-- Search Form -->
        <form action="search.php" method="GET" class="search-form">
            <input type="text" name="query" placeholder="Cari berdasarkan nama" required>
            <button type="submit" class="btn-search">Cari</button>
        </form>
        <a href="../dashboard/index.html" class="btn">Logout</a>
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
                    // Koneksi ke database
                    $conn = new mysqli("localhost", "root", "", "pendaftaran_lomba");
                    if ($conn->connect_error) {
                        die("Koneksi gagal: " . $conn->connect_error);
                    }

                    // Pengaturan pagination
                    $limit = 5; // Jumlah data per halaman
                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $offset = ($page - 1) * $limit;

                    // Mengambil jumlah total data
                    $sql_count = "SELECT COUNT(*) AS total FROM pendaftar";
                    $result_count = $conn->query($sql_count);
                    $total_data = $result_count->fetch_assoc()['total'];
                    $total_pages = ceil($total_data / $limit);

                    // Mengambil data untuk halaman saat ini
                    $sql = "SELECT * FROM pendaftar LIMIT $limit OFFSET $offset";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo"<tr>
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
                            echo"<tr>
                                    <td colspan='11'>Tidak ada data</td>
                                </tr>";
                    }
                    $conn->close();

                    ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <?php if ($total_pages > 1): ?>
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?>" class="page-link">Previous</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>" class="page-link <?php if ($page == $i) echo 'active'; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?php echo $page + 1; ?>" class="page-link">Next</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
