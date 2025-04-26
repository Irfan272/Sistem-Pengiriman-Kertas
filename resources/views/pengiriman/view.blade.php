@extends('layout.master')

@section('title', 'View Data Pengecekan Mobil')

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>View Data Pengecekan Mobil</h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_content">
                        <span class="section">View Data Pengecekan Mobil</span>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Supir</label>
                            <div class="col-md-6 col-sm-6">
                                <select class="form-control selectpicker" disabled>
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
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Plat Mobil</label>
                            <div class="col-md-6 col-sm-6">
                                <input value="{{ old('plat_mobil', $pengecekan->plat_mobil) }}" class="form-control" readonly />
                            </div>                                   
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Pengecekan</label>
                            <div class="col-md-6 col-sm-6">
                                <input type="date" value="{{ old('tanggal_pengecekan', $pengecekan->tanggal_pengecekan) }}" class="form-control" readonly />
                            </div>                                   
                        </div>

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Shift Pengecekan</label>
                            <div class="col-md-6 col-sm-6">
                                <select class="form-control selectpicker" disabled>
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
                                <label class="col-form-label col-md-3 col-sm-3 label-align">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="form-control selectpicker" disabled>
                                        <option readonly value="">Pilih Status</option>
                                        <option value="0" {{ $pengecekan->$field == 0 ? 'selected' : '' }}>Tidak</option>
                                        <option value="1" {{ $pengecekan->$field == 1 ? 'selected' : '' }}>Ya</option>
                                    </select>
                                </div>                                   
                            </div>
                        @endforeach

                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Bukti Video</label>
                            <div class="col-md-6 col-sm-6">
                                @if($pengecekan->bukti_video)
                                    <p>File saat ini: <a href="{{ asset('storage/'.$pengecekan->bukti_video) }}" target="_blank">Lihat Video</a></p>
                                @else
                                    <p>Tidak ada video</p>
                                @endif
                            </div>                                   
                        </div>

                        <div class="ln_solid">
                            <div class="form-group">
                                <div class="col-md-6 offset-md-3">
                                    <a href="/pengecekan" class="btn btn-danger">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
