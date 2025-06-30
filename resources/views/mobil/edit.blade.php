@extends('layout.master')

@section('title', 'Edit Data Mobil')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit Data Mobil</h3>
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

                        <form action="/mobil/update/{{ $mobil->id }}" method="POST" novalidate>
                            @csrf
                            @method('PATCH')
                            <span class="section">Edit Data Mobil</span>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Plat Mobil<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" name="plat_mobil" value="{{ old('plat_mobil', $mobil->plat_mobil) }}" required="required" class="form-control @error('plat_mobil') parsley-error @enderror" />
                                    @error('plat_mobil')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Merk<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" name="merk" value="{{ old('merk', $mobil->merk) }}" required="required" class="form-control @error('merk') parsley-error @enderror" />
                                    @error('merk')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Tipe</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" name="tipe" value="{{ old('tipe', $mobil->tipe) }}" class="form-control @error('tipe') parsley-error @enderror" />
                                    @error('tipe')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Warna</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" name="warna" value="{{ old('warna', $mobil->warna) }}" class="form-control @error('warna') parsley-error @enderror" />
                                    @error('warna')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Tahun</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="number" name="tahun" value="{{ old('tahun', $mobil->tahun) }}" class="form-control @error('tahun') parsley-error @enderror" />
                                    @error('tahun')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Status<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select name="status" class="form-control" required>
                                        <option value="aktif" {{ old('status', $mobil->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="tidak aktif" {{ old('status', $mobil->status) == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                        <option value="rusak" {{ old('status', $mobil->status) == 'rusak' ? 'selected' : '' }}>Rusak</option>
                                    </select>
                                    @error('status')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>
                                    @enderror
                                </div>
                            </div>

                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3">
                                        <button type='submit' class="btn btn-primary">Update</button>
                                        <a href="/mobil" class="btn btn-danger">Batal</a>
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
