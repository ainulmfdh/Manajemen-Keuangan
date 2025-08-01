<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengeluaran;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluarans = Pengeluaran::where('user_id', Auth::id())
            ->orderBy('created_at', 'asc') // data terbaru di bawah
            ->paginate(10);
        return view('pengeluaran.index', compact('pengeluarans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Pengeluaran::create([
            ...$validated,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Pengeluaran berhasil ditambahkan');
    }

     public function edit($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        return response()->json($pengeluaran);
    }

    public function update(Request $request, $id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->update([
            'tanggal'   => $request->tanggal,
            'jumlah'    => $request->jumlah,
            'kategori'  => $request->kategori,
            'deskripsi' => $request->deskripsi,
        ]);
        return redirect()->route('pengeluaran.index')->with('success', 'Data pengeluaran berhasil diupdate!');
    }

    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::where('user_id', Auth::id())->findOrFail($id);
        $pengeluaran->delete();

        return response()->json(['success' => true]);
    }
}
