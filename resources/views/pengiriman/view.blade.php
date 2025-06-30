@extends('layout.master')

@section('title', 'View Data Pengiriman')

@section('content')
    @php
        $readonly = true; // Semua role hanya bisa melihat (readonly)
    @endphp
    <div class="right_col" role="main">
        <div class="page-title">
            <div class="title_left">
                <h3>View Pengiriman</h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form>
                            <div class="form-group">
                                <label for="supir_id">Supir</label>
                                <select id="supir_id" class="form-control selectpicker" data-live-search="true" disabled>
                                    <option value="">Pilih Supir</option>
                                    @foreach ($supir as $s)
                                        <option value="{{ $s->id }}" {{ $pengiriman->supir_id == $s->id ? 'selected' : '' }}>{{ $s->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="pengecekan_mobil_id">Pengecekan Mobil</label>
                                <select id="pengecekan_mobil_id" class="form-control selectpicker" data-live-search="true" disabled>
                                    @foreach ($pengecekan as $s)
                                        <option value="{{ $s->id }}" {{ $pengiriman->pengecekan_mobil_id == $s->id ? 'selected' : '' }}>{{ $s->mobil->plat_mobil }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="shift">Shift</label>
                                <input type="text" class="form-control" value="{{ $pengiriman->shift }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_pengiriman">Tanggal Pengiriman</label>
                                <input type="date" class="form-control" value="{{ $pengiriman->tanggal_pengiriman }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="jam_masuk">Jam Masuk</label>
                                <input type="time" class="form-control" value="{{ $pengiriman->jam_masuk }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="jam_keluar">Jam Keluar</label>
                                <input type="time" class="form-control" value="{{ $pengiriman->jam_keluar }}" readonly>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($details as $detail)
                                        <tr>
                                            <td>
                                                <select class="form-control selectpicker" data-live-search="true" disabled>
                                                    @foreach ($kertas as $k)
                                                        <option value="{{ $k->id }}" {{ $detail->kertas_id == $k->id ? 'selected' : '' }}>{{ $k->jenis_kertas }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="number" class="form-control" value="{{ $detail->tonase_kg }}" readonly></td>
                                            <td><input type="number" class="form-control" value="{{ $detail->ritase }}" readonly></td>
                                            <td><input type="text" class="form-control" value="{{ $detail->lokasi }}" readonly></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="form-group">
                                <label for="user_1">Reviewer 1</label>
                                <select class="form-control selectpicker" data-live-search="true" disabled>
                                    @foreach ($user1 as $s)
                                        <option value="{{ $s->id }}" {{ $pengiriman->user_1 == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="status_approval_1">Status Approval 1</label>
                                <input type="text" class="form-control" value="{{ $pengiriman->status_approval_1 }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="remaks_1">Komentar Reviewer 1</label>
                                <input type="text" class="form-control" value="{{ $pengiriman->remaks_1 }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="user_2">Reviewer 2</label>
                                <select class="form-control selectpicker" data-live-search="true" disabled>
                                    @foreach ($user2 as $s)
                                        <option value="{{ $s->id }}" {{ $pengiriman->user_2 == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="status_approval_2">Status Approval 2</label>
                                <input type="text" class="form-control" value="{{ $pengiriman->status_approval_2 }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="remaks_2">Komentar Reviewer 2</label>
                                <input type="text" class="form-control" value="{{ $pengiriman->remaks_2 }}" readonly>
                            </div>

                            <a href="/pengiriman" class="btn btn-secondary">Kembali</a>
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
                            const platMobil = item.mobil?.plat_mobil || 'Plat tidak tersedia';
                            option.value = item.id;
                            option.text = `${platMobil} (${item.status})`;

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
