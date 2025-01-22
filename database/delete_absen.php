<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$database = "absengo";

$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID dari URL
$id = $_GET['id_user'];

// Query hapus data
$sql = "DELETE FROM absensi2 WHERE id_user = $id";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Data berhasil dihapus'); window.location.href = 'laporan_absen.php';</script>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
