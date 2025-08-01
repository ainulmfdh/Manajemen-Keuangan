<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Karyawan;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::where('user_id', Auth::id())
            ->orderBy('created_at', 'asc') // data terbaru di bawah
            ->paginate(10);
        return view('karyawan.index', compact('karyawans'));
    }

    public function create()
    {
        return view('karyawan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'umur' => 'required|integer|min:18|max:99',
            'kontak' => 'required|string|max:255',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        Karyawan::create($data); 

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambah!');
    }

     public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return response()->json($karyawan);
    }

    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->update([
            'nama'      => $request->nama,
            'posisi'    => $request->posisi,
            'alamat'    => $request->alamat,
            'umur'      => $request->umur,
            'kontak'    => $request->kontak,
        ]);
        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $karyawan = karyawan::where('user_id', Auth::id())->findOrFail($id);
        $karyawan->delete();

        return response()->json(['success' => true]);
    }
}
