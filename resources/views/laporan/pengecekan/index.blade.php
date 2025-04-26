@extends('layout.master')

@section('title', 'Laporan Pengecekan ')

@section('content')


<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Laporan Pengecekan </h3>
            </div>

          
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    
                    <div class="x_content">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                        {{-- <form action="/admin/barang_/store" method="post">
                            @csrf --}}
                            <div class="form-group">
                                <label for="supplier_id">Tanggal Awal:</label>
                 
                                <input type="date" name="tanggal_awal" id="tanggal_awal"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="supplier_id">Tanggal Akhir:</label>
                 
                                <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control">
                            </div>
                        
                            <div class="col-12 d-flex justify-content-end">
                                <a href="#" onclick="exportToExcel()" class="btn btn-success me-1 mb-1">Ekspor ke Excel</a>
                                <a href="" onclick="this.href='/cetak-laporan-pengecekan/'+ document.getElementById('tanggal_awal').value +
                                '/' + document.getElementById('tanggal_akhir').value " 
                                target="_blank" class="btn btn-primary me-1 mb-1">Cetak</a>
                            </div>
                
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include XLSX library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<script>
    function exportToExcel() {
        var tanggalAwal = document.getElementById('tanggal_awal').value;
        var tanggalAkhir = document.getElementById('tanggal_akhir').value;

        if (!tanggalAwal || !tanggalAkhir) {
            alert('Silakan pilih tanggal awal dan akhir.');
            return;
        }

        fetch(`/get-pengecekan-data?tanggal_awal=${tanggalAwal}&tanggal_akhir=${tanggalAkhir}`)
            .then(response => response.json())
            .then(data => {
                if (!data || !Array.isArray(data) || data.length === 0) {
                    alert('Tidak ada data untuk diekspor.');
                    return;
                }

                // Define headers
                const headers = [
                    "Supir",
                    "Plat Mobil",
                    "Tanggal Pengecekan",
                    "Alarm",
                    "Lampu Penerangan",
                    "Lampu Rem",
                    "Rem",
                    "Sen Kanan",
                    "Sen Kiri",
                    "Klakson",
                    "Safety Belt",
                    "Status"
                ];

                // Create a new worksheet
                const worksheet = XLSX.utils.json_to_sheet([]);

                // Add the headers to the worksheet
                XLSX.utils.sheet_add_aoa(worksheet, [headers]);

                // Add data to sheet
                XLSX.utils.sheet_add_json(worksheet, data, {
                    skipHeader: true,
                    origin: -1
                });

                // Get size of sheet
                const range = XLSX.utils.decode_range(worksheet["!ref"] ?? "");
                const rowCount = range.e.r;
                const columnCount = range.e.c;

                // Define border style
                const border = {
                    top: { style: "thin", color: { rgb: "000000" } },
                    bottom: { style: "thin", color: { rgb: "000000" } },
                    left: { style: "thin", color: { rgb: "000000" } },
                    right: { style: "thin", color: { rgb: "000000" } }
                };

                // Add formatting by looping through data in sheet
                for (let row = 0; row <= rowCount; row++) {
                    for (let col = 0; col <= columnCount; col++) {
                        const cellRef = XLSX.utils.encode_cell({ r: row, c: col });

                        // Apply border and other formatting to every cell
                        worksheet[cellRef].s = {
                            border: border,
                            alignment: {
                                horizontal: "left",
                                vertical: "center",
                                wrapText: true,
                            },
                        };

                        // Format headers: bold and centered
                        if (row === 0) {
                            worksheet[cellRef].s = {
                                ...worksheet[cellRef].s,
                                font: { bold: true },
                                alignment: {
                                    horizontal: "center",
                                    vertical: "center",
                                    wrapText: true,
                                },
                            };
                        }
                    }
                }

                // Create a new workbook and add the worksheet
                const wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, worksheet, "Laporan Pengecekan Order");

                // Write the workbook to a file
                XLSX.writeFile(wb, `Laporan_Pengecekan_${tanggalAwal}_to_${tanggalAkhir}.xlsx`);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengunduh data.');
            });
    }
</script>










    
@endsection
