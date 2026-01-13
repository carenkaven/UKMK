<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Fasilitas</title>
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
        <p class="small">Laporan Data Fasilitas UKM</p>
        <div class="line"></div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%; text-align: center;">No</th>
                <th style="width: 30%;">Nama Fasilitas</th>
                <th style="width: 65%;">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fasilitas as $index => $item)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td style="font-weight: bold;">{{ $item->nama_fasilitas }}</td>
                    <td style="text-align: justify;">{{ $item->deskripsi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ date('d-m-Y H:i') }}
    </div>
</body>

</html>