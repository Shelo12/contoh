<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Registrasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="tel"],
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-group textarea {
            height: 100px;
            resize: vertical;
        }
        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }
        .form-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .form-group input[type="submit"], 
        .form-group button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-group input[type="submit"] {
            background-color:navy;
            color: white;
        }

        .form-group input[type="submit"]:hover {
            background-color: navy
        }

        .form-group button {
            background-color: navy;
            color: white;
        }

        .form-group button:hover {
            background-color: navy;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Formulir Registrasi</h2>

    <form action="hasil2.php" method="post">
        <table>
            <thead>
                <tr>
                    <th>Label</th>
                    <th>Input</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><label for="full_name">Nama Lengkap</label></td>
                    <td><input type="text" id="full_name" name="full_name" required></td>
                </tr>
                <tr>
                    <td><label for="email">Email</label></td>
                    <td><input type="email" id="email" name="email" required></td>
                </tr>
                <tr>
                    <td><label for="phone">Nomor Telepon</label></td>
                    <td><input type="tel" id="phone" name="phone" required></td>
                </tr>
                <tr>
                    <td><label for="address">Alamat</label></td>
                    <td><textarea id="address" name="address" required></textarea></td>
                </tr>
            </tbody>
        </table>
        
        <div class="form-group">
        <button type="button" onclick="window.location.href='home.php';">Batal</button>
            <input type="submit" value="Daftar">
        </div>
    </form>
</div>

</body>
</html>
