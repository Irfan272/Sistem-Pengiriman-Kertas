@extends('layout.master')

@section('title', 'Dashboard')

@section('content')
    <div class="right_col" role="main">
        <div class="col-lg-12">
            <div class="top_tiles">
                <h1 class="text-center mb-4">Selamat Datang Di <strong>SIPEDAU</strong></h1>
                <div class="row justify-content-center">

                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-4">
                        <div class="tile-stats d-flex justify-content-between align-items-center text-white p-3"
                            style="background-color: #007bff; border-radius: 10px;">
                            <div>
                                <h5>Pengecekan Mobil</h5>
                                <h3 class="text-white">{{ $pengecekanTotal }}</h3>
                            </div>
                            <i class="fa fa-truck fa-2x"></i>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-4">
                        <div class="tile-stats d-flex justify-content-between align-items-center text-white p-3"
                            style="background-color: #28a745; border-radius: 10px;">
                            <div>
                                <h5>Laporan Masuk</h5>
                                <h3 class="text-white">{{ $laporanDiterimaCounts['Selesai'] ?? 0 }}</h3>
                            </div>
                            <i class="fa fa-check-circle-o fa-2x" aria-hidden="true"></i>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-4">
                        <div class="tile-stats d-flex justify-content-between align-items-center text-white p-3"
                            style="background-color: #ffc107; border-radius: 10px;">
                            <div>
                                <h5>Laporan Proses</h5>
                                <h3 class="text-white">{{ $laporanDiprosesCounts['Menunggu'] ?? 0 }}</h3>
                            </div>
                            <i class="fa fa-hourglass-half fa-2x"></i>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-4">
                        <div class="tile-stats d-flex justify-content-between align-items-center text-white p-3"
                            style="background-color: #dc3545; border-radius: 10px;">
                            <div>
                                <h5>Laporan Ditolak</h5>
                                <h3 class="text-white">{{ $laporanDitolakCounts['Ditolak'] ?? 0 }}</h3>
                            </div>
                            <i class="fa fa-times-circle fa-2x"></i>
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">

                    <h2>Tabel Data <small>Pengiriman (Menunggu)</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">

                                <table id="datatable" class="table table-striped table-bordered " style="width:100%">
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
                                            <th style="width: 25%">Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @foreach ($pengirimanProses as $e)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $e->Supir->nama }}</td>
                                                <td>{{ $e->shift }}</td>
                                                <td>{{ $e->total_tonase }}</td>
                                                <td>{{ $e->total_ritase }}</td>
                                                <td>{{ $e->jam_masuk }}</td>
                                                <td>{{ $e->jam_keluar }}</td>
                                                {{-- <td>{{ $e->Pengecekan->status }}</td> --}}




                                                <td>{{ $e->status }}</td>
                                                <td style="text-align: left">
                                                    <a href="/pengiriman/view/{{ $e->id }}"
                                                        class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> </a>
                                                    <a href="/pengiriman/edit/{{ $e->id }}"
                                                        class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> </a>
                                                    <form action="/pengiriman/delete/{{ $e->id }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-xs"><i
                                                                class="fa fa-trash-o"></i> </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">

                    <h2>Tabel Data <small>Pengiriman (Ditolak)</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">

                                <table id="datatable" class="table table-striped table-bordered " style="width:100%">
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
                                            <th style="width: 25%">Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @foreach ($pengirimanProses as $e)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $e->Supir->nama }}</td>
                                                <td>{{ $e->shift }}</td>
                                                <td>{{ $e->total_tonase }}</td>
                                                <td>{{ $e->total_ritase }}</td>
                                                <td>{{ $e->jam_masuk }}</td>
                                                <td>{{ $e->jam_keluar }}</td>
                                                {{-- <td>{{ $e->Pengecekan->status }}</td> --}}




                                                <td>{{ $e->status }}</td>
                                                <td style="text-align: left">
                                                    <a href="/pengiriman/view/{{ $e->id }}"
                                                        class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> </a>
                                                    <a href="/pengiriman/edit/{{ $e->id }}"
                                                        class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> </a>
                                                    <form action="/pengiriman/delete/{{ $e->id }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-xs"><i
                                                                class="fa fa-trash-o"></i> </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
