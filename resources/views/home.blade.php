@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1>Dashboard</h1>
        <div class="col grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="userTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Guru</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswaList as $siswa)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $siswa->nama }}</td>
                                        <td>{{ $siswa->kelas->nama_kelas }}</td>
                                        <td>{{ $siswa->kelas->guru->nama }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
