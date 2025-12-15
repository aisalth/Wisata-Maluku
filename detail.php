<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "koneksi.php";

$id = $_GET['id'] ?? 0;

$qWisata = mysqli_query($koneksi, "SELECT * FROM wisata WHERE id_wisata='$id'");
$data = mysqli_fetch_assoc($qWisata);

$qGambar = mysqli_query($koneksi, "SELECT * FROM gambar WHERE id_wisata='$id'");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $data['nama_wisata']; ?> - Detail</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #0a4a6e;
            --primary-dark: #083952;
            --accent: #ff6b6b;
            --text-dark: #1a1a1a;
            --text-light: #666;
            --bg-light: #f8f9fa;
            --border: #e1e4e8;
        }

        body {
            font-family: 'Outfit', sans-serif;
            color: var(--text-dark);
            line-height: 1.6;
            background: #fff;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Breadcrumb */
        .breadcrumb {
            padding: 20px 0;
            font-size: 14px;
            color: var(--text-light);
        }

        .breadcrumb a {
            color: var(--text-light);
            text-decoration: none;
            transition: color 0.3s;
        }

        .breadcrumb a:hover {
            color: var(--primary);
        }

        .breadcrumb span {
            margin: 0 8px;
        }

        /* Header Section */
        .property-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 30px;
            animation: fadeInUp 0.6s ease-out;
        }

        .property-title-section {
            flex: 1;
        }

        .property-title {
            font-family: 'Playfair Display', serif;
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--text-dark);
        }

        .stars {
            color: #ffa500;
            font-size: 18px;
            letter-spacing: 2px;
        }

        .property-location {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 12px;
            color: var(--text-light);
            font-size: 15px;
        }

        .property-rating {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
            font-size: 14px;
        }

        .rating-badge {
            background: var(--primary);
            color: white;
            padding: 4px 12px;
            border-radius: 6px;
            font-weight: 600;
        }

        .property-price-section {
            text-align: right;
        }

        .property-price {
            font-size: 36px;
            font-weight: 700;
            color: var(--accent);
            margin-bottom: 8px;
        }

        .price-period {
            font-size: 14px;
            color: var(--text-light);
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Outfit', sans-serif;
        }

        .btn-icon {
            width: 48px;
            height: 48px;
            border: 2px solid var(--border);
            background: white;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .btn-icon:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-2px);
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            padding: 14px 32px;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(10, 74, 110, 0.3);
        }

        /* Photo Gallery */
        .photo-gallery {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-template-rows: 320px 165px;
            gap: 15px;
            margin-bottom: 60px;
            animation: fadeIn 0.8s ease-out 0.2s both;
        }

        .photo-item {
            background: var(--bg-light);
            border-radius: 12px;
            overflow: hidden;
            position: relative;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .photo-item:hover {
            transform: scale(1.02);
        }

        .photo-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .photo-main {
            grid-row: 1 / 3;
        }

        .view-all-photos {
            position: absolute;
            bottom: 20px;
            right: 20px;
            background: white;
            color: var(--primary);
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .view-all-photos:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        /* Overview Section */
        .overview-section {
            margin-bottom: 60px;
            animation: fadeInUp 0.6s ease-out 0.4s both;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--text-dark);
        }

        .overview-text {
            color: var(--text-light);
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .rating-box {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            background: var(--primary);
            color: white;
            padding: 25px 40px;
            border-radius: 12px;
            animation: scaleIn 0.5s ease-out 0.6s both;
        }

        .rating-number {
            font-size: 48px;
            font-weight: 700;
            line-height: 1;
        }

        .rating-label {
            font-size: 16px;
            margin-top: 8px;
            opacity: 0.9;
        }

        .rating-count {
            font-size: 13px;
            opacity: 0.8;
            margin-top: 4px;
        }

        /* Location Map */
        .location-section {
            margin-bottom: 60px;
            animation: fadeInUp 0.6s ease-out 0.5s both;
        }

        .location-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .map-placeholder {
            width: 100%;
            height: 300px;
            background: var(--bg-light);
            border-radius: 12px;
            position: relative;
            overflow: hidden;
        }

        .location-address {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 15px;
            color: var(--text-light);
            font-size: 20px;
        }

        /* Facilities */
        .facilities-section {
            margin-bottom: 60px;
            animation: fadeInUp 0.6s ease-out 0.6s both;
        }

        .facilities-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 40px;
        }

        .facility-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 0;
            border-bottom: 1px solid var(--border);
        }

        .facility-icon {
            font-size: 24px;
            color: var(--primary);
        }

        .facility-text {
            font-size: 15px;
            color: var(--text-dark);
        }

        .see-more {
            color: var(--primary);
            font-size: 14px;
            cursor: pointer;
            margin-top: 10px;
            display: inline-block;
            text-decoration: none;
        }

        .see-more:hover {
            text-decoration: underline;
        }

        /* Reviews */
        .reviews-section {
            margin-bottom: 60px;
            animation: fadeInUp 0.6s ease-out 0.7s both;
        }

        .reviews-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .reviews-rating {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .reviews-rating-number {
            font-size: 56px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .reviews-rating-details {
            display: flex;
            flex-direction: column;
        }

        .reviews-rating-label {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .reviews-rating-count {
            font-size: 14px;
            color: var(--text-light);
        }

        .review-item {
            padding: 25px 0;
            border-bottom: 1px solid var(--border);
            animation: fadeIn 0.5s ease-out;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 12px;
        }

        .reviewer-info {
            display: flex;
            gap: 15px;
        }

        .reviewer-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: var(--bg-light);
            overflow: hidden;
        }

        .reviewer-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .reviewer-details h4 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .reviewer-meta {
            font-size: 13px;
            color: var(--text-light);
        }

        .review-rating {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .review-rating-badge {
            background: #4caf50;
            color: white;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
        }

        .review-text {
            color: var(--text-light);
            line-height: 1.7;
            font-size: 14px;
        }

        .review-flag {
            color: var(--text-light);
            cursor: pointer;
            font-size: 20px;
        }

        .pagination {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
        }

        .pagination button {
            width: 36px;
            height: 36px;
            border: 1px solid var(--border);
            background: white;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .pagination button:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .pagination span {
            color: var(--text-light);
            font-size: 14px;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .property-header {
                flex-direction: column;
            }

            .property-price-section {
                text-align: left;
                margin-top: 20px;
            }

            .photo-gallery {
                grid-template-columns: 1fr;
                grid-template-rows: repeat(5, 200px);
            }

            .photo-main {
                grid-row: auto;
            }

            .facilities-grid {
                grid-template-columns: 1fr;
            }

            .reviews-rating {
                flex-direction: column;
                align-items: start;
            }
        }
    </style>
</head>
<body>

<?php include "header.php"; ?>

<div class="container">

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="index.php">Home</a>
        <span>›</span>
        <span><?= $data['nama_wisata']; ?></span>
    </div>

    <!-- PROPERTY HEADER -->
    <div class="property-header">
        <div class="property-title-section">
            <h1 class="property-title"><?= $data['nama_wisata']; ?></h1>
            <div class="stars">★★★★★</div>

            <div class="property-location">
                📍 <?= $data['alamat']; ?>
            </div>

            <div class="property-rating">
                <span class="rating-badge">4.2</span>
                <span style="color:#666">Very Good</span>
            </div>
        </div>

        <div class="property-price-section">
            <div class="property-price">
                Rp <?= number_format($data['harga'], 0, ',', '.'); ?>
            </div>
            <div class="price-period">/<?= $data['satuan']; ?></div>

            <div class="action-buttons">
                <button class="btn btn-icon">♡</button>
                <button class="btn btn-icon">⤴</button>
                <button class="btn btn-primary">Book now</button>
            </div>
        </div>
    </div>

    <!-- PHOTO GALLERY (NESTED LOOP) -->
    <div class="photo-gallery">
        <?php
        $no = 1;
        while ($g = mysqli_fetch_assoc($qGambar)) {
            $class = ($no == 1) ? "photo-item photo-main" : "photo-item";
        ?>
        <div class="<?= $class; ?>">
            <img src="gambar/<?= $g['gambar']; ?>" alt="">
            <?php if ($no == 5) { ?>
                <div class="view-all-photos">View all photos</div>
            <?php } ?>
        </div>
        <?php
            $no++;
        }
        ?>
    </div>

    <!-- OVERVIEW -->
    <div class="overview-section">
        <h2 class="section-title">Overview</h2>
        <p class="overview-text">
            <?= nl2br($data['deskripsi']); ?>
        </p>

        <div class="rating-box">
            <div class="rating-number">4.2</div>
            <div class="rating-label">Very good</div>
            <div class="rating-count">37 reviews</div>
        </div>
    </div>

    <!-- LOCATION -->
    <div class="location-section">
        <div class="location-header">
            <h2 class="section-title">Location</h2>
            <button class="btn btn-primary">View on Google Maps</button>
        </div>
        <div class="location-address">
            📍 <?= $data['alamat']; ?>
        </div>
    </div>

</div>

<?php include "footer.php"; ?>

</body>
</html>
