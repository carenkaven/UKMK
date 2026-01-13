@extends('layouts.admin')



@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="dashboard-header">
        <h2>Dashboard Overview</h2>
        <p>Monitor aktivitas pendaftaran UKM terkini.</p>
    </div>

    <!-- Stats Grid -->
    <div class="stat-grid">
        <div class="stat-card blue">
            <div class="stat-icon">👥</div>
            <div class="stat-info">
                <p>Total Mahasiswa</p>
                <h3>{{ $totalMahasiswa }}</h3>
            </div>
        </div>
        <div class="stat-card yellow">
            <div class="stat-icon">📝</div>
            <div class="stat-info">
                <p>Pendaftaran Baru</p>
                <h3>{{ $pendaftaranBaru }}</h3>
            </div>
        </div>
        <div class="stat-card green">
            <div class="stat-icon">🏢</div>
            <div class="stat-info">
                <p>Total UKM</p>
                <h3>{{ $totalUkm }}</h3>
            </div>
        </div>
        <div class="stat-card teal">
            <div class="stat-icon">🏟️</div>
            <div class="stat-info">
                <p>Fasilitas</p>
                <h3>{{ $totalFasilitas }}</h3>
            </div>
        </div>
    </div>

    <div class="dashboard-content">
        <!-- Left Column: Chart -->
        <div class="card chart-card">
            <div class="card-header">
                <h3>📊 Top 5 UKM Paling Diminati</h3>
            </div>
            <div class="chart-container">
                <canvas id="ukmChart"></canvas>
            </div>
        </div>

        <!-- Right Column: Recent Activity -->
        <div class="card recent-card">
            <div class="card-header">
                <h3>🕒 Aktivitas Terbaru</h3>
            </div>

            @if($recentActivities->count() > 0)
                <div class="activity-list">
                    @foreach($recentActivities as $act)
                        <div class="activity-item">
                            <div class="avatar">
                                {{ substr($act->mahasiswa->nama, 0, 1) }}
                            </div>
                            <div class="details">
                                <strong>{{ $act->mahasiswa->nama }}</strong>
                                <span>{{ $act->ukm->nama_ukm }}</span>
                            </div>
                            <span class="status-badge {{ $act->status_verifikasi == 'Pending' ? 'pending' : 'success' }}">
                                {{ $act->status_verifikasi }}
                            </span>
                        </div>
                    @endforeach
                </div>
                <div class="view-more">
                    <a href="{{ route('admin.pendaftaran.index') }}">Selengkapnya &rarr;</a>
                </div>
            @else
                <div class="empty-state">
                    <p>Belum ada aktivitas terbaru.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Chart Script -->
    <script>
        const ctx = document.getElementById('ukmChart').getContext('2d');
        const ukmData = @json($chartData);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ukmData.map(d => d.name),
                datasets: [{
                    label: 'Pendaftar',
                    data: ukmData.map(d => d.count),
                    backgroundColor: [
                        'rgba(0, 74, 173, 0.85)',
                        'rgba(40, 167, 69, 0.85)',
                        'rgba(255, 193, 7, 0.85)',
                        'rgba(23, 162, 184, 0.85)',
                        'rgba(108, 117, 125, 0.85)'
                    ],
                    borderRadius: 6,
                    barPercentage: 0.6,
                    maxBarThickness: 40 // Prevent too thick bars
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: { stepSize: 1, font: { size: 11 } },
                        grid: { color: '#f0f0f0' }
                    },
                    y: {
                        grid: { display: false },
                        ticks: { font: { size: 12, weight: '500' } }
                    }
                },
                layout: { padding: { right: 20 } }
            }
        });
    </script>

    <style>
        /* General Layout */
        .dashboard-header {
            margin-bottom: 25px;
        }

        .dashboard-header h2 {
            color: #1a202c;
            margin: 0 0 5px 0;
            font-size: 1.6rem;
            font-weight: 700;
        }

        .dashboard-header p {
            color: #718096;
            margin: 0;
            font-size: 0.95rem;
        }

        /* Stats Grid */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            display: flex;
            align-items: center;
            gap: 15px;
            border: 1px solid #edf2f7;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        }

        .stat-card.blue .stat-icon {
            background: #ebf8ff;
            color: #3182ce;
        }

        .stat-card.yellow .stat-icon {
            background: #fffff0;
            color: #d69e2e;
        }

        .stat-card.green .stat-icon {
            background: #f0fff4;
            color: #38a169;
        }

        .stat-card.teal .stat-icon {
            background: #e6fffa;
            color: #319795;
        }

        .stat-icon {
            font-size: 1.4rem;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
        }

        .stat-info p {
            margin: 0 0 5px;
            color: #718096;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .stat-info h3 {
            margin: 0;
            color: #2d3748;
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1;
        }

        /* Content Area */
        .dashboard-content {
            display: grid;
            grid-template-columns: 2fr 1.2fr;
            gap: 25px;
            /* Use alignment instead of forced height to prevent stretching */
            align-items: start;
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            border: 1px solid #edf2f7;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .card-header {
            padding: 20px 25px;
            border-bottom: 1px solid #edf2f7;
            background: #fff;
        }
        .card-header h3 { margin: 0; font-size: 1.1rem; color: #2d3748; font-weight: 600; }

        /* Chart Specifics */
        .chart-card { min-height: 400px; }
        .chart-container {
            padding: 20px;
            position: relative;
            height: 350px; /* Fixed proportional height */
            width: 100%;
        }

        /* Recent Activity Specifics */
        .recent-card {
            height: 420px; /* Matches chart visual height roughly */
        }
        .activity-list {
            flex: 1;
            overflow-y: auto;
            padding: 0 20px;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 0;
            border-bottom: 1px solid #edf2f7;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .avatar {
            width: 36px;
            height: 36px;
            background: #edf2f7;
            color: #4a5568;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .details {
            flex: 1;
        }

        .details strong {
            display: block;
            font-size: 0.9rem;
            color: #2d3748;
            margin-bottom: 2px;
        }

        .details span {
            font-size: 0.8rem;
            color: #718096;
            display: block;
        }

        .status-badge {
            font-size: 0.7rem;
            padding: 4px 10px;
            border-radius: 20px;
            font-weight: 600;
        }

        .status-badge.pending {
            background: #fffaf0;
            color: #c05621;
            border: 1px solid #fbd38d;
        }

        .status-badge.success {
            background: #f0fff4;
            color: #2f855a;
            border: 1px solid #9ae6b4;
        }

        .view-more {
            padding: 15px;
            text-align: center;
            border-top: 1px solid #edf2f7;
            background: #fafbfc;
        }

        .view-more a {
            color: #3182ce;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.2s;
        }

        .view-more a:hover {
            color: #2b6cb0;
        }

        .empty-state {
            padding: 40px;
            text-align: center;
            color: #a0aec0;
        }

        /* Scrollbar aesthetics */
        .activity-list::-webkit-scrollbar {
            width: 6px;
        }

        .activity-list::-webkit-scrollbar-track {
            background: transparent;
        }

        .activity-list::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 3px;
        }

        .activity-list::-webkit-scrollbar-thumb:hover {
            background: #a0aec0;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .stat-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .dashboard-content {
                grid-template-columns: 1fr;
            }

            .chart-container {
                height: 300px;
            }

            .recent-card {
                height: auto;
                max-height: 500px;
            }

            .stat-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection