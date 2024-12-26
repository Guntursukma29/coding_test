@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1>Daftar Guru</h1>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createGuruModal">Tambah Guru</button>
        <div class="col grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="userTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guru as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            <!-- Button Detail -->
                                            <button class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#detailGuruModal{{ $item->id }}">Detail</button>

                                            <!-- Button Edit -->
                                            <button class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editGuruModal{{ $item->id }}">Edit</button>

                                            <!-- Button Delete -->
                                            <button class="btn btn-danger"
                                                onclick="confirmDelete({{ $item->id }})">Hapus</button>

                                            <!-- Form Delete -->
                                            <form id="deleteForm{{ $item->id }}"
                                                action="{{ route('guru.destroy', $item->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal Detail -->
                                    <div class="modal fade" id="detailGuruModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="detailGuruLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="detailGuruLabel">Detail Guru</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Nama:</strong> {{ $item->nama }}</p>
                                                    <p><strong>Email:</strong> {{ $item->email }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editGuruModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="editGuruLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form method="POST" action="{{ route('guru.update', $item->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editGuruLabel">Edit Guru</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="nama" class="form-label">Nama</label>
                                                            <input type="text" name="nama" class="form-control"
                                                                value="{{ $item->nama }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input type="email" name="email" class="form-control"
                                                                value="{{ $item->email }}" required>
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
                    <div class="modal fade" id="createGuruModal" tabindex="-1" aria-labelledby="createGuruLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <form method="POST" action="{{ route('guru.store') }}">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="createGuruLabel">Tambah Guru</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama</label>
                                            <input type="text" name="nama" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" required>
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
