<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/bd5eaea774.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Variables */
        :root {
            --primary-blue : #0A3A5C;
            --accent-blue : #1E5A7D;
            --text-dark: #1f2937;
        }

        /* Navigation */
        nav {
            background: white;
            padding: 1.5rem 5%;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 100;
            animation: slideDown 0.5s ease-out;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 3rem;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Pindahkan icon user ke kanan */
        nav ul li:last-child {
            margin-left: auto;
        }

        nav a {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.3s ease;
            position: relative;
        }

        nav a:hover {
            color: var(--accent-blue);
        }

        nav a.active {
            color: var(--primary-blue);
            font-weight: 600;
        }

        nav a.active::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--primary-blue);
            animation: expandWidth 0.3s ease-out;
        }

        @keyframes expandWidth {
            from { width: 0; }
            to { width: 100%; }
        }

        /* Style untuk icon user */
        nav a i {
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Beranda</a></li>
            <li><a href="wisata.php">Wisata</a></li>
            <li><a href="penginapan.php">Penginapan</a></li>
            <li><a href="favorite.php">Favorite</a></li>
            <li><a href="#user"><i class="fa-solid fa-user"></i></a></li>
        </ul>
    </nav>
</body>
</html>