<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "absengo");

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form register
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_lengkap = $conn->real_escape_string($_POST['nama_lengkap']);
    $nis = $conn->real_escape_string($_POST['nis']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password

    // Query untuk menyimpan data
    $sql = "INSERT INTO user (nama_lengkap, nis, password) VALUES ('$nama_lengkap', '$nis', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location.href = '../login.html';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
