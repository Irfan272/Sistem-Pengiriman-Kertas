@extends('layout.master')

@section('title', 'Input Data Supir Mobil')

@section('content')
     <!-- page content -->
     <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Form Pengecekan Mobil</h3>
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

                            <form class="" action="/pengecekan/store" method="post" novalidate enctype="multipart/form-data">
                               @csrf
                                <span class="section">Input Data Pengecekan Mobil</span>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Supir<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="supir_id" id="supir_id" class="form-control selectpicker" data-live-search="true" required>
                                            <option readonly value="">Pilih Supir</option>
                                            @foreach($supir as $s)
                                            <option value="{{ $s->id }}">{{ $s->nama }}</option>
                                            @endforeach 
                                        </select>
                                    </div>                                   
                                </div>
                              
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Plat Mobil<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ old('plat_mobil') }}" class="@error('plat_mobil') parsley-error @enderror form-control" data-validate-length-range="6" data-validate-words="2" name="plat_mobil" required="required" />
                                        @error('plat_mobil')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror 
                                    </div>                                   
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Tanggal Pengecekan<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ old('tanggal_pengecekan') }}" class="@error('tanggal_pengecekan') parsley-error @enderror form-control" data-validate-length-range="6" data-validate-words="2" type="date" name="tanggal_pengecekan" required="required" />
                                        @error('tanggal_pengecekan')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror 
                                    </div>                                   
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Shift Pengecekan<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="shift_pengecekan" id="shift_pengecekan" class="form-control selectpicker" required>
                                            <option readonly value="">Pilih Shift</option>
                                           
                                            <option value="Pagi">Pagi</option>
                                            <option value="Siang">Siang</option>
                                            <option value="Malam">Malam</option>
                                     
                                        </select>
                                    </div>                                   
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Alarm<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="alarm" id="alarm" class="form-control selectpicker" required>
                                            <option readonly value="">Pilih Status</option>
                                           
                                            <option value="0">Tidak</option>
                                            <option value="1">Ya</option>
                                     
                                        </select>
                                    </div>                                   
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Lampu Penerangan<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="lampu_penerangan" id="lampu_penerangan" class="form-control selectpicker" required>
                                            <option readonly value="">Pilih Status</option>
                                           
                                            <option value="0">Tidak</option>
                                            <option value="1">Ya</option>
                                     
                                        </select>
                                    </div>                                   
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Lampu Rem<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="lampu_rem" id="lampu_rem" class="form-control selectpicker" required>
                                            <option readonly value="">Pilih Status</option>
                                           
                                            <option value="0">Tidak</option>
                                            <option value="1">Ya</option>
                                     
                                        </select>
                                    </div>                                   
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Rem<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="rem" id="rem" class="form-control selectpicker" required>
                                            <option readonly value="">Pilih Status</option>
                                           
                                            <option value="0">Tidak</option>
                                            <option value="1">Ya</option>
                                     
                                        </select>
                                    </div>                                   
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Sen Kanan<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="sen_kanan" id="sen_kanan" class="form-control selectpicker" required>
                                            <option readonly value="">Pilih Status</option>
                                           
                                            <option value="0">Tidak</option>
                                            <option value="1">Ya</option>
                                     
                                        </select>
                                    </div>                                   
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Sen Kiri<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="sen_kiri" id="sen_kiri" class="form-control selectpicker" required>
                                            <option readonly value="">Pilih Status</option>
                                           
                                            <option value="0">Tidak</option>
                                            <option value="1">Ya</option>
                                     
                                        </select>
                                    </div>                                   
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Klakson<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="klakson" id="klakson" class="form-control selectpicker" required>
                                            <option readonly value="">Pilih Status</option>
                                           
                                            <option value="0">Tidak</option>
                                            <option value="1">Ya</option>
                                     
                                        </select>
                                    </div>                                   
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Safety Belt<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="safety_belt" id="safety_belt" class="form-control selectpicker" required>
                                            <option readonly value="">Pilih Status</option>
                                           
                                            <option value="0">Tidak</option>
                                            <option value="1">Ya</option>
                                     
                                        </select>
                                    </div>                                   
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Bukti Video<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ old('bukti_video') }}" class="@error('bukti_video') parsley-error @enderror form-control" data-validate-length-range="6" data-validate-words="2" name="bukti_video"  type="file" required="required" />
                                        @error('bukti_video')
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
                                            <a href="/pengecekan" class="btn btn-danger">Batal</a>
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