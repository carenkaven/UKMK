<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Sportal ITN</title>
    <link rel="stylesheet" href="{{ asset('assets/admin.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>

    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div style="text-align: center; margin-bottom: 20px;">
                <img src="{{ asset('assets/images/logo-itn.png') }}" alt="Logo ITN"
                    style="width: 50px; margin-bottom: 8px;">
                <h2 style="font-size: 0.9rem; letter-spacing: 0.5px; line-height: 1.3; margin: 0;">
                    DASHBOARD <br> UKMK ITN MALANG
                </h2>
            </div>
            <nav class="sidebar-menu">
                <a href="{{ route('admin.dashboard') }}"
                    class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="icon">🏠</span> Dashboard
                </a>

                <div class="menu-label">Menu Utama</div>
                <a href="{{ route('admin.pendaftaran.index') }}"
                    class="{{ request()->routeIs('admin.pendaftaran.index') ? 'active' : '' }}">
                    <span class="icon">📝</span> Pendaftaran
                </a>

                <div class="menu-label">Data Master</div>
                <a href="{{ route('admin.mahasiswa.index') }}"
                    class="{{ request()->routeIs('admin.mahasiswa.index') ? 'active' : '' }}">
                    <span class="icon">👥</span> Data Mahasiswa UKM
                </a>
                <a href="{{ route('admin.ukm.index') }}"
                    class="{{ request()->routeIs('admin.ukm.index') ? 'active' : '' }}">
                    <span class="icon">🏆</span> Manajemen UKM
                </a>
                <a href="{{ route('admin.fasilitas.index') }}"
                    class="{{ request()->routeIs('admin.fasilitas.index') ? 'active' : '' }}">
                    <span class="icon">🏟️</span> Fasilitas
                </a>

                <div class="menu-label">Analisis SPK</div>
                <a href="{{ route('admin.kriteria.index') }}"
                    class="{{ request()->routeIs('admin.kriteria.index') ? 'active' : '' }}">
                    <span class="icon">📊</span> Kriteria
                </a>
                <a href="{{ route('admin.penilaian.index') }}"
                    class="{{ request()->routeIs('admin.penilaian.index') ? 'active' : '' }}">
                    <span class="icon">⚖️</span> Penilaian
                </a>

                <div class="menu-label">System</div>
                <a href="{{ route('admin.admins.index') }}"
                    class="{{ request()->routeIs('admin.admins.index') ? 'active' : '' }}">
                    <span class="icon">🛡️</span> Admin
                </a>

                <form action="{{ route('admin.logout') }}" method="POST" style="margin-top: 20px;">
                    @csrf
                    <button type="submit" class="nav-link logout-btn">
                        <span class="icon">🚪</span> Logout
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="topbar">
                <button class="toggle-sidebar" id="toggleSidebar">
                    <span>&#9776;</span>
                </button>
                <h3>Admin Dashboard</h3>
                <div class="user-info">
                    <span>Halo, <strong>{{ Auth::guard('admin')->user()->nama_admin ?? 'Admin' }}</strong></span>
                </div>
            </header>

            <div class="content">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function () {
            document.querySelector('.admin-container').classList.toggle('sidebar-active');
        });
    </script>

</body>

</html>