@extends('layout.master')

@section('title', 'Input Data Supir')

@section('content')
     <!-- page content -->
     <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Form Supir</h3>
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

                            <form class="" action="/supir/store" method="post" novalidate>
                               @csrf
                                <span class="section">Input Data Supir</span>
                              
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">NIK<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ old('nik') }}" class="@error('nik') parsley-error @enderror form-control" data-validate-length-range="6" data-validate-words="2" name="nik" required="required" />
                                        @error('nik')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror 
                                    </div>                                   
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Nama<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ old('nama') }}" class="@error('nama') parsley-error @enderror form-control" data-validate-length-range="6" data-validate-words="2" name="nama" required="required" />
                                        @error('nama')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror 
                                    </div>                                   
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Alamat<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ old('alamat') }}" class="@error('alamat') parsley-error @enderror form-control" data-validate-length-range="6" data-validate-words="2" name="alamat" required="required" />
                                        @error('alamat')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror 
                                    </div>                                   
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Department<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="department_id" id="department_id" class="form-control selectpicker" data-live-search="true" required>
                                            <option readonly value="">Pilih Department</option>
                                            @foreach($department as $s)
                                            <option value="{{ $s->id }}">{{ $s->nama }}</option>
                                            @endforeach 
                                        </select>
                                    </div>                                   
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Telepon<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ old('telepon') }}" class="@error('telepon') parsley-error @enderror form-control" data-validate-length-range="6" data-validate-words="2" name="telepon" required="required" />
                                        @error('telepon')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror 
                                    </div>                                   
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">SIM<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ old('sim') }}" class="@error('sim') parsley-error @enderror form-control" data-validate-length-range="6" data-validate-words="2" name="sim" required="required" />
                                        @error('sim')
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
                                            <a href="/supir" class="btn btn-danger">Batal</a>
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