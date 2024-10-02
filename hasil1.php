<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Registrasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            position: relative;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .info {
            margin-bottom: 20px;
        }
        .info p {
            margin: 0;
            padding: 5px 0;
            font-size: 16px;
        }
        .photo {
            float: right;
            width: 100px;
            height: 150px;
            border: 1px solid #ddd;
            object-fit: cover;
            margin-left: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        td.icon {
            text-align: center;
            font-size: 20px;
        }
        .check-icon {
            color: green;
        }
        .document-link {
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Hasil Registrasi</h2>
    
    <!-- Pas Foto -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ambil data dari form
        $suspect_name = isset($_POST['suspect_name']) ? $_POST['suspect_name'] : '';
        $submitter_name = isset($_POST['submitter_name']) ? $_POST['submitter_name'] : '';
        $organization = isset($_POST['organization']) ? $_POST['organization'] : '';
        $position = isset($_POST['position']) ? $_POST['position'] : '';
        $date = isset($_POST['date']) ? $_POST['date'] : '';
        
        // Menangani upload foto
        $photoPath = 'uploads/' . basename($_FILES['photo']['name']); // Sesuaikan dengan direktori penyimpanan
        move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath); // Pindahkan file ke direktori yang diinginkan

        // Tampilkan informasi
        echo "<div class='info'>";
        echo "<img src='" . htmlspecialchars($photoPath) . "' alt='Pas Foto' class='photo'>";
        echo "<p><strong>Nama Tersangka:</strong> " . htmlspecialchars($suspect_name) . "</p>";
        echo "<p><strong>Nama Pengaju:</strong> " . htmlspecialchars($submitter_name) . "</p>";
        echo "<p><strong>Instansi:</strong> " . htmlspecialchars($organization) . "</p>";
        echo "<p><strong>Jabatan:</strong> " . htmlspecialchars($position) . "</p>";
        echo "<p><strong>Tanggal:</strong> " . htmlspecialchars($date) . "</p>";
        echo "</div>";
    } else {
        echo "<p>Data tidak dikirim. Silakan pastikan form telah dikirim dengan benar.</p>";
        exit;
    }
    ?>

    <!-- Tabel Verifikasi Dokumen -->
    <?php
    // Ambil data dari form
    $id_card = isset($_POST['id_card']) && $_POST['id_card'] === 'Ya';
    $evidence = isset($_POST['evidence']) && $_POST['evidence'] === 'Ya';
    $lab_result = isset($_POST['lab_result']) && $_POST['lab_result'] === 'Ya';
    $police_report = isset($_POST['police_report']) && $_POST['police_report'] === 'Ya';
    $screenshot = isset($_POST['screenshot']) && $_POST['screenshot'] === 'Ya';

    // Fungsi untuk menampilkan ikon centang
    function getCheckIcon($isChecked) {
        return $isChecked ? "<span class='check-icon'>&#10003;</span>" : ""; // Hanya menampilkan centang jika tercentang
    }

    // Fungsi untuk menampilkan berkas
    function getDocumentStatus($isChecked, $file) {
        if (!$isChecked) {
            return "Tidak ada berkas yang diunggah"; // Pesan jika "Tidak" dipilih
        }
        return isset($file) ? "<a href='uploads/" . htmlspecialchars($file['name']) . "'>Lihat Dokumen</a>" : ""; // Tautan jika file ada
    }

    // Tampilkan tabel verifikasi dokumen
    echo "<table>";
    echo "<tr><th>Dokumen</th><th>Ya</th><th>Tidak</th><th>Berkas</th></tr>";
    echo "<tr><td>Kartu Identitas</td><td class='icon'>" . getCheckIcon($id_card) . "</td><td class='icon'>" . getCheckIcon(!$id_card) . "</td><td>" . getDocumentStatus($id_card, $_FILES['id_card_file']) . "</td></tr>";
    echo "<tr><td>Barang Bukti</td><td class='icon'>" . getCheckIcon($evidence) . "</td><td class='icon'>" . getCheckIcon(!$evidence) . "</td><td>" . getDocumentStatus($evidence, $_FILES['evidence_file']) . "</td></tr>";
    echo "<tr><td>Hasil Lab</td><td class='icon'>" . getCheckIcon($lab_result) . "</td><td class='icon'>" . getCheckIcon(!$lab_result) . "</td><td>" . getDocumentStatus($lab_result, $_FILES['lab_result_file']) . "</td></tr>";
    echo "<tr><td>Laporan Polisi</td><td class='icon'>" . getCheckIcon($police_report) . "</td><td class='icon'>" . getCheckIcon(!$police_report) . "</td><td>" . getDocumentStatus($police_report, $_FILES['police_report_file']) . "</td></tr>";
    echo "<tr><td>Screenshot Percakapan</td><td class='icon'>" . getCheckIcon($screenshot) . "</td><td class='icon'>" . getCheckIcon(!$screenshot) . "</td><td>" . getDocumentStatus($screenshot, $_FILES['screenshot_file']) . "</td></tr>";
    echo "</table>";
    ?>
</div>

</body>
</html>
