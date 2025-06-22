<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title> 
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        
        :root {
            --primary-color: #0e4bf1;
            --light-color: #f4f4f4;
            --dark-color: #333;
            --sidebar-color: #11101d;
            --sidebar-light-color: #1d1b31;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { display: flex; min-height: 100vh; background-color: var(--light-color); }

        /* Style untuk Sidebar */
        .sidebar { position: fixed; top: 0; left: 0; height: 100%; width: 260px; background-color: var(--sidebar-color); z-index: 100; transition: all 0.5s ease; }
        .sidebar.close { width: 78px; }
        .sidebar .logo-details { height: 60px; width: 100%; display: flex; align-items: center; }
        .sidebar .logo-details i { font-size: 30px; color: #fff; height: 50px; min-width: 78px; text-align: center; line-height: 50px; }
        .sidebar .logo-details .logo-name { font-size: 22px; color: #fff; font-weight: 600; transition: 0.3s ease; transition-delay: 0.1s; }
        .sidebar.close .logo-details .logo-name { opacity: 0; pointer-events: none; transition-delay: 0s; }
        .sidebar .nav-links { height: 100%; padding: 30px 0 150px 0; overflow: auto; list-style: none; }
        .sidebar.close .nav-links { overflow: visible; }
        .sidebar .nav-links::-webkit-scrollbar { display: none; }
        .sidebar .nav-links li { position: relative; transition: all 0.4s ease; }
        .sidebar .nav-links li:hover { background: var(--sidebar-light-color); }
        .sidebar .nav-links li a { display: flex; align-items: center; text-decoration: none; width: 100%; height: 100%; }
        .sidebar .nav-links li a .link-name { font-size: 18px; font-weight: 400; color: #fff; }
        .sidebar.close .nav-links li a .link-name { opacity: 0; pointer-events: none; }
        .sidebar .nav-links li i { height: 50px; min-width: 78px; text-align: center; line-height: 50px; color: #fff; font-size: 20px; }
        .sidebar .nav-links li.active { background: var(--primary-color); }

        /* Style untuk Kerangka Utama dan Header */
        .main-section { position: relative; background: var(--light-color); left: 260px; width: calc(100% - 260px); transition: all 0.5s ease; }
        .sidebar.close ~ .main-section { left: 78px; width: calc(100% - 78px); }
        .header { display: flex; align-items: center; justify-content: space-between; background: #fff; padding: 15px 20px; border-radius: 10px; margin: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.05); }
        .header .menu-toggle { font-size: 24px; cursor: pointer; }
        .header .user-profile { display: flex; align-items: center; }
        .header .user-profile span { margin-right: 10px; font-weight: 500; }
        .header .user-profile i { font-size: 28px; }
    </style>

    @stack('styles')
</head>
<body>
    @include('admin.components.sidebar')

    <section class="main-section">
        <header class="header">
            <div class="menu-toggle"><i class='bx bx-menu'></i></div>
            <div class="user-profile"><span>Halo, Admin</span><i class='bx bxs-user-circle'></i></div>
        </header>

        <main style="padding: 0 20px 20px;">
             @yield('content')
        </main>
    </section>

    <script>
        let sidebar = document.querySelector(".sidebar");
        let menuToggle = document.querySelector(".menu-toggle");
        
        if (menuToggle && sidebar) {
            menuToggle.addEventListener("click", () => {
                sidebar.classList.toggle("close");
            });
        }
    </script>
    
</body>
</html>