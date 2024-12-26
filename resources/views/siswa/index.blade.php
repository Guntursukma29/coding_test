@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1>Daftar Siswa</h1>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createSiswaModal">Tambah Siswa</button>
        <div class="col grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="userTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswa as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                                        <td>
                                            <!-- Button Detail -->
                                            <button class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#detailSiswaModal{{ $item->id }}">Detail</button>

                                            <!-- Button Edit -->
                                            <button class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editSiswaModal{{ $item->id }}">Edit</button>

                                            <!-- Button Delete -->
                                            <button class="btn btn-danger"
                                                onclick="confirmDelete({{ $item->id }})">Hapus</button>

                                            <!-- Form Delete -->
                                            <form id="deleteForm{{ $item->id }}"
                                                action="{{ route('siswa.destroy', $item->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal Detail -->
                                    <div class="modal fade" id="detailSiswaModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="detailSiswaLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="detailSiswaLabel">Detail Siswa</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Nama Siswa:</strong> {{ $item->nama }}</p>
                                                    <p><strong>Kelas:</strong> {{ $item->kelas->nama_kelas ?? '-' }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editSiswaModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="editSiswaLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form method="POST" action="{{ route('siswa.update', $item->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editSiswaLabel">Edit Siswa</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="nama" class="form-label">Nama Siswa</label>
                                                            <input type="text" name="nama" class="form-control"
                                                                value="{{ $item->nama }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="kelas_id" class="form-label">Kelas</label>
                                                            <select name="kelas_id" class="form-control">
                                                                <option value="">Pilih Kelas</option>
                                                                @foreach ($kelas as $k)
                                                                    <option value="{{ $k->id }}"
                                                                        {{ $item->kelas_id == $k->id ? 'selected' : '' }}>
                                                                        {{ $k->nama_kelas }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Modal Delete -->
                                    <div class="modal fade" id="deleteSiswaModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="deleteSiswaLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form method="POST" action="{{ route('siswa.destroy', $item->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteSiswaLabel">Hapus Siswa</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menghapus siswa
                                                            <strong>{{ $item->nama }}</strong>?
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Create -->
        <div class="modal fade" id="createSiswaModal" tabindex="-1" aria-labelledby="createSiswaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('siswa.store') }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createSiswaLabel">Tambah Siswa</h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Siswa</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="kelas_id" class="form-label">Kelas</label>
                                <select name="kelas_id" class="form-control">
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($kelas as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection
