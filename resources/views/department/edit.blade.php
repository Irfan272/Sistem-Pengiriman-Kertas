@extends('layout.master')

@section('title', 'Edit Data Department')

@section('content')
     <!-- page content -->
     <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Form Department</h3>
                </div>

              
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="x_content">
                            <form action="/department/update/{{ $department->id }}" method="post" novalidate>
                                @csrf
                                @method('PATCH')
                                <span class="section">Edit Data Department</span>
                                
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Nama Department<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ $department->nama }}" class="@error('nama') parsley-error @enderror form-control" name="nama" required="required" />
                                        @error('nama')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror 
                                    </div>
                                </div>
                            
                                <div class="ln_solid">
                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-3">
                                            <button type='submit' class="btn btn-primary">Submit</button>
                                            <a href="/department" class="btn btn-danger">Batal</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection