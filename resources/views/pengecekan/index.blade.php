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
                <a href="/pengecekan/create" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah Data
                </a>
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
                                                <th>Alarm</th>
                                                <th>Lampu Penerangan</th>
                                                <th>Lampu Rem</th>
                                                <th>Rem</th>
                                                <th>Sen Kanan</th>
                                                <th>Sen Kiri</th>
                                                <th>Klakson</th>
                                                <th>Safety Belt</th>
                                                <th>Status</th>
                                                <th style="width: 25%">Action</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            @foreach ($cek as $e)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $e->Supir->nama }}</td>
                                                    <td>{{ $e->plat_mobil }}</td>
                                                    <td>{{ $e->tanggal_pengecekan }}</td>
                                                    <td>{{ $e->shift_pengecekan }}</td>
                                                    <td>
                                                        @if ($e->alarm == 1)
                                                            <i class="bi bi-check-circle-fill text-success"
                                                                style="font-size: 1.5rem;"></i>
                                                        @else
                                                            <i class="bi bi-x-circle-fill text-danger"
                                                                style="font-size: 1.5rem;"></i>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($e->lampu_penerangan == 1)
                                                            <i class="bi bi-check-circle-fill text-success"
                                                                style="font-size: 1.5rem;"></i>
                                                        @else
                                                            <i class="bi bi-x-circle-fill text-danger"
                                                                style="font-size: 1.5rem;"></i>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($e->lampu_rem == 1)
                                                            <i class="bi bi-check-circle-fill text-success"
                                                                style="font-size: 1.5rem;"></i>
                                                        @else
                                                            <i class="bi bi-x-circle-fill text-danger"
                                                                style="font-size: 1.5rem;"></i>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($e->rem == 1)
                                                            <i class="bi bi-check-circle-fill text-success"
                                                                style="font-size: 1.5rem;"></i>
                                                        @else
                                                            <i class="bi bi-x-circle-fill text-danger"
                                                                style="font-size: 1.5rem;"></i>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($e->sen_kanan == 1)
                                                            <i class="bi bi-check-circle-fill text-success"
                                                                style="font-size: 1.5rem;"></i>
                                                        @else
                                                            <i class="bi bi-x-circle-fill text-danger"
                                                                style="font-size: 1.5rem;"></i>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($e->sen_kiri == 1)
                                                            <i class="bi bi-check-circle-fill text-success"
                                                                style="font-size: 1.5rem;"></i>
                                                        @else
                                                            <i class="bi bi-x-circle-fill text-danger"
                                                                style="font-size: 1.5rem;"></i>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($e->klakson == 1)
                                                            <i class="bi bi-check-circle-fill text-success"
                                                                style="font-size: 1.5rem;"></i>
                                                        @else
                                                            <i class="bi bi-x-circle-fill text-danger"
                                                                style="font-size: 1.5rem;"></i>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($e->safety_belt == 1)
                                                            <i class="bi bi-check-circle-fill text-success"
                                                                style="font-size: 1.5rem;"></i>
                                                        @else
                                                            <i class="bi bi-x-circle-fill text-danger"
                                                                style="font-size: 1.5rem;"></i>
                                                        @endif
                                                    </td>


                                                    {{-- <td>{{ $e->lampu_penerangan == 1 ? 'Ya' : 'Tidak' }}</td> --}}
                                                    {{-- <td>{{ $e->lampu_rem == 1 ? 'Ya' : 'Tidak' }}</td> --}}
                                                    {{-- <td>{{ $e->rem == 1 ? 'Ya' : 'Tidak' }}</td> --}}
                                                    {{-- <td>{{ $e->sen_kanan == 1 ? 'Ya' : 'Tidak' }}</td> --}}
                                                    {{-- <td>{{ $e->sen_kiri == 1 ? 'Ya' : 'Tidak' }}</td> --}}
                                                    {{-- <td>{{ $e->klakson == 1 ? 'Ya' : 'Tidak' }}</td> --}}
                                                    {{-- <td>{{ $e->safety_belt == 1 ? 'Ya' : 'Tidak' }}</td> --}}
                                                    <td>{{ $e->status }}</td>
                                                    <td style="text-align: left">
                                                        <a href="/pengecekan/view/{{ $e->id }}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> </a>
                                                        <a href="/pengecekan/edit/{{ $e->id }}"
                                                            class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> </a>
                                                        <form action="/pengecekan/delete/{{ $e->id }}" method="POST"
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
        @endsection
