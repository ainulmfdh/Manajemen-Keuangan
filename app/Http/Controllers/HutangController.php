<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Hutang;

class HutangController extends Controller
{
     public function index()
    {
        $hutangs = Hutang::where('user_id', Auth::id())
            ->orderBy('created_at', 'asc') // data terbaru di bawah
            ->paginate(10);
        return view('hutang.index', compact('hutangs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'alasan' => 'required|string|max:255',
            'penghutang' => 'required|string',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        Hutang::create($data); 

        return redirect()->back()->with('success', 'Hutang berhasil ditambahkan');
    }

    public function show($id)
    {
        $hutang = Hutang::where('user_id', Auth::id())->findOrFail($id);
        return response()->json($hutang);
    }

    public function edit($id)
    {
        $hutang = Hutang::findOrFail($id);
        return response()->json($hutang);
    }

    public function update(Request $request, $id)
    {
        $hutang = Hutang::findOrFail($id);
        $hutang->update([
            'tanggal'       => $request->tanggal,
            'jumlah'        => $request->jumlah,
            'alasan'        => $request->alasan,
            'penghutang'    => $request->penghutang,
        ]);
        return redirect()->route('hutang.index')->with('success', 'Data hutang berhasil diupdate!');
    }

    public function destroy($id)
    {
        $hutang = Hutang::where('user_id', Auth::id())->findOrFail($id);
        $hutang->delete();

        return response()->json(['success' => true]);
        return redirect()->route('hutang.index')->with('success', 'Data berhasil dihapus!');
    }
}
