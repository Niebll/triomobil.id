<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarRental - Sewa Mobil Terpercaya</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            overflow-x: hidden;
        }

        /* Navbar Styles */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            z-index: 1000;
            padding: 1rem 0;
            transition: all 0.3s ease;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 2px 30px rgba(0, 0, 0, 0.15);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: #2c3e50;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo i {
            color: #e74c3c;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .nav-menu a {
            text-decoration: none;
            color: #2c3e50;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-menu a:hover {
            color: #e74c3c;
        }

        .nav-menu a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: #e74c3c;
            transition: width 0.3s ease;
        }

        .nav-menu a:hover::after {
            width: 100%;
        }

        .nav-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        .nav-toggle span {
            width: 25px;
            height: 3px;
            background: #2c3e50;
            margin: 3px 0;
            transition: 0.3s;
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="white" opacity="0.1"><polygon points="0,0 1000,100 1000,0"/></svg>');
            background-size: cover;
        }

        .hero-content {
            max-width: 800px;
            padding: 0 2rem;
            z-index: 2;
            position: relative;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            animation: fadeInUp 1s ease;
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            animation: fadeInUp 1s ease 0.3s both;
        }

        .cta-button {
            display: inline-block;
            padding: 1rem 2rem;
            background: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            transition: all 0.3s ease;
            animation: fadeInUp 1s ease 0.6s both;
            box-shadow: 0 10px 30px rgba(231, 76, 60, 0.3);
        }

        .cta-button:hover {
            background: #c0392b;
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(231, 76, 60, 0.4);
        }

        /* Features Section */
        .features {
            padding: 5rem 0;
            background: #f8f9fa;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-title h2 {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .section-title p {
            font-size: 1.1rem;
            color: #7f8c8d;
            max-width: 600px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .feature-card {
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            font-size: 3rem;
            color: #e74c3c;
            margin-bottom: 1.5rem;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #2c3e50;
        }

        .feature-card p {
            color: #7f8c8d;
            line-height: 1.6;
        }

        /* Cars Section */
        .cars-section {
            padding: 5rem 0;
            background: white;
        }

        .cars-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .car-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .car-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .car-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .car-card:hover .car-image {
            transform: scale(1.05);
        }

        .car-info {
            padding: 2rem;
        }

        .car-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        .car-type {
            color: #7f8c8d;
            margin-bottom: 1rem;
        }

        .car-specs {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .spec-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .spec-item i {
            color: #e74c3c;
        }

        .car-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #e74c3c;
            margin-bottom: 1rem;
        }

        .car-status {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: #2ecc71;
            color: white;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .car-status.disewa {
            background: #e74c3c;
        }

        .view-all-btn {
            text-align: center;
            margin-top: 3rem;
        }

        .view-all-btn a {
            display: inline-block;
            padding: 1rem 2rem;
            background: #2c3e50;
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .view-all-btn a:hover {
            background: #34495e;
            transform: translateY(-2px);
        }

        /* Footer */
        .footer {
            background: #2c3e50;
            color: white;
            padding: 3rem 0 1rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h3 {
            margin-bottom: 1rem;
            color: #e74c3c;
        }

        .footer-section p,
        .footer-section a {
            color: #bdc3c7;
            text-decoration: none;
            line-height: 1.8;
        }

        .footer-section a:hover {
            color: #e74c3c;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid #34495e;
            color: #95a5a6;
        }

        /* Animations */
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-menu {
                position: fixed;
                left: -100%;
                top: 70px;
                flex-direction: column;
                background-color: white;
                width: 100%;
                text-align: center;
                transition: 0.3s;
                box-shadow: 0 10px 27px rgba(0, 0, 0, 0.05);
                padding: 2rem 0;
            }

            .nav-menu.active {
                left: 0;
            }

            .nav-toggle {
                display: flex;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .cars-grid {
                grid-template-columns: 1fr;
            }

            .car-specs {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <a href="#" class="logo">
                <i class="fas fa-car"></i>
                CarRental
            </a>
            <ul class="nav-menu" id="nav-menu">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('car.list') }}">Car</a></li>
                <li><a href="#about">About Us</a></li>
            </ul>
            <div class="nav-toggle" id="nav-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Sewa Mobil Impian Anda</h1>
            <p>Nikmati perjalanan yang nyaman dan aman dengan koleksi mobil terbaik kami. Harga terjangkau, pelayanan terpercaya.</p>
            <a href="{{ route('car.list') }}" class="cta-button">
                <i class="fas fa-car"></i> Lihat Koleksi Mobil
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="section-title">
                <h2>Mengapa Memilih Kami?</h2>
                <p>Kami menyediakan layanan terbaik dengan berbagai keunggulan yang akan membuat perjalanan Anda lebih menyenangkan</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Aman & Terpercaya</h3>
                    <p>Semua mobil kami telah melewati inspeksi ketat dan diasuransikan untuk keamanan Anda</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <h3>Harga Terjangkau</h3>
                    <p>Dapatkan mobil berkualitas dengan harga yang kompetitif dan transparan tanpa biaya tersembunyi</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3>Pelayanan 24/7</h3>
                    <p>Tim customer service kami siap membantu Anda kapan saja untuk keperluan perjalanan Anda</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Cars Section -->
    <section class="cars-section">
        <div class="container">
            <div class="section-title">
                <h2>Mobil Terbaru Kami</h2>
                <p>Pilihan mobil terbaru dengan kondisi prima dan harga terbaik untuk perjalanan Anda</p>
            </div>
            <div class="cars-grid">
                @forelse($cars as $car)
                <div class="car-card">
                    <img src="{{ $car->main_image }}" alt="{{ $car->brand }} {{ $car->model }}" class="car-image">
                    <div class="car-info">
                        <h3 class="car-title">{{ $car->brand }} {{ $car->model }}</h3>
                        <p class="car-type">{{ $car->car_type }} • {{ $car->year }}</p>
                        <div class="car-specs">
                            <div class="spec-item">
                                <i class="fas fa-users"></i>
                                <span>{{ $car->seat }} Kursi</span>
                            </div>
                            <div class="spec-item">
                                <i class="fas fa-cog"></i>
                                <span>{{ ucfirst($car->gearbox) }}</span>
                            </div>
                            <div class="spec-item">
                                <i class="fas fa-palette"></i>
                                <span>{{ $car->color }}</span>
                            </div>
                        </div>
                        <div class="car-price">
                            Rp {{ number_format($car->price_per_day, 0, ',', '.') }}/hari
                        </div>
                        <span class="car-status {{ $car->status == 'disewa' ? 'disewa' : '' }}">
                            {{ $car->status == 'tersedia' ? 'Tersedia' : 'Disewa' }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p>Belum ada mobil yang tersedia.</p>
                </div>
                @endforelse
            </div>
            <div class="view-all-btn">
                <a href="{{ route('car.list') }}">Lihat Semua Mobil</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="about">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>CarRental</h3>
                    <p>Penyedia layanan sewa mobil terpercaya dengan koleksi mobil berkualitas dan pelayanan terbaik untuk perjalanan Anda.</p>
                </div>
                <div class="footer-section">
                    <h3>Layanan</h3>
                    <p><a href="#">Sewa Mobil Harian</a></p>
                    <p><a href="#">Sewa Mobil Mingguan</a></p>
                    <p><a href="#">Sewa Mobil Bulanan</a></p>
                    <p><a href="#">Layanan Antar Jemput</a></p>
                </div>
                <div class="footer-section">
                    <h3>Kontak</h3>
                    <p><i class="fas fa-phone"></i> +62 123 456 7890</p>
                    <p><i class="fas fa-envelope"></i> info@carrental.com</p>
                    <p><i class="fas fa-map-marker-alt"></i> Jakarta, Indonesia</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 CarRental. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Mobile menu toggle
        const navToggle = document.getElementById('nav-toggle');
        const navMenu = document.getElementById('nav-menu');

        navToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
        });

        // Close mobile menu when clicking on a link
        document.querySelectorAll('.nav-menu a').forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.remove('active');
            });
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe elements for animation
        document.querySelectorAll('.feature-card, .car-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    </script>
</body>
</html>