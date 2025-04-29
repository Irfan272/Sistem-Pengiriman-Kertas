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

                        <form action="{{ route('pengecekan.update', $pengecekan->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <span class="section">Edit Data Pengecekan Mobil</span>

                            {{-- Supir --}}
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Supir <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select name="supir_id" id="supir_id" class="form-control" required>
                                        <option disabled selected value="">Pilih Supir</option>
                                        @foreach($supir as $s)
                                            <option value="{{ $s->id }}" {{ old('supir_id', $pengecekan->supir_id) == $s->id ? 'selected' : '' }}>
                                                {{ $s->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Plat Mobil --}}
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Plat Mobil <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input value="{{ old('plat_mobil', $pengecekan->plat_mobil) }}" type="text" name="plat_mobil" class="form-control" required />
                                </div>
                            </div>

                            {{-- Tanggal Pengecekan --}}
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Pengecekan <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="date" value="{{ old('tanggal_pengecekan', $pengecekan->tanggal_pengecekan) }}" name="tanggal_pengecekan" class="form-control" required />
                                </div>
                            </div>

                            {{-- Shift Pengecekan --}}
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Shift Pengecekan <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select name="shift_pengecekan" class="form-control" required>
                                        <option disabled selected value="">Pilih Shift</option>
                                        @foreach (['Pagi', 'Siang', 'Malam'] as $shift)
                                            <option value="{{ $shift }}" {{ old('shift_pengecekan', $pengecekan->shift_pengecekan) == $shift ? 'selected' : '' }}>
                                                {{ $shift }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Status Fields --}}
                            @php
                                $status_fields = ['alarm', 'lampu_penerangan', 'lampu_rem', 'rem', 'sen_kanan', 'sen_kiri', 'klakson', 'safety_belt'];
                            @endphp

                            @foreach($status_fields as $field)
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">{{ ucwords(str_replace('_', ' ', $field)) }} <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="{{ $field }}" class="form-control" required>
                                            <option disabled selected value="">Pilih Status</option>
                                            <option value="1" {{ old($field, $pengecekan->$field) == 1 ? 'selected' : '' }}>Ya</option>
                                            <option value="0" {{ old($field, $pengecekan->$field) == 0 ? 'selected' : '' }}>Tidak</option>
                                        </select>
                                    </div>
                                </div>
                            @endforeach

                            {{-- Bukti Video --}}
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Bukti Video <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="file" name="bukti_video" class="form-control @error('bukti_video') is-invalid @enderror" />
                                    @error('bukti_video')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if($pengecekan->bukti_video)
                                        <small>File saat ini: <a href="{{ asset('storage/'.$pengecekan->bukti_video) }}" target="_blank">Lihat Video</a></small>
                                    @endif
                                </div>
                            </div>

                            {{-- Submit Button --}}
                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="{{ route('pengecekan.index') }}" class="btn btn-danger">Batal</a>
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
