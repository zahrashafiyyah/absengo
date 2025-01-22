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

// Ambil data dari tabel absensi2
$sql = "SELECT * FROM absensi2"; // Ganti dengan nama tabel yang benar
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Absen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #4aa8ff;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .data-section {
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 800px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <section class="data-section">
        <h3>Laporan Absensi</h3>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id_user']}</td>
                            <td>{$row['nama_lengkap']}</td>
                            <td>{$row['nis']}</td>
                            <td>{$row['kelas']}</td>
                            <td>{$row['jurusan']}</td>
                            <td>{$row['tanggal']}</td>
                            <td>{$row['status_absen']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7' class='empty-message'>Belum ada data absensi</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>
