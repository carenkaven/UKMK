<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Kriteria</title>
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
            vertical-align: top;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Laporan Data Kriteria & Sub-Kriteria</h2>
        <p>Institut Teknologi Nasional Malang</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kriteria</th>
                <th>Bobot (%)</th>
                <th>Sub Kriteria & Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kriterias as $index => $kriteria)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $kriteria->nama_kriteria }}</td>
                    <td>{{ $kriteria->bobot }}%</td>
                    <td>
                        @if($kriteria->subkriteria->count() > 0)
                            <ul>
                                @foreach($kriteria->subkriteria as $sub)
                                    <li>{{ $sub->nama_sub }} (Nilai: {{ $sub->nilai }})</li>
                                @endforeach
                            </ul>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>