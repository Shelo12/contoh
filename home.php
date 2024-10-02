<?php
session_start();

// Menyimpan status bahwa pengguna sudah mengakses halaman home
$_SESSION['visited_home'] = true;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        /* Mengatur tampilan dasar */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'georgia', serif;
            background-color: #f0f2f5;
            color: #333;
            line-height: 1.6;
        }


        /* Styling untuk navigasi bar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: white;
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-logo img {
            width: 50px;  /* Ukuran logo */
            height: 50px;
            object-fit: contain;
        }

        .navbar-buttons {
            margin-left: 20px; /* Jarak antara logo dan tombol */
        }

        .form-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }

        .form-button:hover {
            background-color: #45a049;
        }

         /* Styling untuk Link Navbar */
         .navbar-links {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex; /* Menggunakan Flexbox untuk tata letak */
        }

        .navbar-links li {
            margin-right: 20px;
        }

        .navbar-links li a {
            color: black;
            text-decoration: none;
        }

        /* Hero section */
        .hero {
            background-image: url('background.jpg');
            background-size: cover;
            background-position: center;
            height: 85vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            position: relative;
        }

        /* Overlay untuk menambahkan efek gelap pada gambar */
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        /* Konten di dalam hero section */
        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            padding: 20px;
        }

        .hero-content h2 {
            font-size: 3em;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .hero-content p {
            font-size: 1.5em;
            margin-bottom: 30px;
        }

        /* Tombol pada hero section */
        .hero-content a {
            display: inline-block;
            padding: 15px 30px;
            background-color: #0a0f56;
            color: white;
            font-size: 1.2em;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .hero-content a:hover {
            background-color: #white;
        }

        /* Bagian footer */
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 20px;
        }

        footer p {
            margin: 0;
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 768px) {
            .hero-content h2 {
                font-size: 2em;
            }

            .hero-content p {
                font-size: 1.2em;
            }

            .hero-content a {
                font-size: 1em;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
  
    <!-- Bagian Header -->
    <header>
    <div class="navbar">
    <div class="navbar-logo">
        <img src="logo.jpg" alt="Logo"> <!-- Ganti dengan URL/logo yang sesuai -->
    </div>

     <!-- Link lain pada navbar -->
     <ul class="navbar-links">
        <li><a href="formulir.html">Formulir1</a></li>
        <li><a href="formulir2.php">Formulir2</a></li>
    </ul>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h2>Selamat Datang</h2>
            <p>Kelola dan bagikan informasi dengan mudah dan cepat.</p>
            <a href="index.php">Mulai</a>
        </div>
    </section>

    <!-- Bagian Footer -->
    <footer>
        <p>&copy; 2024 Sistem Data. All Rights Reserved.</p>
    </footer>

</body>
</html>