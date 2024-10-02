<?php
session_start();

// Cek apakah pengguna sudah mengunjungi halaman home
if (!isset($_SESSION['visited_home'])) {
    // Jika belum, arahkan ke halaman home
    header("Location: home.php");
    exit();
}
?>

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

// Ambil kategori dari database
$categories = [];
$cat_sql = "SELECT DISTINCT kategori FROM tambah_data_db"; // Perbaikan query
$cat_result = $conn->query($cat_sql);

if ($cat_result && $cat_result->num_rows > 0) {
    while ($cat_row = $cat_result->fetch_assoc()) {
        $categories[] = $cat_row['kategori'];
    }
}

// Cek apakah dropdown dipilih
$selected_category = isset($_POST['category']) ? $_POST['category'] : '';
$selected_week = isset($_POST['week']) ? $_POST['week'] : '';
$selected_month = isset($_POST['month']) ? $_POST['month'] : '';
$selected_year = isset($_POST['year']) ? $_POST['year'] : '';

// Query untuk mengambil daftar orang berdasarkan kategori yang dipilih
$sql = "SELECT id, nama, DATE_FORMAT(tanggal_input, '%Y-%m-%d') as tanggal FROM tambah_data_db WHERE 1=1";

if ($selected_category) {
    $sql .= " AND kategori = '$selected_category'"; // Pastikan kolom "kategori" ada di tabel
}

// Filter berdasarkan minggu
if ($selected_week) {
    $sql .= " AND WEEK(tanggal_input) = '$selected_week'";
}

// Filter berdasarkan bulan
if ($selected_month) {
    $sql .= " AND MONTH(tanggal_input) = '$selected_month'";
}

// Filter berdasarkan tahun
if ($selected_year) {
    $sql .= " AND YEAR(tanggal_input) = '$selected_year'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        h2 {
            color: #333;
            margin-top: 30px;
        }

        .person {
            margin: 5px 0;
            padding: 10px;
            background-color: #e9ecef;
            border-radius: 5px;
        }

        .person a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .person:hover {
            background-color: #cce5ff;
        }

        .container form {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
}

.dropdown-container {
    margin-right: 15px;
    margin-bottom: 0;
}

.dropdown-container select, .dropdown-container button {
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-right: 10px;
}

.dropdown-container button {
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    padding: 10px 20px;
}

.dropdown-container button:hover {
    background-color: #0056b3;
}

form {
    margin-bottom: 20px;
    width: 100%;
}

    </style>
</head>
<body>
    <a href="tambah_data.php" style="display: inline-block; margin-bottom: 20px; padding: 10px 20px; background-color: #0a0f56; color: white; text-decoration: none; border-radius: 5px; font-size: 1.1em;">Tambah Data Orang</a>

<div class="container">
    <h1>Daftar</h1>
   
    <form method="post" action="">
    <div class="dropdown-container">
        <label for="category">Pilih Kategori:</label>
        <select id="category" name="category">
            <option value="">-- Semua Kategori --</option>
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category ?>" <?= ($selected_category == $category) ? 'selected' : '' ?>><?= $category ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>

    <div class="dropdown-container">
        <label for="week">Pilih Minggu:</label>
        <select id="week" name="week">
            <option value="">-- Semua Minggu --</option>
            <?php for ($i = 1; $i <= 52; $i++): ?>
                <option value="<?= $i ?>" <?= ($selected_week == $i) ? 'selected' : '' ?>>Minggu ke-<?= $i ?></option>
            <?php endfor; ?>
        </select>
    </div>

    <div class="dropdown-container">
        <label for="month">Pilih Bulan:</label>
        <select id="month" name="month">
            <option value="">-- Semua Bulan --</option>
            <?php for ($m = 1; $m <= 12; $m++): ?>
                <option value="<?= $m ?>" <?= ($selected_month == $m) ? 'selected' : '' ?>><?= date('F', mktime(0, 0, 0, $m, 10)) ?></option>
            <?php endfor; ?>
        </select>
    </div>

    <div class="dropdown-container">
        <label for="year">Pilih Tahun:</label>
        <select id="year" name="year">
            <option value="">-- Semua Tahun --</option>
            <?php for ($y = 2020; $y <= date('Y'); $y++): ?>
                <option value="<?= $y ?>" <?= ($selected_year == $y) ? 'selected' : '' ?>><?= $y ?></option>
            <?php endfor; ?>
        </select>
    </div>

    <div class="dropdown-container">
        <button type="submit">Filter</button>
    </div>
</form>

    
    <h2>Nama</h2>

    <?php
    // Tampilkan daftar nama orang dengan link ke detail.php
    if($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Tampilkan nama sebagai link ke halaman detail.php
            echo "<div class='person'><a href='detail.php?id=" . $row['id'] . "'>" . $row['nama'] . "</a> (Tanggal: " . $row['tanggal'] . ")</div>";
        }
    } else {
        echo "Tidak ada data.";
    }

    $conn->close();
    ?>
</div>

</body>
</html>
