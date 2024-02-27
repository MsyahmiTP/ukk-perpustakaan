<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::all();
        return view('admin.buku', compact('buku'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');

        $result = Buku::where('judul', 'like', "%$query%")
            ->orWhereHas('kategoriBukuRelasi.kategori', function ($kategoriQuery) use ($query) {
                $kategoriQuery->where('nama_kategori', 'like', "%$query%");
            })
            ->orWhere('penulis', 'like', "%$query%")
            ->get();

        return view('pengguna.beranda', ['buku' => $result, 'query' => $query]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'foto' => 'image|nullable|mimes:png,jpg,gif|max:2048',
            'deskripsi' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
        ]);

        if($request->has('foto')){

            $file = $request->file('foto');
            $extension = $file->getClientOriginalName();

            $filename = $extension;

            $path = 'img/';
            $file->move($path, $filename);
        }

        Buku::create([
            'judul' => $request->judul,
            'foto' => $path.$filename,
            'deskripsi' => $request->deskripsi,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'stok' => $request->stok,
        ]);

        return redirect()->route('bukus.index')
            ->with('success', 'Buku created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'foto' => 'image|nullable|mimes:png,jpg,gif|max:2048',
            'deskripsi' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'stok' => 'required',
        ]);

        $buku = Buku::findOrFail($id);

        if ($request->has('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalName();
            $filename = $extension;
            $path = 'img/';
            $file->move($path, $filename);

            if ($buku->foto) {
                unlink(public_path($buku->foto));
            }

            $buku->update([
                'judul' => $request->judul,
                'foto' => $path.$filename,
                'deskripsi' => $request->deskripsi,
                'penulis' => $request->penulis,
                'penerbit' => $request->penerbit,
                'tahun_terbit' => $request->tahun_terbit,
                'stok' => $request->stok,
            ]);
        } else {
            $buku->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'penulis' => $request->penulis,
                'penerbit' => $request->penerbit,
                'tahun_terbit' => $request->tahun_terbit,
                'stok' => $request->stok,
            ]);
        }

        return redirect()->route('bukus.index');
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);

        if ($buku->foto) {
            unlink(public_path($buku->foto));
        }

        $buku->delete();

        return redirect()->route('bukus.index')
            ->with('success', 'Buku deleted successfully.');
    }
    public function bukuPDF()
    {
        $buku = Buku::all();
        $pdf = FacadePdf::loadView('admin.pdf.buku', compact('buku'));
        return $pdf->stream('Data Buku' . now()->format('d-m-Y'));
    }
}