@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1>Daftar Kelas</h1>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createKelasModal">Tambah Kelas</button>

        <div class="col grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="userTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kelas</th>
                                    <th>Guru</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kelas as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->nama_kelas }}</td>
                                        <td>{{ $item->guru->nama ?? '-' }}</td>
                                        <td>
                                            <!-- Button Detail -->
                                            <button class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#detailKelasModal{{ $item->id }}">Detail</button>

                                            <!-- Button Edit -->
                                            <button class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editKelasModal{{ $item->id }}">Edit</button>

                                            <!-- Button Delete -->
                                            <button class="btn btn-danger"
                                                onclick="confirmDelete({{ $item->id }})">Hapus</button>

                                            <!-- Form Delete -->
                                            <form id="deleteForm{{ $item->id }}"
                                                action="{{ route('kelas.destroy', $item->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal Detail -->
                                    <div class="modal fade" id="detailKelasModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="detailKelasLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="detailKelasLabel">Detail Kelas</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Nama Kelas:</strong> {{ $item->nama_kelas }}</p>
                                                    <p><strong>Guru:</strong> {{ $item->guru->nama ?? '-' }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editKelasModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="editKelasLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form method="POST" action="{{ route('kelas.update', $item->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editKelasLabel">Edit Kelas</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="nama_kelas" class="form-label">Nama Kelas</label>
                                                            <input type="text" name="nama_kelas" class="form-control"
                                                                value="{{ $item->nama_kelas }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="guru_id" class="form-label">Guru</label>
                                                            <select name="guru_id" class="form-control">
                                                                <option value="">Pilih Guru</option>
                                                                @foreach ($guru as $g)
                                                                    <option value="{{ $g->id }}"
                                                                        {{ $item->guru_id == $g->id ? 'selected' : '' }}>
                                                                        {{ $g->nama }}
                                                                    </option>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal Create -->
                    <div class="modal fade" id="createKelasModal" tabindex="-1" aria-labelledby="createKelasLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <form method="POST" action="{{ route('kelas.store') }}">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="createKelasLabel">Tambah Kelas</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="nama_kelas" class="form-label">Nama Kelas</label>
                                            <input type="text" name="nama_kelas" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="guru_id" class="form-label">Guru</label>
                                            <select name="guru_id" class="form-control">
                                                <option value="">Pilih Guru</option>
                                                @foreach ($guru as $g)
                                                    <option value="{{ $g->id }}">{{ $g->nama }}</option>
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
                </div>
            </div>
        </div>
    </div>
@endsection
