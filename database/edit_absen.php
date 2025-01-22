<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "absengo";

// Koneksi ke database
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data berdasarkan ID
if (isset($_GET['id'])) { // Gunakan parameter 'id' dari URL
    $id = $_GET['id'];

    // Query untuk mendapatkan data
    $stmt = $conn->prepare("SELECT * FROM absensi2 WHERE id_user = ?"); // Pastikan kolom id_user ada di database
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if (!$data) {
        die("Data tidak ditemukan.");
    }
} else {
    die("ID tidak ditemukan.");
}

// Proses penyimpanan data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_user']; // Ambil ID dari hidden input
    $nama = $_POST['nama_lengkap'];
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status_absen'];

    // Query update data
    $stmt = $conn->prepare("UPDATE absensi2 SET nama_lengkap = ?, nis = ?, kelas = ?, jurusan = ?, tanggal = ?, status_absen = ? WHERE id_user = ?");
    $stmt->bind_param("ssssssi", $nama, $nis, $kelas, $jurusan, $tanggal, $status, $id);

    if ($stmt->execute()) {
        header("Location: rekapabsen.php?pesan=sukses");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Absen - AbsenGo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #42b3f5;
            text-align: center;
            padding: 50px;
        }
        .form-container {
            display: inline-block;
            text-align: left;
            background: #fff;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            width: 400px;
        }
        h2 {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            font-size: 24px;
            margin-bottom: 20px;
        }
        h2 img {
            width: 50px;
            height: 50px;
        }
        label {
            font-size: 16px; 
            margin-bottom: 5px;
            display: block;
        }
        input[type="text"], input[type="date"], select {
            padding: 10px; 
            font-size: 14px; 
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            margin-bottom: 15px;
            display: block;
            width: 100%;
        }
        select {
            height: 40px;
        }
        button {
            width: 100%;
            padding: 14px; 
            font-size: 16px; 
            background-color: #62d9f0;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background-color: #1800f0;
        }
        .link {
            text-align: center;
            margin-top: 15px;
        }
        .link a {
            text-decoration: none;
            color: #007bff;
        }
        .link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>
        <img src="../gambar/edit.png" alt="Edit Icon">
            Edit Absen
        </h2>
        <form action="" method="post">
            <!-- Hidden input untuk menyimpan ID -->
            <input type="hidden" name="id_user" value="<?php echo $data['id_user']; ?>">
            
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?php echo $data['nama_lengkap']; ?>" required>
            
            <label for="nis">NIS</label>
            <input type="text" id="nis" name="nis" value="<?php echo $data['nis']; ?>" required>
            
            <label for="kelas">Kelas</label>
            <input type="text" id="kelas" name="kelas" value="<?php echo $data['kelas']; ?>" required>
            
            <label for="jurusan">Jurusan</label>
            <input type="text" id="jurusan" name="jurusan" value="<?php echo $data['jurusan']; ?>" required>
            
            <label for="tanggal">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" value="<?php echo $data['tanggal']; ?>" required>
            
            <label for="status_absen">Status Absen</label>
            <select id="status_absen" name="status_absen" required>
                <option value="Hadir" <?php if ($data['status_absen'] == 'Hadir') echo 'selected'; ?>>Hadir</option>
                <option value="Sakit" <?php if ($data['status_absen'] == 'Sakit') echo 'selected'; ?>>Sakit</option>
                <option value="Izin" <?php if ($data['status_absen'] == 'Izin') echo 'selected'; ?>>Izin</option>
            </select>
            
            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
