<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::with('kelas')->get();
        return view('guru.index', compact('guru'));
    }

    public function create()
    {
        return view('guru.create');
    }

    public function store(Request $request)
    {
        Guru::create($request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:guru,email',
        ]));

        return redirect()->route('guru.index')->with('success', 'Guru berhasil ditambahkan!');
    }

    public function edit(Guru $guru)
    {
        return view('guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru)
    {
        $guru->update($request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:guru,email,' . $guru->id,
        ]));

        return redirect()->route('guru.index')->with('success', 'Guru berhasil diupdate!');
    }

    public function destroy(Guru $guru)
    {
        $guru->delete();
        return redirect()->route('guru.index')->with('delete_success', 'Data Guru berhasil dihapus!');
    }
}

