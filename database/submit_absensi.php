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

// Ambil data dari form
$nama_lengkap = $_POST['nama_lengkap'];
$nis = $_POST['nis'];
$kelas = $_POST['kelas'];
$jurusan = $_POST['jurusan'];
$tanggal = date("Y-m-d"); // Tanggal otomatis hari ini
$status_absen = $_POST['status_absen'];

// Insert data ke tabel
$sql = "INSERT INTO absensi2 (nama_lengkap, nis, kelas, jurusan, tanggal, status_absen)
        VALUES ('$nama_lengkap', '$nis', '$kelas', '$jurusan', '$tanggal', '$status_absen')";

if ($conn->query($sql) === TRUE) {
    echo "Data absensi berhasil disimpan!";
    header("Location: laporan_absen.php"); // Redirect ke laporan
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
