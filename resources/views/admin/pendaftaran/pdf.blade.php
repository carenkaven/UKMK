<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Pendaftaran</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h2 {
            font-size: 20px;
            margin: 0;
            color: #004aad;
            text-transform: uppercase;
            font-weight: 800;
        }

        .header p {
            font-size: 14px;
            margin: 5px 0;
            color: #666;
        }

        .line {
            border-bottom: 2px solid #004aad;
            margin-top: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #e0e0e0;
            padding: 12px;
            text-align: left;
            vertical-align: middle;
        }

        th {
            background-color: #004aad;
            color: white;
            text-transform: uppercase;
            font-size: 11px;
            font-weight: bold;
            border-color: #003380;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
            display: inline-block;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }

        .status-diterima {
            background-color: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }

        .status-ditolak {
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }

        .footer {
            position: fixed;
            bottom: 20px;
            width: 100%;
            text-align: right;
            font-size: 10px;
            color: #999;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>INSTITUT TEKNOLOGI NASIONAL MALANG</h2>
        <p>Jalan Bendungan Sigura-gura No. 2 Malang, Jawa Timur</p>
        <p class="small">Laporan Data Pendaftaran Anggota UKM</p>
        <div class="line"></div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%; text-align: center;">No</th>
                <th style="width: 25%;">Nama Mahasiswa</th>
                <th style="width: 15%;">NIM</th>
                <th style="width: 25%;">Pilihan UKM</th>
                <th style="width: 15%;">Tanggal Daftar</th>
                <th style="width: 15%; text-align: center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendaftarans as $index => $data)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td style="font-weight: bold;">{{ $data->mahasiswa->nama ?? '-' }}</td>
                    <td>{{ $data->mahasiswa->nim ?? '-' }}</td>
                    <td>{{ $data->ukm->nama_ukm ?? '-' }}</td>
                    <td>{{ $data->created_at->format('d/m/Y') }}</td>
                    <td style="text-align: center;">
                        @if($data->status_verifikasi == 'Pending')
                            <span class="status-badge status-pending">PENDING</span>
                        @elseif($data->status_verifikasi == 'Diterima')
                            <span class="status-badge status-diterima">DITERIMA</span>
                        @else
                            <span class="status-badge status-ditolak">{{ strtoupper($data->status_verifikasi) }}</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ date('d-m-Y H:i') }}
    </div>
</body>

</html>