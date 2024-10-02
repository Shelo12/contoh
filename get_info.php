<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data_orang_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil ID dari parameter GET
$id = intval($_GET['id']);

// Query untuk mengambil detail orang berdasarkan ID
$sql = "SELECT * FROM tambah_data_db WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Menampilkan informasi orang
    $row = $result->fetch_assoc();
    echo "<strong>Nama:</strong> " . $row['nama'] . "<br>";
    echo "<strong>Tempat Lahir:</strong> " . $row['tempat_lahir'] . "<br>";
    echo "<strong>Tanggal Lahir:</strong> " . $row['tanggal_lahir'] . "<br>";
    echo "<strong>Umur:</strong> " . $row['umur'] . "<br>";
    echo "<strong>Jenis Kelamin:</strong> " . $row['jenis_kelamin'] . "<br>";
    echo "<strong>Pekerjaan:</strong> " . $row['pekerjaan'] . "<br>";
    echo "<strong>Alamat:</strong> " . $row['alamat'] . "<br>";
    echo "<strong>Tanggal Penangkapan:</strong> " . $row['tanggal_penangkapan'] . "<br>";
} else {
    echo "Data tidak ditemukan.";
}

$conn->close();
?>