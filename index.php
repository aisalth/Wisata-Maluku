<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "/opt/lampp/htdocs/app_wisata/koneksi.php";

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keindahan Timur Nusantara</title>
    <script src="https://kit.fontawesome.com/bd5eaea774.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <div class="navlink">
            <a href="index.php">Beranda</a>
            <a href="wisata.php">Wisata</a>
            <a href="penginapan.php">Penginapan</a>
            <a href="favorite.php">Favorite</a>
        </div>
        <div class="log-reg">
            <a href="auth.php">Login</a>
            <a href="auth.php">Sign Up</a>
        </div>
    </div>

    <div class="containt-top">
        <div class="top-content">
            <div class="back">
                <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=1920&q=80" alt="Beautiful scenery of Indonesia">
            </div>
            <div class="text-top">
                <p>Temukan. Jelajahi. Rasakan</p>
                <h1>Keindahan Timur Nusantara</h1>
                <p>Temukan destinasi menakjubkan, kaya budaya, dan pengalaman tak terlupakan di Timur Indonesia.</p>
                <button>Get Started</button>
            </div>
        </div>
    </div>

    <h2>Ini tambahan baru</h2>

    <div class="stats-section">
        <div class="stats">
            <div class="stat-item">
                <span class="stat-number">500+</span>
                <span class="stat-label">Destinasi Pilihan</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">400+</span>
                <span class="stat-label">Pelanggan Puas</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">1300+</span>
                <span class="stat-label">Perjalanan Selesai</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">4.9/5</span>
                <span class="stat-label">Rating</span>
            </div>
        </div>
    </div>

    <section class="container">
        <div class="section-header">
            <div>
                <h2 class="section-title">Rekomendasi</h2>
                <p class="section-subtitle">Destinasi dan Penginapan yang paling populer</p>
            </div>
            <a href="wisata.php" class="btn-view-all">lihat semua pilihan</a>
        </div>
        
        <div class="destinations-grid">
