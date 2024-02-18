<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class KategoriBukuController extends Controller
{
    public function index()
    {
        $kategoribuku = KategoriBuku::all();
        $buku = Buku::all();
        $kategori = Kategori::all();
        return view('admin.kategoribuku', compact('kategoribuku','buku','kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required',
            'kategori_id' => 'required',
        ]);

        KategoriBuku::create($request->all());

        return redirect()->route('kategori-buku.index')->with('success', 'Kategori buku berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kategoribuku = Buku::findOrFail($id);
        return view('admin.kategoribuku', compact('kategoribuku'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'buku_id' => 'required',
            'kategori_id' => 'required',
        ]);

        $kategoribuku = KategoriBuku::findOrFail($id);
        $kategoribuku->update($request->all());

        return redirect()->route('kategori-buku.index')->with('success', 'Kategori buku berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kategoribuku = KategoriBuku::findOrFail($id);
        $kategoribuku->delete();

        return redirect()->route('kategori-buku.index')->with('success', 'Kategori buku berhasil dihapus');
    }
}
