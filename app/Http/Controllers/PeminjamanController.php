<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::all();
        return view('admin.peminjaman', compact('peminjaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
        ]);

        $buku = Buku::find($request->buku_id);

        Peminjaman::create([
            'buku_id' => $request->buku_id,
            'users_id' => Auth::user()->id,
            'tgl_peminjaman' => now(),
            'status_peminjaman' => 'N'
        ]);

        $buku->stok = $buku->stok - 1;
        $buku->save();

        return redirect()->back();
        
    }
    

    public function update($id)
    {
        $peminjaman = Peminjaman::find($id);
        $peminjaman->tgl_pengembalian = now();
        $peminjaman->update(['status_peminjaman' => 'Y']);

        $buku = Buku::find($peminjaman->buku_id);
        $buku->stok = $buku->stok + 1;
        $buku->save();

        return redirect()->route('peminjaman.index');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('peminjaman.index');
    }

    public function peminjamanPDF()
    {
        $peminjaman = Peminjaman::all();
        $pdf = Pdf::loadView('admin.pdf.peminjaman', compact('peminjaman'));
        return $pdf->stream('Data Peminjaman' . now()->format('d-m-Y'));
    }
}
