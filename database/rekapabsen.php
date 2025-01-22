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

// Ambil data dari tabel absensi
$sql = "SELECT * FROM absensi2"; // Sesuaikan nama tabel
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Data Absen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #42b3f5;
            text-align: center;
            margin: 0;
            padding-top: 60px; 
        }

        nav {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000; 
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            background-color: #007bff;
            overflow: hidden;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            padding: 15px 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        .container {
            margin: 20px auto;
            padding: 20px;
            max-width: 800px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 24px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        h2 img {
            width: 50px;
            height: 50px;
        }

        hr {
            border: 1px solid #ddd;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        table th {
            background-color: #007bff;
            color: white;
        }

        .no-data {
            text-align: center;
            color: #666;
        }

        .action-buttons a {
            text-decoration: none;
            color: white;
            padding: 8px 12px;
            margin: 0 5px;
            border-radius: 5px;
            background-color:rgb(0, 255, 174);
        }

        .action-buttons a:hover {
            background-color: #0056b3;
        }

        .action-buttons a.delete {
            background-color:rgb(226, 8, 1);
        }

        .action-buttons a.delete:hover {
            background-color: pink;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="../home.html">Home</a></li>
            <li><a href="../absensi.html">Absensi</a></li>
            <li><a href="../database/laporan_absen.php">Laporan Absensi</a></li>
            <li><a href="../admin.html">Admin</a></li>
        </ul>
    </nav>
    <div class="container">
        <h2>
        <img src="../gambar/laporanabsensi.png" alt="Laporan Icon">
            Rekap Data Absen
        </h2>
        <hr>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
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
                                <td class='action-buttons'>
                                    <a href='edit_absen.php?id={$row['id_user']}'>Edit</a>
                                    <a href='delete_absen.php?id={$row['id_user']}' class='delete' onclick=\"return confirm('Yakin ingin menghapus data ini?');\">Hapus</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='no-data'>Belum ada data absensi</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