<?php 
$select = mysqli_query($koneksi, "SELECT * FROM wisata");
while($data = mysqli_fetch_assoc($select)){
?>
    <div class="destination-item">

        <?php 
        $id = $data['id_wisata'];
        $select_img = mysqli_query($koneksi, "SELECT * FROM gambar WHERE id_wisata='$id'");
        while($data_gambar = mysqli_fetch_assoc($select_img)){
        ?>
            <img src="gambar/<?= $data_gambar['gambar']; ?>" 
                 class="destination-thumb">
        <?php } ?>

        <div class="destination-details">
            <h3><?= $data['nama_wisata']; ?></h3>
            <div class="destination-tags">
                <span class="tag"><?= $data['kategori']; ?></span>
            </div>
        </div>

    </div>
<?php } ?>
</div>

    </section>

    <section class="container">
        <div class="featured-cards">
            <div class="featured-card">
                <img src="https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?w=800" alt="Destinasi Wisata">
                <div class="featured-overlay">
                    <h3>Destinasi Wisata</h3>
                    <p>Lihat dan temukan destinasi wisata pindahkah pencarilanmu</p>
                    <a href="wisata.php" class="btn-explore">▶ Lihat Destinasi</a>
                </div>
            </div>

            <div class="featured-card">
                <img src="https://images.unsplash.com/photo-1605640840605-14ac1855827b?w=800" alt="Penginapan">
                <div class="featured-overlay">
                    <h3>Penginapan</h3>
                    <p>Lihat dan temukan penginapan populer dan nyaman di Maluku</p>
                    <a href="penginapan.php" class="btn-explore">▶ Lihat Penginapan</a>
                </div>
            </div>
        </div>
    </section>

    <section class="maluku-section">
        <div class="maluku-header">
            <h3>Wonders Of Maluku</h3>
            <h2>Discover the Beauty of Maluku</h2>
            <p>Perjalanan tak terlupakan di pulau Maluku</p>
        </div>

        <div class="gallery-grid">
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=600" alt="Maluku 1">
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1540202404-a2f29016b523?w=600" alt="Maluku 2">
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?w=400" alt="Maluku 3">
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1583417319070-4a69db38a482?w=400" alt="Maluku 4">
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=600" alt="Maluku 5">
            </div>
        </div>

        <div class="maluku-description">
            <p>Selamat datang di perjalanan visual menuju Timur Indonesia. Di sini, alam memancarkan keindahaannya lewat laut yang berkilau dan lanskap yang memukau. Setiap rekam menjadi saksi keindahan yang alami dan murni, namun luar biasa mempesona.</p>
        </div>
    </section>

    <section class="reviews-section">
        <div class="reviews-header">
            <h2>Ulasan</h2>
            <p>Apa kata mereka tentang Maluku?</p>
        </div>

        <div class="reviews-grid">
            <div class="review-card">
                <p class="review-quote">"Wisatanya sangat indah dan damai"</p>
                <p class="review-text">Saya sangat berkunjung ke Maluku, keindahan alamnya luar biasa, suasanya tenang, sangat cocok untuk liburan keluarga dan menenangkan pikiran.</p>
                <div class="stars">★★★★★</div>
                <div class="reviewer-info">
                    <svg class="google-icon" viewBox="0 0 24 24">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                    <span class="reviewer-name">Olga</span>
                </div>
                <div class="reviewer-meta">Maluku Studio · 2w Teh</div>
                <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=400" alt="Review" class="review-image">
            </div>

            <div class="review-card">
                <p class="review-quote">"Tempatnya indah, Penginapannya nyaman"</p>
                <p class="review-text">Saya sangat puas dengan Maluku, tempat wisatanya indah, penginapanya mudah dijumpai dan sangat nyaman. Pelayanan ramah dan fasilitas lengkap.</p>
                <div class="stars">★★★★★</div>
                <div class="reviewer-info">
                    <svg class="google-icon" viewBox="0 0 24 24">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                    <span class="reviewer-name">Thomas</span>
                </div>
                <div class="reviewer-meta">Banda Neira · Dimjuok</div>
                <img src="https://images.unsplash.com/photo-1540202404-a2f29016b523?w=400" alt="Review" class="review-image">
            </div>

            <div class="review-card">
                <p class="review-quote">"Amazing view, highly recommended"</p>
                <p class="review-text">Absolutely breathtaking! Maluku has the cleanest waters I've ever seen and diving here is world class. The local culture is fascinating too!</p>
                <div class="stars">★★★★★</div>
                <div class="reviewer-info">
                    <svg class="google-icon" viewBox="0 0 24 24">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                    <span class="reviewer-name">Eliot</span>
                </div>
                <div class="reviewer-meta">Diving Studio · 4w Teh</div>
                <img src="https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?w=400" alt="Review" class="review-image">
            </div>
        </div>
        </div>

        <div class="btn-view-more">
            <a href="#" id="loadMoreBtn">Lihat Ulasan Lainnya</a>
        </div>
    </section>

    <footer class="footer">
  <div class="footer-container">
    
    <div class="footer-col">
      <div class="social">
        <a href="#"><i class="fa-brands fa-facebook"></i></a>
        <a href="#"><i class="fa-brands fa-twitter"></i></a>
        <a href="#"><i class="fa-brands fa-youtube"></i></a>
        <a href="#"><i class="fa-brands fa-square-instagram"></i></a>
      </div>
    </div>

    <div class="footer-col">
      <h4>Destinasi</h4>
      <ul>
        <li><a href="#">Ambon</a></li>
        <li><a href="#">Tual</a></li>
        <li><a href="#">Buru</a></li>
        <li><a href="#">Buru Selatan</a></li>
        <li><a href="#">Kepulauan Aru</a></li>
        <li><a href="#">Kepulauan Tanimbar</a></li>
        <li><a href="#">Maluku Barat Daya</a></li>
        <li><a href="#">Maluku Tengah</a></li>
        <li><a href="#">Maluku Tenggara</a></li>
      </ul>
    </div>

    <div class="footer-col">
      <h4>Tentang</h4>
      <ul>
        <li><a href="#">Tentang Kami</a></li>
        <li><a href="#">Sejarah</a></li>
      </ul>
    </div>

    <div class="footer-col">
      <h4>Contact</h4>
      <ul>
        <li><a href="mailto:maluku@gmail.com">maluku@gmail.com</a></li>
        <li><a href="#">maluku.cs</a></li>
      </ul>
    </div>

  </div>
</footer>

</body>
</html>