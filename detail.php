<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah ID ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data orang berdasarkan ID
    $sql = "SELECT * FROM tambah_data_db WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Ambil data orang
        $row = $result->fetch_assoc();
        $nama = $row['nama'];
        $tempat_lahir = $row['tempat_lahir'];
        $tanggal_lahir = $row['tanggal_lahir'];
        $umur = $row['umur'];
        $jenis_kelamin = $row['jenis_kelamin'];
        $pekerjaan = $row['pekerjaan'];
        $alamat = $row['alamat'];
        $tanggal_penangkapan = $row['tanggal_penangkapan'];
    } else {
        echo "Data tidak ditemukan.";
        exit();
    }
} else {
    echo "ID tidak ditemukan.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Orang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        p {
            font-size: 16px;
            margin: 10px 0;
            line-height: 1.6;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border-radius: 6px;
            text-align: center;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .back-btn {
            background-color: #6c757d;
        }

        .back-btn:hover {
            background-color: #5a6268;
        }

        .delete-btn {
            background-color: #dc3545;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        .btn-container {
            text-align: center;
            margin-top: 20px;
        }

        .btn-container a {
            margin: 0 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Detail Orang</h1>

    <table>
        <tr>
        <th>Field</th>
        <th>Value</th>
        </tr>
        <tr>
            <td>Nama</td>
            <td><?php echo htmlspecialchars($nama); ?></td>
        </tr>
        <tr>
            <td>Tempat Lahir</td>
            <td><?php echo htmlspecialchars($tempat_lahir); ?></td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td><?php echo htmlspecialchars($tanggal_lahir); ?></td>
        </tr>
        <tr>
            <td>Umur</td>
            <td><?php echo htmlspecialchars($umur); ?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td><?php echo htmlspecialchars($jenis_kelamin); ?></td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td><?php echo htmlspecialchars($pekerjaan); ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td><?php echo htmlspecialchars($alamat); ?></td>
        </tr>
        <tr>
            <td>Tanggal Penangkapan</td>
            <td><?php echo htmlspecialchars($tanggal_penangkapan); ?></td>
        </tr>
    </table>

    <a href="edit.php?id=<?php echo $id; ?>" class="btn">Edit</a>
    <a href="index.php" class="btn back-btn">Kembali ke Daftar</a>
    <a href="delete.php?id=<?php echo $id; ?>" class="btn delete-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
</div>

</body>
</html>