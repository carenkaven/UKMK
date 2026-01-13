@extends('layouts.admin')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="h3 text-dark fw-bold mb-1">Dashboard Overview</h2>
            <p class="text-muted">Monitor aktivitas pendaftaran UKM terkini.</p>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="row g-4 mb-4">
        <!-- Total Mahasiswa -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3 bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-people fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 small text-uppercase fw-bold">Total Mahasiswa</h6>
                        <h3 class="mb-0 fw-bold text-dark">{{ $totalMahasiswa }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pendaftaran Baru -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3 bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-file-earmark-text fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 small text-uppercase fw-bold">Pendaftaran Baru</h6>
                        <h3 class="mb-0 fw-bold text-dark">{{ $pendaftaranBaru }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total UKM -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3 bg-success bg-opacity-10 text-success">
                        <i class="bi bi-trophy fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 small text-uppercase fw-bold">Total UKM</h6>
                        <h3 class="mb-0 fw-bold text-dark">{{ $totalUkm }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fasilitas -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3 bg-info bg-opacity-10 text-info">
                        <i class="bi bi-building fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1 small text-uppercase fw-bold">Fasilitas</h6>
                        <h3 class="mb-0 fw-bold text-dark">{{ $totalFasilitas }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Chart Section -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <h5 class="card-title mb-0 fw-bold">📊 Top 5 UKM Paling Diminati</h5>
                </div>
                <div class="card-body">
                    <div style="height: 350px; width: 100%;">
                        <canvas id="ukmChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <h5 class="card-title mb-0 fw-bold">🕒 Aktivitas Terbaru</h5>
                </div>
                <div class="card-body p-0">
                    @if($recentActivities->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recentActivities as $act)
                                <div class="list-group-item d-flex align-items-center gap-3 py-3 border-0 border-bottom mx-3">
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center flex-shrink-0 fw-bold text-secondary"
                                        style="width: 40px; height: 40px;">
                                        {{ substr($act->mahasiswa->nama, 0, 1) }}
                                    </div>
                                    <div class="flex-grow-1 min-width-0">
                                        <h6 class="mb-0 text-truncate font-weight-bold ml-2">{{ $act->mahasiswa->nama }}</h6>
                                        <small class="text-muted d-block text-truncate">{{ $act->ukm->nama_ukm }}</small>
                                    </div>
                                    <span
                                        class="badge rounded-pill {{ $act->status_verifikasi == 'Pending' ? 'bg-warning text-dark' : 'bg-success' }}">
                                        {{ $act->status_verifikasi }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                        <div class="p-3 text-center border-top mt-auto">
                            <a href="{{ route('admin.pendaftaran.index') }}" class="text-decoration-none fw-medium">Lihat
                                Selengkapnya <i class="bi bi-arrow-right"></i></a>
                        </div>
                    @else
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            <p class="mb-0">Belum ada aktivitas terbaru.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('ukmChart').getContext('2d');
            const ukmData = @json($chartData); // Ensure controller sends this variable

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ukmData.map(d => d.name),
                    datasets: [{
                        label: 'Pendaftar',
                        data: ukmData.map(d => d.count),
                        backgroundColor: [
                            'rgba(13, 110, 253, 0.8)',  // Primary
                            'rgba(25, 135, 84, 0.8)',   // Success
                            'rgba(255, 193, 7, 0.8)',   // Warning
                            'rgba(13, 202, 240, 0.8)',  // Info
                            'rgba(108, 117, 125, 0.8)'  // Secondary
                        ],
                        borderWidth: 0,
                        borderRadius: 4,
                        maxBarThickness: 50
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            grid: { color: '#f8f9fa' },
                            ticks: { precision: 0 }
                        },
                        y: {
                            grid: { display: false }
                        }
                    }
                }
            });
        });
    </script>
@endsection