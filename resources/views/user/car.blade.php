<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mobil - CarRental</title>
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
            background: #f8f9fa;
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

        .nav-menu a.active {
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

        .nav-menu a:hover::after,
        .nav-menu a.active::after {
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

        /* Main Content */
        .main-content {
            margin-top: 80px;
            padding: 2rem 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Page Header */
        .page-header {
            text-align: center;
            margin-bottom: 3rem;
            padding: 2rem 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 20px;
            margin: 0 2rem 3rem;
        }

        .page-header h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .page-header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* Search and Filter Section */
        .search-filter {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 3rem;
        }

        .search-filter h3 {
            margin-bottom: 1.5rem;
            color: #2c3e50;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-form {
            display: grid;
            grid-template-columns: 1fr auto auto;
            gap: 1rem;
            align-items: end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #2c3e50;
        }

        .form-control {
            padding: 0.75rem 1rem;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #e74c3c;
            box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.1);
        }

        .search-input {
            position: relative;
        }

        .search-input i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #7f8c8d;
        }

        .search-input input {
            padding-left: 3rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: #e74c3c;
            color: white;
        }

        .btn-primary:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        /* Results Info */
        .results-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding: 1rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .results-count {
            color: #7f8c8d;
        }

        .results-count strong {
            color: #2c3e50;
        }

        /* Cars Grid */
        .cars-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .car-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
        }

        .car-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .car-image-container {
            position: relative;
            overflow: hidden;
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

        .car-status-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .car-status-badge.tersedia {
            background: #2ecc71;
            color: white;
        }

        .car-status-badge.disewa {
            background: #e74c3c;
            color: white;
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
            font-size: 1rem;
        }

        .car-description {
            color: #7f8c8d;
            margin-bottom: 1.5rem;
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .car-specs {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
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
            width: 16px;
        }

        .car-details {
            margin-bottom: 1.5rem;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .detail-row strong {
            color: #2c3e50;
        }

        .car-price {
            font-size: 1.8rem;
            font-weight: bold;
            color: #e74c3c;
            text-align: center;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 10px;
            margin-top: 1rem;
        }

        .price-unit {
            font-size: 1rem;
            color: #7f8c8d;
            font-weight: normal;
        }

        /* Pagination */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 3rem;
        }

        .pagination {
            display: flex;
            list-style: none;
            gap: 0.5rem;
            background: white;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .pagination a,
        .pagination span {
            padding: 0.75rem 1rem;
            text-decoration: none;
            color: #7f8c8d;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .pagination a:hover {
            background: #e74c3c;
            color: white;
        }

        .pagination .active span {
            background: #e74c3c;
            color: white;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .empty-state i {
            font-size: 4rem;
            color: #e74c3c;
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: #7f8c8d;
            margin-bottom: 2rem;
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

            .page-header h1 {
                font-size: 2rem;
            }

            .filter-form {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .results-info {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .cars-grid {
                grid-template-columns: 1fr;
            }

            .car-specs {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo">
                <i class="fas fa-car"></i>
                CarRental
            </a>
            <ul class="nav-menu" id="nav-menu">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('car.list') }}" class="active">Car</a></li>
                <li><a href="{{ route('home') }}#about">About Us</a></li>
            </ul>
            <div class="nav-toggle" id="nav-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Page Header -->
            <div class="page-header">
                <h1>Daftar Mobil</h1>
                <p>Temukan mobil impian Anda dengan mudah</p>
            </div>

            <!-- Search and Filter -->
            <div class="search-filter">
                <h3><i class="fas fa-search"></i> Cari & Filter Mobil</h3>
                <form method="GET" action="{{ route('car.list') }}" class="filter-form">
                    <div class="form-group">
                        <label for="search">Cari Mobil</label>
                        <div class="search-input">
                            <i class="fas fa-search"></i>
                            <input 
                                type="text" 
                                id="search" 
                                name="search" 
                                class="form-control" 
                                placeholder="Masukkan brand, model, atau plat nomor..."
                                value="{{ request('search') }}"
                            >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status Ketersediaan</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">Semua Status</option>
                            <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="disewa" {{ request('status') == 'disewa' ? 'selected' : '' }}>Disewa</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    @if(request('search') || request('status'))
                    <a href="{{ route('car.list') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Reset
                    </a>
                    @endif
                </form>
            </div>

            <!-- Results Info -->
            <div class="results-info">
                <div class="results-count">
                    <strong>{{ $cars->total() }}</strong> mobil ditemukan
                    @if(request('search'))
                        untuk pencarian "<strong>{{ request('search') }}</strong>"
                    @endif
                    @if(request('status'))
                        dengan status "<strong>{{ request('status') == 'tersedia' ? 'Tersedia' : 'Disewa' }}</strong>"
                    @endif
                </div>
                <div class="results-pagination">
                    Halaman {{ $cars->currentPage() }} dari {{ $cars->lastPage() }}
                </div>
            </div>

            <!-- Cars Grid -->
            @if($cars->count() > 0)
            <div class="cars-grid">
                @foreach($cars as $car)
                <div class="car-card">
                    <div class="car-image-container">
                        <img src="{{ $car->main_image }}" alt="{{ $car->brand }} {{ $car->model }}" class="car-image">
                        <div class="car-status-badge {{ $car->status }}">
                            {{ $car->status == 'tersedia' ? 'tersedia' : 'disewa' }}
                        </div>
                    </div>
                    <div class="car-info">
                        <h3 class="car-title">{{ $car->brand }} {{ $car->model }}</h3>
                        <p class="car-type">{{ $car->car_type }} • {{ $car->year }}</p>
                        
                        @if($car->description)
                        <p class="car-description">{{ $car->description }}</p>
                        @endif

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
                            <div class="spec-item">
                                <i class="fas fa-id-card"></i>
                                <span>{{ $car->license_plate }}</span>
                            </div>
                        </div>

                        <div class="car-details">
                            <div class="detail-row">
                                <span>Brand:</span>
                                <strong>{{ $car->brand }}</strong>
                            </div>
                            <div class="detail-row">
                                <span>Model:</span>
                                <strong>{{ $car->model }}</strong>
                            </div>
                            <div class="detail-row">
                                <span>Tahun:</span>
                                <strong>{{ $car->year }}</strong>
                            </div>
                        </div>

                        <div class="car-price">
                            Rp {{ number_format($car->price_per_day, 0, ',', '.') }}
                            <span class="price-unit">/hari</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper">
                {{ $cars->links() }}
            </div>
            @else
            <!-- Empty State -->
            <div class="empty-state">
                <i class="fas fa-car"></i>
                <h3>Mobil Tidak Ditemukan</h3>
                <p>Maaf, tidak ada mobil yang sesuai dengan kriteria pencarian Anda.</p>
                <a href="{{ route('car.list') }}" class="btn btn-primary">
                    <i class="fas fa-refresh"></i> Lihat Semua Mobil
                </a>
            </div>
            @endif
        </div>
    </main>

    <script>
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

        // Auto-submit form on status change
        document.getElementById('status').addEventListener('change', function() {
            this.form.submit();
        });

        // Add animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe car cards for animation
        document.querySelectorAll('.car-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });

        // Search input focus effect
        const searchInput = document.getElementById('search');
        const searchIcon = document.querySelector('.search-input i');

        searchInput.addEventListener('focus', function() {
            searchIcon.style.color = '#e74c3c';
        });

        searchInput.addEventListener('blur', function() {
            searchIcon.style.color = '#7f8c8d';
        });
    </script>
</body>
</html>