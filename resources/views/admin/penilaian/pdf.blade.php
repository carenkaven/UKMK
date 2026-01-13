<!DOCTYPE html>
<html>

<head>
    <title>Laporan Hasil Perangkingan (SPK)</title>
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

        .score {
            font-weight: bold;
            color: #004aad;
            font-size: 14px;
        }

        .rank-top {
            background-color: #e3f2fd !important;
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
        <p class="small">Laporan Hasil Rekomendasi Atlet - Metode SAW</p>
        <div class="line"></div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 10%; text-align: center;">Ranking</th>
                <th style="width: 30%;">Nama Mahasiswa</th>
                <th style="width: 25%;">NIM</th>
                <th style="width: 20%;">Prodi</th>
                <th style="width: 15%; text-align: center;">Total Skor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rankings as $index => $rank)
                <tr class="{{ $index < 3 ? 'rank-top' : '' }}">
                    <td style="text-align: center; font-weight: bold;">
                        @if($index == 0) 1 🥇
                        @elseif($index == 1) 2 🥈
                        @elseif($index == 2) 3 🥉
                        @else {{ $index + 1 }}
                        @endif
                    </td>
                    <td style="font-weight: bold;">{{ $rank['mahasiswa']->nama }}</td>
                    <td>{{ $rank['mahasiswa']->nim }}</td>
                    <td>{{ $rank['mahasiswa']->prodi }}</td>
                    <td class="score" style="text-align: center;">{{ number_format($rank['total_skor'], 3) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ date('d-m-Y H:i') }}
    </div>
</body>

</html>