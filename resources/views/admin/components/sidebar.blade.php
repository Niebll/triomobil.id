<div class="sidebar">
    <div class="logo-details">
        <i class='bx bxs-car'></i>
        <span class="logo-name">Mobillin</span>
    </div>
    <ul class="nav-links">
        {{--
            Untuk link aktif, kita bisa gunakan helper Request::is() dari Laravel.
            Contoh: class="{{ Request::is('admin/dashboard/dashboard*') ? 'active' : '' }}"
        --}}
        <li class="{{ Request::is('admin/dashboard*') ? 'active' : '' }}">
            <a href="#"> {{-- Arahkan ke route('admin.dashboard.dashboard') --}}
                <i class='bx bxs-grid-alt'></i>
                <span class="link-name">Dashboard</span>
            </a>
        </li>
        <li class="{{ Request::is('admin/cars*') ? 'active' : '' }}">
            <a href="#"> {{-- Arahkan ke route('admin.cars.index') --}}
                <i class='bx bxs-car-garage'></i>
                <span class="link-name">Manajemen Mobil</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bxs-user-account'></i>
                <span class="link-name">Manajemen User</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class='bx bxs-cog'></i>
                <span class="link-name">Pengaturan</span>
            </a>
        </li>
            <li>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class='bx bx-log-out'></i>
                <span class="link-name">Logout</span>
            </a>
            <form id="logout-form" action="#" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>