@extends('layout.master')

@section('title', 'Input Data Pengiriman')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Registrasi Pengiriman</h3>
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

                            <form action="/pengiriman/store" method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="supir_id">Supir</label>
                                    <select name="supir_id" id="supir_id" class="form-control selectpicker"
                                        data-live-search="true" required onchange="loadPengecekanMobil()">
                                        <option value="">Pilih Supir</option>
                                        @foreach ($supir as $s)
                                            <option value="{{ $s->id }}">{{ $s->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="pengecekan_mobil_id">Pengecekan Mobil</label>
                                    <select name="pengecekan_mobil_id" id="pengecekan_mobil_id"
                                        class="form-control selectpicker" data-live-search="true" required>
                                        <option value="">Pilih Pengecekan Mobil</option>
                                        {{-- Data pengecekan di-load lewat JavaScript, jadi kosong dulu --}}
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="shift">Shift</label>
                                    <select name="shift" class="form-control selectpicker" required>
                                        <option value="">Pilih Shift</option>
                                        <option value="Pagi">Pagi</option>
                                        <option value="Siang">Siang</option>
                                        <option value="Malam">Malam</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_pengiriman">Tanggal Pengiriman</label>
                                    <input type="date" name="tanggal_pengiriman" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="jam_masuk">Jam Masuk</label>
                                    <input type="time" id="jam_masuk" name="jam_masuk" class="form-control" required
                                        step="1">
                                </div>


                                <div class="form-group">
                                    <label for="jam_keluar">Jam Keluar</label>
                                    <input type="time" id="jam_keluar" name="jam_keluar" class="form-control" required step="1">
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select name="kertas_id[]" class="form-control selectpicker"
                                                    data-live-search="true" required onchange="getLokasi(this)">
                                                    <option value="">Pilih Kertas</option>
                                                    @foreach ($kertas as $k)
                                                        <option value="{{ $k->id }}">{{ $k->jenis_kertas }}</option>
                                                    @endforeach
                                                </select>

                                            </td>
                                            <td><input type="number" name="tonase_kg[]" class="form-control" required></td>
                                            <td><input type="number" name="ritase[]" class="form-control" required></td>
                                            <td><input type="text" name="lokasi[]" class="form-control" readonly
                                                    required></td>
                                            <td><button type="button" class="btn btn-danger btn-sm"
                                                    onclick="removeRow(this)">Hapus</button></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <button type="button" class="btn btn-primary" id="addRow">Tambah Detail Kertas</button>

                                <div class="form-group">
                                    <label for="user_1">Reviewer 1</label>
                                    <select name="user_1" id="user_1" class="form-control selectpicker"
                                        data-live-search="true" required>
                                        <option value="">Pilih Reviewer 1</option>
                                        @foreach ($user1 as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            
                                @if (Auth::guard('user')->user()->role == 'Kordinator Lapangan')
                                <div class="form-group">
                                    <label for="shift">Status Approval 1</label>
                                    <select name="status_approval_1" class="form-control selectpicker" >
                                        <option value="">Pilih Status</option>
                                        <option value="Approve">Approve</option>
                                        <option value="Reject">Reject</option>
                                    </select>
                                </div>
                               

                                <div class="form-group">
                                    <label for="remaks_1">Komentar Reviewer 1</label>
                                    <input type="text" name="remaks_1" class="form-control" >
                                </div>

                                @endif


                                <div class="form-group">
                                    <label for="user_1">Reviewer 2</label>
                                    <select name="user_2" id="user_2" class="form-control selectpicker"
                                        data-live-search="true" required>
                                        <option value="">Pilih Reviewer 2</option>
                                        @foreach ($user2 as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                @if (Auth::guard('user')->user()->role == 'Kepala Bagian')
                                <div class="form-group">
                                    <label for="shift">Status Approval 2</label>
                                    <select name="status_approval_2" class="form-control selectpicker" >
                                        <option value="">Pilih Status</option>
                                        <option value="Approve">Approve</option>
                                        <option value="Reject">Reject</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="remaks_2">Komentar Reviewer 2</label>
                                    <input type="text" name="remaks_2" class="form-control" >
                                </div>

                                @endif

                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-success">Simpan Pengiriman</button>
                                    <a href="/pengiriman" class="btn btn-danger">Batal</a>
                                </div>
                            </form>

                        </div>
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

        document.addEventListener('DOMContentLoaded', function() {
            function setCurrentTime() {
                const now = new Date();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');
                const currentTime = `${hours}:${minutes}:${seconds}`;
                document.getElementById('jam_masuk').value = currentTime;
                document.getElementById('jam_keluar').value = currentTime;
            }

            setCurrentTime();
            setInterval(setCurrentTime, 1000); // Update tiap detik

            document.getElementById('addRow').addEventListener('click', function() {
                var row = `
            <tr>
                <td>
                    <select name="kertas_id[]" class="form-control selectpicker" data-live-search="true" required onchange="getLokasi(this)">
                        <option value="">Pilih Kertas</option>
                        @foreach ($kertas as $k)
                            <option value="{{ $k->id }}">{{ $k->jenis_kertas }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="number" name="tonase_kg[]" class="form-control" required></td>
                <td><input type="number" name="ritase[]" class="form-control" required></td>
                <td><input type="text" name="lokasi[]" class="form-control" readonly required></td>
                <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
            </tr>
            `;
                document.querySelector('table tbody').insertAdjacentHTML('beforeend', row);
                $('.selectpicker').selectpicker('refresh'); // Bootstrap Select refresh
            });

            window.removeRow = function(button) {
                button.closest('tr').remove();
            }
        });

        function loadPengecekanMobil() {
            let supirId = document.getElementById('supir_id').value;
            let pengecekanSelect = document.querySelector('select[name="pengecekan_mobil_id"]');

            // Kosongkan dulu
            pengecekanSelect.innerHTML = '<option value="">Pilih Pengecekan Mobil</option>';

            if (supirId) {
                fetch(`/get-pengecekan-mobil?supir_id=${supirId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(function(pengecekan) {
                            let option = document.createElement('option');
                            option.value = pengecekan.id;
                            option.text = pengecekan.plat_mobil + ' (' + pengecekan.status + ')';
                            // Sesuaikan kalau nama field bukan 'status'
                            pengecekanSelect.appendChild(option);
                        });
                        $('.selectpicker').selectpicker('refresh'); // Refresh tampilan selectpicker
                    })
                    .catch(error => {
                        console.error('Error fetching pengecekan mobil:', error);
                    });
            }
        }
    </script>

@endsection
