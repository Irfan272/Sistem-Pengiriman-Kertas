@extends('layout.master')

@section('title', 'Edit Data Pengecekan Mobil')

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit Data Pengecekan Mobil</h3>
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

                        <form action="/pengecekan/update/{{ $pengecekan->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <span class="section">Edit Data Pengecekan Mobil</span>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Supir<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select name="supir_id" id="supir_id" class="form-control selectpicker" data-live-search="true" required>
                                        <option readonly value="">Pilih Supir</option>
                                        @foreach($supir as $s)
                                            <option value="{{ $s->id }}" {{ $pengecekan->supir_id == $s->id ? 'selected' : '' }}>
                                                {{ $s->nama }}
                                            </option>
                                        @endforeach 
                                    </select>
                                </div>                                   
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Plat Mobil<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input value="{{ old('plat_mobil', $pengecekan->plat_mobil) }}" class="form-control" name="plat_mobil" required />
                                </div>                                   
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Pengecekan<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="date" value="{{ old('tanggal_pengecekan', $pengecekan->tanggal_pengecekan) }}" class="form-control" name="tanggal_pengecekan" required />
                                </div>                                   
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Shift Pengecekan<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select name="shift_pengecekan" class="form-control selectpicker" required>
                                        <option readonly value="">Pilih Shift</option>
                                        <option value="Pagi" {{ $pengecekan->shift_pengecekan == 'Pagi' ? 'selected' : '' }}>Pagi</option>
                                        <option value="Siang" {{ $pengecekan->shift_pengecekan == 'Siang' ? 'selected' : '' }}>Siang</option>
                                        <option value="Malam" {{ $pengecekan->shift_pengecekan == 'Malam' ? 'selected' : '' }}>Malam</option>
                                    </select>
                                </div>                                   
                            </div>

                            @php
                                $status_fields = ['alarm', 'lampu_penerangan', 'lampu_rem', 'rem', 'sen_kanan', 'sen_kiri', 'klakson', 'safety_belt'];
                            @endphp

                            @foreach($status_fields as $field)
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">{{ ucfirst(str_replace('_', ' ', $field)) }}<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="{{ $field }}" class="form-control selectpicker" required>
                                            <option readonly value="">Pilih Status</option>
                                            <option value="0" {{ $pengecekan->$field == 0 ? 'selected' : '' }}>Tidak</option>
                                            <option value="1" {{ $pengecekan->$field == 1 ? 'selected' : '' }}>Ya</option>
                                        </select>
                                    </div>                                   
                                </div>
                            @endforeach

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Bukti Video<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="@error('bukti_video') parsley-error @enderror form-control" data-validate-length-range="6" data-validate-words="2" name="bukti_video"  type="file"  />
                                    @error('bukti_video')
                                    <ul class="parsley-errors-list filled">
                                        <li class="parsley-required">{{ $message }}</li>
                                    </ul>   
                                    @enderror 
                                    @if($pengecekan->bukti_video)
                                        <p>File saat ini: <a href="{{ asset('storage/'.$pengecekan->bukti_video) }}" target="_blank">Lihat Video</a></p>
                                    @endif
                                </div>                                   
                            </div>

                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3">
                                        <button type='submit' class="btn btn-primary">Update</button>
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
