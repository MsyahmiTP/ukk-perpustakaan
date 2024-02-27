@extends('layouts.user')
@section('content')

<div class="mb-3">
    <div class="font-bold text-lg">Rekomendasi Buku</div>
</div>

<form action="{{ route('bukus.search') }}" method="GET" class="mb-4">
    <div class="relative">
        <input type="search" id="search" name="search" class="block w-full p-2 text-sm border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari Berdasarkan Judul, Kategori Dan Penulis" required />
        <button type="submit" class="absolute top-0 right-0 px-3 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
    </div>
</form>

<div class="grid grid-cols-4 gap-1">
    @if(isset($buku) && $buku->count() > 0)
        @foreach ($buku as $buku)
            <div class="bg-white border shadow">
                <div class="flex ml-2 mt-2 mb-2">
                    <div class="">
                        <a href="{{ route('buku.show', $buku->id) }}" class="bg-white block">
                            <img class="w-auto h-[120px]" src="{{ asset($buku->foto) }}" alt="{{ $buku->foto }}" />
                        </a>              
                    </div>
                    <div class="ml-2">
                        <div class="">
                            <p class="text-base font-semibold">{{ $buku->judul }}</p>                   
                        </div>
                        @foreach ($buku->kategoriBukuRelasi as $kategoriBuku)
                            <span class="px-2 py-1 mb-1 text-xs font-medium text-center text-white bg-teal-400 rounded-lg hover:bg-teal-500">{{ $kategoriBuku->kategori->nama_kategori }}</span>
                        @endforeach
                        <h5 class="text-sm font-semibold tracking-tight text-gray-600">{{ $buku->penulis }}</h5>
                    </div>
                </div>
            </div>
            
        @endforeach
    @else
        <p class="text-gray-500">Tidak Ada Buku</p>
    @endif
</div>
@endsection
