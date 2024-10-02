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

    // Cek apakah form dikirim
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nama = $_POST['nama'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $umur = $_POST['umur'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $pekerjaan = $_POST['pekerjaan'];
        $alamat = $_POST['alamat'];
        $tanggal_penangkapan = $_POST['tanggal_penangkapan'];

        // Query untuk mengupdate data berdasarkan ID
        $sql = "UPDATE orang SET nama='$nama', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', umur='$umur', jenis_kelamin='$jenis_kelamin',
                pekerjaan='$pekerjaan', alamat='$alamat', tanggal_penangkapan='$tanggal_penangkapan' WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            // Redirect kembali ke detail.php setelah data diupdate
            header("Location: detail.php?id=$id");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
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
    <title>Edit Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
            color: #555;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        input[type="submit"],
        datalist {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"] {
            margin-top: 20px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1.1em;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .button-group a,
        .button-group input[type="submit"] {
            padding: 10px 15px;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border-radius: 5px;
            text-align: center;
        }

        .button-group a:hover {
            background-color: #0056b3;
        }

        @media (max-width: 600px) {
            .container {
                width: 100%;
                padding: 15px;
            }

            input[type="text"],
            input[type="number"],
            input[type="date"] {
                font-size: 0.9em;
            }

            input[type="submit"],
            .button-group a {
                font-size: 0.9em;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Edit Data</h1>

    <form method="POST" action="edit.php?id=<?php echo $id; ?>">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" value="<?php echo $nama; ?>" required>

        <label for="tempat_lahir">Tempat Lahir</label>
        <input type="text" name="tempat_lahir" id="tempat_lahir" value="<?php echo $tempat_lahir; ?>" required>

        <label for="tanggal_lahir">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo $tanggal_lahir; ?>" required>

        <label for="umur">Umur</label>
        <input type="number" name="umur" id="umur" value="<?php echo $umur; ?>" required>

        <label for="jenis_kelamin">Jenis Kelamin</label>
        <input list="gender" name="jenis_kelamin" id="jenis_kelamin" value="<?php echo $jenis_kelamin; ?>" required>
        <datalist id="gender">
            <option value="Laki-laki">
            <option value="Perempuan">
        </datalist>

        <label for="pekerjaan">Pekerjaan</label>
        <input type="text" name="pekerjaan" id="pekerjaan" value="<?php echo $pekerjaan; ?>" required>

        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" id="alamat" value="<?php echo $alamat; ?>" required>

        <label for="tanggal_penangkapan">Tanggal Penangkapan</label>
        <input type="date" name="tanggal_penangkapan" id="tanggal_penangkapan" value="<?php echo $tanggal_penangkapan; ?>" required>

        <div class="button-group">
            <input type="submit" value="Update Data">
        </div>
    </form>
</div>

</body>
</html>