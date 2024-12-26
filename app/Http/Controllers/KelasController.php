<?php
namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Guru;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('guru', 'siswa')->get();
        $guru = Guru::all();
        return view('kelas.index', compact('kelas','guru'));
    }

    public function create()
    {
        $guru = Guru::all();
        return view('kelas.create', compact('guru'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'guru_id' => 'nullable|exists:guru,id',
        ]);

        // Simpan data kelas
        try {
            Kelas::create($validatedData);
            return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->route('kelas.index')->withErrors('Gagal menambahkan kelas. Coba lagi!');
        }
    }

    public function edit(Kelas $kelas)
    {
        $guru = Guru::all();
        return view('kelas.edit', compact('kelas', 'guru'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'nama_kelas' => 'required|string|max:255',
                'guru_id' => 'nullable|exists:guru,id',
            ]);
            $kelas->update($validatedData);
    
    
            return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diupdate!');
        } catch (\Exception $e) {
            // Log error
    
            return redirect()->route('kelas.index')
                ->withErrors('Gagal memperbarui kelas. Coba lagi!')
                ->withInput();
        }
    }



    public function destroy($id)
{
    // Temukan data kelas yang akan dihapus
    $kelas = Kelas::findOrFail($id);

    // Hapus data kelas
    $kelas->delete();

    // Redirect atau response setelah penghapusan
    return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus');
}

//     public function destroy(Kelas $kelas)
// {
//     try {
//         // Hapus kelas, guru_id akan diset menjadi NULL jika ada pengaturan onDelete('set null')
//         $kelas->delete(); // Menghapus kelas

//         return redirect()->route('kelas.index')->with('delete_success', 'Kelas berhasil dihapus!');
//     } catch (\Exception $e) {
//         return redirect()->route('kelas.index')->withErrors('Gagal menghapus kelas. Coba lagi!');
//     }
// }



}
