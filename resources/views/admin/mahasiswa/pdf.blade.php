<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Mahasiswa UKM</title>
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
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
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
        <p class="small">Laporan Data Mahasiswa UKM</p>
        <div class="line"></div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%; text-align: center;">No</th>
                <th style="width: 20%;">Nama</th>
                <th style="width: 15%;">NIM</th>
                <th style="width: 15%;">No Telepon</th>
                <th style="width: 25%;">Fakultas / Prodi</th>
                <th style="width: 20%;">UKM Aktif</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mahasiswas as $index => $mhs)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td style="font-weight: bold;">{{ $mhs->nama }}</td>
                    <td>{{ $mhs->nim }}</td>
                    <td>{{ $mhs->telepon }}</td>
                    <td>{{ $mhs->fakultas }} - {{ $mhs->prodi }}</td>
                    <td>
                        <ul style="margin: 0; padding-left: 15px;">
                            @forelse($mhs->pendaftaran as $pend)
                                @if($pend->status_verifikasi == 'Diterima')
                                    <li>{{ $pend->ukm->nama_ukm }}</li>
                                @endif
                            @empty
                                <li style="list-style: none; color: #999;">-</li>
                            @endforelse
                        </ul>
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