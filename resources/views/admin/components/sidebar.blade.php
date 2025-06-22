<div class="sidebar">
    <div class="logo-details">
        <i class='bx bxs-car'></i>
        <span class="logo-name">Mobillin</span>
    </div>
    <ul class="nav-links">
        {{-- Logika untuk link aktif --}}
        <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard.dashboard') }}">
                <i class='bx bxs-grid-alt'></i>
                <span class="link-name">Dashboard</span>
            </a>
        </li>
        <li class="{{ Request::is('dashboard/cars*') ? 'active' : '' }}">
            <a href="{{ route('dashboard.cars') }}"> {{-- Arahkan ke route('admin.cars.index') nanti --}}
                <i class='bx bxs-car-garage'></i>
                <span class="link-name">Manajemen Mobil</span>
            </a>
        </li>
        <li>
            {{-- Form logout yang benar --}}
            <a href="{{ route('auth.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class='bx bx-log-out'></i>
                <span class="link-name">Logout</span>
            </a>
            <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</div>