<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Kriteria</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .header-kop {
            display: table;
            width: 100%;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header-logo {
            display: table-cell;
            width: 15%;
            vertical-align: middle;
            text-align: center;
        }

        .header-text {
            display: table-cell;
            width: 85%;
            text-align: center;
            vertical-align: middle;
        }

        .header-text h3 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .header-text h2 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
            color: #000;
        }

        .header-text p {
            margin: 2px 0;
            font-size: 11px;
        }

        .content-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .content-title h4 {
            margin: 0;
            text-transform: uppercase;
            text-decoration: underline;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 12px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
        }

        th {
            background-color: #f0f0f0;
            text-align: center;
            font-weight: bold;
        }

        .signature-section {
            margin-top: 40px;
            width: 100%;
            display: table;
            break-inside: avoid;
        }

        .signature-box {
            display: table-cell;
            width: 40%;
            text-align: center;
            padding-left: 60%;
        }

        .signature-box p {
            margin: 2px 0;
        }

        .signature-space {
            height: 70px;
        }

        .signature-name {
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    @php
        $path = public_path('assets/images/logo-itn.png');
        $logoBase64 = '';
        if (file_exists($path)) {
            try {
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $logoBase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            } catch (\Exception $e) {
                $logoBase64 = '';
            }
        }
    @endphp
    <div class="header-kop">
        <div class="header-logo">
            <img src="{{ $logoBase64 }}" alt="Logo ITN" style="width: 80px; height: auto;">
        </div>
        <div class="header-text">
            <h3>PERKUMPULAN PENGELOLA PENDIDIKAN UMUM DAN TEKNOLOGI</h3>
            <h2>INSTITUT TEKNOLOGI NASIONAL MALANG</h2>
            <h3>FAKULTAS TEKNOLOGI INDUSTRI</h3>
            <p>Jalan Bendungan Sigura-gura No. 2 Telp. (0341) 551431 Fax. (0341) 553015 Malang 65145</p>
            <p>Website: www.itn.ac.id | Email: ftiteknik@itn.ac.id</p>
        </div>
    </div>

    <div class="content-title">
        <h4>LAPORAN DATA KRITERIA DAN SUB-KRITERIA (SPK)</h4>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
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
                    <td style="text-align: center;">{{ $kriteria->bobot }}%</td>
                    <td>
                        @if($kriteria->subkriteria->count() > 0)
                            <ul style="margin: 0; padding-left: 20px;">
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

    <div class="signature-section">
        <div class="signature-box">
            <p>Malang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p>Mengetahui,</p>
            <p>Kepala Bagian Kemahasiswaan</p>
            <div class="signature-space"></div>
            <p class="signature-name">(..................................................)</p>
            <p>NIP. ....................................</p>
        </div>
    </div>
</body>

</html>