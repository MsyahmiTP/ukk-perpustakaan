@extends('layouts.user')
@section('content')


<div class="mb-3">
    <div class="font-bold text-lg">Rekomendasi Buku</div>
   
</div>

{{-- <div class="grid grid-cols-6 gap-2">
    @foreach ($buku as $buku)
        <div class="bg-white border border-white shadow">
            <a href="{{ route('buku.show', $buku->id) }}">
                <img class="w-full h-[190px]" src="{{ asset($buku->foto) }}" alt="{{ $buku->foto }}"/>
            </a>
            <div class="p-3">
                <h5 class="mb-2 text-sm font-semibold tracking-tight text-gray-600">{{ $buku->penulis }}</h5>
                <p class="mb-2 text-sm font-semibold">{{ $buku->judul }}</p>
            </div>
        </div>
    @endforeach
</div> --}}

<div class="grid grid-cols-4 gap-1">
    @foreach ($buku as $buku)
        <div class=" bg-white border shadow ">
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
</div>



@endsection