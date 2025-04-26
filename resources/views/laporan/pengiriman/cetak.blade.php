<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengiriman</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        @page {
            size: A4 portrait;
            margin: 0;
        }

        body {
            margin: 1cm;
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            height: 80px;
            width: auto;
            display: block;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        .wrap-text {
            word-wrap: break-word;
            white-space: normal;
        }

        .page-break {
            page-break-after: always;
        }

        .print-button {
            display: block;
            width: 100%;
            text-align: right;
            margin-bottom: 20px;
        }

        .print-button button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
</head>

<body>
    <header>
        {{-- <img src="{{ asset('assets/images/logo2.png') }}" alt="Logo Perusahaan" class="logo"> --}}
        <h1>Laporan Pengiriman</h1>
    </header>

    <div class="print-button">
        <button onclick="window.print()">Print</button>
    </div>

    <main>
        <p class="text-center">Periode: {{ $tanggal_mulai }} - {{ $tanggal_terakhir }}</p>
        <p>Total Pengiriman: {{ $total }}</p>
        <p>Tanggal Cetak: {{ $tanggal_cetak }}</p>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                                                <th>Supir</th>
                                                <th>Shift</th>
                                                <th>Total Tonase(KG)</th>
                                                <th>Total Ritase</th>
                                                <th>Jam Masuk</th>
                                                <th>Jam Keluar</th>
                                                {{-- <th>Status Pengecekan Mobil</th>                                    --}}
                                                <th>Status</th>                         
                </tr>
            </thead>
            <tbody>
                @foreach ($pengiriman as $e)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $e->Supir->nama }}</td>
                    <td>{{ $e->shift}}</td>
                    <td>{{ $e->total_tonase }}</td>
                    <td>{{ $e->total_ritase }}</td>
                    <td>{{ $e->jam_masuk }}</td>
                    <td>{{ $e->jam_keluar }}</td>
                    {{-- <td>{{ $e->Pengecekan->status }}</td> --}}
    
                  


                     <td>{{ $e->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>

</html>
