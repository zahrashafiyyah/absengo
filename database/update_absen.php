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

// Ambil data dari formulir
$id = $_POST['id'];
$nama = $_POST['nama'];
$nis = $_POST['nis'];
$kelas = $_POST['kelas'];
$jurusan = $_POST['jurusan'];
$tanggal = $_POST['tanggal'];
$status = $_POST['status'];

// Query update data
$sql = "UPDATE absensi2 SET 
        nama_lengkap='$nama', 
        nis='$nis', 
        kelas='$kelas', 
        jurusan='$jurusan', 
        tanggal='$tanggal', 
        status_absen='$status' 
        WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Data berhasil diupdate'); window.location.href = '../laporan_absen.php';</script>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
