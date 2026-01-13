<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data UKM</title>
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
        <h2>Laporan Data UKM</h2>
        <p>Institut Teknologi Nasional Malang</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama UKM</th>
                <th>Ketua</th>
                <th>Deskripsi</th>
                <th>Kontak</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ukms as $index => $ukm)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $ukm->nama_ukm }}</td>
                    <td>{{ $ukm->ketua_ukm }}</td>
                    <td>{{ Str::limit($ukm->deskripsi, 100) }}</td>
                    <td>{{ $ukm->kontak }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>