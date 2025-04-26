@extends('layout.master')

@section('title', 'Input Data Kertas')

@section('content')
     <!-- page content -->
     <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Form Kertas</h3>
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
                            <form class="" action="/kertas/store" method="post" novalidate>
                               @csrf
                                <span class="section">Input Data Kertas</span>
                              
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Nama Kertas<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ old('jenis_kertas') }}" class="@error('jenis_kertas') parsley-error @enderror form-control" data-validate-length-range="6" data-validate-words="2" name="jenis_kertas" required="required" />
                                        @error('jenis_kertas')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror 
                                    </div>                                   
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Lokasi<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ old('lokasi') }}" class="@error('lokasi') parsley-error @enderror form-control" data-validate-length-range="6" data-validate-words="2" name="lokasi" required="required" />
                                        @error('lokasi')
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
                                            <a href="/kertas" class="btn btn-danger">Batal</a>
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