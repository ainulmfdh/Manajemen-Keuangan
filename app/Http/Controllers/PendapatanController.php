<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendapatan;

class PendapatanController extends Controller
{
    public function index()
    {
        $pendapatans = Pendapatan::where('user_id', Auth::id())
            ->orderBy('created_at', 'asc') // data terbaru di bawah
            ->paginate(10);
        return view('pendapatan.index', compact('pendapatans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Pendapatan::create([
            ...$validated,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Pendapatan berhasil ditambahkan');
    }

    public function show($id)
    {
        $pendapatan = Pendapatan::where('user_id', Auth::id())->findOrFail($id);
        return response()->json($pendapatan);
    }

    public function edit($id)
    {
        $pendapatan = Pendapatan::findOrFail($id);
        return response()->json($pendapatan);
    }

    public function update(Request $request, $id)
    {
        $pendapatan = Pendapatan::findOrFail($id);
        $pendapatan->update([
            'tanggal'   => $request->tanggal,
            'jumlah'    => $request->jumlah,
            'kategori'  => $request->kategori,
            'deskripsi' => $request->deskripsi,
        ]);
        return redirect()->route('pendapatan.index')->with('success', 'Data pendapatan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $pendapatan = Pendapatan::where('user_id', Auth::id())->findOrFail($id);
        $pendapatan->delete();

        return response()->json(['success' => true]);
        return redirect()->route('pendapatan.index')->with('success', 'Data berhasil dihapus!');
    }
}
