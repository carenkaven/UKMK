<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Kriteria</title>
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
            vertical-align: top;
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

        ul {
            margin: 0;
            padding-left: 20px;
        }

        li {
            margin-bottom: 4px;
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
        <p class="small">Laporan Data Kriteria & Sub-Kriteria (SPK)</p>
        <div class="line"></div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%; text-align: center;">No</th>
                <th style="width: 25%;">Kriteria</th>
                <th style="width: 15%;">Bobot</th>
                <th style="width: 55%;">Sub Kriteria & Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kriterias as $index => $kriteria)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td style="font-weight: bold;">{{ $kriteria->nama_kriteria }}</td>
                    <td><span
                            style="background-color: #e3f2fd; padding: 2px 6px; border-radius: 4px; font-weight: bold; color: #0d47a1;">{{ $kriteria->bobot }}%</span>
                    </td>
                    <td>
                        @if($kriteria->subkriteria->count() > 0)
                            <ul>
                                @foreach($kriteria->subkriteria as $sub)
                                    <li><strong>{{ $sub->nama_sub }}</strong> (Nilai: {{ $sub->nilai }})</li>
                                @endforeach
                            </ul>
                        @else
                            <span style="color: #999; font-style: italic;">Belum ada sub kriteria</span>
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