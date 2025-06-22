{{-- CSS Khusus untuk Navbar ada di sini --}}
<style>
    /* Pastikan variabel CSS :root (seperti --dark-color, --white-color) 
       sudah terdefinisi di file CSS utama/global yang di-load oleh halaman pemanggil,
       atau definisikan ulang variabel yang dibutuhkan di sini jika ingin benar-benar mandiri.
       Untuk contoh ini, kita asumsikan :root sudah ada di halaman pemanggil. */

    .navbar {
        background: var(--dark-color, #1a1a1a); /* Fallback color jika var tidak ada */
        padding: 1rem 0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        position: sticky;
        top: 0;
        z-index: 1000;
    }
    .navbar .container { /* container class ini mungkin perlu didefinisikan global juga */
        max-width: 1100px;
        margin: auto;
        padding: 0 20px;
        overflow: hidden;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
    }
    .navbar .logo { font-size: 1.5rem; font-weight: 700; }
    .navbar .logo a { color: var(--white-color, #fff); text-decoration: none;}
    .navbar .nav-links {
        display: flex;
        list-style: none;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        padding-left: 0; /* Reset padding default ul */
        margin-bottom: 0; /* Reset margin default ul */
    }
    .navbar .nav-links li { margin: 0 15px; }
    .navbar .nav-links a {
        color: #ccc;
        font-weight: 500;
        transition: color 0.3s;
        text-decoration: none;
    }
    .navbar .nav-links a:hover, 
    .navbar .nav-links a.active { color: var(--white-color, #fff); }
    
    #menu-icon {
        font-size: 2rem;
        color: var(--white-color, #fff);
        cursor: pointer;
        display: none;
        z-index: 101;
    }

    /* Navbar Responsif (Mobile) */
    @media (max-width: 768px) {
        #menu-icon { display: block; }
        .navbar .nav-links {
            position: absolute;
            top: 100%; /* Relative to navbar height */
            left: -100%;
            width: 100%;
            background: var(--dark-color, #1a1a1a);
            flex-direction: column;
            padding: 10px 0;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
            transition: all 0.4s ease;
            transform: none; /* Reset transform */
        }
        .navbar .nav-links.active { left: 0; }
        .navbar .nav-links li { margin: 10px 20px; text-align: center; }
    }
</style>

<nav class="navbar">
    <div class="container">
        <h1 class="logo"><a href="{{ url('/home') }}">Ngacir Wir</a></h1>
        
        <ul class="nav-links" id="nav-links-ul"> {{-- Ganti ID agar unik jika #nav-links dipakai di tempat lain --}}
            <li><a href="{{ url('/home') }}" class="{{ request()->is('home') ? 'active' : '' }}">Beranda</a></li>
            <li><a href="{{ url('/car-list') }}" class="{{ request()->is('car*') ? 'active' : '' }}">Mobil</a></li>
            <li><a href="{{ url('/#tentang-kami') }}">Tentang Kami</a></li>
        </ul>

        <i class='bx bx-menu' id="menu-icon-toggle"></i> {{-- Ganti ID agar unik --}}
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuIconToggle = document.getElementById('menu-icon-toggle');
        const navLinksUl = document.getElementById('nav-links-ul');

        if (menuIconToggle && navLinksUl) {
            menuIconToggle.addEventListener('click', () => {
                navLinksUl.classList.toggle('active');
            });
        }
    });
</script>