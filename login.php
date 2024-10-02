<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login with CAPTCHA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
        .g-recaptcha {
            margin-bottom: 15px;
        }
    </style>
    <!-- Tambahkan script Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>

        <!-- PHP: Menampilkan pesan error jika CAPTCHA gagal -->
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $recaptchaResponse = $_POST['g-recaptcha-response'];
            $secretKey = 'your-secret-key'; // Ganti dengan secret key dari Google reCAPTCHA
            $verifyURL = "https://www.google.com/recaptcha/api/siteverify";

            // Mengirim permintaan verifikasi ke Google
            $response = file_get_contents($verifyURL . "?secret=" . $secretKey . "&response=" . $recaptchaResponse);
            $responseKeys = json_decode($response, true);

            // Cek hasil CAPTCHA
            if (intval($responseKeys["success"]) === 1) {
                echo "<p style='color:green;'>CAPTCHA valid. Login berhasil.</p>";
                // Lanjutkan proses login
            } else {
                echo "<p style='color:red;'>Verifikasi CAPTCHA gagal. Silakan coba lagi.</p>";
            }
        }
        ?>

        <!-- Form login -->
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <!-- Google reCAPTCHA widget -->
            <div class="g-recaptcha" data-sitekey="your-site-key"></div>
            
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</body>
</html>
