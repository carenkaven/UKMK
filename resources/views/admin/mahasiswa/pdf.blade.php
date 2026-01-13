<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Mahasiswa UKM</title>
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
    </style>
</head>

<body>
    <div class="header">
        <h2>Laporan Data Mahasiswa UKM</h2>
        <p>Institut Teknologi Nasional Malang</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>No Telepon</th>
                <th>Fakultas / Prodi</th>
                <th>UKM Aktif</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mahasiswas as $index => $mhs)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $mhs->nama }}</td>
                    <td>{{ $mhs->nim }}</td>
                    <td>{{ $mhs->telepon }}</td>
                    <td>{{ $mhs->fakultas }} - {{ $mhs->prodi }}</td>
                    <td>
                        <!-- Tampilkan UKM -->
                        @foreach($mhs->pendaftaran as $pend)
                            @if($pend->status_verifikasi == 'Diterima')
                                - {{ $pend->ukm->nama_ukm }}<br>
                            @endif
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>