<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .signature {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }
        .signature div {
            width: 30%;
            text-align: center;
        }
        .signature-line {
            margin-top: 80px;
            border-top: 1px solid #000;
            width: 100%;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Hasil Registrasi</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ambil data dari form
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        // Tampilkan hasil registrasi
        echo "<table style='width: 100%; border-collapse: collapse;'>";
        echo "<tr><th>Label</th><th>Input</th></tr>";
        echo "<tr><td>Nama Lengkap</td><td>" . htmlspecialchars($full_name) . "</td></tr>";
        echo "<tr><td>Email</td><td>" . htmlspecialchars($email) . "</td></tr>";
        echo "<tr><td>Nomor Telepon</td><td>" . htmlspecialchars($phone) . "</td></tr>";
        echo "<tr><td>Alamat</td><td>" . nl2br(htmlspecialchars($address)) . "</td></tr>";
        echo "</table>";
    } else {
        echo "Data tidak dikirim.";
    }
    ?>

    <div class="signature">
        <div>
            <p>Tanda Tangan</p>
            <div class="signature-line"></div>
        </div>
        <div>
            <p>Tanda Tangan</p>
            <div class="signature-line"></div>
        </div>
    </div>
</div>

</body>
</html>
