<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Pendaftaran</title>
    <style>
        body {
            font-family: sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            color: #004aad;
            text-transform: uppercase;
        }

        .header p {
            margin: 5px 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px;
            font-size: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .badge {
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
        }

        .badge-pending {
            background-color: #ffeeba;
            color: #856404;
        }

        .badge-verified {
            background-color: #d4edda;
            color: #155724;
        }

        .badge-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Laporan Data Pendaftaran UKM</h2>
        <p>Institut Teknologi Nasional Malang</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>NIM</th>
                <th>Pilihan UKM</th>
                <th>Tanggal Daftar</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendaftarans as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->mahasiswa->nama ?? '-' }}</td>
                    <td>{{ $data->mahasiswa->nim ?? '-' }}</td>
                    <td>{{ $data->ukm->nama_ukm ?? '-' }}</td>
                    <td>{{ $data->created_at->format('d-m-Y') }}</td>
                    <td>
                        @if($data->status_verifikasi == 'Pending')
                            <span class="badge badge-pending">Pending</span>
                        @elseif($data->status_verifikasi == 'Diterima')
                            <span class="badge badge-verified">Diterima</span>
                        @else
                            <span class="badge badge-rejected">{{ $data->status_verifikasi }}</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>