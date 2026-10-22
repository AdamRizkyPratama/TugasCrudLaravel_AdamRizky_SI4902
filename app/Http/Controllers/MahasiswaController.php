<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->query('cari');

        $mahasiswa = Mahasiswa::query()
            ->when($keyword, function ($query, $keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('nama', 'like', "%{$keyword}%")
                      ->orWhere('nim', 'like', "%{$keyword}%");
                });
            })
            ->latest()
            ->get();

        return view('index', compact('mahasiswa', 'keyword'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nim' => [
                'required',
                'string',
                'max:30',
                'unique:mahasiswas,nim',
            ],
            'nama' => ['required', 'string', 'max:255'],
            'angkatan' => [
                'required',
                'integer',
                'min:2000',
                'max:2100',
            ],
            'sks_lulus' => [
                'required',
                'integer',
                'min:0',
                'max:255',
            ],
            'status_keaktifan' => [
                'required',
                Rule::in(['Aktif', 'Tidak Aktif']),
            ],
            'gambar' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')
                ->store('foto-mahasiswa', 'public');
        }

        Mahasiswa::create($data);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $data = $request->validate([
            'nim' => [
                'required',
                'string',
                'max:30',
                Rule::unique('mahasiswas', 'nim')
                    ->ignore($mahasiswa->id),
            ],
            'nama' => ['required', 'string', 'max:255'],
            'angkatan' => [
                'required',
                'integer',
                'min:2000',
                'max:2100',
            ],
            'sks_lulus' => [
                'required',
                'integer',
                'min:0',
                'max:255',
            ],
            'status_keaktifan' => [
                'required',
                Rule::in(['Aktif', 'Tidak Aktif']),
            ],
            'gambar' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('gambar')) {
            if ($mahasiswa->gambar) {
                Storage::disk('public')->delete($mahasiswa->gambar);
            }

            $data['gambar'] = $request->file('gambar')
                ->store('foto-mahasiswa', 'public');
        }

        $mahasiswa->update($data);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        if ($mahasiswa->gambar) {
            Storage::disk('public')->delete($mahasiswa->gambar);
        }

        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    public function show(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        return view('detail', compact('mahasiswa'));
    }
}


