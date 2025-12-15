<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "/opt/lampp/htdocs/app_wisata/koneksi.php";

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maluku Tourism - Wisata</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-blue: #0A3A5C;
            --accent-blue: #1E5A7D;
            --text-dark: #2C3E50;
            --text-light: #6C757D;
            --border-color: #E8ECF0;
            --bg-light: #F8F9FA;
            --star-color: #FF6B6B;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            background-color: #FFFFFF;
            line-height: 1.6;
        }

        /* Main Container */
        .container {
            max-width: 1400px;
            margin: 3rem auto;
            padding: 0 5%;
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 3rem;
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Sidebar Filters */
        .sidebar {
            position: sticky;
            top: 120px;
            height: fit-content;
        }

        .filter-section {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid var(--border-color);
            transition: box-shadow 0.3s ease;
        }

        .filter-section:hover {
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .filter-section h3 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1.2rem;
            color: var(--text-dark);
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .filter-section h3::after {
            content: '−';
            font-size: 1.5rem;
            color: var(--text-light);
        }

        .filter-section h3.collapsed::after {
            content: '+';
        }

        .filters-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
        }

        /* Rating Filters */
        .rating-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .rating-btn {
            padding: 0.5rem 1rem;
            border: 1px solid var(--border-color);
            background: white;
            border-radius: 6px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        .rating-btn:hover {
            border-color: var(--accent-blue);
            background: rgba(30, 90, 125, 0.05);
        }

        .rating-btn.active {
            background: var(--primary-blue);
            color: white;
            border-color: var(--primary-blue);
        }

        /* Checkbox Filters */
        .filter-options {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .checkbox-item:hover {
            transform: translateX(3px);
        }

        .checkbox-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: var(--primary-blue);
        }

        .checkbox-item label {
            font-size: 0.9rem;
            color: var(--text-dark);
            cursor: pointer;
        }

        .show-more {
            color: var(--accent-blue);
            font-size: 0.85rem;
            cursor: pointer;
            margin-top: 0.5rem;
            display: inline-block;
            font-weight: 500;
        }

        .show-more:hover {
            text-decoration: underline;
        }

        /* Main Content */
        .main-content {
            animation: fadeInUp 0.7s ease-out 0.2s both;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .tabs {
            display: flex;
            gap: 2rem;
            border-bottom: 2px solid var(--border-color);
            margin-bottom: 2rem;
        }

        .tab {
            padding: 1rem 0;
            cursor: pointer;
            font-weight: 500;
            color: var(--text-light);
            position: relative;
            transition: color 0.3s ease;
        }

        .tab:hover {
            color: var(--accent-blue);
        }

        .tab.active {
            color: var(--primary-blue);
            font-weight: 600;
        }

        .tab.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--primary-blue);
            animation: expandWidth 0.3s ease-out;
        }

        .tab-subtitle {
            font-size: 0.85rem;
            color: var(--text-light);
            margin-top: 0.2rem;
        }

        /* Results Header */
        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .results-count {
            font-size: 0.95rem;
            color: var(--text-light);
        }

        .sort-dropdown {
            padding: 0.6rem 1.2rem;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            background: white;
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .sort-dropdown:hover {
            border-color: var(--accent-blue);
        }

        /* Place Cards */
        .places-grid {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .place-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            gap: 1.5rem;
            border: 1px solid var(--border-color);
            transition: all 0.4s ease;
            animation: cardFadeIn 0.5s ease-out backwards;
        }

        .place-card:nth-child(1) { animation-delay: 0.1s; }
        .place-card:nth-child(2) { animation-delay: 0.2s; }
        .place-card:nth-child(3) { animation-delay: 0.3s; }
        .place-card:nth-child(4) { animation-delay: 0.4s; }
        .place-card:nth-child(5) { animation-delay: 0.5s; }

        @keyframes cardFadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .place-card:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
            transform: translateY(-3px);
        }

        .place-image {
            width: 250px;
            height: 180px;
            position: relative;
            overflow: hidden;
            flex-shrink: 0;
        }

        .place-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .place-card:hover .place-image img {
            transform: scale(1.08);
        }

        .favorite-btn {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .favorite-btn:hover {
            background: white;
            transform: scale(1.1);
        }

        .favorite-btn.active {
            background: var(--star-color);
            color: white;
        }

        .place-content {
            flex: 1;
            padding: 1.5rem 1.5rem 1.5rem 0;
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .place-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-dark);
            font-family: 'Playfair Display', serif;
        }

        .place-location {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .place-rating {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .stars {
            display: flex;
            gap: 2px;
        }

        .star {
            color: var(--star-color);
            font-size: 1rem;
        }

        .rating-badge {
            background: var(--bg-light);
            padding: 0.3rem 0.7rem;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .reviews-count {
            color: var(--text-light);
            font-size: 0.85rem;
        }

        .place-actions {
            display: flex;
            gap: 1rem;
            margin-top: auto;
        }

        .wishlist-icon {
            width: 42px;
            height: 42px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }

        .wishlist-icon:hover {
            border-color: var(--accent-blue);
            background: rgba(30, 90, 125, 0.05);
            transform: scale(1.05);
        }

        .view-place-btn {
            flex: 1;
            padding: 0.9rem 1.5rem;
            background: var(--primary-blue);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        .view-place-btn:hover {
            background: var(--accent-blue);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(10, 58, 92, 0.3);
        }

        /* Load More Button */
        .load-more-container {
            text-align: center;
            margin-top: 3rem;
        }

        .load-more-btn {
            padding: 1rem 3rem;
            background: rgba(10, 58, 92, 0.9);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        .load-more-btn:hover {
            background: var(--primary-blue);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(10, 58, 92, 0.3);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .container {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: static;
            }

            .footer-content {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            nav ul {
                gap: 1.5rem;
                font-size: 0.9rem;
            }

            .place-card {
                flex-direction: column;
            }

            .place-image {
                width: 100%;
                height: 220px;
            }

            .footer-content {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <?php include "header.php"; ?>

    <!-- Main Container -->
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2 class="filters-title">Filters</h2>

            <!-- Rating Filter -->
            <div class="filter-section">
                <h3>Rating</h3>
                <div class="rating-buttons">
                    <button class="rating-btn">0+</button>
                    <button class="rating-btn">1+</button>
                    <button class="rating-btn">2+</button>
                    <button class="rating-btn">3+</button>
                    <button class="rating-btn active">4+</button>
                </div>
            </div>

            <!-- Freebies Filter -->
            <div class="filter-section">
                <h3>Freebies</h3>
                <div class="filter-options">
                    <div class="checkbox-item">
                        <input type="checkbox" id="breakfast">
                        <label for="breakfast">Free breakfast</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="parking">
                        <label for="parking">Free parking</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="internet">
                        <label for="internet">Free internet</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="shuttle">
                        <label for="shuttle">Free airport shuttle</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="cancellation">
                        <label for="cancellation">Free cancellation</label>
                    </div>
                </div>
            </div>

            <!-- Amenities Filter -->
            <div class="filter-section">
                <h3>Amenities</h3>
                <div class="filter-options">
                    <div class="checkbox-item">
                        <input type="checkbox" id="desk">
                        <label for="desk">24hr front desk</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="ac">
                        <label for="ac">Air-conditioned</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="fitness">
                        <label for="fitness">Fitness</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="pool">
                        <label for="pool">Pool</label>
                    </div>
                </div>
                <span class="show-more">+36 more</span>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Tabs -->
            <div class="tabs">
                <div class="tab active">
                    <div>Wisata Alam</div>
                    <div class="tab-subtitle">257 tempat</div>
                </div>
                <div class="tab">
                    <div>Wisata Edukasi</div>
                    <div class="tab-subtitle">45 tempat</div>
                </div>
            </div>

            <!-- Results Header -->
            <div class="results-header">
                <p class="results-count">Lihat 4 dari 257 tempat</p>
                <select class="sort-dropdown">
                    <option>Urutkan dari Rekomendasi</option>
                    <option>Rating Tertinggi</option>
                    <option>Harga Terendah</option>
                    <option>Harga Tertinggi</option>
                </select>
            </div>

            <!-- Places Grid -->
            <div class="places-grid">

                <?php
$wisata = mysqli_query($koneksi, "SELECT * FROM wisata WHERE kategori = 'wisata alam' 
     OR kategori = 'wisata edukasi' ");

while ($w = mysqli_fetch_assoc($wisata)) {
?>
<div class="place-card">
    <div class="place-image">

        <?php
        $id = $w['id_wisata'];
        $gambar = mysqli_query(
            $koneksi,
            "SELECT * FROM gambar WHERE id_wisata='$id' LIMIT 1"
        );

        if ($g = mysqli_fetch_assoc($gambar)) {
        ?>
            <img src="gambar/<?= $g['gambar']; ?>"
                 alt="<?= $w['nama_wisata']; ?>">
        <?php } else { ?>
            <img src="assets/no-image.png" alt="no image">
        <?php } ?>

        <button class="favorite-btn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
            </svg>
        </button>
    </div>

    <div class="place-content">
        <h3 class="place-title"><?= $w['nama_wisata']; ?></h3>

        <div class="place-location">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
            </svg>
            <?= $w['alamat']; ?>
        </div>

        <div class="place-rating">
            <div class="stars">
                <span class="star">★</span>
                <span class="star">★</span>
                <span class="star">★</span>
                <span class="star">★</span>
                <span class="star">★</span>
            </div>
            <span class="rating-badge">4.2</span>
            <span class="reviews-count">Very Good</span>
        </div>

        <div class="place-actions">
            <button class="wishlist-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                </svg>
            </button>

            <a href="detail.php?id=<?= $w['id_wisata']; ?>" class="view-place-btn">
                View Place
            </a>
        </div>
    </div>
</div>
<?php } ?>

            </div>

            <!-- Load More -->
            <div class="load-more-container">
                <button class="load-more-btn">Show more results</button>
            </div>
        </main>
    </div>

    <?php include "footer.php"; ?>

    <script>
        // Rating button toggle
        document.querySelectorAll('.rating-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.rating-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Tab switching
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Favorite buttons
        document.querySelectorAll('.favorite-btn, .wishlist-icon').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                this.classList.toggle('active');
            });
        });

        // Load more button
        document.querySelector('.load-more-btn').addEventListener('click', function() {
            alert('Loading more results...');
        });

        // Filter section collapse
        document.querySelectorAll('.filter-section h3').forEach(header => {
            header.addEventListener('click', function() {
                this.classList.toggle('collapsed');
                const content = this.nextElementSibling;
                if (content) {
                    content.style.display = content.style.display === 'none' ? 'flex' : 'none';
                }
            });
        });
    </script>
</body>
</html>