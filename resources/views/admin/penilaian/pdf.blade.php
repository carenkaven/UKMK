<!DOCTYPE html>
<html>

<head>
    <title>Laporan Hasil Perangkingan (SPK)</title>
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

        .score {
            font-weight: bold;
            color: #004aad;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Laporan Hasil Perangkingan</h2>
        <p>Metode Simple Additive Weighting (SAW)</p>
        <p>Institut Teknologi Nasional Malang</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Ranking</th>
                <th>Nama Mahasiswa</th>
                <th>NIM</th>
                <th>Prodi</th>
                <th>Total Skor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rankings as $index => $rank)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ $rank['mahasiswa']->nama }}</td>
                    <td>{{ $rank['mahasiswa']->nim }}</td>
                    <td>{{ $rank['mahasiswa']->prodi }}</td>
                    <td class="score">{{ number_format($rank['total_skor'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>