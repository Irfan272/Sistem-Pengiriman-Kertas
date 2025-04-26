@extends('layout.master')

@section('title', 'Data Supir')

@section('content')
    
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="top_tiles">
            <h1>Data Supir</h1>
          </div>

          <div class="col-md-12 col-sm-12 ">
              <a href="/supir/create" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah Data
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


                  <h2>Tabel Data <small>Supir</small></h2>
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
                        <th>NIK</th>
                        <th>Nama Supir</th>
                        <th>Alamat</th>
                        <th>Department</th>
                        <th>Telepon</th>
                        <th>SIM</th>
                        <th style="width: 25%">Action</th>
                      </tr>
                    </thead>


                    <tbody>
                      @foreach ($supir as $e)
                          
                      <tr >
                        <td >{{ $loop->iteration }}</td>
                        <td>{{ $e->nik }}</td>
                        <td>{{ $e->nama }}</td>
                        <td>{{ $e->alamat }}</td>
                        <td>{{ $e->Department->nama }}</td>
                        <td>{{ $e->telepon }}</td>
                        <td>{{ $e->sim }}</td>
                        <td style="text-align: left">
                          {{-- <a href="/supir/view/{{ $e->id }}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> </a> --}}
                          <a href="/supir/edit/{{ $e->id }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> </a>
                          <form action="/supir/delete/{{$e->id}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> </button>
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