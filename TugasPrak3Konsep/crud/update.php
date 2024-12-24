<?php
$conn = new mysqli("localhost", "root", "", "pendaftaran_lomba");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM pendaftar WHERE id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $tanggal_pendaftaran = $row['tanggal_pendaftaran'];
        $umur = $row['umur'];
        $jenis_kelamin = $row['jenis_kelamin'];
        $kategori_lomba = $row['kategori_lomba'];
        $status = $row['status'];
        $pesan = $row['pesan'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $tanggal_pendaftaran = $_POST['tanggal_pendaftaran'];
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $kategori_lomba = $_POST['kategori_lomba'];
    $status = $_POST['status'];
    $pesan = $_POST['pesan'];

    $sql = "UPDATE pendaftar SET name='$name', email='$email', phone='$phone', tanggal_pendaftaran='$tanggal_pendaftaran', umur='$umur', jenis_kelamin='$jenis_kelamin', kategori_lomba='$kategori_lomba', status='$status', pesan='$pesan' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Daftar Peserta</title>
    <style>
        /* Mengatur gaya umum untuk body */
        body {
            font-family: Arial, sans-serif;
            background-color: #fbd4d4; /* Warna latar belakang sesuai gambar */
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px 0; /* Menambahkan jarak atas dan bawah */
            margin: 0;
            min-height: 100vh; /* Agar memenuhi tinggi layar */
        }

        /* Mengatur gaya container form */
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            width: 80%; /* Lebar responsif, maksimal 90% layar */
            max-width: 400px; /* Batas maksimal untuk layar besar */
            margin: 20px 0; /* Jarak atas dan bawah */
        }

        /* Mengatur spasi antar elemen di form */
        form label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        /* Input dan textarea */
        form input[type="text"],
        form input[type="email"],
        form input[type="tel"],
        form input[type="date"],
        form input[type="number"],
        form textarea,
        form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
            color: #333;
        }

        /* Radio button dan labelnya */
        form input[type="radio"] {
            margin-right: 10px;
        }

        form .radio-group label {
            display: inline-block;
            margin-right: 20px;
            font-weight: normal;
        }

        /* Gaya tombol */
        form button {
            width: 100%;
            padding: 12px;
            background-color: rgb(187, 234, 248); /* Warna tombol sesuai gambar */
            color: black;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        /* Hover efek untuk tombol */
        form button:hover {
            background-color: lightblue; /* Warna saat hover */
        }

        /* Mengatur textarea khusus */
        form textarea {
            resize: none;
            height: 80px;
        }

        /* Placeholder untuk dropdown */
        form select option[disabled] {
            color: #aaa;
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 600px) {
            form {
                padding: 15px; /* Mengurangi padding untuk layar kecil */
            }

            form button {
                padding: 10px; /* Menyesuaikan ukuran tombol */
                font-size: 14px; /* Menyesuaikan ukuran teks tombol */
            }
        }
    </style>
</head>
<body>

<form method="POST" action="">
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <!-- Nama -->
    <label>Nama Lengkap / Nama Tim :</label>
    <input type="text" name="name" value="<?php echo $name; ?>" required>

    <!-- Email -->
    <label>Email :</label>
    <input type="email" name="email" value="<?php echo $email; ?>" required>

    <!-- Nomor Telepon -->
    <label>Nomor Telepon :</label>
    <input type="text" name="phone" value="<?php echo $phone; ?>" required>

    <!-- Tanggal Pendaftaran -->
    <label>Tanggal Pendaftaran :</label>
    <input type="date" name="tanggal_pendaftaran" value="<?php echo $tanggal_pendaftaran; ?>" required>

    <!-- Umur Pendaftar -->
    <label>Umur Pendaftar :</label>
    <input type="number" name="umur" value="<?php echo $umur; ?>" min="0" required>

    <!-- Jenis Kelamin -->
    <label>Jenis Kelamin :</label>
    <div class="radio-group">
        <label>
            <input type="radio" name="jenis_kelamin" value="laki-laki" 
            <?php if (trim(strtolower($jenis_kelamin)) == "laki-laki") echo "checked"; ?>> Laki-Laki
        </label>
        <label>
            <input type="radio" name="jenis_kelamin" value="perempuan" 
            <?php if (trim(strtolower($jenis_kelamin)) == "perempuan") echo "checked"; ?>> Perempuan
        </label>
    </div>

    <!-- Kategori Lomba -->
    <label>Kategori Lomba :</label>
    <select name="kategori_lomba" required>
        <option value="" disabled>Pilih Kategori</option>
        <option value="Sepak Bola" <?php if ($kategori_lomba == "Sepak Bola") echo "selected"; ?>>Sepak Bola</option>
        <option value="Basket" <?php if ($kategori_lomba == "Basket") echo "selected"; ?>>Basket</option>
        <option value="Voli" <?php if ($kategori_lomba == "Voli") echo "selected"; ?>>Voli</option>
        <option value="Badminton" <?php if ($kategori_lomba == "Badminton") echo "selected"; ?>>Badminton</option>
        <option value="Lari 5 Km" <?php if ($kategori_lomba == "Lari 5 Km") echo "selected"; ?>>Lari 5 Km</option>
        <option value="Lari 10 Km" <?php if ($kategori_lomba == "Lari 10 Km") echo "selected"; ?>>Lari 10 Km</option>
    </select>

    <!-- Status Peserta -->
    <label>Status :</label>
    <div class="radio-group">
        <label>
            <input type="radio" name="status" value="pelajar" 
            <?php if (trim(strtolower($status)) == "pelajar") echo "checked"; ?>> Pelajar
        </label>
        <label>
            <input type="radio" name="status" value="mahasiswa" 
            <?php if (trim(strtolower($status)) == "mahasiswa") echo "checked"; ?>> Mahasiswa
        </label>
        <label>
            <input type="radio" name="status" value="umum" 
            <?php if (trim(strtolower($status)) == "umum") echo "checked"; ?>> Umum
        </label>
    </div>

    <!-- Pesan atau Komentar -->
    <label>Pesan dan Komentar:</label>
    <textarea name="pesan" rows="4" placeholder="Tuliskan pesan atau komentar Anda di sini"><?php echo $pesan; ?></textarea>

    <!-- Tombol Update -->
    <button type="submit">Update</button>
</form>
</body>
</html>
