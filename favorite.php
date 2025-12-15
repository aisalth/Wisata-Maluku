<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorite - Maluku Tourism</title>
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
            --price-red: #FF6B6B;
            --tab-active: #4A9D9C;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            background-color: #FFFFFF;
            line-height: 1.6;
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

        /* Main Container */
        .container {
            max-width: 1200px;
            margin: 3rem auto;
            padding: 0 5%;
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

        /* Page Title */
        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: var(--text-dark);
        }

        /* Favorite Tabs */
        .favorite-tabs {
            display: flex;
            gap: 0;
            border-bottom: 2px solid var(--border-color);
            margin-bottom: 3rem;
        }

        .favorite-tab {
            flex: 1;
            padding: 1.5rem 2rem;
            background: white;
            border: none;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            border-bottom: 3px solid transparent;
        }

        .favorite-tab:hover {
            background: rgba(74, 157, 156, 0.05);
        }

        .favorite-tab.active {
            border-bottom-color: var(--tab-active);
        }

        .tab-title {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.3rem;
        }

        .favorite-tab.active .tab-title {
            color: var(--tab-active);
        }

        .tab-count {
            font-size: 0.85rem;
            color: var(--text-light);
        }

        /* Content Sections */
        .tab-content {
            display: none;
            animation: fadeInUp 0.5s ease-out;
        }

        .tab-content.active {
            display: block;
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

        /* Place Cards */
        .places-list {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .place-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            display: flex;
            gap: 2rem;
            border: 1px solid var(--border-color);
            transition: all 0.4s ease;
            animation: cardFadeIn 0.5s ease-out backwards;
        }

        .place-card:nth-child(1) { animation-delay: 0.1s; }
        .place-card:nth-child(2) { animation-delay: 0.2s; }
        .place-card:nth-child(3) { animation-delay: 0.3s; }

        @keyframes cardFadeIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .place-card:hover {
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            transform: translateY(-5px);
        }

        .place-image {
            width: 320px;
            height: 220px;
            position: relative;
            overflow: hidden;
            flex-shrink: 0;
            background: #E8ECF0;
        }

        .place-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .place-card:hover .place-image img {
            transform: scale(1.1);
        }

        .favorite-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 45px;
            height: 45px;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .favorite-badge:hover {
            background: rgba(0, 0, 0, 0.85);
            transform: scale(1.1);
        }

        .place-content {
            flex: 1;
            padding: 1.8rem 2rem 1.8rem 0;
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
            position: relative;
        }

        .place-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.5rem;
        }

        .place-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            font-family: 'Playfair Display', serif;
        }

        .place-price {
            text-align: right;
        }

        .price-label {
            font-size: 0.75rem;
            color: var(--text-light);
            margin-bottom: 0.2rem;
        }

        .price-amount {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--price-red);
        }

        .price-suffix {
            font-size: 0.85rem;
            color: var(--text-light);
            font-weight: 400;
        }

        .place-location {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .place-meta {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            flex-wrap: wrap;
            margin-bottom: 0.8rem;
        }

        .stars {
            display: flex;
            gap: 3px;
        }

        .star {
            color: var(--star-color);
            font-size: 1.1rem;
        }

        .hotel-type {
            font-size: 0.85rem;
            color: var(--text-dark);
            font-weight: 500;
        }

        .amenities-badge {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.85rem;
            color: var(--text-dark);
            background: var(--bg-light);
            padding: 0.3rem 0.8rem;
            border-radius: 6px;
        }

        .place-rating {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            margin-bottom: 1rem;
        }

        .rating-badge {
            background: var(--bg-light);
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-size: 0.9rem;
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
            width: 48px;
            height: 48px;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }

        .wishlist-icon:hover {
            border-color: var(--price-red);
            background: rgba(255, 107, 107, 0.05);
            transform: scale(1.05);
        }

        .wishlist-icon.active {
            background: var(--price-red);
            border-color: var(--price-red);
        }

        .wishlist-icon.active svg {
            fill: white;
        }

        .view-place-btn {
            flex: 1;
            padding: 1rem 2rem;
            background: var(--primary-blue);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        .view-place-btn:hover {
            background: var(--accent-blue);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(10, 58, 92, 0.3);
        }

        /* Footer */
        footer {
            background: var(--primary-blue);
            color: white;
            padding: 3rem 5%;
            margin-top: 5rem;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 3rem;
        }

        .footer-section h3 {
            font-size: 1.1rem;
            margin-bottom: 1.2rem;
            font-weight: 600;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section li {
            margin-bottom: 0.7rem;
        }

        .footer-section a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: white;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .social-icon {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-light);
        }

        .empty-state svg {
            width: 80px;
            height: 80px;
            margin-bottom: 1.5rem;
            opacity: 0.3;
        }

        .empty-state h3 {
            font-size: 1.3rem;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .footer-content {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            nav ul {
                gap: 1.5rem;
                font-size: 0.9rem;
            }

            .page-title {
                font-size: 2rem;
            }

            .place-card {
                flex-direction: column;
            }

            .place-image {
                width: 100%;
                height: 240px;
            }

            .place-content {
                padding: 1.5rem;
            }

            .place-header {
                flex-direction: column;
                gap: 1rem;
            }

            .place-price {
                text-align: left;
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
        <h1 class="page-title">Favorite</h1>

        <!-- Favorite Tabs -->
        <div class="favorite-tabs">
            <button class="favorite-tab" data-tab="destinasi">
                <div class="tab-title">Destinasi</div>
                <div class="tab-count">2 marked</div>
            </button>
            <button class="favorite-tab active" data-tab="penginapan">
                <div class="tab-title">Penginapan</div>
                <div class="tab-count">3 marked</div>
            </button>
        </div>

        <!-- Destinasi Content -->
        <div class="tab-content" id="destinasi-content">
            <div class="places-list">
                <!-- Destinasi Card 1 -->
                <div class="place-card">
                    <div class="place-image">
                        <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=600&h=400&fit=crop" alt="Pantai Ora">
                        <div class="favorite-badge">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="place-content">
                        <div class="place-header">
                            <h3 class="place-title">Pantai Ora</h3>
                        </div>
                        <div class="place-location">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                            Maluku Tengah, Maluku
                        </div>
                        <div class="place-meta">
                            <div class="stars">
                                <span class="star">★</span>
                                <span class="star">★</span>
                                <span class="star">★</span>
                                <span class="star">★</span>
                                <span class="star">★</span>
                            </div>
                        </div>
                        <div class="place-rating">
                            <span class="rating-badge">4.8</span>
                            <span class="reviews-count">Excellent 425 reviews</span>
                        </div>
                        <div class="place-actions">
                            <button class="wishlist-icon active">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                </svg>
                            </button>
                            <button class="view-place-btn">View Place</button>
                        </div>
                    </div>
                </div>

                <!-- Destinasi Card 2 -->
                <div class="place-card">
                    <div class="place-image">
                        <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600&h=400&fit=crop" alt="Gunung Binaiya">
                        <div class="favorite-badge">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="place-content">
                        <div class="place-header">
                            <h3 class="place-title">Gunung Binaiya</h3>
                        </div>
                        <div class="place-location">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                            Seram, Maluku Tengah
                        </div>
                        <div class="place-meta">
                            <div class="stars">
                                <span class="star">★</span>
                                <span class="star">★</span>
                                <span class="star">★</span>
                                <span class="star">★</span>
                                <span class="star">★</span>
                            </div>
                        </div>
                        <div class="place-rating">
                            <span class="rating-badge">4.6</span>
                            <span class="reviews-count">Very Good 289 reviews</span>
                        </div>
                        <div class="place-actions">
                            <button class="wishlist-icon active">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                </svg>
                            </button>
                            <button class="view-place-btn">View Place</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Penginapan Content -->
        <div class="tab-content active" id="penginapan-content">
            <div class="places-list">
                <!-- Penginapan Card 1 -->
                <div class="place-card">
                    <div class="place-image">
                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=600&h=400&fit=crop" alt="Banda Neira Villa">
                        <div class="favorite-badge">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="place-content">
                        <div class="place-header">
                            <h3 class="place-title">Banda Neira Villa</h3>
                            <div class="place-price">
                                <div class="price-label">starting from</div>
                                <div class="price-amount">Rp 1,5jt <span class="price-suffix">excl. tax</span></div>
                            </div>
                        </div>
                        <div class="place-location">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                            Gumusuru Mah. Inonu Cad. No:8, Istanbul 34437
                        </div>
                        <div class="place-meta">
                            <div class="stars">
                                <span class="star">★</span>
                                <span class="star">★</span>
                                <span class="star">★</span>
                                <span class="star">★</span>
                                <span class="star">★</span>
                            </div>
                            <span class="hotel-type">5 Star Hotel</span>
                            <div class="amenities-badge">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                                20+ Amenities
                            </div>
                        </div>
                        <div class="place-rating">
                            <span class="rating-badge">4.2</span>
                            <span class="reviews-count">Very Good 371 reviews</span>
                        </div>
                        <div class="place-actions">
                            <button class="wishlist-icon active">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                </svg>
                            </button>
                            <button class="view-place-btn">View Place</button>
                        </div>
                    </div>
                </div>

                <!-- Penginapan Card 2 -->
                <div class="place-card">
                    <div class="place-image">
                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=600&h=400&fit=crop" alt="Banda Neira Villa">
                        <div class="favorite-badge">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="place-content">
                        <div class="place-header">
                            <h3 class="place-title">Banda Neira Villa</h3>
                            <div class="place-price">
                                <div class="price-label">starting from</div>
                                <div class="price-amount">Rp 1,5jt <span class="price-suffix">excl. tax</span></div>
                            </div>
                        </div>
                        <div class="place-location">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                            Gumusuru Mah. Inonu Cad. No:8, Istanbul 34437
                        </div>
                        <div class="place-meta">
                            <div class="stars">
                                <span class="star">★</span>
                                <span class="star">★</span>
                                <span class="star">★</span>
                                <span class="star">★</span>
                                <span class="star">★</span>
                            </div>
                            <span class="hotel-type">5 Star Hotel</span>
                            <div class="amenities-badge">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                                20+ Amenities
                            </div>
                        </div>
                        <div class="place-rating">
                            <span class="rating-badge">4.2</span>
                            <span class="reviews-count">Very Good 371 reviews</span>
                        </div>
                        <div class="place-actions">
                            <button class="wishlist-icon active">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                </svg>
                            </button>
                            <button class="view-place-btn">View Place</button>
                        </div>
                    </div>
                </div>

                <!-- Penginapan Card 3 -->
                <div class="place-card">
                    <div class="place-image">
                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=600&h=400&fit=crop" alt="Banda Neira Villa">
                        <div class="favorite-badge">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="place-content">
                        <div class="place-header">
                            <h3 class="place-title">Banda Neira Villa</h3>
                            <div class="place-price">
                                <div class="price-label">starting from</div>
                                <div class="price-amount">Rp 1,5jt <span class="price-suffix">excl. tax</span></div>
                            </div>
                        </div>
                        <div class="place-location">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                            Gumusuru Mah. Inonu Cad. No:8, Istanbul 34437
                        </div>
                        <div class="place-meta">
                            <div class="stars">
                                <span class="star">★</span>
                                <span class="star">★</span>
                                <span class="star">★</span>
                                <span class="star">★</span>
                                <span class="star">★</span>
                            </div>
                            <span class="hotel-type">5 Star Hotel</span>
                            <div class="amenities-badge">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                                20+ Amenities
                            </div>
                        </div>
                        <div class="place-rating">
                            <span class="rating-badge">4.2</span>
                            <span class="reviews-count">Very Good 371 reviews</span>
                        </div>
                        <div class="place-actions">
                            <button class="wishlist-icon active">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                </svg>
                            </button>
                            <button class="view-place-btn">View Place</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "footer.php"; ?>

    <script>
        // Tab switching
        const tabs = document.querySelectorAll('.favorite-tab');
        const contents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs and contents
                tabs.forEach(t => t.classList.remove('active'));
                contents.forEach(c => c.classList.remove('active'));

                // Add active class to clicked tab
                this.classList.add('active');

                // Show corresponding content
                const targetTab = this.getAttribute('data-tab');
                document.getElementById(`${targetTab}-content`).classList.add('active');
            });
        });

        // Favorite/Wishlist toggle
        document.querySelectorAll('.wishlist-icon, .favorite-badge').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                this.classList.toggle('active');
                
                // Show notification
                const notification = document.createElement('div');
                notification.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: #4A9D9C;
                    color: white;
                    padding: 1rem 1.5rem;
                    border-radius: 8px;
                    z-index: 1000;
                    animation: slideIn 0.3s ease-out;
                `;
                notification.textContent = this.classList.contains('active') ? 
                    '❤️ Added to favorites!' : '💔 Removed from favorites';
                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.style.animation = 'slideOut 0.3s ease-out';
                    setTimeout(() => notification.remove(), 300);
                }, 2000);
            });
        });

        // View place button
        document.querySelectorAll('.view-place-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const placeName = this.closest('.place-card').querySelector('.place-title').textContent;
                alert(`Opening details for ${placeName}...`);
            });
        });

        // Add slide animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>