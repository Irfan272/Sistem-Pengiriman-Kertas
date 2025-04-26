<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengecekan</title>
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
        <h1>Laporan Pengecekan</h1>
    </header>

    <div class="print-button">
        <button onclick="window.print()">Print</button>
    </div>

    <main>
        <p class="text-center">Periode: {{ $tanggal_mulai }} - {{ $tanggal_terakhir }}</p>
        <p>Total Pengecekan: {{ $total }}</p>
        <p>Tanggal Cetak: {{ $tanggal_cetak }}</p>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Supir</th>
                    <th>Plat Mobil</th>
                    <th>Tanggal Pengecekan</th>
                    <th>Shift Pengecekan</th>
                    <th>Alarm</th>
                    <th>Lampu Penerangan</th>
                    <th>Lampu Rem</th>
                    <th>Rem</th>
                    <th>Sen Kanan</th>
                    <th>Sen Kiri</th>
                    <th>Klakson</th>
                    <th>Safety Belt</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengecekan as $e)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $e->Supir->nama }}</td>
                        <td>{{ $e->plat_mobil }}</td>
                        <td>{{ $e->tanggal_pengecekan }}</td>
                        <td>{{ $e->shift_pengecekan }}</td>
                        <td>
                            {{ $e->alarm == 1 ? 'Ok' : 'Tidak' }}
                        </td>
                        <td>
                            {{ $e->lampu_penerangan == 1 ? 'Ok' : 'Tidak' }}
                        </td>
                        <td>
                            {{ $e->lampu_rem == 1 ? 'Ok' : 'Tidak' }}
                        </td>
                        <td>
                            {{ $e->rem == 1 ? 'Ok' : 'Tidak' }}
                        </td>
                        <td>
                            {{ $e->sen_kanan == 1 ? 'Ok' : 'Tidak' }}
                        </td>
                        <td>
                            {{ $e->sen_kiri == 1 ? 'Ok' : 'Tidak' }}
                        </td>
                        <td>
                            {{ $e->klakson == 1 ? 'Ok' : 'Tidak' }}
                        </td>
                        <td>
                            {{ $e->safety_belt == 1 ? 'Ok' : 'Tidak' }}
                        </td>
                        


                        {{-- <td>{{ $e->lampu_penerangan == 1 ? 'Ya' : 'Tidak' }}</td> --}}
                        {{-- <td>{{ $e->lampu_rem == 1 ? 'Ya' : 'Tidak' }}</td> --}}
                        {{-- <td>{{ $e->rem == 1 ? 'Ya' : 'Tidak' }}</td> --}}
                        {{-- <td>{{ $e->sen_kanan == 1 ? 'Ya' : 'Tidak' }}</td> --}}
                        {{-- <td>{{ $e->sen_kiri == 1 ? 'Ya' : 'Tidak' }}</td> --}}
                        {{-- <td>{{ $e->klakson == 1 ? 'Ya' : 'Tidak' }}</td> --}}
                        {{-- <td>{{ $e->safety_belt == 1 ? 'Ya' : 'Tidak' }}</td> --}}
                        <td>{{ $e->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>

</html>
