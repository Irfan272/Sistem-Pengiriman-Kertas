@extends('layout.master')

@section('title', 'Data Pengecekan Mobi')

@section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="top_tiles">
                <h1>Data Pengecekan Mobi</h1>
            </div>

            <div class="col-md-12 col-sm-12 ">
               
                <div class="x_panel">
                    <div class="x_title">

                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif


                        <h2>Tabel Data <small>Pengecekan Mobi</small></h2>
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
                                                <th>Plat Mobil</th>
                                                <th>Tanggal Pengecekan</th>
                                                <th>Shift Pengecekan</th>
                                                <th>Status</th>
                                                <th>Link Video</th>
                                                {{-- <th style="width: 25%">Action</th> --}}
                                            </tr>
                                        </thead>


                                        <tbody>
                                            @foreach ($cek as $e)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $e->Supir->nama }}</td>
                                                    <td>{{ $e->Mobil->plat_mobil }}</td>
                                                    <td>{{ $e->tanggal_pengecekan }}</td>
                                                    <td>{{ $e->shift_pengecekan }}</td>
                                                   
                                                    <td>{{ $e->status }}</td>
                                                    <td><a href="{{ asset('storage/'.$e->bukti_video) }}" target="_blank">Lihat Video</a></td>
                                                    
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
        @endsection
