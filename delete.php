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

// Cek apakah ID ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data orang berdasarkan ID
    $sql = "DELETE FROM tambah_data_db WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman daftar (index.php) setelah penghapusan
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "ID tidak ditemukan.";
}

$conn->close();
?>