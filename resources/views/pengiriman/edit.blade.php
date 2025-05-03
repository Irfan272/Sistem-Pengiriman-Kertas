@extends('layout.master')

@section('title', 'Edit Data Pengiriman')

@section('content')
    <div class="right_col" role="main">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit Pengiriman</h3>
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

                        <form action="{{ route('pengiriman.update', $pengiriman->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label for="supir_id">Supir</label>
                                <select name="supir_id" id="supir_id" class="form-control selectpicker"
                                    data-live-search="true" required onchange="loadPengecekanMobil()"
                                    @if (Auth::guard('user')->user()->role == 'Kordinator Lapangan' || Auth::guard('user')->user()->role == 'Kepala Bagian') disabled @endif>
                                    <option value="">Pilih Supir</option>
                                    @foreach ($supir as $s)
                                        <option value="{{ $s->id }}"
                                            {{ $pengiriman->supir_id == $s->id ? 'selected' : '' }}>
                                            {{ $s->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @if (Auth::guard('user')->user()->role == 'Kordinator Lapangan' || Auth::guard('user')->user()->role == 'Kepala Bagian')
                                    <input type="hidden" name="supir_id" value="{{ $pengiriman->supir_id }}">
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="pengecekan_mobil_id">Pengecekan Mobil</label>
                                @if (Auth::guard('user')->user()->role == 'Operator')
                                    <select name="pengecekan_mobil_id" id="pengecekan_mobil_id"
                                        class="form-control selectpicker" data-live-search="true">
                                        <option value="">Memuat data...</option>
                                    </select>
                                @endif

                                @if (Auth::guard('user')->user()->role == 'Kordinator Lapangan' || Auth::guard('user')->user()->role == 'Kepala Bagian')
                                    <select name="pengecekan_mobil_id" id="pengecekan_mobil_ids"
                                        class="form-control selectpicker" data-live-search="true" disabled>
                                        <option value="">Pilih Mobil</option>
                                        @foreach ($pengecekan as $s)
                                            <option value="{{ $s->id }}"
                                                {{ $pengiriman->pengecekan_mobil_id == $s->id ? 'selected' : '' }}>
                                                {{ $s->plat_mobil }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="pengecekan_mobil_id"
                                        value="{{ $pengiriman->pengecekan_mobil_id }}">
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="shift">Shift</label>
                                <select name="shift" class="form-control selectpicker" required
                                    @if (Auth::guard('user')->user()->role == 'Kordinator Lapangan' || Auth::guard('user')->user()->role == 'Kepala Bagian') disabled @endif>
                                    <option value="">Pilih Shift</option>
                                    <option value="Pagi" {{ $pengiriman->shift == 'Pagi' ? 'selected' : '' }}>Pagi
                                    </option>
                                    <option value="Siang" {{ $pengiriman->shift == 'Siang' ? 'selected' : '' }}>Siang
                                    </option>
                                    <option value="Malam" {{ $pengiriman->shift == 'Malam' ? 'selected' : '' }}>Malam
                                    </option>
                                </select>
                                @if (Auth::guard('user')->user()->role == 'Kordinator Lapangan' || Auth::guard('user')->user()->role == 'Kepala Bagian')
                                    <input type="hidden" name="shift" value="{{ $pengiriman->shift }}">
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="tanggal_pengiriman">Tanggal Pengiriman</label>
                                <input type="date" name="tanggal_pengiriman" class="form-control"
                                    value="{{ $pengiriman->tanggal_pengiriman }}" required
                                    @if (Auth::guard('user')->user()->role == 'Kordinator Lapangan' || Auth::guard('user')->user()->role == 'Kepala Bagian') readonly @endif>
                            </div>

                            <div class="form-group">
                                <label for="jam_masuk">Jam Masuk</label>
                                <input type="time" id="jam_masuk" name="jam_masuk" class="form-control"
                                    value="{{ $pengiriman->jam_masuk }}" step="1"
                                    @if (Auth::guard('user')->user()->role == 'Kordinator Lapangan' || Auth::guard('user')->user()->role == 'Kepala Bagian') readonly @endif>
                            </div>

                            <div class="form-group">
                                <label for="jam_keluar">Jam Keluar</label>
                                <input type="time" id="jam_keluar" name="jam_keluar" class="form-control"
                                    value="{{ $pengiriman->jam_keluar }}" step="1"
                                    @if (Auth::guard('user')->user()->role == 'Kordinator Lapangan' || Auth::guard('user')->user()->role == 'Kepala Bagian') readonly @endif>
                            </div>

                            <hr>
                            <h4>Detail Kertas yang Dikirim:</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Kertas</th>
                                        <th>Tonase (Kg)</th>
                                        <th>Ritase</th>
                                        <th>Lokasi</th>
                                        @if (Auth::guard('user')->user()->role == 'Operator')
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($details as $detail)
                                        <tr>
                                            <td>
                                                <select name="kertas_id[]" class="form-control selectpicker"
                                                    data-live-search="true" required onchange="getLokasi(this)"
                                                    @if (Auth::guard('user')->user()->role == 'Kordinator Lapangan' || Auth::guard('user')->user()->role == 'Kepala Bagian') disabled @endif>
                                                    <option value="">Pilih Kertas</option>
                                                    @foreach ($kertas as $k)
                                                        <option value="{{ $k->id }}"
                                                            {{ $detail->kertas_id == $k->id ? 'selected' : '' }}>
                                                            {{ $k->jenis_kertas }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if (Auth::guard('user')->user()->role == 'Kordinator Lapangan' || Auth::guard('user')->user()->role == 'Kepala Bagian')
                                                    <input type="hidden" name="kertas_id[]"
                                                        value="{{ $detail->kertas_id }}">
                                                @endif
                                            </td>
                                            <td><input type="number" name="tonase_kg[]" class="form-control"
                                                    value="{{ $detail->tonase_kg }}" required
                                                    @if (Auth::guard('user')->user()->role == 'Kordinator Lapangan' || Auth::guard('user')->user()->role == 'Kepala Bagian') readonly @endif></td>
                                            <td><input type="number" name="ritase[]" class="form-control"
                                                    value="{{ $detail->ritase }}" required
                                                    @if (Auth::guard('user')->user()->role == 'Kordinator Lapangan' || Auth::guard('user')->user()->role == 'Kepala Bagian') readonly @endif></td>
                                            <td><input type="text" name="lokasi[]" class="form-control"
                                                    value="{{ $detail->lokasi }}" readonly required></td>
                                            @if (Auth::guard('user')->user()->role == 'Operator')
                                                <td><button type="button" class="btn btn-danger btn-sm"
                                                        onclick="removeRow(this)">Hapus</button></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @if (Auth::guard('user')->user()->role == 'Operator')
                                <button type="button" class="btn btn-primary" id="addRow">Tambah Detail Kertas</button>
                            @endif

                            {{-- Reviewer 1 --}}
                            <div class="form-group">
                                <label for="user_1">Reviewer 1</label>
                                <select name="user_1" class="form-control selectpicker" data-live-search="true" required
                                    @if (Auth::guard('user')->user()->role == 'Kordinator Lapangan' || Auth::guard('user')->user()->role == 'Kepala Bagian') disabled @endif>
                                    <option value="">Pilih Reviewer 1</option>
                                    @foreach ($user1 as $s)
                                        <option value="{{ $s->id }}"
                                            {{ $pengiriman->user_1 == $s->id ? 'selected' : '' }}>
                                            {{ $s->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if (Auth::guard('user')->user()->role == 'Kordinator Lapangan' || Auth::guard('user')->user()->role == 'Kepala Bagian')
                                    <input type="hidden" name="user_1" value="{{ $pengiriman->user_1 }}">
                                @endif
                            </div>

                            @if (Auth::guard('user')->user()->role == 'Kordinator Lapangan' || Auth::guard('user')->user()->role == 'Kepala Bagian')
                                <div class="form-group">
                                    <label for="status_approval_1">Status Approval 1</label>
                                    <select name="status_approval_1" class="form-control selectpicker"
                                        @if (Auth::guard('user')->user()->role == 'Kepala Bagian') disabled @endif>
                                        <option value="">Pilih Status</option>
                                        <option value="Approve"
                                            {{ $pengiriman->status_approval_1 == 'Approve' ? 'selected' : '' }}>Approve
                                        </option>
                                        <option value="Reject"
                                            {{ $pengiriman->status_approval_1 == 'Reject' ? 'selected' : '' }}>Reject
                                        </option>
                                    </select>
                                    @if (Auth::guard('user')->user()->role == 'Kepala Bagian')
                                        <input type="hidden" name="status_approval_1"
                                            value="{{ $pengiriman->status_approval_1 }}">
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="remaks_1">Komentar Reviewer 1</label>
                                    <input type="text" name="remaks_1" class="form-control"
                                        value="{{ $pengiriman->remaks_1 }}"
                                        @if (Auth::guard('user')->user()->role == 'Kepala Bagian') readonly @endif>
                                </div>
                            @endif

                            {{-- Reviewer 2 --}}
                            <div class="form-group">
                                <label for="user_2">Reviewer 2</label>
                                <select name="user_2" class="form-control selectpicker" data-live-search="true"
                                    @if (Auth::guard('user')->user()->role == 'Kordinator Lapangan' || Auth::guard('user')->user()->role == 'Kepala Bagian') disabled @endif>
                                    <option value="">Pilih Reviewer 2</option>
                                    @foreach ($user2 as $s)
                                        <option value="{{ $s->id }}"
                                            {{ $pengiriman->user_2 == $s->id ? 'selected' : '' }}>
                                            {{ $s->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if (Auth::guard('user')->user()->role == 'Kordinator Lapangan' || Auth::guard('user')->user()->role == 'Kepala Bagian')
                                    <input type="hidden" name="user_2" value="{{ $pengiriman->user_2 }}">
                                @endif
                            </div>

                            @if (Auth::guard('user')->user()->role == 'Kordinator Lapangan' || Auth::guard('user')->user()->role == 'Kepala Bagian')
                                <div class="form-group">
                                    <label for="status_approval_2">Status Approval 2</label>
                                    <select name="status_approval_2" class="form-control selectpicker"
                                        @if (Auth::guard('user')->user()->role == 'Kordinator Lapangan') disabled @endif>
                                        <option value="">Pilih Status</option>
                                        <option value="Approve"
                                            {{ $pengiriman->status_approval_2 == 'Approve' ? 'selected' : '' }}>Approve
                                        </option>
                                        <option value="Reject"
                                            {{ $pengiriman->status_approval_2 == 'Reject' ? 'selected' : '' }}>Reject
                                        </option>
                                    </select>
                                    @if (Auth::guard('user')->user()->role == 'Kordinator Lapangan')
                                        <input type="hidden" name="status_approval_2"
                                            value="{{ $pengiriman->status_approval_2 }}">
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="remaks_2">Komentar Reviewer 2</label>
                                    <input type="text" name="remaks_2" class="form-control"
                                        value="{{ $pengiriman->remaks_2 }}"
                                        @if (Auth::guard('user')->user()->role == 'Kordinator Lapangan') readonly @endif>
                                </div>
                            @endif

                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-success">Update Pengiriman</button>
                                <a href="/pengiriman" class="btn btn-danger">Batal</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function getLokasi(selectElement) {
            let kertasId = selectElement.value;
            let lokasiInput = selectElement.closest('tr').querySelector('input[name="lokasi[]"]');

            if (kertasId) {
                fetch(`/kertas/${kertasId}/lokasi`)
                    .then(response => response.json())
                    .then(data => {
                        lokasiInput.value = data.lokasi || '';
                    })
                    .catch(err => {
                        console.error('Gagal mengambil lokasi:', err);
                        lokasiInput.value = '';
                    });
            } else {
                lokasiInput.value = '';
            }
        }

        function loadPengecekanMobil(supirId, selectedId = null) {
            const pengecekanSelect = document.getElementById('pengecekan_mobil_id');
            pengecekanSelect.innerHTML = '<option value="">Pilih Pengecekan Mobil</option>';

            const url = new URL('/get-pengecekan-mobil', window.location.origin);
            if (supirId) url.searchParams.append('supir_id', supirId);

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.length) {
                        data.forEach(item => {
                            const option = document.createElement('option');
                            option.value = item.id;
                            option.text = `${item.plat_mobil} (${item.status})`;
                            if (selectedId && selectedId == item.id) {
                                option.selected = true;
                            }
                            pengecekanSelect.appendChild(option);
                        });
                    } else {
                        pengecekanSelect.innerHTML = '<option value="">Tidak ada pengecekan</option>';
                    }
                    $('.selectpicker').selectpicker('refresh');
                })
                .catch(error => console.error('Error:', error));
        }

        function setCurrentTime() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const currentTime = `${hours}:${minutes}:${seconds}`;
            document.getElementById('jam_masuk').value = currentTime;
            document.getElementById('jam_keluar').value = currentTime;
        }

        document.addEventListener('DOMContentLoaded', function() {
            setCurrentTime();
            setInterval(setCurrentTime, 1000);
            const supirId = document.getElementById('supir_id').value;
            const selectedPengecekanId = "{{ old('pengecekan_mobil_id', $pengiriman->pengecekan_mobil_id) }}";

            loadPengecekanMobil(supirId, selectedPengecekanId);


            document.getElementById('addRow').addEventListener('click', function() {
                const tbody = document.querySelector('table tbody');

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>
                        <select name="kertas_id[]" class="form-control selectpicker" data-live-search="true" required>
                            <option value="">Pilih Kertas</option>
                            @foreach ($kertas as $k)
                                <option value="{{ $k->id }}">{{ $k->jenis_kertas }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="tonase_kg[]" class="form-control" required></td>
                    <td><input type="number" name="ritase[]" class="form-control" required></td>
                    <td><input type="text" name="lokasi[]" class="form-control" readonly required></td>
                    <td><button type="button" class="btn btn-danger btn-sm remove-btn">Hapus</button></td>
                `;

                tbody.appendChild(row);
                $('.selectpicker').selectpicker('refresh');

                row.querySelector('select[name="kertas_id[]"]').addEventListener('change', function() {
                    getLokasi(this);
                });

                row.querySelector('.remove-btn').addEventListener('click', function() {
                    row.remove();
                });
            });

            document.getElementById('supir_id').addEventListener('change', function() {
                const newSupirId = this.value;
                loadPengecekanMobil(newSupirId); // tanpa selectedId karena data baru
            });

        });
    </script>



@endsection
