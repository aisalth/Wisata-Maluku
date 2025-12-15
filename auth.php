<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();
    include "/opt/lampp/htdocs/app_wisata/koneksi.php";

    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $pass = md5($_POST['pass']);

        $query = mysqli_query($koneksi, "SELECT * FROM user WHERE email='$email' AND password='$pass'");

        if(mysqli_num_rows($query) == 1){
            $data = mysqli_fetch_assoc($query);
            $_SESSION['id_user'] = $data['id_user'];
            header("location:index.php?login=berhasil");
            exit();
        }
    }
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
            background-color: #f9fafb;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .form-section {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .image-section {
            width: 50%;
            position: relative;
            display: none;
        }

        @media (min-width: 1024px) {
            .form-section {
                width: 50%;
            }
            
            .image-section {
                display: block;
            }
        }

        .form-wrapper {
            width: 100%;
            max-width: 500px;
        }

        .form-wrapper.register {
            max-width: 700px;
        }

        h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 0.75rem;
        }

        .subtitle {
            color: #6b7280;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 1rem;
            outline: none;
            transition: all 0.2s;
        }

        input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .password-wrapper {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #6b7280;
            padding: 0;
        }

        .password-toggle:hover {
            color: #374151;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
        }

        .checkbox-wrapper input[type="checkbox"] {
            width: 1rem;
            height: 1rem;
            margin-right: 0.5rem;
            cursor: pointer;
        }

        .checkbox-wrapper label {
            margin: 0;
            font-size: 0.875rem;
            cursor: pointer;
        }

        .forgot-link {
            color: #fca5a5;
            text-decoration: none;
            font-size: 0.875rem;
        }

        .forgot-link:hover {
            color: #ef4444;
        }

        .btn-primary {
            width: 100%;
            padding: 0.75rem;
            background-color: #1e3a8a;
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-primary:hover {
            background-color: #1e40af;
        }

        .switch-page {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.875rem;
            color: #6b7280;
        }

        .switch-link {
            color: #fca5a5;
            text-decoration: none;
            font-weight: 500;
            cursor: pointer;
        }

        .switch-link:hover {
            color: #ef4444;
        }

        .divider {
            position: relative;
            text-align: center;
            margin: 1.5rem 0;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background-color: #d1d5db;
        }

        .divider span {
            position: relative;
            background-color: #f9fafb;
            padding: 0 1rem;
            color: #6b7280;
            font-size: 0.875rem;
        }

        .social-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .btn-social {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            background: white;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-social:hover {
            background-color: #f9fafb;
        }

        .btn-social svg {
            width: 1.25rem;
            height: 1.25rem;
        }

        /* Image Section Styles */
        .image-carousel {
            height: 90%;
            width: 70%;
            top: 45px;
            left: 100px;
            position: relative;
            overflow: hidden;
        }

        .login-page .image-carousel {
            border-radius: 3rem 3rem 3rem 3rem;
        }

        .register-page .image-carousel {
            border-radius: 3rem;
        }

        .carousel-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .carousel-image.active {
            opacity: 1;
        }

        .carousel-dots {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 0.5rem;
            z-index: 10;
        }

        .dot {
            height: 0.5rem;
            border-radius: 9999px;
            background-color: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s;
        }

        .dot.active {
            width: 2rem;
            background-color: #5eead4;
        }

        .dot:not(.active) {
            width: 0.5rem;
        }

        .terms-text {
            font-size: 0.875rem;
            color: #374151;
        }

        .terms-text a {
            color: #fca5a5;
            text-decoration: none;
        }

        .terms-text a:hover {
            color: #ef4444;
        }

        .hidden {
            display: none;
        }

        /* Eye icon styles */
        .eye-icon {
            width: 20px;
            height: 20px;
        }
    </style>
</head>
<body>
    <!-- Login Page -->
    <div id="loginPage" class="container login-page">
        <div class="form-section">
            <div class="form-wrapper">
                <h1>Login</h1>
                <p class="subtitle">Login to access our features</p>

                <form action="" method="post">
                    <div class="form-group">
                        <label for="loginEmail">Email</label>
                        <input type="email" name="email" id="loginEmail" value="">
                    </div>

                    <div class="form-group">
                        <label for="loginPassword">Password</label>
                        <div class="password-wrapper">
                            <input type="password" name="pass" id="loginPassword" value="">
                            <button type="button" class="password-toggle" onclick="togglePassword('loginPassword')">
                                <svg class="eye-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="remember-forgot">
                        <div class="checkbox-wrapper">
                            <input type="checkbox" id="rememberMe">
                            <label for="rememberMe">Remember me</label>
                        </div>
                        <a href="#" class="forgot-link">Forgot Password</a>
                    </div>

                    <input type="submit" value="LOGIN" name="login" class="btn-primary">
                    <p class="switch-page">
                        Don't have an account? 
                        <a class="switch-link" onclick="showRegister()">Sign up</a>
                    </p>

                    <div class="divider">
                        <span>Or login with</span>
                    </div>

                    <div class="social-buttons">
                        <button type="button" class="btn-social">
                            <svg viewBox="0 0 24 24">
                                <path fill="#1877F2" d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </button>
                        <button type="button" class="btn-social">
                            <svg viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="image-section">
            <div class="image-carousel">
                <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=800&q=80" alt="Scenic view 1" class="carousel-image active">
                <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&q=80" alt="Scenic view 2" class="carousel-image">
                <img src="https://images.unsplash.com/photo-1540202404-a2f29016b523?w=800&q=80" alt="Scenic view 3" class="carousel-image">
                
                <div class="carousel-dots">
                    <div class="dot active" onclick="setCarouselImage(0)"></div>
                    <div class="dot" onclick="setCarouselImage(1)"></div>
                    <div class="dot" onclick="setCarouselImage(2)"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Page -->
    <div id="registerPage" class="container register-page hidden">
        <div class="image-section">
            <div class="image-carousel">
                <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&q=80" alt="Scenic view 1" class="carousel-image active">
                <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=800&q=80" alt="Scenic view 2" class="carousel-image">
                <img src="https://images.unsplash.com/photo-1540202404-a2f29016b523?w=800&q=80" alt="Scenic view 3" class="carousel-image">
                
                <div class="carousel-dots">
                    <div class="dot active" onclick="setCarouselImageRegister(0)"></div>
                    <div class="dot" onclick="setCarouselImageRegister(1)"></div>
                    <div class="dot" onclick="setCarouselImageRegister(2)"></div>
                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="form-wrapper register">
                <h1>Sign up</h1>
                <p class="subtitle">Let's get you all st up so you can access your personal account.</p>

                <form onsubmit="return false;">
                    <div class="form-group">
                        <div class="form-row">
                            <div>
                                <label for="firstName">Name</label>
                                <input type="text" id="firstName" value="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div>
                                <label for="registerEmail">Email</label>
                                <input type="email" name="email" id="registerEmail" value="">
                            </div>
                            <div>
                                <label for="phoneNumber">Phone Number</label>
                                <input type="tel" name="tel" id="phoneNumber" value="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="registerPassword">Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="registerPassword" value="">
                            <button type="button" class="password-toggle" onclick="togglePassword('registerPassword')">
                                <svg class="eye-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="checkbox-wrapper">
                            <input type="checkbox" id="agreeTerms">
                            <label for="agreeTerms" class="terms-text">
                                I agree to all the <a href="#">Terms</a> and <a href="#">Privacy Policies</a>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn-primary">Create account</button>

                    <p class="switch-page">
                        Already have an account? 
                        <a class="switch-link" onclick="showLogin()">Login</a>
                    </p>

                    <div class="divider">
                        <span>Or Sign up with</span>
                    </div>

                    <div class="social-buttons">
                        <button type="button" class="btn-social">
                            <svg viewBox="0 0 24 24">
                                <path fill="#1877F2" d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </button>
                        <button type="button" class="btn-social">
                            <svg viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let currentImageIndex = 0;
        let currentImageIndexRegister = 0;

        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            input.type = input.type === 'password' ? 'text' : 'password';
        }

        function showLogin() {
            document.getElementById('loginPage').classList.remove('hidden');
            document.getElementById('registerPage').classList.add('hidden');
        }

        function showRegister() {
            document.getElementById('loginPage').classList.add('hidden');
            document.getElementById('registerPage').classList.remove('hidden');
        }

        function setCarouselImage(index) {
            const loginPage = document.getElementById('loginPage');
            const images = loginPage.querySelectorAll('.carousel-image');
            const dots = loginPage.querySelectorAll('.dot');
            
            images.forEach((img, i) => {
                img.classList.toggle('active', i === index);
            });
            
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
            
            currentImageIndex = index;
        }

        function setCarouselImageRegister(index) {
            const registerPage = document.getElementById('registerPage');
            const images = registerPage.querySelectorAll('.carousel-image');
            const dots = registerPage.querySelectorAll('.dot');
            
            images.forEach((img, i) => {
                img.classList.toggle('active', i === index);
            });
            
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
            
            currentImageIndexRegister = index;
        }

        // Auto-advance carousel
        setInterval(() => {
            if (!document.getElementById('loginPage').classList.contains('hidden')) {
                currentImageIndex = (currentImageIndex + 1) % 3;
                setCarouselImage(currentImageIndex);
            }
            
            if (!document.getElementById('registerPage').classList.contains('hidden')) {
                currentImageIndexRegister = (currentImageIndexRegister + 1) % 3;
                setCarouselImageRegister(currentImageIndexRegister);
            }
        }, 5000);
    </script>
</body>
</html>