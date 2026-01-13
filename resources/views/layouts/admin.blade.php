<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Sportal ITN</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        #sidebar {
            min-width: 260px;
            max-width: 260px;
            min-height: 100vh;
            background: #fff;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            position: fixed;
            z-index: 999;
        }

        #sidebar.active {
            margin-left: -260px;
        }

        .sidebar-header {
            padding: 20px;
            background: #fff;
            border-bottom: 1px solid #f0f0f0;
        }

        .sidebar-menu {
            padding: 15px 10px;
        }

        .menu-label {
            color: #adb5bd;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 15px 0 5px 10px;
        }

        .nav-link {
            color: #495057;
            padding: 10px 15px;
            margin-bottom: 4px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s;
        }

        .nav-link:hover {
            color: #0d6efd;
            background: #e9ecef;
        }

        .nav-link.active {
            color: #0d6efd;
            background: #e7f1ff;
            font-weight: 600;
        }

        .nav-link i {
            font-size: 1.1rem;
        }

        .logout-btn {
            color: #dc3545 !important;
        }

        .logout-btn:hover {
            background: #fee2e2 !important;
            color: #b02a37 !important;
        }

        /* Main Content */
        #content {
            width: 100%;
            margin-left: 260px;
            min-height: 100vh;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
        }

        #content.active {
            margin-left: 0;
        }

        /* Navbar */
        .navbar {
            background: #fff;
            padding: 12px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .main-container {
            padding: 30px;
            flex: 1;
        }

        /* Responsive */
        @media (max-width: 768px) {
            #sidebar {
                margin-left: -260px;
            }

            #sidebar.active {
                margin-left: 0;
            }

            #content {
                margin-left: 0;
            }

            #content.active {
                margin-left: 260px;
                /* Optional: push content or overlay */
            }

            /* Overlay when sidebar is active on mobile */
            .overlay {
                display: none;
                position: fixed;
                width: 100vw;
                height: 100vh;
                background: rgba(0, 0, 0, 0.4);
                z-index: 998;
                opacity: 0;
                transition: all 0.5s ease-in-out;
            }

            .overlay.active {
                display: block;
                opacity: 1;
            }
        }
    </style>
</head>

<body>

    <div class="d-flex wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header text-center">
                <div class="d-flex align-items-center justify-content-center gap-2">
                    <img src="{{ asset('assets/images/logo-itn.png') }}" alt="Logo" width="40">
                    <div class="text-start">
                        <small class="d-block text-muted" style="line-height:1; font-size: 0.7rem;">DASHBOARD</small>
                        <h6 class="m-0 fw-bold text-primary">UKMK ITN</h6>
                    </div>
                </div>
            </div>

            <div class="sidebar-menu">
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
                </a>

                <div class="menu-label">Menu Utama</div>
                <a href="{{ route('admin.pendaftaran.index') }}"
                    class="nav-link {{ request()->routeIs('admin.pendaftaran.index') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-text"></i> <span>Pendaftaran</span>
                </a>

                <div class="menu-label">Data Master</div>
                <a href="{{ route('admin.mahasiswa.index') }}"
                    class="nav-link {{ request()->routeIs('admin.mahasiswa.index') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> <span>Data Mahasiswa</span>
                </a>
                <a href="{{ route('admin.ukm.index') }}"
                    class="nav-link {{ request()->routeIs('admin.ukm.index') ? 'active' : '' }}">
                    <i class="bi bi-trophy"></i> <span>Manajemen UKM</span>
                </a>
                <a href="{{ route('admin.fasilitas.index') }}"
                    class="nav-link {{ request()->routeIs('admin.fasilitas.index') ? 'active' : '' }}">
                    <i class="bi bi-building"></i> <span>Fasilitas</span>
                </a>

                <div class="menu-label">Analisis SPK</div>
                <a href="{{ route('admin.kriteria.index') }}"
                    class="nav-link {{ request()->routeIs('admin.kriteria.index') ? 'active' : '' }}">
                    <i class="bi bi-bar-chart"></i> <span>Kriteria</span>
                </a>
                <a href="{{ route('admin.penilaian.index') }}"
                    class="nav-link {{ request()->routeIs('admin.penilaian.index') ? 'active' : '' }}">
                    <i class="bi bi-calculator"></i> <span>Penilaian</span>
                </a>

                <div class="menu-label">System</div>
                <a href="{{ route('admin.admins.index') }}"
                    class="nav-link {{ request()->routeIs('admin.admins.index') ? 'active' : '' }}">
                    <i class="bi bi-shield-lock"></i> <span>Admin</span>
                </a>

                <form action="{{ route('admin.logout') }}" method="POST" class="mt-4 border-top pt-2">
                    @csrf
                    <button type="submit" class="nav-link logout-btn w-100 border-0 bg-transparent">
                        <i class="bi bi-box-arrow-right"></i> <span>Logout</span>
                    </button>
                </form>
            </div>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg border-bottom">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-light shadow-sm border">
                        <i class="bi bi-list"></i>
                    </button>

                    <div class="ms-auto d-flex align-items-center gap-3">
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center text-decoration-none text-dark dropdown-toggle"
                                id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                                    style="width: 35px; height: 35px;">
                                    {{ substr(Auth::guard('admin')->user()->nama_admin ?? 'A', 0, 1) }}
                                </div>
                                <span>{{ Auth::guard('admin')->user()->nama_admin ?? 'Admin' }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="dropdownUser1">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('admin.logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content Area -->
            <div class="main-container">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>

            <!-- Footer might go here -->
            <footer class="bg-white text-center py-3 border-top mt-auto">
                <small class="text-muted text-uppercase">&copy; {{ date('Y') }} Project UKMK ITN Malang</small>
            </footer>
        </div>

        <!-- Overlay for mobile -->
        <div class="overlay" id="overlay"></div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            const sidebarCollapse = document.getElementById('sidebarCollapse');
            const overlay = document.getElementById('overlay');

            function toggleSidebar() {
                sidebar.classList.toggle('active');
                content.classList.toggle('active');
                if (window.innerWidth <= 768) {
                    overlay.classList.toggle('active');
                }
            }

            sidebarCollapse.addEventListener('click', toggleSidebar);
            overlay.addEventListener('click', toggleSidebar);

            // Responsive check on resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('active');
                    content.classList.remove('active');
                    overlay.classList.remove('active');
                }
            });
        });
    </script>
</body>

</html>