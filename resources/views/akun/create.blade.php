@extends('layout.master')

@section('title', 'Input Data Akun')

@section('content')
     <!-- page content -->
     <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Form Akun</h3>
                </div>

              
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        
                        <div class="x_content">
                            <form class="" action="/akun/store" method="post" novalidate>
                               @csrf
                                <span class="section">Input Data Akun</span>
                                {{-- <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">NIK<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="number" value="{{ old('nik') }}" class="@error('nik') parsley-error @enderror form-control" data-validate-length-range="6" data-validate-words="2" name="nik" required="required" />
                                        @error('nik')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror 
                                    </div>
                                </div> --}}
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Username<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="text" value="{{ old('name') }}" class="@error('name') parsley-error @enderror form-control" data-validate-length-range="6" data-validate-words="2" name="name" required="required" />
                                        @error('name')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror 
                                    </div>
                                </div>
                                {{-- <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Nama Lengkap<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="text" value="{{ old('nama_lengkap') }}" class="@error('nama_lengkap') parsley-error @enderror form-control" data-validate-length-range="6" data-validate-words="2" name="nama_lengkap" required="required" />
                                        @error('nama_lengkap')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror 
                                    </div>
                                </div> --}}

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Email<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="email" value="{{ old('email') }}" class="@error('email') parsley-error @enderror form-control" data-validate-length-range="6" data-validate-words="2" name="email" required="required" />
                                        @error('email')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror 
                                    </div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Password<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="password" value="{{ old('password') }}" class="@error('password') parsley-error @enderror form-control" data-validate-length-range="6" data-validate-words="2" name="password" required="required" />
                                        @error('password')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror 
                                    </div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Role<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="role" id="role" class="form-control selectpicker" data-live-search="true"  required='required'>
                                            <option readonly value="">Pilih Role</option>                                      
                                            <option value="Operator">Operator</option>
                                            <option value="Kordinator Lapangan">Kordinator Lapangan</option>
                                            <option value="Kepala Bagian">Kepala Bagian</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="ln_solid">
                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-3">
                                            <button type='submit' class="btn btn-primary">Submit</button>
                                            <a href="/akun" class="btn btn-danger">Batal</a>
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