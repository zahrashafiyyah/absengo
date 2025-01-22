<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "absengo");

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_lengkap = $conn->real_escape_string($_POST['nama_lengkap']);
    $nis = $conn->real_escape_string($_POST['nis']);

    // Query untuk memeriksa pengguna
    $query = "SELECT * FROM user WHERE nama_lengkap = ? AND nis = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $nama_lengkap, $nis);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($_POST['password'], $user['password'])) {
            // Redirect ke home.html
            if (!file_exists("../home.html")) {
                die("File home.html tidak ditemukan.");
            }
            header("Location: ../home.html");
            exit();
        } else {
            echo "Password salah!";
        }
    } else {
        echo "Nama lengkap atau NIS salah!";
    }

    $stmt->close();
}

$conn->close();
?>
